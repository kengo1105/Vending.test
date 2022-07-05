<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        
        <title>@yield('title')</title>
        <link rel="stylesheet" href="vending.css/app.css" >        
    </head>

    <body class="item-pages">
        <header>
            @include('header')
        </header>
        <div class="container">
            @yield('content')
        </div>
                    
                
            
        
    </body>
</html>
