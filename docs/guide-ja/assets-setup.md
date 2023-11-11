アセットのセットアップ
======================

このパッケージは、アセットのインストールについて、[Bower](https://bower.io/) および/または [NPM](https://www.npmjs.org/) のパッケージに依存しています。
このパッケージを使う前に、これらのパッケージをあなたのプロジェクトにインストールする方法を決定しなければなりません。


## asset-packagist レポジトリを使う

[asset-packagist.org](https://asset-packagist.org) を Bootstrap アセットのソース・パッケージとしてセットアップすることが出来ます。

あなたのプロジェクトの `composer.json` に下記の行を追加して下さい。

```json
"repositories": [
    {
        "type": "composer",
        "url": "https://asset-packagist.org"
    }
]
```

そして、アプリケーション構成で `@npm` と `@bower` を設定します。

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


## composer アセット・プラグインを使う

次のコマンドを使って [composer アセット・プラグイン](https://github.com/francoispluchino/composer-asset-plugin/) をグローバルにインストールします。

```
composer global require "fxp/composer-asset-plugin:^1.4.0"
```

Yii を使ってアセットを発行したい場合は、あなたのプロジェクトの `composer.json` に下記の行を追加して、
インストールされるパッケージが置かれるディレクトリを設定します。

```json
"extra": {
    "asset-installer-paths": {
        "npm-asset-library": "vendor/npm",
        "bower-asset-library": "vendor/bower"
    }
}
```

これで、`composer install/update` コマンドを実行すると、JQuery UI のアセットを取得することが可能になります。

> Note: `fxp/composer-asset-plugin` は asset-packagist に比べると、`composer update`
  コマンドを著しく遅くさせます。


## Bower/NPM クライアントを直接に使う

Bower または NPM のクライアントを直接に使って JQuery UI のアセットをインストールすることが出来ます。
あなたのプロジェクトの `package.json` に次の行を追加して下さい。

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

あなたのプロジェクトの `package.json` に次の行を追加して、JQuery UI アセットの冗長なインストールを防止します。

```json
"replace": {
    "bower-asset/jquery-ui": ">=1.12.0"
},
```


## CDN を使う

[公式 CDN](https://code.jquery.com/ui/) から JQuery UI アセットを取得して使うことが出来ます。

あなたのプロジェクトの `package.json` に次の行を追加して、JQuery UI アセットの冗長なインストールを防止します。

```json
"replace": {
    "bower-asset/jquery-ui": ">=1.12.0"
},
```

'assetManager' アプリケーション・コンポーネントを構成して、JQuery UI アセット・バンドルを CDN のリンクでオーバーライドします。

```php
return [
    'components' => [
        'assetManager' => [
            // バンドルをオーバーライドして CDN を使う
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
