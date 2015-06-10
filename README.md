# Itty, bitty CMS

## Installation

First, pull in the package through Composer.

```js
"require": {
    "brucecms/pages": "~0.1"
}
```

Then, if using Laravel 5, include the service provider within `config/app.php`.

```php
'providers' => [
    'BruceCms\Pages\PagesServiceProvider'
];
```

Then, publish all the assets so that we can use them in the application.

```bash
php artisan vendor:publish
```

This will create a migration for the `pages` table, a PageRequest class in `app/Http/Requests`.

To see the navigation, you will need to include the `nav` partial in the view that requires the navigation.

```html
@include('pages::partials/nav')
```

Each component has a class on it and can be styled however you need.

Finally, for the sorting functionality to work, we need to `@yield` their section types. So, in your main layout file, usually `app.blade.php`...

```html
<!-- Put this below your last stylesheet <link> --> 
@yield('header-styles')

...

<!-- Put this below your jQuery <script> -->
@yield('footer-scripts')
```

If you are using the default `app.blade.php` and have not done anything to it, it might look like this...

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    @yield('header-styles')

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Laravel</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">Home</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">Login</a></li>
                        <li><a href="{{ url('/auth/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- The navigation partial we included earlier -->
    @include('pages::partials/nav')

    @yield('content')

    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    @yield('footer-scripts')
    
</body>
</html>
```


## Usage

Coming soon!
