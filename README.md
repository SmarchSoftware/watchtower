# The Watchtower

A front end (GUI) package for the [Caffeinated/Shinobi](https://github.com/caffeinated/shinobi) RBAC authorization system for Laravel 5.

![enter image description here](http://i.imgur.com/zYBjWsF.png)

[TOC]

## Overview

This package is to administer / manage your roles and permissions tables with the Shinobi role based access control system for Laravel 5.

> **Note:**
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

#### :white_square_button: Composer

    composer require smarch/watchtower

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
**Example**

*config/app.php*

        /*
        * Third Party Service Providers
        */
        'Form'     => Collective\Html\FormFacade::class,  // required for Watchtower Forms
        'HTML'     => Collective\Html\HtmlFacade::class,   // required for Watchtower Forms
        //'Watchtower'=> Smarch\Watchtower\WatchtowerFacade::class, // not required
        'Shinobi'  => Caffeinated\Shinobi\Facades\Shinobi::class, // For RBAC functions

#### :ticket: Database Migrations / Seeds

If you did not install Shinobi earlier, you will need to run the migration files to properly set up and create the necessary tables. From your command prompt (wherever you run your artisan commands) enter the following command <kbd>php artisan publish</kbd> and then <kbd>php artisan migrate</kbd>. This should properly create your necessary tables AND create the Watchtower config file *(which allows you to define any views / permissions you wish to change from their defaults)*.

> :hand: Note If you already have your roles and permissions set up, you can skip the following step and just change the Watchtower config file to reflect the permissions it should use to permit functionality.

To permit the ability to restrict and permit access to the various admin areas of Watchtower, you will need to run the Watchtower seeder which will prepopulate your database with permissions and roles.
