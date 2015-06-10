# Itty, bitty CMS for Laravel

This package is currently under development, working to be as cleanly compatible with Laravel 5.1 as possible. I would not recommend using it until a solid beta version is out.

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
    BruceCms\Pages\PagesServiceProvider::class
];
```

Then, publish all the assets so that we can use them in the application.

```bash
php artisan vendor:publish
```

This will create a migration for the `pages` table, a PageRequest class in `app/Http/Requests`, and a number of views. You might recognize most of them as some iteration of the defaults from 5.0. Since 5.1 pulls them out, we're reintroducing them. It's this part that's the most opinionated about this package, and if this doesn't work for you, just don't use it.

After you've published all the assets, you will need to get your [database configuration](http://laravel.com/docs/5.1/database) set and run:

```bash
php artisan migrate
```

Then, you'll be ready to go!

## Usage

In this package, everything except the pages themselves are hidden behind the [Auth middleware](http://laravel.com/docs/5.1/authentication#protecting-routes), so you will need to register a new administrator. We provide a view for `auth/register` by default, so I would create one that way.

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

#### Edit an Existing Page
By either going to the page you wish to edit and adding '/edit' to the URL, or clicking the 'Edit' button from the Page Manager, you can edit the content you have previously set.
**NOTE** The hidden feature seems to turn on and off randomly. I'll need to do some debugging there...

#### Delete a Page
To delete a page, click the 'Delete' button from the Page Manager. A confirmation box will show up, letting you know this is forever. Just confirm, and the page is gone.

#### View a page
To view a page, just go to the link you set for it. You can also get to it from the navigation links (it would be pretty useless if you couldn't, huh?)

### Flash

This package utilzes [Jeffrey Way's Flash Message](https://github.com/laracasts/flash) package, because we like it. Because we pull it in, you don't have to, and you can use it anywhere in your application that you would like to. Please refer to the github page for documentation.