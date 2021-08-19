<?php

namespace App\Http\Controllers;

use App\Http\Requests\changeemailrequest;
use App\Models\aidrequest;
use App\Models\genre;
use App\Models\platform;
use App\Models\profile;
use App\Models\User;
use App\Rules\buypoints;
use App\Rules\enoughpoints;
use BTCPayServer\Buyer;
use BTCPayServer\Currency;
use BTCPayServer\Invoice;
use BTCPayServer\Item;
use BTCPayServer\Storage\EncryptedFilesystemStorage;
use BTCPayServer\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addpoints(Request $request)
    { if(Auth::user()->ban==1)
        return view('banned');
        $key_dir = public_path( '/btcpay_token');
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
        $buyer->setEmail(Auth::user()->email);
// See 002.php for explanation
#$storageEngine = new \BTCPayServer\Storage\EncryptedFilesystemStorage('YourTopSecretPassword'); // Password may need to be updated if you changed it

// ---------------------------
        /**
         * The last object that must be injected is the token object.
         */





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
        // request()->validate(
        //      [
        //         'points'=>['required']
        //     ]
        //   );
        //   $this->validate($request, ['points' => new buypoints()]);
        //  $u= user::find(Auth::user()->id);
        // $u->points=$u->points+$request->points  ;
        //  $u->save();
    }

    public function aidrequest(Request $request)
    {

        request()->validate(
            [
                'name' => ['required'],
                'gameplay' => 'required',
                'numberoftesters' => 'required'
            ]
        );
        aidrequest::create([
            'User_id' => Auth::user()->id,
            'name' => $request->name,
            'website' => $request->website,
            'socialmedia' => $request->social_media,
            'gameplay' => $request->gameplay,
            'playersnum' => $request->numberoftesters
        ]);
        return redirect()->back()->with('success', 'aid request sent, please wait while our team check your request');
    }

    public function changeemail(request $request)
    {
        $request->validate([
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'current_password' => 'required'
            ]
        );
        $user = User::find(Auth::user()->id);
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('fail', 'wrong password');
        }
        $user->email = $request->email;
        $user->save();
        $user->sendEmailVerificationNotification();
        return redirect()->back();
    }

    public function createprofile(request $request)
    {
        $request->validate([
            'country' => 'required',
            'date_of_birth' => 'required|before:2008-1-1|after:1950-1-1',
            'sex' => 'required',
            'native_language' => 'required',
            'secondary_lanuguage' => 'required',
            'platform' => 'required',
            'secondary_platform' => 'required',
            'genres' => 'required'

        ]);
        if(Auth::user()->ban==1)
            return view('banned');
        profile::create([
            'user_id' => Auth::user()->id,
            'country' => $request->country,
            'gender' => $request->sex,
            'DOB' => $request->date_of_birth . ' 00:00:00',
            'native_language' => $request->native_language,
            'secondary_language' => $request->secondary_lanuguage,
            'platform' => $request->platform,
            'secondary_platform' => $request->secondary_platform,
            'genres' => $request->genres
        ]);

        return redirect('/')->with('success', 'profile created succesfully');
    }

    public function skipprofile(request $request)
    {
        $user = Auth::user();
        $user->skipped_profile = '1';
        $user->save();


        return redirect('/');
    }

    public function showaccount(request $request)
    {
        if(Auth::user()->ban==1)
            return view('banned');
        if (AUTH::user()->profile()->exists()) {
            $profile=AUTH::user()->profile()->with('platform','secondaryplatform')->first();
            $genres=genre::all();
            return view('profile.profile',[
                'profile'=>$profile,
                    'genres'=>$genres,
                    'p'=>platform::all()
                ]
            );
        }
        else {
            $genres = genre::all();
            return view('profile.createprofile', [
                'genres' => $genres,
                'platforms' => platform::all()
            ]);
        }
    }

    public function updateemail(request $request)
    {
        $request->validate([
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'current_password' => 'required',
                'email_confirmation' => 'required'
            ]
        );
        if ($request->email_confirmation != $request->email) {
            return redirect()->back()->with('error', 'email and email confirmation must match');
        }
        $user = User::find(Auth::user()->id);
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('fail', 'wrong password');
        }
        $user->email_verified_at=null;
        $user->email = $request->email;
        $user->save();
        $user->sendEmailVerificationNotification();
        return redirect()->back()->with('success', 'email change succesfully, please check your email for confirmation');
    }


    public function updatepassword(request $request)
    {
        $request->validate( [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)],
            'password_confirmation'=>'required'
        ]);
        $user = User::find(Auth::user()->id);
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('fail', 'wrong password');
        }
        if($request->password!=$request->password_confirmation)
        {
            return redirect()->back()->with('fail', 'password and password confirmation must match');
        }
        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();
        return redirect()->back()->with('success','password updated succesfully');
    }
    public function updateprofile(request $request)
    {
        $request->validate([
            'platform' => 'required',
            'secondary_platform' => 'required',
            'genres' => 'required'

        ]);
        $profile=profile::where('user_id',Auth::user()->id);
        $profile->update([
            'platform' => $request->platform,
            'secondary_platform' => $request->secondary_platform,
            'genres' => $request->genres
        ]);

        return redirect()->back()->with('success', 'profile created succesfully');
    }
}
