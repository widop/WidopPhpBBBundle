# Installation

## Symfony 2.1.*

### Add the WidopPhpBBBundle to your composer configuration

Add the bundle to the require section of your `composer.json`

``` json
{
    "require": {
        "widop/phpbb-bundle": "dev-master"
    }
}
```

Run the composer update command

``` bash
$ php composer.phar update
```

### Add the WidopPhpBBBundle to your application kernel

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        //..
        new Widop\PhpBBBundle\WidopPhpBBBundle(),
    );
}
```

## Symfony 2.0.*

### Add respectivly the WidopPhpBBBundle & the Widop phpbb3 fork to your vendor/bundles/ & vendor directory

#### Using the vendors script

Add the following lines in your ``deps`` file

```
[phpbb3]
    git=http://github.com/widop/phpbb3.git

[WidopPhpBBBundle]
    git=http://github.com/widop/WidopPhpBBBundle.git
    target=bundles/Widop/PhpBBBundle
```

Run the vendors script

``` bash
$ php bin/vendors update
```

#### Using submodules

``` bash
$ git submodule add http://github.com/widop/phpbb3.git vendor/phpbb3
$ git submodule add http://github.com/widop/WidopPhpBBBundle.git vendor/bundles/Widop/PhpBBBundle
```

### Add the Widop namespace to your autoloader

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    //..
    'Widop' => __DIR__.'/../vendor/bundles',
);
```

### Add the WidopPhpBBBundle to your application kernel

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        //..
        new Widop\PhpBBBundle\WidopPhpBBBundle(),
    );
}
```

## Make phpbb accessible

Create a symlink in your web directory:

``` bash
$ ln -s /your/path/vendor/widop/phpbb3 /your/path/web/phpbb
```

Update your htaccess:

```
RewriteRule ^phpbb/$ phpbb/index.php [QSA,L]
```