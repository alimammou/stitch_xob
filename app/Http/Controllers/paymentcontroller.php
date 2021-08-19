<?php

namespace App\Http\Controllers;

use App\Models\bugreport;
use App\Models\knownbugs;
use BTCPayServer\Buyer;
use BTCPayServer\Client\Adapter\CurlAdapter;
use BTCPayServer\Client\Client;
use BTCPayServer\Currency;
use BTCPayServer\Invoice;
use BTCPayServer\Item;
use BTCPayServer\PrivateKey;
use BTCPayServer\PublicKey;
use BTCPayServer\SinKey;
use BTCPayServer\Storage\EncryptedFilesystemStorage;
use BTCPayServer\Token;
use Illuminate\Http\Request;

class paymentcontroller extends Controller
{
    public function boot()
    {
        $key_dir = public_path( '/btcpay_token');
        $privateKey = PrivateKey::create($key_dir . '/btcpay.pri')->generate();
        $publicKey = new PublicKey($key_dir . '/btcpay.pub');
        $publicKey->setPrivateKey($privateKey);
        $publicKey->generate();
        $storageEngine = new EncryptedFilesystemStorage('TopSecretPassword');
        $storageEngine->persist($privateKey);
        $storageEngine->persist($publicKey);
    }
    public function pair()
    {
        $key_dir = public_path( '/btcpay_token');
        $storageEngine = new EncryptedFilesystemStorage('TopSecretPassword');
        $privateKey = $storageEngine->load($key_dir . '/btcpay.pri');
        $publicKey = $storageEngine->load($key_dir . '/btcpay.pub');
        $client = new Client();
        $adapter = new CurlAdapter();
        $client->setPrivateKey($privateKey);
        $client->setPublicKey($publicKey);
        $client->setUri('https://payment.stitch.games');
        $client->setAdapter($adapter);
        $pairingCode = 'rtf4399';
        $sin = new SinKey(public_path( '/btcpay_token/sin.key'));
        $sin->setPublicKey($publicKey);
        $sin->generate();
#$sin = \BTCPayServer\SinKey::create()->setPublicKey($publicKey)->generate();
        error_log('$pairingCode: ' . $pairingCode);
        error_log('$sin: ' . $sin);
        $facade = 'merchant';
        if (!$facade):
            try {
                $token = $client->createToken(array(
                    'pairingCode' => $pairingCode,
                    'label' => 'description',
                    'id' => (string)$sin,

                ));
            } catch (\Exception $e) {
                echo "Exception occured: " . $e->getMessage() . PHP_EOL;
                echo "Pairing failed. Please check whether you're trying to pair a production pairing code on test." . PHP_EOL;
                $request = $client->getRequest();
                $response = $client->getResponse();
                echo (string)$request . PHP_EOL . PHP_EOL . PHP_EOL;
                echo (string)$response . PHP_EOL . PHP_EOL;
                exit(1); // We do not want to continue if something went wrong
            }
            $persistThisValue = $token->getToken();
            echo 'Token obtained: ' . $persistThisValue . PHP_EOL;
        endif;
        if ($facade == 'merchant' || $facade == 'payroll'):
            try {
                $token = $client->createToken(array(
                    'facade' => $facade,
                    'label' => 'label this token',
                    'id' => (string)$sin,
                    'port'=>443
                ));
                echo "<pre>";
                var_dump($token);
                echo "</pre>";
                $pairingCode = $token->GetpairingCode();
                $url = 'https://payment.stitch.games/api-access-request?pairingCode=' . $pairingCode;
                echo "\n$url";
                echo "\n";
                echo 'Token obtained: ' . $token->getToken() . PHP_EOL;
            } catch (\Exception $e) {
                echo "Exception occured: " . $e->getMessage() . PHP_EOL;
                echo "Pairing failed. Please check whether you're trying to pair a production pairing code on test." . PHP_EOL;
                $request = $client->getRequest();
                $response = $client->getResponse();
                echo (string)$request . PHP_EOL . PHP_EOL . PHP_EOL;
                echo (string)$response . PHP_EOL . PHP_EOL;


                exit(1); // We do not want to continue if something went wrong

            }
        endif;
    }

    public function createinvoice()
    {
        $key_dir = public_path( '/btcpay_token');

// See 002.php for explanation
#$storageEngine = new \BTCPayServer\Storage\EncryptedFilesystemStorage('YourTopSecretPassword'); // Password may need to be updated if you changed it
        $storageEngine = new EncryptedFilesystemStorage('TopSecretPassword');
        $privateKey = $storageEngine->load($key_dir . '/btcpay.pri');
        $publicKey = $storageEngine->load($key_dir . '/btcpay.pub');
        $client = new \BTCPayServer\Client\Client();
//$network       = new \BTCPayServer\Network\Testnet();
        $adapter = new \BTCPayServer\Client\Adapter\CurlAdapter();
        $client->setPrivateKey($privateKey);
        $client->setPublicKey($publicKey);
        $client->setUri('https://payment.stitch.games:443');
        $client->setAdapter($adapter);
// ---------------------------
        /**
         * The last object that must be injected is the token object.
         */

        $token = new Token();
        $token->setToken('4YgBgCtqixswnobx8mV2CbpeCWEJ94zAEngjoCdntuJe'); // UPDATE THIS VALUE
        /**
         * Token object is injected into the client
         */
        $client->setToken($token);
        /**
         * This is where we will start to create an Invoice object, make sure to check
         * the InvoiceInterface for methods that you can use.
         */
        $invoice = new Invoice();

        $buyer = new Buyer();
        $buyer->setEmail('ali.moumou.a.m@gmail.com');

// Add the buyers info to invoice
        $invoice->setBuyer($buyer);

        /**
         * Item is used to keep track of a few things
         */
        $item = new Item();
        $item->setCode('skuNumber')->setDescription('General Description of Item')->setPrice('0.5');
        $invoice->setItem($item);

        /**
         * BitPay supports multiple different currencies. Most shopping cart applications
         * and applications in general have defined set of currencies that can be used.
         * Setting this to one of the supported currencies will create an invoice using
         * the exchange rate for that currency.
         *
         * @see https://test.bitpay.com/bitcoin-exchange-rates for supported currencies
         */
        $invoice->setCurrency(new Currency('USD'));
// Configure the rest of the invoice
        $invoice->setOrderId('OrderIdFromYourSystem')
            // You will receive IPN's at this URL, should be HTTPS for security purposes!
            ->setNotificationUrl('https://store.example.com/bitpay/callback');
        /**
         * Updates invoice with new information such as the invoice id and the URL where
         * a customer can view the invoice.
         */
        try {
          //  echo "Creating invoice at BitPay now." . PHP_EOL;
            $client->createInvoice($invoice);
        } catch (\Exception $e) {
            echo "Exception occured: " . $e->getMessage() . PHP_EOL;
            $request = $client->getRequest();
            $response = $client->getResponse();
            echo (string)$request . PHP_EOL . PHP_EOL . PHP_EOL;
            echo (string)$response . PHP_EOL . PHP_EOL;
            exit(1); // We do not want to continue if something went wrong
        }
echo   $invoice->getUrl() ;
        return redirect($invoice->getUrl());
//        echo 'Invoice "' . $invoice->getId() . '" created, see ' . $invoice->getUrl() . PHP_EOL;
     //   echo "Verbose details." . PHP_EOL;
    //    print_r($invoice);
    }
    public function getinvoice()
    {
        $client = new Client();
        $adapter = new CurlAdapter();
        $client->setUri('https://payment.stitch.games');
        $client->setAdapter($adapter);

        $token = new Token();
        $token->setToken('4YgBgCtqixswnobx8mV2CbpeCWEJ94zAEngjoCdntuJe'); // UPDATE THIS VALUE
        $client->setToken($token);

        /**
         * This is where we will fetch the invoice object
         */
        $invoice = $client->getInvoice("XDtjFErY9pbjN2A8MJrcJA");
        $request = $client->getRequest();
        $response = $client->getResponse();
        echo (string)$request . PHP_EOL . PHP_EOL . PHP_EOL;
        echo (string)$response . PHP_EOL . PHP_EOL;

        print_r($invoice);
    }
    public function save(Request $request)
    {
         $request;
        $rrequest=json_encode($request);
        knownbugs::create([
            'tests_id'=>1,
            'text'=>$rrequest
        ]);

    }
}

