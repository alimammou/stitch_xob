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

    </head>

<body class="bodyMain">

    {{ $slot }}
<script>
    function changeColor() {
    var elem = document.getElementById('xx');
        if(elem.childElementCount>30) {
            alert("too many questions")
            return;
        }
        elem.appendChild( document.createElement("INPUT"));

    }</script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/bs-init.js')}}"></script>
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js')}}"></script>
    <script src="{{asset('assets/js/navLinkActive.js')}}"></script>
    <script src="{{asset('assets/js/stopCloseMenuClick.js')}}"></script>
    <script   src={{asset('https://code.jquery.com/jquery-3.1.1.min.js')}}   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
    <script src={{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js')}} integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src={{asset('https://unpkg.com/@popperjs/core@2')}}></script>
    <script src={{asset('https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js')}} integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
