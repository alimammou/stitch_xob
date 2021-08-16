<x-app-layout>
    <x-slot name="header">
        @if(Auth::check())

            <li class="nav-item navItem nIUser" id="showThisOnceLoggedIn">
                <div class="nav-item dropdown DDNavItem"><a class="dropdown-toggle linkDLUserNav" aria-expanded="false" data-toggle="dropdown" href="#">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu menuDL">
                        <div class="divUserInfoNav">
                            <p class="dUINPara">Rank:&nbsp;<span class="dUINPSpan">Bronze</span></p>
                        </div><a class="dropdown-item mDLItem" href="/account">Account</a>
                        <a class="dropdown-item mDLItem" href="/notification">Notifications</a>
                        <a class="dropdown-item mDLItem mDLITomato" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>

        @else
            <li class="nav-item navItem nIUser" id="removeThisOnceLoggedIn"><a class="nav-link linkNL LNLUser" href="/register">Login/Register</a></li>     @endif
    </x-slot>
    <div class="divAboutHero">
        <div class="divCustomContainer">
            <div class="dAH"><img class="dAHImg" src="assets/img/Stitch%20Logo.png">
                <h1 class="dAHHeading"><span class="dAHHSpan">STITCH</span>, CONNECTING <span class="dAHHSpan">GAME-DEVELOPERS</span>&nbsp;WITH <span class="dAHHSpan">PLAY-TESTERS</span>.</h1>
            </div>
        </div>
    </div>
    <div class="divMainContent">
        <div class="divCustomContainer">
            <div class="divAbout">
                <div class="divATop">
                    <div class="divHVideo"><iframe allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/s5GoSzoC5J0" class="vidHV" width="100%" height="100%"></iframe></div>
                    <div class="divHContent">
                        <h2 class="headingHC">What's Stitch?</h2>
                        <p class="paraHC">It's a game-testing platform that connects game-developers with play-testers, where developers reward testers with points, used to acquire premium games, when they submit quality feedback and bug reports.</p>
                    </div>
                </div>
                <div class="divADivider"></div>
                <div class="divAContent dACGrid">
                    <div class="dACG"><i class="fas fa-user-astronaut" style="text-align: center;font-size: 100px;padding: 20px;"></i>
                        <h2 class="dACGHeading">Developers</h2>
                        <p class="dACGPara">Start receiving quality-focused feedback and bug reports for your games, as you review and rate them while rewarding your play-testers with points to spend on premium games.</p>
                    </div>
                    <div class="dACG"><i class="fas fa-user-injured" style="text-align: center;font-size: 100px;padding: 20px;"></i>
                        <h2 class="dACGHeading">Testers</h2>
                        <p class="dACGPara">Get earlier access to games, play-test and send in your feedback, then get rewarded with points to spend on obtaining premium games.</p>
                    </div>
                </div>
                <div class="divADivider"></div>
                <div class="divAContent"><i class="fas fa-coins" style="text-align: center;font-size: 100px;padding: 20px;"></i>
                    <h2 class="dACGHeading">What's are the costs?</h2>
                    <p class="dACGPara">Almost everything is free, from making an account, creating game tests, signing up for tests, sending and receiving feedback and bug reports. The only thing that has a price is when a developer wants points to reward their testers, and for that option, $100 worth of points would let you to reward anywhere between around 40 to 470 testers (depending on the quality of their feedback and bug reports).</p>
                </div>
                <div class="divADivider"></div>
                <div class="divAContent">
                    <h2 class="dACGHeading">The Stitch Mission</h2>
                    <p class="dACGPara dACGPCentre">Provide game developers with the best cost-effective QA solutions</p>
                    <div class="divAC3Grid">
                        <div class="divAC3G">
                            <h2 class="dACGHeading">Indie Budget</h2>
                            <p class="dACGPara dACGPCentre">We think of indie game developers first, that's why most of what's offered is free.</p>
                        </div>
                        <div class="divAC3G">
                            <h2 class="dACGHeading">Quality Focused</h2>
                            <p class="dACGPara dACGPCentre">We prioritize thorough testing and quality reporting, educating our testers with the best testing practices &amp; etiquette.<br></p>
                        </div>
                        <div class="divAC3G">
                            <h2 class="dACGHeading">Services Plus</h2>
                            <p class="dACGPara dACGPCentre">We'll provide what most QA firms offer and more with our own unique twist.</p>
                        </div>
                    </div>
                </div>
                <div class="divADivider"></div>
                <div class="divAContent">
                    <h2 class="dACGHeading">Game Rewards</h2>
                    <p class="dACGPara dACGPCentre">Here's an example list of possible games that, if a tester has gained enough points for, can acquire. We'll always push to have a variety of indie, double and triple-A games for testers to look forward to.</p>
                    <div class="divAC4Grid">
                        <div class="divAC3GGames"><video class="dAC3GG" src="https://giant.gfycat.com/ThunderousMellowArgali.webm" width="100%" height="auto" muted="" loop="" autoplay=""></video><img class="dAC3GGImg" src="assets/img/The-Witcher-3-Wild-Hunt-Pic.jpg"></div>
                        <div class="divAC3GGames"><video class="dAC3GG" src="https://giant.gfycat.com/FewSeveralHog.webm" width="100%" height="auto" muted="" loop="" autoplay=""></video><img class="dAC3GGImg" src="assets/img/Battlefield-4-Pic.jpg"></div>
                        <div class="divAC3GGames"><video class="dAC3GG" src="https://giant.gfycat.com/WeakTightGiantschnauzer.webm" width="100%" height="auto" muted="" loop="" autoplay=""></video><img class="dAC3GGImg" src="assets/img/Rocket-League-Pic.jpg"></div>
                        <div class="divAC3GGames"><video class="dAC3GG" src="https://giant.gfycat.com/RepulsiveGoodnaturedLark.webm" width="100%" height="auto" muted="" loop="" autoplay=""></video><img class="dAC3GGImg" src="assets/img/Super-Hot-Pic.png"></div>
                    </div>
                </div>
                <div class="divADivider"></div>
                <div class="divAContent">
                    <h2 class="dACGHeading">Team</h2>
                    <p class="dACGPara dACGPCentre">A passionate group of gamers, striving to make the industry better as best as we can, even if we're in Lebanon with a headache dealing with basic services from electricity and internet outages.</p>
                    <div class="divAC3Grid">
                        <div class="divTeamCardHolder">
                            <div class="divTeamCard">
                                <div class="dTC dTCPic"><img class="imgDTCP" src="assets/img/Screenshot_38.jpg"></div>
                                <div class="dTC dTCText">
                                    <p class="paraDTCT pDTCTTop">Ahmad Arabi</p>
                                    <p class="paraDTCT pDTCTMid">Founder, CEO</p>
                                    <p class="paraDTCT">Business development, design, marketing.</p>
                                </div>
                                <div class="dTC dTCSocial"><a class="linkDTCS" href="#"><i class="fab fa-twitter"></i></a><a class="linkDTCS" href="#"><i class="fab fa-facebook-f"></i></a><a class="linkDTCS" href="#"><i class="fab fa-instagram"></i></a><a class="linkDTCS" href="#"><i class="fab fa-linkedin-in"></i></a></div>
                            </div>
                        </div>
                        <div class="divTeamCardHolder">
                            <div class="divTeamCard">
                                <div class="dTC dTCPic"><img class="imgDTCP" src="assets/img/Screenshot_3.jpg"></div>
                                <div class="dTC dTCText">
                                    <p class="paraDTCT pDTCTTop">Haidar AlAmir</p>
                                    <p class="paraDTCT pDTCTMid">CSO</p>
                                    <p class="paraDTCT">Business and development support.</p>
                                </div>
                                <div class="dTC dTCSocial"><a class="linkDTCS" href="#"><i class="fab fa-twitter"></i></a><a class="linkDTCS" href="#"><i class="fab fa-facebook-f"></i></a><a class="linkDTCS" href="#"><i class="fab fa-instagram"></i></a><a class="linkDTCS" href="#"><i class="fab fa-linkedin-in"></i></a></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
