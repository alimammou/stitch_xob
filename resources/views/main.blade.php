<!DOCTYPE html>
<html class="htmlMain" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Stitch 2021 Ali</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <link rel="stylesheet" href="assets/css/Lightbox-Gallery.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
<div id="xx1">
    @include('welcome')
</div>


<script>
    function routetostore(){
        event.preventDefault();
        const CSRF_TOKEN=$('meta[name="csrf-token"]').attr('content');
        $.ajax(
            {
                url:"/store",
                type:'get',
                data:{
                    CSRF_TOKEN
                },
                success:function (data)
                {
                    console.log(data)
                   $("#xx1").html(data)
                }
            }
        )
        window.history.replaceState({}, '','/storeitem');
    }
    function routetohome(){
        event.preventDefault();
        const CSRF_TOKEN=$('meta[name="csrf-token"]').attr('content');
        $.ajax(
            {
                url:"/home",
                type:'get',
                data:{
                    CSRF_TOKEN
                },
                success:function (data)
                {
                    console.log(data)
                    $("#xx1").html(data)
                }
            }
        )
        window.history.replaceState({}, '','/');
    }
    function routetotests(){
        event.preventDefault();
        const CSRF_TOKEN=$('meta[name="csrf-token"]').attr('content');
        $.ajax(
            {
                url:"/tests",
                type:'get',
                data:{
                    CSRF_TOKEN
                },
                success:function (data)
                {
                    console.log(data)
                    $("#xx1").html(data)
                }
            }
        )
        window.history.replaceState({}, '','/tests');
    }
    function routetodashboard(){
        event.preventDefault();
        const CSRF_TOKEN=$('meta[name="csrf-token"]').attr('content');
        $.ajax(
            {
                url:"/dashboard",
                type:'get',
                data:{
                    CSRF_TOKEN
                },
                success:function (data)
                {
                    console.log(data)
                    $("#xx1").html(data)
                }
            }
        )
        window.history.replaceState({}, '','/dashboard');
    }
</script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
<script src="assets/js/navLinkActive.js"></script>
<script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>

