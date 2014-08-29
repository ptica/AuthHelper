AuthHelper
==========

You've configured your `Auth->authenticate` and `Auth->authorize`
and now you just want to hide the links that current user
is not allowed to access anyway.

Enter `AuthHelper->is_allowed()`


TODO
----
* [ ] resulting access should be cached (in production mode)
* [ ] account for access through `$this->Auth->allow('action')`
* [ ] access the AuthComponent more cleanly

Installation
------------

The easiest way to install the plugin is to use Composer.
Install Composer in the app folder of your application and then run:

```
php composer.phar require ptica/auth-helper:dev-master
```
Once the plugin is in place, load it in your `app/Config/bootstrap.php` by adding this line:

```php
# app/Config/bootstrap.php
CakePlugin::load('AuthHelper');
```

As I am currently unable to access the AuthComponent from a helper
we need to resort to an ugly trick and sneak the initialized AuthComponent into
the helper using:

```php
# AppController.php
public function beforeRender() {
    // UGLY HACK
    // pass the initialized Auth component into our helper
    // (under a settings called 'Auth') so we are able
    // to reach AuthComponent::isAuthorized()
    $this->helpers['AuthHelper.Auth']['Auth'] = $this->Auth;
}
```

Now to use the Helper, simply load it in your Controller:

```php
public $helpers = array('AuthHelper.Auth');
```

Finally do the auth check:

```php
# any_view.ctp
if ($this->Auth->is_allowed('/controller/action', AuthComponent::user()))  { ... }
```
