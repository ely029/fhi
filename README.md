<!-- @TB: For easy reference. -->
## Server Requirements

- Apache Web Server to utilize `.htaccess` (Nginx is supported but not optimized)
- Laravel's [Server Requirements](https://laravel.com/docs/installation#server-requirements)
- PHP 7.3+ is [required by PHP Insights](https://phpinsights.com/get-started.html#within-laravel)
- MySQL 5.6+ is [supported by Laravel](https://laravel.com/docs/database#introduction)



### Using the Boilerplate

[https://gitlab.com/thinkbit/web-app-laravel-boilerplate](https://gitlab.com/thinkbit/web-app-laravel-boilerplate/)

  

1.  Download then extract the boilerplate.
    
2.  Update your Homestead.yaml file.
    

1.  Reference for setting up homestead.yaml - Note: type: “nfs” is for mac os only
    
   ```
 folders:
        - map: ~/code/thinkbit/web-app-laravel-boilerplate
        to: /home/vagrant/thinkbit/web-app-laravel-boilerplate
        type: "nfs"

    sites:
        - map: laravel.thinkbitsolutions.local #localhost url site
        to: /home/vagrant/thinkbit/web-app-laravel-boilerplate/public
        schedule: true
        type: "apache"

    databases:
        - thinkbit_web-app-laravel-boilerplate
```





2.  If you haven’t installed the plugin `(https://github.com/cogitatio/vagrant-hostsupdater)`. Install using `vagrant plugin install vagrant-hostsupdater` on homestead directory. This is for the vagrant automatically managing the `hosts` file and for the localhost url site on your homestead yaml to work.
    
3.  If your machine is running on windows, open command-prompt and run as administrator then type this command cacls %SYSTEMROOT%\system32\drivers\etc\hosts /E /G %USERNAME%:W
    

3.  Connect via SSH
    
4.  Navigate to your project’s directory
    
5.  Execute composer install
    
6.  Execute php -r "file_exists('.env') || copy('.env.example', '.env');"
    
7.  Update .env variables such as DB_DATABASE, DB_USERNAME & DB_PASSWORD
    
8.  Update mail driver setup(do not use test email for local development)
    

# @TB: Default setting for local development

MAIL_DRIVER=log

9.  Execute php artisan key:generate
    
10.  Execute php artisan migrate (Note : if you have seeder execute php artisan db:seed)
    
11.  In your browser, navigate to your project’s URL to check if you’ve set up correctly.
    

  

Sharing localhost  
In case mobile devs or someone wants to access your localhost on remote;

1.  Connect or run the command `vagrant ssh`.
    
2.  Type `share {your project map site} -region ap`.
    
3.  Share them the link that starts with `https`.
    

  

### Phpmyadmin

  

Get started

1.  Download the stable version of phpmyadmin at [https://www.phpmyadmin.net](https://www.phpmyadmin.net/).
    
2.  Open Homestead.yaml and add port to the phpmyadmin project directory.
    
3.  Run vagrant reload --provision inside /Homestead directory of terminal
    

4.  Connect via SSH

5.  Navigate to your project’s directory

6.  Execute composer install

  
  

For MySQL Workbench Configuration

1.  Set server config
    

Connection Method: CM-Standard TCP/IP  
Hostname: 127.0.0.1  
Port: 33060  
Username: Homestead  
Password: secret

2.  Create user ( User and Privileges )
    

User: Homestead  
From Host: localhost  
~set privileges then set password to “secret” then apply.

  

### API Generator

1.  Use Laravel Api Doc Generator for documentation of API
    

1.  Check for "knuckleswtf/scribe": "^1.9" on composer.json if it exist
    
2.  Run composer install
    
3.  Run php artisan scribe:generate
    
4.  Access the api documentation url/docs
    
5.  Check views/apidoc/index.blade.php for the size and width of the image in nav
    
6.  For api groupings, description, sample response check this url for reference:[https://scribe.readthedocs.io/en/latest/index.html](https://scribe.readthedocs.io/en/latest/index.html)
    
7.  You need to php artisan scribe:generate to apply changes you made to the markdowns.
    

### API Best Practices  
  
https://laravel.com/docs/8.x/controllers#actions-handled-by-resource-controller


Follow naming convention for controllers and models it should be singular and camelcase:

    php artisan make:controller PhotoController --resource --model=Photo

Follow Laravel resource routing in creating endpoints. You can also look at [https://stripe.com/docs/api](https://stripe.com/docs/api) for good api reference.

### App Release

For additional technical reference, take a look at the detailed [App Release](https://docs.google.com/document/d/1igb0WYeJLnLlMcZ5AY2uF12wVTZHWBrPEfLCOFlUMLA/edit#heading=h.uyapnx3y2jfu) document for systems administrators.

Unit testing is not set in the GitLab CI/CD Configurations below, however you may still include it as needed with reference to [this snippet](https://l.facebook.com/l.php?u=https%253A%252F%252Fgitlab.com%252Fthinkbit%252Fweb-app-laravel-boilerplate%252Fsnippets%252F1709497&h=AT3jgsT16HAcoNfUJXhbjuGxFk1BLCLjA4LHBbSOyh34RR95f9hd8l2GMiarwD1PWoSKUcsc5aAMphTno9KIzM9WuDwks5s42KGUiU1Em0fVp2GiGQNmhd6OxGYA1y5GiMngsDDCDkPH_9N1).

When hosted on SiteGround or any other cPanel, web (Laravel) apps are released continuously using GitLab CI. Use this [cPanel: GCP: GitLab CI/CD Configuration](https://l.facebook.com/l.php?u=https%253A%252F%252Fgitlab.com%252Fthinkbit%252Fweb-app-laravel-boilerplate%252Fsnippets%252F1700221&h=AT0VPEEhprt-jHQbezusWJOE--XAxzQHaQ7qF1tTkj0j1mYZmD2fH-bNFd-M2eBMDDcgD_UqR1A0C9IoWPKKndmD047Lb9zsjCJHrSfI97c8uv23-AauvYikW5_Qq5KI6vigPXgaJ8rulhBC) snippet and paste it in the root of the project.

When hosted on GCP App Engine, web (Laravel) apps are released continuously using GitLab CI. Use this [GCP: GitLab CI/CD Configuration](https://l.facebook.com/l.php?u=https%253A%252F%252Fgitlab.com%252Fthinkbit%252Fweb-app-laravel-boilerplate%252Fsnippets%252F1700241&h=AT3s-6sKVNNNh_v9plfAclKXeLH9wrfR0fLFuaUg7mtwUqBnihAX7A2EaYJO0tXHd_-vIrGohctFll30kfr9dliLEndPXOsxFrC8bwxROCpjWgDg1N3jnBFc90TIUsOK-8Ydnq66UrEg8Emu) snippet and paste it in the root of the project.

When hosted on AWS Elastic Beanstalk, web (Laravel) apps are released manually using the Upload and Deploy function in the environment dashboard. Use the following snippets to get started: [AWS: Elastic Beanstalk Configuration](https://l.facebook.com/l.php?u=https%253A%252F%252Fgitlab.com%252Fthinkbit%252Fweb-app-laravel-boilerplate%252Fsnippets%252F1701064&h=AT2qjFb89nsuQkQ6WuPxQ1Q7iiVpCwJtX_g5f4v6q9C-jgTH1bLYdMcED3bR94s8fE0tyflo-_S5hqPOHHvISGo5pHY0nBvdYhPEuuqQ073-W9y-jCgARQ2IStd7bMSbezlqYG9k-MuwHM2xGbGhXlDr9KisjA) and [AWS: Elastic Beanstalk Extensions](https://l.facebook.com/l.php?u=https%253A%252F%252Fgitlab.com%252Fthinkbit%252Fweb-app-laravel-boilerplate%252Fsnippets%252F1701078&h=AT33fZbfQa6eJqMG37Bhhvh972g0TBjRUVO-ATaRjx0Ae14gS-GCnbBd4M3LEkYa0GsEeWgbZKEoLI5k8heq6ztH4vzSQqXqFm6HE5diG1pwwud_NyNIHGiqEK0KVoRq9lVm7hs0eLOI-nghxT3s98W3u4k5Tg). Lastly, you must modify the following in .htaccess:

1.  Comment out php_value lines
    
2.  Swap Forcing `https://` snippets
    

 ### Resetting The Database After Each Test


It is often useful to reset your database after each test so that data from a previous test does not interfere with subsequent tests. The RefreshDatabase trait takes the most optimal approach to migrating your test database depending on if you are using an in-memory database or a traditional database. Use the trait on your test class and everything will be handled for you:

    
`<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $response = $this->get('/');

        // ...
    }
}`
  
  



