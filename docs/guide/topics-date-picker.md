Handling date input with the DatePicker
=======================================

Using the [[yii\jui\DatePicker|DatePicker]] widget, collecting date input from users can be done in a very convenient way.
In the following example we will use a `Task` model which has a `deadline` attribute, which should be set by a user using
an [ActiveForm](https://github.com/yiisoft/yii2/blob/master/docs/guide/input-forms.md). The attribute value will be stored as a unix timestamp in the database.

In this situation there are 3 components that play together:

- The [[yii\jui\DatePicker|DatePicker]] widget, which is used in the form to display the input field for the model's attribute.
- The [formatter](https://github.com/yiisoft/yii2/blob/master/docs/guide/output-formatting.md) application component which is responsible for the date format that is displayed to the user.
- The [DateValidator](https://github.com/yiisoft/yii2/blob/master/docs/guide/tutorial-core-validators.md#date) which will validate the user input and convert it to a unix timestamp.

First, we add the date picker input field to the form by using the [[yii\widgets\ActiveField::widget()|widget()]] method of the form field:

```php
<?= $form->field($model, 'deadline')->widget(\yii\jui\DatePicker::className(), [
    // if you are using bootstrap, the following line will set the correct style of the input field
    'options' => ['class' => 'form-control'],
    // ... you can configure more DatePicker properties here
]) ?>
```

The second step is to configure the date validator in the [model's rules() method](https://github.com/yiisoft/yii2/blob/master/docs/guide/input-validation.md#declaring-rules):

```php
public function rules()
{
    return [
        // ...

        // ensure empty values are stored as NULL in the database
        ['deadline', 'default', 'value' => null],

        // validate the date and overwrite `deadline` with the unix timestamp
        ['deadline', 'date', 'timestampAttribute' => 'deadline'],
    ];
}
```

We have also added a [default value filter](https://github.com/yiisoft/yii2/blob/master/docs/guide/input-validation.md#handling-empty-inputs) to ensure empty values are stored as `NULL` in the database.
You may skip this step if your date value is [required](https://github.com/yiisoft/yii2/blob/master/docs/guide/tutorial-core-validators.md#required).

The default format of both, date picker and date validator is the value of `Yii::$app->formatter->dateFormat` so you can use this
property to configure the format of the date for the whole application.
To change the date format you have to configure [[yii\validators\DateValidator::format]] and [[yii\jui\DatePicker::dateFormat]].
