基本用法
===========

下面的代码将在视图文件中呈现 [jQuery UI DatePicker](http://api.jqueryui.com/datepicker/) 小部件：

```php
<?= yii\jui\DatePicker::widget(['name' => 'attributeName']) ?>
```

通过 clientOptions 属性配置 jQuery UI 选项：

```php
<?= yii\jui\DatePicker::widget(['name' => 'attributeName', 'clientOptions' => ['defaultDate' => '2014-01-01']]) ?>
```

在 ActiveForm 使用 JUI 小部件：

```php
<?= $form->field($model, 'attributeName')->widget(DatePicker::className(), ['clientOptions' => ['defaultDate' => '2014-01-01']]) ?>
```
