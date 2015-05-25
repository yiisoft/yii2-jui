基本的な使用方法
================

ビューファイルに、たった一行、下記のコードを記述すると、[jQuery UI DatePicker](http://api.jqueryui.com/datepicker/) ウィジェットがレンダリングされます。

```php
<?= yii\jui\DatePicker::widget(['name' => 'attributeName']) ?>
```

jQuery UI のオプションは、`clientOptions` 属性を使って構成しなければなりません。

```php
<?= yii\jui\DatePicker::widget(['name' => 'attributeName', 'clientOptions' => ['defaultDate' => '2014-01-01']]) ?>
```

ActiveForm の中で JUI ウィジェットを使いたい場合は、次のようにすることが出来ます。

```php
<?= $form->field($model, 'attributeName')->widget(DatePicker::className(), ['clientOptions' => ['defaultDate' => '2014-01-01']]) ?>
```
