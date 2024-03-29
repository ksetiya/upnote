<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use Blade;
class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		 view()->composer('partials.nav', function($view)
		{
			if(!\Auth::guest()){
				$user = \Auth::user();
				$unreadNotifications = $user->notifications()->unread()->orderBy('sent_at', 'DESC')->get();
				$view->with('unreadNotifications', $unreadNotifications);
				}
		});
		
		Blade::extend(function($value)
		{
		  return preg_replace('/(\s*)@(break|continue)(\s*)/', '$1<?php $2; ?>$3', $value);
		});

	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}


}
