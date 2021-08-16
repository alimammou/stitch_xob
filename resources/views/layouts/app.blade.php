<!DOCTYPE html>
<html class="htmlMain" lang="en">
<head>
    <title >stitch</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome5-overrides.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/Lightbox-Gallery.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/formbuilder/js/footable/css/footable.standalone.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/formbuilder/css/styles.css') }}{{ App\Http\Helpers\Helper::bustCache() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bodyMain">
@if(session()->has('error'))
    <div class="divPopUpGeneralMain dPUGMGreen">
        <p class="dPUGM">{{ session()->get('error') }}&nbsp;</p>
        <button class="btn popUpBtnClose" type="button"  onclick="deletepopup(this)">
            <i class="fa fa-close "></i>
        </button>
    </div>
@endif
@if(session()->has('fail'))
    <div class="divPopUpGeneralMain dPUGMRed">

        <p class="dPUGM">{{ session()->get('fail') }}&nbsp;</p>
        <button class="btn popUpBtnClose" type="button" onclick="deletepopup(this)">
            <i class="fa fa-close "></i>
        </button>
    </div>
@endif
@if(session()->has('message'))
    <div class="divPopUpGeneralMain dPUGMGreen">
        <p class="dPUGM">{{ session()->get('message') }}&nbsp;</p>
        <button class="btn popUpBtnClose" type="button" onclick="deletepopup(this)">
            <i class="fa fa-close "></i>
        </button>
    </div>
@endif
@if(session()->has('success'))
    <div class="divPopUpGeneralMain dPUGMGreen">
        <p class="dPUGM">{{ session()->get('success') }}&nbsp;</p>
        <button class="btn popUpBtnClose" type="button" onclick="deletepopup(this)">
            <i class="fa fa-close "></i>
        </button>
    </div>
@endif
<div class="divNavGrouped">
    <div class="divNav">
        <div class="divCustomContainer">
            <nav class="navbar navbar-light navbar-expand NavBar">
                <div class="container divCustomContainer">
                    <div class="navHolder">
                        <div class="collapse navbar-collapse NavBarCollapse" id="navcol-2">
                            <ul class="navbar-nav navItemHolder" id="nav">
                                <li class="nav-item navItem"><a class="nav-link linkNL" href="/">Home</a></li>
                                <li class="nav-item navItem"><a class="nav-link linkNL" href="/tests">Tests</a></li>
                                <li class="nav-item navItem"><a class="nav-link linkNL" href="/store">Store</a></li>

                                <li class="nav-item navItem"><a class="nav-link linkNL" href="/dashboard">Dashboard</a></li>



                                        {{ $header }}


                            </ul>
                        </div>
                    </div><button data-target="#navcol-2" data-toggle="collapse" class="navbar-toggler NavBarToggler"><i class="fa fa-bars"></i></button>
                </div>
            </nav>
        </div>
    </div>
    <div class="divUnderNavSocial">
        <div class="divCustomContainer">
            <div class="divNavSocial"><a class="linkNavSocial anyGrey" href="https://twitter.com/stitchgamesqa/" target="_blank"><i class="fa fa-twitter iconNS"></i></a><a class="linkNavSocial anyGrey" href="https://facebook.com/stitchgamesqa/" target="_blank"><i class="fa fa-facebook iconNS"></i></a><a class="linkNavSocial anyGrey" href="https://instagram.com/stitchgamesqa/" target="_blank"><i class="fa fa-instagram iconNS"></i></a><a class="linkNavSocial anyGrey" href="https://www.youtube.com/channel/UCo6IlN--yGJ_P19DMey-_tw" target="_blank"><i class="fa fa-youtube-play iconNS"></i></a><a class="linkNavSocial anyGrey" href="https://discord.gg/ewbZVqp" target="_blank"><i class="fab fa-discord iconNS"></i></a><a class="linkNavSocial anyGrey" href="https://t.me/joinchat/VGx-dJzgsbWKeg83" target="_blank"><i class="fab fa-telegram-plane iconNS"></i></a></div>
        </div>
    </div>
</div>
<div class="divMainContent">
{{$slot}}
</div>
<div class="divMainFooter">
    <div class="divCustomContainer">
        <div class="divMFGrid">
            <div class="divMFLogo">
                <div class="divFooterLogo"><img class="imgFooterLogo" src={{asset('assets/img/Stitch%20Logo.png')}}></div>
            </div>
            <div class="divMFLinksHolder">
                <div class="divMFLinks">
                    <div class="dMFL">
                        <div class="dMFLHolder"><a class="linkDMFL" href="/">Stitch</a><a class="linkDMFL" href="/">Stitch News</a><a class="linkDMFL" href="/">Stitch Interactive</a></div>
                    </div>
                    <div class="dMFL">
                        <div class="dMFLHolder"><a class="linkDMFL" href="/about">About</a><a class="linkDMFL" href="/faq">FAQ</a><a class="linkDMFL" href="/presskit">Presskit</a></div>
                    </div>
                    <div class="dMFL dMFLBottom">
                        <div class="dMFLHolder dMFLHBottom"><a class="linkDMFL" href="/privacypolicy">Privacy Policy</a><a class="linkDMFL" href="/termsandconditions">T&amp;C</a><a class="linkDMFL" href="/legalnotice">Legal Notice</a><a class="linkDMFL" href="/cookies">Cookie Policy</a></div>
                    </div>
                </div>
            </div>
            <div class="divMFSocial">
                <div class="divSCHolder"><a class="linkSocialCard anyGrey" href="https://twitter.com/stitchgamesqa/" target="_blank"><i class="fa fa-twitter iconSC" style="display: flex;flex-direction: row;justify-content: center;align-items: center;text-align: center;"></i>
                        <p class="paraCS">Twitter</p>
                    </a><a class="linkSocialCard " href="https://facebook.com/stitchgamesqa/" target="_blank"><i class="fa fa-facebook iconSC" style="display: flex;flex-direction: row;justify-content: center;align-items: center;text-align: center;"></i>
                        <p class="paraCS">Facebook</p>
                    </a><a class="linkSocialCard anyGrey" href="https://instagram.com/stitchgamesqa/" target="_blank"><i class="fa fa-instagram iconSC" style="display: flex;flex-direction: row;justify-content: center;align-items: center;text-align: center;"></i>
                        <p class="paraCS">Instagram</p>
                    </a><a class="linkSocialCard " href="https://www.youtube.com/channel/UCo6IlN--yGJ_P19DMey-_tw" target="_blank"><i class="fa fa-youtube iconSC" style="display: flex;flex-direction: row;justify-content: center;align-items: center;text-align: center;"></i>
                        <p class="paraCS">Youtube</p>
                    </a><a class="linkSocialCard" target="_blank" href="https://discord.gg/ewbZVqp"><i class="fab fa-discord iconSC"></i>
                        <p class="paraCS">Discord</p>
                    </a><a class="linkSocialCard anyGrey" href="mailto:team@stitch.games" target="_blank"><i class="fas fa-envelope iconSC"></i>
                        <p class="paraCS">Email</p>
                    </a><a class="linkSocialCard anyGrey" href="https://t.me/joinchat/VGx-dJzgsbWKeg83" target="_blank"><i class="fab fa-telegram-plane iconSC"></i>
                        <p class="paraCS">Telegram</p>
                    </a></div>
            </div>
        </div>
    </div>
    <div class="divMFSubFooter">
        <div class="divCustomContainer">
            <div class="divMFSF">
                <p class="paraMFSF">Stitch © 2021 All rights reserved.</p>
            </div>
        </div>
    </div>
</div>
<script>
    function deletepopup(button)
    {
        x=button.parentElement;
        x.remove();
    }
</script>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/bs-init.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js')}}"></script>
<script src="{{asset('assets/js/navLinkActive.js')}}"></script>
<script   src={{asset('https://code.jquery.com/jquery-3.1.1.min.js')}}   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
<script src={{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js')}} integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src={{asset('https://unpkg.com/@popperjs/core@2')}}></script>
<script src={{asset('https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js')}} integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('vendor/formbuilder/js/jquery-ui.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/sweetalert.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/jquery-formbuilder/form-builder.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/jquery-formbuilder/form-render.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/parsleyjs/parsley.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/clipboard/clipboard.min.js') }}?b=ck24" defer></script>
<script src="{{ asset('vendor/formbuilder/js/moment.js') }}"></script>
<script src="{{asset('assets/js/stopCloseMenuClick.js')}}"></script>
<script src="{{ asset('vendor/formbuilder/js/footable/js/footable.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/script.js') }}{{ App\Http\helpers\Helper::bustCache() }}" defer></script>
</body>

</html>
