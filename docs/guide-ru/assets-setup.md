Настройка ресурсов
============

Эти расширения используются для пакетов [Bower](http://bower.io/) и/или [NPM](https://www.npmjs.org/) для установки ресурсов.
Перед использованием этого пакета вы должны решить, каким образом вы будете устанавливать его в свой проект.


## Использование репозитория asset-packagist

Вы можете нстроить [asset-packagist.org](https://asset-packagist.org) как источник пакета для ресурсов JQuery UI.

В `composer.json` вашего проекта, добавте следующие строки:

```json
"repositories": [
    {
        "type": "composer",
        "url": "https://asset-packagist.org"
    }
]
```

Настройте `@npm` и `@bower` в конфигурации вашего приложения:

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


## Использование планина composer

Установите глобально [composer asset plugin](https://github.com/francoispluchino/composer-asset-plugin/), используя следующую команду:

```
composer global require "fxp/composer-asset-plugin:^1.4.0"
```

Добавьте следующие строки в `composer.json` вашего проекта, чтобы настроить каталоги, в которых будут размещаться установленные пакеты, если вы хотите опубликовать их с помощью Yii:

```json
"extra": {
    "asset-installer-paths": {
        "npm-asset-library": "vendor/npm",
        "bower-asset-library": "vendor/bower"
    }
}
```

Затем вы можете запустить команду composer install/update чтобы получить ресурсы JQuery UI.

> Note: `fxp/composer-asset-plugin` значительно замедляет команду `composer update` по сравнению с asset-packagist.

## Использование клиента Bower/NPM напрямую

Вы можете установить JQuery UI ресурсы непосредственно через Bower или NPM клиент.
В `package.json` вашего проекта добавьте следующие строки:

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

В `composer.json` вашего проекта, добавьте следующие строки чтобы предотвратить избыточную установку ресурсов JQuery UI:

```json
"replace": {
    "bower-asset/jquery-ui": ">=1.12.0"
},
```


## Использование CDN

Вы можете использовать ресурсы JQuery UI из [официального CDN](https://code.jquery.com/ui/).

В `composer.json` вашего проекта, добавьте следующие строки чтобы предотвратить избыточную установку ресурсов JQuery UI:

```json
"replace": {
    "bower-asset/jquery-ui": ">=1.12.0"
},
```

Настройте компонент приложения 'assetManager', переопределив пакеты согласования ресурсов JQuery UI с сылками CDN:

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
