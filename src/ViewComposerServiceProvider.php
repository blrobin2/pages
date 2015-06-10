<?php namespace BruceCms\Pages;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		\View::composer('pages::partials/nav', function($view)
        {
            $view->with('pages', Page::orderBy('sort')->get());
        });
	}

}
