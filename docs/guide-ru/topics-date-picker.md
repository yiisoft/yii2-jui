Обработка ввода даты с помощью DatePicker
=======================================

Использование виджета [[yii\jui\DatePicker|DatePicker]], для сбора данных от пользователей, может быть выполнено очень удобным способом.

В следующем примере мы будем использовать модель `Task` которая имеет атрибут `deadline`, который должен быть задан пользователем с помощью [ActiveForm](https://github.com/yiisoft/yii2/blob/master/docs/guide/input-forms.md). Значение атрибута будет храниться как временная метка unix в базе данных.


В этой ситуации есть три компонента, которые работают вместе:

- Виджет [[yii\jui\DatePicker|DatePicker]], используется в форме для отображения поля ввода для атрибута модели.
- Компонент [форматирования](https://github.com/yiisoft/yii2/blob/master/docs/guide/output-formatting.md) приложения, который отвечает за формат даты отображаемый пользователю.
- [DateValidator](https://github.com/yiisoft/yii2/blob/master/docs/guide/tutorial-core-validators.md#date) проверяет ввод пользователя и преобразовывает его в временную метку unix.

Во-первых, мы добавляем поле ввода выбора даты в форму с помощью метода [[yii\widgets\ActiveField::widget()|widget()]] поля формы:

```php
<?= $form->field($model, 'deadline')->widget(\yii\jui\DatePicker::className(), [
    // if you are using bootstrap, the following line will set the correct style of the input field
    'options' => ['class' => 'form-control'],
    // ... you can configure more DatePicker properties here
]) ?>
```

Во-вторых - настраиваем валидатор даты в [методе модели rules()](https://github.com/yiisoft/yii2/blob/master/docs/guide/input-validation.md#declaring-rules):

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

Мы также добавили [фильтр значений по умолчанию](https://github.com/yiisoft/yii2/blob/master/docs/guide/input-validation.md#handling-empty-inputs) чтобы гарантировать, что пустые значения сохраняются как `NULL` в базе данных.
Вы можете пропустить этот шаг если ваше значение даты [обязательно](https://github.com/yiisoft/yii2/blob/master/docs/guide/tutorial-core-validators.md#required).

Формат, по умолчанию, для выбора даты и валидатора даты - это значение `Yii::$app->formatter->dateFormat` поэтому вы можете использовать это свойство для настройки формата даты всего приложения.
Чтобы изменить формат даты, вам необходимо нстроить [[yii\validators\DateValidator::format]] и [[yii\jui\DatePicker::dateFormat]].
