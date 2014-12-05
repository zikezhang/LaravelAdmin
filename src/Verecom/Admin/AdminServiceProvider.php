<?php namespace Verecom\Admin;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ServiceProvider;
use Verecom\Admin\Console\InstallCommand;
use Verecom\Admin\Console\UserSeedCommand;
use Verecom\Admin\Permission\Repo\PermissionRepository;
use Verecom\Admin\Permission\Repo\Permission;
use Verecom\Admin\Permission\Form\PermissionForm;
use Verecom\Admin\Permission\Form\PermissionValidator;
use Verecom\Admin\Group\Repo\GroupRepository;
use Verecom\Admin\Group\Form\GroupForm;
use Verecom\Admin\Group\Form\GroupValidator;
use Verecom\Admin\User\Repo\UserRepository;
use Verecom\Admin\User\Form\UserForm;
use Verecom\Admin\User\Form\UserValidator;
use Verecom\Admin\User\Form\PasswordForm;
use Verecom\Admin\User\Form\PasswordValidator;
use Verecom\Admin\User\UserMailer;

class AdminServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('verecom/admin');
        include __DIR__ .'/routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerCommands();
        $this->registerPermission();
        $this->registerGroup();
        $this->registerUser();
        $this->registerPassword();
	}

     /**
     * Register console commands admin:install
     * Register console commands admin:user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return void
     */
    public function registerCommands()
    {
        $this->app['command.admin.install'] = $this->app->share(function()
        {
            return new InstallCommand();
        });

        $this->app['command.admin.user'] = $this->app->share(function()
        {
            return new UserSeedCommand();
        });

        $this->commands('command.admin.install','command.admin.user');
    }

    /**
     * Register Permission module component
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     */
    public function registerPermission()
    {
        $app = $this->app;

        $app->bind('Verecom\Admin\Permission\Repo\PermissionInterface', function($app)
        {
            return new PermissionRepository(new Permission, $app['events'], $app['config']);
        });

        $app->bind('Verecom\Admin\Permission\Form\PermissionFormInterface', function($app)
        {
            return new PermissionForm(
                new PermissionValidator($app['validator'], new MessageBag),
                $app->make('Verecom\Admin\Permission\Repo\PermissionInterface')
            );
        });
    }

    /**
     * Register Group binding
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     */
    public function registerGroup()
    {
        $app = $this->app;

        $app->bind('Verecom\Admin\Group\Repo\AdminGroupInterface', function($app)
        {
            return new GroupRepository($app['sentry'], $app['events']);
        });

        $app->bind('Verecom\Admin\Group\Form\GroupFormInterface', function($app)
        {
            return new GroupForm(
                new GroupValidator($app['validator'], new MessageBag),
                $app->make('Verecom\Admin\Group\Repo\AdminGroupInterface')
            );
        });
    }

    /**
     * Register User binding
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     */
    public function registerUser()
    {
        $app = $this->app;

        $app->bind('Verecom\Admin\User\Repo\AdminUserInterface', function($app)
        {
            return new UserRepository($app['sentry'], $app['events']);
        });

        $app->bind('Verecom\Admin\User\Form\UserFormInterface', function($app)
        {
            return new UserForm(
                new UserValidator($app['validator'], new MessageBag),
                $app->make('Verecom\Admin\User\Repo\AdminUserInterface')
            );
        });
    }

    /**
     * Register bindings for the password reset
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     */
    public function registerPassword()
    {
        $app = $this->app;

        $app->bind('Verecom\Admin\User\Form\PasswordFormInterface', function($app)
        {
           return new PasswordForm(
               new PasswordValidator($app['validator'], new MessageBag),
               $app->make('Verecom\Admin\User\Repo\AdminUserInterface'),
               $app->make('Verecom\Admin\User\UserMailerInterface')
           );
        });

        $app->bind('Verecom\Admin\User\UserMailerInterface', function($app)
        {
            return new UserMailer();
        });
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('admin');
	}

}
