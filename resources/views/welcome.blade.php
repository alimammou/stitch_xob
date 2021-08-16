
    <div class="divMainSec dMSHero">
        <div class="divCustomContainer">
            <div class="divHero">
                <div class="divHVideo"><iframe allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/s5GoSzoC5J0" class="vidHV" width="100%" height="100%"></iframe></div>
                <div class="divHContent">
                    <h2 class="headingHC">What's Stitch?</h2>
                    <p class="paraHC">It's a game-testing platform that connects game-developers with play-testers, where developers reward testers with points, used to acquire premium games, when they submit quality feedback and bug reports.</p><a class="btn btnHC" role="button" href="/about">Learn more</a>
                </div>
            </div>
        </div>
    </div>
    <div class="divMainSec">
        <div class="divCustomContainer">
            <div class="divMSTitle">
                <div class="divMSLine"></div>
                <h2 class="headingMSText">Tests</h2>
                <div class="divMSLineRight"></div>
            </div>
            <div class="divGridMain">


                @foreach($tests as $test)
                    @if($test->test)
                <div class="divGMCard">
                    <div class="divGMCImg"><img class="imgGMCI" src="{{asset($test->test->pathtothumbnail)}}"></div>
                    <div class="divGMContent">
                        <h5 class="headingGMC">{{$test->test->title}}</h5>
                        <div class="divGMCDetails"><i class="{{$test->test->platform->class}} iconGMCD"></i>@if($test->test->rewardpool>0)<i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i>@endif</div>
                        <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="tests/{{$test->test->id}}">View</a></div>
                    </div>
                </div>
                    @endif
                @endforeach
            </div>
            <div class="divGMButton"><a class="btn btnMain btnMainFull btnMainFullSmall" role="button" href="/tests">View more</a></div>
        </div>
    </div>
    <div class="divMainSec">
        <div class="divCustomContainer">
            <div class="divMSTitle">
                <div class="divMSLine"></div>
                <h2 class="headingMSText">Store</h2>
                <div class="divMSLineRight"></div>
            </div>
            <div class="divGridMain">


                @foreach($stores as $store)
                    @if($store->storeitems)
                <div class="divGMCard">
                    <div class="divGMCImg"><img class="imgGMCI" src="{{asset($store->storeitems->pathtothumbnail)}}"></div>
                    <div class="divGMContent">
                        <h5 class="headingGMC">{{$store->storeitems->title}}<br></h5>
                        <div class="divGMCDetails"><i class="{{$store->storeitems->platform->class}} iconGMCD"></i></div>
                        <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="/store/{{$store->storeitems->id}}">{{$store->storeitems->price*10*$price->rate}}</a></div>
                    </div>
                </div>
                    @endif
                @endforeach
            </div>
            <div class="divGMButton"><a class="btn btnMain btnMainFull btnMainFullSmall" role="button" href="/store">View more</a></div>
        </div>
    </div>




