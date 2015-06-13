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

		$this->publishes([__DIR__.'/views/pages/' => 'resources/views/pages/', 'pages']);
		$this->publishes([__DIR__.'/views/layouts/' => 'resources/views/layouts/'], 'layouts');
		$this->publishes([__DIR__.'/views/partials/' => 'resources/views/partials/'], 'partials');

		// For Laravel 5.1, which doesn't include this by default anymore.
		$this->publishes([__DIR__.'/views/auth/' => 'resources/views/auth/'], 'auth');
		$this->publishes([__DIR__.'/views/app/' => 'resources/views/'], 'app');

		// Create directories for file manager.
		if(! is_dir(public_path('source'))) {
			\File::makeDirectory(public_path('source', 0755, true));
		}

		if(! is_dir(public_path('thumbs'))) {
			\File::makeDirectory(public_path('thumbs', 0775, true));
		}

		$this->publishes([__DIR__.'/tinymce/' => 'public/tinymce/'], 'tincymce');
		$this->publishes([__DIR__.'/filemanager/' => 'public/filemanager/'], 'filemanager');
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

		// Form Builder dependencies
		$this->app->register('Collective\Html\HtmlServiceProvider');
		$loader = AliasLoader::getInstance();
		$loader->alias('Form', 'Collective\Html\FormFacade');

		// Flash dependencies
		$this->app->register('Laracasts\Flash\FlashServiceProvider');
		$loader->alias('Flash', 'Laracasts\Flash\Flash');
	}
}