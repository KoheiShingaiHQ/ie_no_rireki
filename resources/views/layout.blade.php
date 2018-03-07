<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta content="IE=Edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width,initial-scale=1.0,user-scalable=no" name="viewport">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Opnew">
        <meta property="og:site_name" content="Opnew">
        <link rel="icon" href="assets/images/16px16px.png" type="image/x-icon">
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
        <link rel="apple-touch-icon" href="assets/images/152px.png">
        <title>いえのりれき</title>
        <link href="//fonts.googleapis.com/css?family=Roboto:700,800,300,400,500" rel="stylesheet">
        <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="assets/styles/main.css">
    </head>
    <body class="{{ltrim(Request::path(), '/')}}">
        <div class="mobile-menu">
           <i class="menu-close material-icons">clear</i>
           <ul>
　　　　　　　 <li><a class="develop" href="develop">コンソールへ移動</a></li>
           </ul>
        </div>
        <header>
            <div class="wrap"></div>
            <div class="row">
                <i class="hamburger material-icons"></i>
                <a href="/" class="logo">
                    <img src="assets/images/logo.png" alt="Opnew">
                    <img src="assets/images/logo2.png" alt="Opnew">
                </a>
                <nav>
                    <ul>
                        <li class="link">
                            <a class="develop" href="/develop">コンソールへ移動</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
        @yield('content')
        </main>
        <footer>
          <ul>
            <li class="copy">© 2018 Kohei Shingai</li>
          </ul>
        </footer>
        <script>
            var $body = document.body;
            $menu_open = document.getElementsByClassName('hamburger')[0];
            $menu_close = document.getElementsByClassName('menu-close')[0];
            $menu_open.addEventListener('click', openMenu, false);
            $menu_close.addEventListener('click', closeMenu, false);
            function openMenu() {
              $body.className += " open-menu";
            }
            function closeMenu() {
              $body.classList.remove("open-menu");
            }
        </script>
    </body>
</html>
