jQuery Plus Bundle for Symfony 2.1
=======================

## Current Version

- jQuery 1.8.2
- JQuery-ui 1.8.23
- Select2 3.2
- GMaps 1.0

## Installation

### Add bundle to your composer.json file

``` js
// composer.json

{
    "require": {
		// ...
        "ner0tic/jquery-plus-bundle": "*"
    }
}
```

### Add bundle to your application kernel

``` php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Ner0tic\JQueryPlusBundle\Ner0ticJQueryPlusBundle(),
        // ...
    );
}
```

### Download the bundle using Composer

``` bash
$ php composer.phar update ner0tic/jquery-plus-bundle
```

### Install assets

Given your server's public directory is named "web", install the public vendor resources

``` bash
$ php app/console assets:install web --symlink # drop the symlink flag to create copies instead
```

## Usage

### Twig

``` html
<script type="text/javascript" src="{{ asset('bundles/ner0ticjqueryplus/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bundles/ner0ticjqueryplus/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bundles/ner0ticjqueryplus/js/select2.js') }}"></script>
<script type="text/javascript" src="{{ asset('bundles/ner0ticjqueryplus/js/gmaps.js') }}"></script>
```


[1]: http://jquery.com
[2]: http://symfony.com