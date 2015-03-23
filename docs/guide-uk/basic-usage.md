Основне використання
====================

Наступний рядок коду в файлі буде *виконувати* [JQuery UI DatePicker](http://api.jqueryui.com/datepicker/) віджет:

```php
<?= yii\jui\DatePicker::widget(['name' => 'attributeName']) ?>
```

Налаштування опцій Jquery UI повинні бути воконані з атрибутом clientOptions:

```php
<?= yii\jui\DatePicker::widget(['name' => 'attributeName', 'clientOptions' => ['defaultDate' => '2014-01-01']]) ?>
```

Якщо ви хочете використовувати JUI віджет в ActiveForm, ви повинні зробити наступне:

```php
<?= $form->field($model,'attributeName')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => '2014-01-01']]) ?>
```
