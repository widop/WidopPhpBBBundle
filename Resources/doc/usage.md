# Usage

In order to use the bundle, first, you need to configure it.

## Configuration

``` yaml
# app/config.yml

widop_php_bb:
    path: %kernel.root_dir%/../vendor/widop/phpbb3
```

The configuration is pretty simple... You just need to set the phpbb root path.

## Usage

In order to login/logout automatically on php throw your symfony2 account,
you need to create an authentication success handler & a logout success handler.
In theses handlers, you just need to inject the `widop_php_bb.authentication_manager` service a use it.

In order to register & delete automatically you phpbb account when you create or delete
an account on your symfony2 project, you can use the `widop_php_bb.user_manager` and use it.

There is no more documentation because the twos services are already well documented in the code.

## PhpBB Configuration

If you want keep a sync between phpbb and your application, you need to disable all user control panel which allow to
update account informations in order to make your symfony app mandatory.

In order to do that, go to Sytem -> User Control Panel -> Profile & so, disable the panel you want.
