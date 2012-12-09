LandmarxBundle
=============

1. [Installation](LandmarxBundle/blob/master/README.md)
2. [Usage](LandmarxBundle/blob/master/Resources/doc/usage.md)

Installation
------------
Add to `composer.json`
```php
"require": {
    "ner0tic/landmarx-bundle": "*",
    // ...
}
```
Register the bundle
Add to `app/AppKernel.php`
```php
public function registerBundles()
{
    $bundles = array(
        new Landmarx\Bundle\LandmarxBundle\LandmarxBundle(),
        // ...
    );
}
```

## Credits

Based on [KnpMenu](https://github.com/KnpLabs/KnpMenu)