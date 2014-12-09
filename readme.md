## Laravel Admin 


Laravel 4 package used to provide an admin panel with user, groups and permissions management.
This package is currently under active development.

##Features
* Cartalyst Sentry package
* Anahkiasen Former package
* Twitter Bootstrap 2.3.1
* Font-awesome 3.2.0
* Users, Groups and Permissions out of the box.
* Base controller for admin panel development
* Most of the views can be replaced by your own in the config file

##Installation
Begin by installing this package through Composer. Edit your project's `composer.json` file to require `verecom/admin`.

```javascript
{
    "require": {
        "verecom/admin": "dev-master"
    }
}
```

Update your packages with `composer update` or install with `composer install`.

You need to add the following service provider. 
Open `app/config/app.php`, and add a new items to the providers array.

```php
'Former\FormerServiceProvider',
'Cartalyst\Sentry\SentryServiceProvider',
'Verecom\Admin\AdminServiceProvider',
```

Then add the following Class Aliases
```php
'Former' => 'Former\Facades\Former',
'Sentry' => 'Cartalyst\Sentry\Facades\Laravel\Sentry',
```

Finally run the following command in the terminal. php artisan admin:install This will publish the config files for Cartalyst/Sentry, Anahkiasen/Former and Stevemo/Cpanel also it will run the migration.

To create a user simply do php artisan admin:user

Done! Just go to http://localhost/admin to access the admin panel.

To create a user simply do `php artisan admin:user`

Done! Just go to [http://localhost/admin](http://localhost/admin) to access the admin dashborad.

##Missing
* Dashborad Page in Admin
* Send Activation code by email when user register
* Password reset/reminder
* unit test… started reading Laravel Testing decoded ;-)
* Documentation
