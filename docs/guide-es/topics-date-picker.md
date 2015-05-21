Manejando entradas de fechas con DatePicker
===========================================

Usando el widget [[yii\jui\DatePicker|DatePicker]], la recogida de entradas de fechas de los usuarios se puede hacer de manera muy conveniente.
En el siguiente ejemplo nosotros utilizaremos un modelo `Task` que tiene un atributo `deadline`, el cual debería ser asignado por un
usuario usando un [ActiveForm](https://github.com/yiisoft/yii2/blob/master/docs/guide-es/input-forms.md). El valor del atributo
debe ser almacenado como un unix timestamp en la base de datos.

En esta situación hay 3 componentes que funcionan juntos:

 - El widget [[yii\jui\DatePicker|DatePicker]], el cual es usado en el formulario para mostrar los campos de entrada para los atributos de los modelos.
 - El componente de aplicación [formatter](https://github.com/yiisoft/yii2/blob/master/docs/guide-es/output-formatting.md) es el responsable de formatear los datos que son mostrados al usuario.
 - El [DateValidator](https://github.com/yiisoft/yii2/blob/master/docs/guide-es/tutorial-core-validators.md#date) validará la entrada del usuario y lo convertirá en un unix timestamp.

Primero, nosotros añadiremos el campo de entrada datepicker para el formulario usando el método [[yii\widgets\ActiveField::widget()|widget()]] del campo del formulario:

```php
<?= $form->field($model, 'deadline')->widget(\yii\jui\DatePicker::className(), [
    // si estás usando bootstrap, la siguiente linea asignará correctamente el estilo del campo de entrada
    'options' => ['class' => 'form-control'],
    // ... puedes configurar más propiedades del DatePicker aquí
]) ?>
```

El segundo paso es configurar el validador de fechas en el [método rules() del modelo](https://github.com/yiisoft/yii2/blob/master/docs/guide-es/input-validation.md#declaring-rules):

```php
public function rules()
{
    return [
        // ...

        // asegura que los valores vacíos son almacenados como NULL en la base de datos
        ['deadline', 'default', 'value' => null],

        // valida la fecha y sobrescribe `deadline` con el unix timestamp
        ['deadline', 'date', 'timestampAttribute' => 'deadline'],
    ];
}
```

Nosotros tenemos también que añadir un [filtro de valor por defecto](https://github.com/yiisoft/yii2/blob/master/docs/guide-es/input-validation.md#handling-empty-inputs) que asegure
que los valores vacíos son almacenados como `NULL` en la base de datos.
Puedes saltarte este paso si el valor de tu fecha es [requerido](https://github.com/yiisoft/yii2/blob/master/docs/guide-es/tutorial-core-validators.md#required).

El formato por defecto de ambos, datepicker y el validador de fechas (date validator) es el valor de `Yii::$app->formatter->dateFormat` así que puedes usar esta
propiedad para configurar el formato de las fechas para toda la aplicación.
Para cambiar el formato de la fecha debes configurar [[yii\validators\DateValidator::format]] y [[yii\jui\DatePicker::dateFormat]]
