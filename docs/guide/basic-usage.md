Basic Usage
===========

The following
single line of code in a view file would render a [jQuery UI DatePicker](http://api.jqueryui.com/datepicker/) widget:

```php
<?= yii\jui\DatePicker::widget(['name' => 'attributeName']) ?>
```

Configuring the jQuery UI options should be done using the clientOptions attribute:

```php
<?= yii\jui\DatePicker::widget(['name' => 'attributeName', 'clientOptions' => ['defaultDate' => '2014-01-01']]) ?>
```

If you want to use the JUI widget in an ActiveForm, it can be done like this:

```php
<?= $form->field($model, 'attributeName')->widget(DatePicker::className(), ['clientOptions' => ['defaultDate' => '2014-01-01']]) ?>
```
