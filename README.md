# Itty, bitty CMS for Laravel

UPDATE: I no longer work for the company for whom I was developing this project. If you'd like to pick it up and make it better, please feel free to fork and improve as needed!

Bruce is a highly opinionated CMS with basic authentication. While we try to provide some flexibility, there are a number of choices made that may make or break your decision to use the package.

Please note that this package is currently under development. I would not recommend using it until a solid beta version is out.

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

This will create a migration for the `pages` table, a PageRequest class in `app/Http/Requests`, and a number of views. You might recognize most of them as some iteration of the defaults from 5.0. Since 5.1 pulls them out, we're reintroducing them. We also publish some assets to the public folder, and create a couple of folders. This is for the page editor and file manager (more below).

After you've published all the assets, you will need to get your [database configuration](http://laravel.com/docs/5.1/database) set and run:

```bash
php artisan migrate
```

In order to solve a chicken and egg problem, we need to create a "Home" page and an admin. So, in your `database/seeds/DatabaseSeeder.php` add the following in the `run` method:

```php
$this->call(BruceCms\Pages\Seeds\PageSeeder::class);
```

Then run:

```bash
php artisan db:seed
```

In order to get the newly created home page to show up under the "/" route, you'll need to remove Laravel's default welcome route from `app/routes.php`.

Then, you'll be ready to go!

## Usage

In this package, everything except the pages themselves are hidden behind the [Auth middleware](http://laravel.com/docs/5.1/authentication#protecting-routes). Since you ran the seeder, you have a default admin with the following credentials:

* Email: admin@example.com
* Password: password

PLEASE change these to your domains needs. To do so, please read the "Edit Your Profile" section below.

You'll also notice that the master `app/routes.php` can override any of the routes we have set up. If, for whatever reason, you need to change the URI, you can update it there. If you need help figuring out how to point to our internally controller, take a look at our `routes.php` in the `src/` directory.

### Routes

#### Page Manager
The Page Manager is under the `pages` route. If you ran the database seeder, you should see the home page. If you want to change the sorting of pages in the navigation, you can simply drag the rows to stack in the order that you wish and click 'Sort Pages'.

You can also use this page to set parent pages if you need nested navigation. At this point, the package only supports one level of nesting. So, if you set a page to a child of a child, IT MIGHT DISAPPEAR FROM THE NAVIGATION. To make it reappear, just set the parent to a top level navigation element, or to "none";

#### Create a New Page
By either clicking on the link on the `pages` route, or by going to `pages/create`, you can create a new page. Each field is fairly self-explanatory, but for thoroughness's sake:
* Title - The title of the page. This is also how the link will display in the navigation.
* Link - The route that will be used to get to the page. As it notes, you don't want to put in a sentence or spaces between words. By convention, it recommends uses a dash.
* Body - The actual content of the page. Pages uses [TinyMCE](http://www.tinymce.com/) as it's fairly lightweight, and does all the things most clients and end-users would need to do. We also include [Responsive Filemanager](http://www.responsivefilemanager.com/), a plugin for TinyMCE to manage files from the within. For usage, please refer to website. Don't worry, it's easy to use and much more performant than the site for it.
* Hidden from Navigation? - If you want to create a page, but you don't want it to show up in the navigation.

When the content is to your satisfaction, click 'Create Page'. It's that easy.

#### Edit an Existing Page
By either going to the page you wish to edit and adding '/edit' to the URL, or clicking the 'Edit' button from the Page Manager, you can edit the content you have previously set.

#### Delete a Page
To delete a page, click the 'Delete' button from the Page Manager. A confirmation box will show up, letting you know this is forever. Just confirm, and the page is gone.

#### View a page
To view a page, just go to the link you set for it. You can also get to it from the navigation links (it would be pretty useless if you couldn't, huh?)

#### Sitemap
This packages uses [a sitemap generator built for Laravel](https://github.com/RoumenDamianoff/laravel-sitemap) and generate a default one that includes all pages created using this system. If for some reason you need a more complex sitemap, you can override the route in `app/routes.php` and refer to the package's documentation. We recommend sticking to dynamic sitemaps as serving an actual .xml file can be troublesome. Regardless, the package includes that capability if you need it.

#### Admin Manager
The Admin manager is under the `admins` route. If you ran the database seeder, you should see the default admin. Note that you can only create new admins and delete them. Editing is reserved for the admin themselves. More below.

#### Create a New Admin
By clicking the "click here" to create a new admin link on the `admins` page, you can create a new admin. The fields are the defaults that Laravel uses, but for thoroughness's sake:
* Name - The username for the admin. This can be their actual name or a handle, as it's only used as a reference.
* E-Mail Address - The E-Mail Address for the admin. It needs to be an actual email so that they can reset their password if need be.
* Password - The password for the admin. By default, Laravel enforces a 6-character minimum.
* Confirm Password - The password above in the exact same format.

#### Edit Your Profile
By clicking the "Edit Your Profile" link in the admin navigation, you can edit your profile. From here you can update your information.

#### Delete an Admin
To delete an admin, click the 'Delete' button from the Admin Manager. A confirmation box will show up, letting you know this is forever. Just confirm, and the page is gone.

### Navigation Menu
This package includes a partial for navigation output that is included by default in the main app layout. It provides a number of hooks to make CSS easier:
* A "nav" class on the `<nav>` element, as well as a "--main" flag, in case you have multiple menus.
* A "first" class on the first `<li>` element in the navigation. This adjusts to your sorting.
* A "last" class on the last `<li>` element in the navigation. Like first, this adjusts to your sorting.

### Flash

This package utilizes [Jeffrey Way's Flash Message](https://github.com/laracasts/flash) package to display success or error messages to the user. Because we pull it in, you don't have to, and you can use it anywhere in your application that you would like to. Please refer to the github page for documentation.

