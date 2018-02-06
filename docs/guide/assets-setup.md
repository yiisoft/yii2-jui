Assets Setup
============

This extensions relies on [Bower](http://bower.io/) and/or [NPM](https://www.npmjs.org/) packages for the asset installation.
Before using this package you should decide in which way you will install those packages in your project.


## Using asset-packagist repository

You can setup [asset-packagist.org](https://asset-packagist.org) as package source for the JQuery UI assets.

In the `composer.json` of your project, add the following lines:

```json
"repositories": [
    {
        "type": "composer",
        "url": "https://asset-packagist.org"
    }
]
```

Adjust `@npm` and `@bower` in you application configuration:

```php
return [
    //...
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    //...
];
```


## Using composer asset plugin

Install [composer asset plugin](https://github.com/francoispluchino/composer-asset-plugin/) globally, using following command:

```
composer global require "fxp/composer-asset-plugin:^1.4.0"
```

Add the following lines to `composer.json` of your project to adjust directories where the installed packages
will be placed, if you want to publish them using Yii:

```json
"extra": {
    "asset-installer-paths": {
        "npm-asset-library": "vendor/npm",
        "bower-asset-library": "vendor/bower"
    }
}
```

Then you can run composer install/update command to pick up JQuery UI assets.

> Note: `fxp/composer-asset-plugin` significantly slows down the `composer update` command in comparison
  to asset-packagist.


## Using Bower/NPM client directly

You can install JQuery UI assets directly via Bower or NPM client.
In the `package.json` of your project, add the following lines:

```json
{
    ...
    "dependencies": {
        "jquery-ui": "1.12.1",
        ...
    }
    ...
}
```

In the `composer.json` of your project, add the following lines in order to prevent redundant JQuery UI asset installation:

```json
"replace": {
    "bower-asset/jquery-ui": ">=1.12.0"
},
```


## Using CDN

You may use JQuery UI assets from [official CDN](https://code.jquery.com/ui/).

In the `composer.json` of your project, add the following lines in order to prevent redundant JQuery UI asset installation:

```json
"replace": {
    "bower-asset/jquery-ui": ">=1.12.0"
},
```

Configure 'assetManager' application component, overriding JQuery UI assent bundles with CDN links:

```php
return [
    'components' => [
        'assetManager' => [
            // override bundles to use CDN :
            'bundles' => [
                'yii\jui\JuiAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://code.jquery.com/ui/1.12.1',
                    'js' => [
                        'jquery-ui.min.js'
                    ],
                ],
                'yii\jui\DatePickerLanguageAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://code.jquery.com/ui/1.12.1',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```
