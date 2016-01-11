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

#### Installing on LARAVEL 5.1? USE THE master branch _(or tag 1.0.0)_

Depending on whether or not you have already installed Shinobi, your install is pretty straightforward. Install Watchtower, add Service Providers, add Facade, run DB commands. Win.

> :hand: ***Note***
>  Even though Watchtower uses a few packages to properly theme and layout the admin area, they are referenced through [cdnjs.com](https://cdnjs.com/) and are **not installed locally**.
>
>*Watchtower makes use of the following packages : [Bootstrap](http://getbootstrap.com), [Bootstrap theming](http://bootswatch.com), [JQuery](http://jquery.com), [Pace](http://github.hubspot.com/pace/docs/welcome/), [Sweetalert](http://t4t5.github.io/sweetalert/) and [Modernizr](https://modernizr.com/). If you wish to not use the cdn versions and use local versions instead, modify the master.layout file to reflect those changes. (Or alternately, use the config file to point your master.layout to your local copies of those packages.)*

#### :black_square_button: Composer

    composer require "smarch/watchtower:1.0.1"

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
        //'Watchtower'=> Smarch\Watchtower\WatchtowerFacade::class, // not required
        'Shinobi'  => Caffeinated\Shinobi\Facades\Shinobi::class, // For RBAC functions

#### :lock: Authentication
By default, Laravel does not ship with Authentication set up. But you CAN set it up and make it available really easily using laravel's built in artisan command.

    php artisan auth:make
   
This will create all the views you need, the logic you need, and set up the routes you need to allow your users to login / logout / register / reset password.

#### :card_index: Database Migrations / Seeds
If you did not install Shinobi earlier, you will need to run the migration files to properly set up and create the necessary tables. From your command prompt (wherever you run your artisan commands) enter the following command <kbd>php artisan vendor:publish</kbd> and then <kbd>php artisan migrate</kbd>. This should properly create your necessary tables AND create the Watchtower config file *(which allows you to define any views / permissions you wish to change from their defaults)*.

    php artisan vendor:publish
    php artisan migrate

> :hand: ***Note*** If you already have your roles and permissions set up, you can skip the following step and just change the Watchtower config file to reflect the permissions it should use to permit functionality.

To permit the ability to restrict and permit access to the various admin areas of Watchtower, you will need to run the Watchtower seeder which will prepopulate your database with permissions and roles.

    php artisan db:seed --class Smarch\Watchtower\Seeds\WatchtowerTableSeeder

#### :memo: Shinobi usage requirements
If you are installing Shinobi now, with Watchtower, you will need to also make the following changes so that you can use Shinobi's RBAC functions instead of Laravel defaulting to its own "Gate" authorization methods. Modify your User model to reflect the following changes : 

    namespace App;
    
    use Caffeinated\Shinobi\Traits\ShinobiTrait; // <-- Add this for Shinobi
    
    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class User extends Authenticatable
    {
        use ShinobiTrait;
        ...

> :construction:
> Until Shinobi is updated, you will need to go to the ShinobiTrait.php file and make the following changes - 
> * Line 132 change <kbd>public function can($permission)</kbd> to <kbd>public function can($permission, $arguments = [])</kbd>
> * Line 145 change <kbd>if ($role->can($permission)) {</kbd> to <kbd>if ($role->can($permission, $arguments)) {</kbd>
> * Line 207 change <kbd>return $this->can($permission);</kbd> to <kbd>return $this->can($permission, $arguments);</kbd>
> I will remove this construction section once Shinobi has its update...
>
> :construction:

Once this is all finished, you should be able to go to

### :earth_americas: http://yoursite/watchtower 
![](http://i.imgur.com/ou6oses.png)

 and be rewarded with a big ole warning. :smile: That's normal. This shows you that Shinobi is working and properly protecting your admin *(Watchtower)* area. Just login with admin@change.me and password *(if you used the db:seed command)* and you will have full access. If you already had a user in your database, log in with that first user to enable access. `By default, the db:seed command will associate the admin role with `user->id = 1` in the database.`

### Laravel 5.2 Updates
* They introduced a breaking change. All auth sessions are stored in a group now so you will need to manually edit the smarch\watchtower\src\routes.php to wrap the Watchtower routes into the web group. <kbd>Route::group(['middleware' => ['web']], function () {</kbd> and don't forget the <kbd>});</kbd> at the end.

#### :trident: Why "Watchtower"?
I've been a DC geek for over 30 years now. Watchtower is the name of the floating spacestation the Justice League used to monitor / administer the super heroes. ....coulda been worse. I was thinking of going with OMAC for a while. :smile:
