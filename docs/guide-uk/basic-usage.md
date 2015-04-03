Основне використання
====================

Наступний рядок коду в файлі буде виводити віджет [JQuery UI DatePicker](http://api.jqueryui.com/datepicker/):

```php
<?= yii\jui\DatePicker::widget(['name' => 'attributeName']) ?>
```

Налаштування опцій Jquery UI повинні бути виконані з атрибутом clientOptions:

```php
<?= yii\jui\DatePicker::widget(['name' => 'attributeName', 'clientOptions' => ['defaultDate' => '2014-01-01']]) ?>
```

Якщо ви хочете використовувати віджет JUI в ActiveForm, ви повинні зробити наступне:

```php
<?= $form->field($model,'attributeName')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => '2014-01-01']]) ?>
```
