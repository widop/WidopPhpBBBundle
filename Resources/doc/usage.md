# Usage

In order to use the bundle, first, you need to configure it.

## Configuration

``` yaml
# app/config.yml

widop_php_bb:
    path: %kernel.root_dir%/../vendor/widop/phpbb3
    web_path: /forum
```

The configuration is pretty simple, you just need to set the phpbb absolute `path`, and its 
`web_path` path. The `web_path` is where you symlinked it in you `/web` directory.

## Usage

In order to login/logout automatically on php throw your symfony2 account,
you need to create an authentication success handler & a logout success handler.
In theses handlers, you just need to inject the `widop_php_bb.authentication_manager` service a use it.

In order to register & delete automatically you phpbb account when you create or delete
an account on your symfony2 project, you can use the `widop_php_bb.user_manager` and use it.

There is no more documentation because the twos services are already well documented in the code.

## Initial Forum Setup

If using a different database for phpbb, you'll need to create it:

```
mysql> create database my_phpbb_db;
```

Proper folder permissions must be setup. Refer to the Symfony2 [permissions guide](http://symfony.com/doc/2.0/book/installation.html) for your exact system. The following example is for Ubuntu-based systems with ```setfacl``` support:

```
mkdir -p web/forum/phpbb_seo/cache
sudo setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx web/forum/cache web/forum/files web/forum/store web/forum/phpbb_seo/cache web/forum/gym_sitemaps/cache/ web/forum/config.php web/forum/images/avatars/upload/
sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx web/forum/cache web/forum/files web/forum/store web/forum/phpbb_seo/cache web/forum/gym_sitemaps/cache/ web/forum/config.php web/forum/images/avatars/upload/
```

Visit the forum's installation URL: http://client.com/forum/install/index.php and follow the installation steps. Fill out the information as required for your system. Note the "Administrator details" section. Make sure to use a valid username and password combination from your symfony2 app.

When finished, do NOT login via phpbb.

Make sure all the cookie settings match your symfony2 app exactly. If not, your phpbb user will NOT be logged in. Changing the ```cookie_name``` is optional and will not affect your symfony2 app. However, the other three values (```cookie_domain```, ```cookie_path``` and ```cookie_secure``` must match):

```
mysql> select * from phpbb_config where config_name like 'cookie%';
+---------------+---------------------+------------+
| config_name   | config_value        | is_dynamic |
+---------------+---------------------+------------+
| cookie_domain | client.com          |          0 |
| cookie_name   | phpbb3_eldvd        |          0 |
| cookie_path   | /                   |          0 |
| cookie_secure | 0                   |          0 |
+---------------+---------------------+------------+
4 rows in set (0.00 sec)
```

Clear the cache for good measure:

```
rm -rf web/forum/cache/*
```

Remove installation directory:

```
rm -rf web/forum/install/
```

### Troubleshooting

If you can't login try changing the phpbb_users password for your user to the same hash as in your symfony2 app. For instance, assuming the hashed password in your Symfony2 app is ```7e4d880a7d856442d4aeacba6922e72715466d08```, then do:

```
update phpbb_users set user_password="7e4d880a7d856442d4aeacba6922e72715466d08" where user_id=2;
update phpbb_users set user_login_attempts=0 where user_id=2;
```

For all new users, you'll create from your app. For example, a new admin:

```
$phpbbuserman = $kernel->getContainer()->get('widop_php_bb.user_manager');
// Here 5 and 3 are "owner" (phpbb admin) type.
$userGroup = 5; 
$userType = 3;
$phpbbuserman->addUser('sf2_username', 'hashed_password_from_sf2_user', 
    'email@email.com', $userGroup, $userType);
```

## PhpBB Configuration

If you want keep a sync between phpbb and your application, you need to disable all user control panel which allow to
update account informations in order to make your symfony app mandatory.

In order to do that, go to Sytem -> User Control Panel -> Profile & so, disable the panel you want.
