[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Laravel 5.1](https://img.shields.io/badge/Laravel-5.x-orange.svg?style=flat-square)](http://laravel.com)
[![Packagist Version](https://img.shields.io/packagist/v/smarch/watchtower.svg?style=flat-square)](https://packagist.org/packages/smarch/watchtower)
[![Total Downloads](https://img.shields.io/packagist/dt/smarch/watchtower.svg?style=flat-square)](https://packagist.org/packages/smarch/watchtower)
[![GitHub stars](https://img.shields.io/github/stars/badges/shields.svg?style=social&label=Star)](https://github.com/SmarchSoftware/watchtower)



# The Watchtower

A front end (GUI) package for the [Caffeinated/Shinobi](https://github.com/caffeinated/shinobi) RBAC authorization system for Laravel **5**.

![enter image description here](http://i.imgur.com/zYBjWsF.png)

This page is intended for installation, please check out the wiki for more information about usage.

* :scroll: [Configuration Options](https://github.com/SmarchSoftware/watchtower/wiki/Configuration-Options)
* :key: [Permissions](https://github.com/SmarchSoftware/watchtower/wiki/Permissions)
* :busts_in_silhouette: [Roles](https://github.com/SmarchSoftware/watchtower/wiki/Roles)
* :bust_in_silhouette: [Users](https://github.com/SmarchSoftware/watchtower/wiki/Users)

## Overview

This package is to administer / manage your roles and permissions tables with the Shinobi role based access control system for Laravel 5.

> :hand: **Note:**
> Shinobi is a required part of this package. This package is merely the GUI front end for the Shinobi package and this Watchtower package does not actually provide any of the authorization functionality. If you don't already have the Shinobi package installed, it will be installed as part of the installation of Watchtower.

It will give you full control over your roles :busts_in_silhouette:, their permissions :key: and the users :bust_in_silhouette: that have access to them. You will be able to add, edit, update, delete and synchronize all three as needed. 

Out of the box, Watchtower contains all the views necessary to enable Role & Permissions management.  It also provides the necessary permissions to secure your site so that only those allowed to perform the admin functions are permitted. Of course, this is made possible using Shinobi and, naturally, all views and permissions are configurable so you are free to provide your own views and change the permissions the way your app requires them.

------
##### Example of the user matrix
![The User Matrix](http://i.imgur.com/lZMx20B.png)


## Installation

Depending on whether or not you have already installed Shinobi, your install is pretty straightforward. Install Watchtower, add Service Providers, add Facade, run DB commands. Win.

> :hand: ***Note***
>  Even though Watchtower uses a few packages to properly theme and layout the admin area, they are referenced through [cdnjs.com](https://cdnjs.com/) and are **not installed locally**.
>
>*Watchtower makes use of the following packages : [Bootstrap](http://getbootstrap.com), [Bootstrap theming](http://bootswatch.com), [JQuery](http://jquery.com), [Pace](http://github.hubspot.com/pace/docs/welcome/), [Sweetalert](http://t4t5.github.io/sweetalert/) and [Modernizr](https://modernizr.com/). If you wish to not use the cdn versions and use local versions instead, modify the master.layout file to reflect those changes. (Or alternately, use the config file to point your master.layout to your local copies of those packages.)*

#### :black_square_button: Composer

    composer require "smarch/watchtower"

#### :pencil: Service Provider

Once composer has installed the necessary packages for watchtower to function you need to open your laravel config page for service providers and add Watchtower. To properly function you need to have all 3 service providers referenced : Shinobi, [HTML Forms](https://laravelcollective.com/docs/5.1/html) and Watchtower.

*config/app.php*
       
       /*
        * Third Party Service Providers
        */
        Caffeinated\Shinobi\ShinobiServiceProvider::class, // For RBAC
        Collective\Html\HtmlServiceProvider::class, // For Watchtower Forms to function
        Smarch\Watchtower\WatchtowerServiceProvider::class, // For Watchtower

#### :pencil: Facades
While Watchtower itself does not need a facade, one is provided if you wish to use one. However the Shinobi and Forms facades are used heavily by Watchtower so be sure you add them to your Facades.

*config/app.php*

        /*
        * Third Party Service Providers
        */
        'Form'     => Collective\Html\FormFacade::class,  // required for Watchtower Forms
        'HTML'     => Collective\Html\HtmlFacade::class,   // required for Watchtower Forms
        'Shinobi'  => Caffeinated\Shinobi\Facades\Shinobi::class, // For RBAC functions
        //'Watchtower'=> Smarch\Watchtower\WatchtowerFacade::class, // not required, but available

#### :card_index: Database Migrations / Seeds

If you did not install Shinobi earlier, you will need to run the migration files to properly set up and create the necessary tables. From your command prompt (wherever you run your artisan commands) enter the following command <kbd>php artisan vendor:publish</kbd> and then <kbd>php artisan migrate</kbd>. This should properly create your necessary tables AND create the Watchtower config file *(which allows you to define any views / permissions you wish to change from their defaults)*.

    php artisan vendor:publish
    php artisan migrate

> :hand: ***Note*** If you already have your roles and permissions set up, you can skip the following step and just change the Watchtower config file to reflect the permissions it should use to permit functionality.

To permit the ability to restrict and permit access to the various admin areas of Watchtower, you will need to run the Watchtower seeder which will prepopulate your database with permissions and roles.

    php artisan db:seed --class Smarch\Watchtower\Seeds\WatchtowerTableSeeder

#### :memo: Shinobi usage requirements
If you are installing Shinobi now, with Watchtower, you will need to also make the following changes so that you can use Shinobi's RBAC functions instead of Laravel defaulting to its own "Gate" authorization methods. Modify your User model to reflect the following changes _(stripping out Laravel's Authorizable contracts and traits)_ : 

    <?php
    namespace App;

    use Illuminate\Auth\Authenticatable;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Auth\Passwords\CanResetPassword;
    use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
    use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

    use Caffeinated\Shinobi\Traits\ShinobiTrait;

    class User extends Model implements AuthenticatableContract,
                                        CanResetPasswordContract
    {
        use Authenticatable, CanResetPassword, ShinobiTrait;

Once this is all finished, you should be able to go to

### :earth_americas: http://yoursite/watchtower 
![](http://i.imgur.com/ou6oses.png)

 and be rewarded with a big ole warning. :smile: That's normal. This shows you that Shinobi is working and properly protecting your admin *(Watchtower)* area. Just login with admin@change.me and password *(if you used the db:seed command)* and you will have full access. If you already had a user in your database, log in with that first user to enable access. `By default, the db:seed command will associate the admin role with `user->id = 1` in the database.`
 
> :hand: **Note** If you have not setup a login redirect yet, and don't have a HOME route and view, you will probably get another route error. Create a route for Home or [redirect your logins](http://laravel.com/docs/5.1/authentication#included-authenticating) or just type the url of http://yoursite/watchtower again. 

#### :exclamation: Laravel Authentication Views (login, etc...)

##### Laravel 5.2
Now you can use artisan to make all your auth views and routes using the following command :
    
    php artisan make:auth

This will generate the routes / views you need for authentication to work for you.

##### Laravel 5.1
Watchtower does not ship enabled _(see note below after routes)_ with the default laravel authentication views/routes, since Laravel removed them in 5.1. However you can find some samples / information from Laravel here : [Laravel Login / Auth Views](http://laravel.com/docs/5.1/authentication#authentication-quickstart) that will provide you with the routes / views necessary to permit login and registration.

You will need the following routes for authentication. (also provided on Laravel auth link above) Copy these into your app/routes.php file _(or wherever you define your routes)_.

	routes.php 
	// Authentication routes...
	Route::get('auth/login', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('auth/logout', 'Auth\AuthController@getLogout');
	
	// Registration routes...
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::post('auth/register', 'Auth\AuthController@postRegister');
	
	// Password reset link request routes...
	Route::get('password/email', 'Auth\PasswordController@getEmail');
	Route::post('password/email', 'Auth\PasswordController@postEmail');
	
	// Password reset routes...
	Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');

> :hand: **Note** As a convenience, the default Laravel auth views are included with Watchtower in the "vendor\smarch\watchtower\src\Views\auth" folder. Simply copy and paste the auth folder to your "root\resources\views" folder on your app to enable them.

#### :trident: Why "Watchtower"?
I've been a DC geek for over 30 years now. Watchtower is the name of the floating spacestation the Justice League used to monitor / administer the super heroes. ....coulda been worse. I was thinking of going with OMAC for a while. :smile:
