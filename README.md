# Itty, bitty CMS for Laravel

This package is currently under development, working to be as cleanly compatible with Laravel 5.1 as possible. I would not recommend using it until

## Prerequisites

* PHP >= 5.5.0
* Laravel >= 5.1 

## Installation

First, pull in the package through Composer.

```bash
composer require brucecms/pages
```

Then, include the service provider within `config/app.php`.

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

You will need to get your [database configuration](http://laravel.com/docs/5.0/database) set and run:

```bash
php artisan migrate
```

Then, you'll be ready to go!

## Usage

In this package, everything except the pages themselves are hidden behind the [Auth middleware](http://laravel.com/docs/5.0/authentication#protecting-routes), you will need to register a new administrator. By default, the `auth/register` route is open, so I would create it that way.

### Routes

#### Page Manager
The Page Manager is under the `pages` route. By default, you have no pages except the home page, which is not really a page because it's usually a special case. More on that later. If you want to change the sorting of pages in the navigation, you can simply drag the rows to stack in the order that you wish and click 'Sort Pages'.

#### Create a New Page
By either clicking on the link on the `pages` route, or by going to `pages/create`, you can create a new page. Each field is fairly self-explanatory, but for thoroughness's sake:
* Title - The title of the page. This is also how the link will display in the navigation.
* Link - The route that will be used to get to the page. As it notes, you don't want to put in a sentence or spaces between words. By convention, it recommends uses a dash.
* Body - The actual content of the page. Pages uses [TinyMCE](http://www.tinymce.com/) as it's fairly lightweight, and does all the things most clients and end-users would need to do. A future upgrade may include a file manger.
* Hidden from Navigation? - If you want to create a page, but you don't want it to show up in the navigation.

When the content is to your satisfaction, click 'Create Page'. It's that easy.