<?php namespace BruceCms\Pages;
 
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
 
class PagesServiceProvider extends ServiceProvider {
 
	/**
	* Bootstrap the application services.
	*
	* @return void
	*/
	public function boot()
	{
		$this->publishes([__DIR__.'/migrations/' => 'database/migrations'], 'migrations');
		$this->publishes([__DIR__.'/requests/' => 'app/Http/Requests/'], 'request');

		$this->loadViewsFrom(__DIR__.'/views/', 'pages');
	}
 
	/**
	* Register the application services.
	*
	* @return void
	*/
	public function register()
	{
		include __DIR__.'/routes.php';

		$this->app->make('BruceCms\Pages\Page');
		$this->app->make('BruceCms\Pages\PagesController');

		$this->app->register('BruceCms\Pages\ViewComposerServiceProvider');

		// Form Builder dependencies
		$this->app->register('Collective\Html\HtmlServiceProvider');
		$loader = AliasLoader::getInstance();
		$loader->alias('Form', 'Collective\Html\FormFacade');
	}
 
}