Базовое использование
===========

Следующая строка кода в файле вида будет отображать виджет [jQuery UI DatePicker](http://api.jqueryui.com/datepicker/):

```php
<?= yii\jui\DatePicker::widget(['name' => 'attributeName']) ?>
```

Настройка параметров jQuery UI должна выполняться с использованием атрибута `clientOptions`:

```php
<?= yii\jui\DatePicker::widget(['name' => 'attributeName', 'clientOptions' => ['defaultDate' => '2014-01-01']]) ?>
```

Если вы хотите использовать виджет JUI в ActiveForm, это можно сделать следующим образом:

```php
<?= $form->field($model, 'attributeName')->widget(DatePicker::className(), ['clientOptions' => ['defaultDate' => '2014-01-01']]) ?>
```
