Uso Básico
==========

La siguiente
linea de código en una vista renderizaría un [jQuery UI DatePicker](http://api.jqueryui.com/datepicker/) widget:

```php
<?= yii\jui\DatePicker::widget(['name' => 'attributeName']) ?>
```

Para configurar las opciones de jQuery UI debe usarse el atributo clientOptions:

```php
<?= yii\jui\DatePicker::widget(['name' => 'attributeName', 'clientOptions' => ['defaultDate' => '2014-01-01']]) ?>
```

Si desea usar algún widget JUI en un ActiveForm, puede hacerse de la siguiente manera:

```php
<?= $form->field($model, 'attributeName')->widget(DatePicker::className(), ['clientOptions' => ['defaultDate' => '2014-01-01']]) ?>
```
