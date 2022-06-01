<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/app.css">
    @yield('style')
    @yield('script')
    <script src="/js/bootstrap.min.js"></script>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
    
        ym(88938536, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/88938536" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-main">
        <div class="container">
            <a class="navbar-btand" href="/">
              <img src="./img/home.png" alt="" height="38">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/chayhana">
                            <img src="./img/logo.png" alt="">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/panasia">
                            <img src="./img/logo1.png" alt="">
                        </a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/mangal">
                        <img src="./img/logo3.png" alt="">
                    </a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <div class="d-flex flex-column m-3">
                        <div>Донбасская, 6</div>
                        <div><a class="text-decoration-none" href="tel:+79068559037">+7 (906) 855‒90‒37</a></div>
                    </div>
                </span>
                @if(Request::is('/'))
                    <a class="btn btn-dark btn-busket d-none d-lg-block" href="./cart">Корзина</a>
                @endif
            </div>
        </div>
    </nav>

    @yield('content')

    @include('layouts.footer')
</body>
</html>