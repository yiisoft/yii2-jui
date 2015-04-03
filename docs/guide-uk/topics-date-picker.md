Обробка вводу дати з допомогою DatePicker
=========================================

Збирання вводу дат від користувачів можливо виконати даже зручним способом, завдяки віджету [[yii\jui\DatePicker|DatePicker]].
В наступному прикладі ми будемо використовувати модель `Task`, яка має атрибут `deadline`,
який повинен бути встановлений користувачем, використовуючи [ActiveForm](https://github.com/yiisoft/yii2/blob/master/docs/guide/input-forms.md).
Значення атрибуту буде збережено в якості мітки часу Unix в базі даних.

В цій ситуації є 3 компоненти, що взаємодіють між собою:

- Віджет [[yii\jui\DatePicker|DatePicker]], який використовується у формі для відображення поля введення атрибуту моделі.
- Компонент додатку [formatter](https://github.com/yiisoft/yii2/blob/master/docs/guide/output-formatting.md),
який відповідає за формат дати, що відображається користувачеві.
- [DateValidator](https://github.com/yiisoft/yii2/blob/master/docs/guide/tutorial-core-validators.md#date),
який перевіряє що ввів користувач і конвертує в мітку часу Unix.

Спершу ми додамо поле вибору дати до форми, використовуючи метод [[yii\widgets\ActiveField::widget()|widget()]] поля форми:

```php
<?= $form->field($model, 'deadline')->widget(\yii\jui\DatePicker::className(), [
    // якщо ви використовуєте bootstrap, наступний рядок буде встановлювати правильний стиль для поля вводу
    'options' => ['class' => 'form-control'],
    // ... ви можете налаштувати більше властивостей DatePicker тут
]) ?>
```

Другим кроком буде налаштування валідатора дати в 
[методі моделі rules()](https://github.com/yiisoft/yii2/blob/master/docs/guide/input-validation.md#declaring-rules):

```php
public function rules()
{
    return [
        // ...

        // забезпечить збереження порожніх значень в базі данних у вигляді NULL
        ['deadline', 'default', 'value' => null],

        // валідація дати і перезапис `deadline` з міткою часу Unix
        ['deadline', 'date', 'timestampAttribute' => 'deadline'],
    ];
}
```

Ми можемо також додати [стандартні значення фільтру](https://github.com/yiisoft/yii2/blob/master/docs/guide/input-validation.md#handling-empty-inputs),
щоб забезпечити збереження порожніх значень в базі данних у вигляді `NULL`.
Ви можете пропустити цей крок, якщо значення дати є 
[обовʼязковим](https://github.com/yiisoft/yii2/blob/master/docs/guide/tutorial-core-validators.md#required).

Формат за замовчуванням для вибору дати і валідації значення дати міститься в `Yii::$app->formatter->dateFormat`, 
таким чином ви можете використовувати ці властивості, щоб налаштувати формат дати для всього додатку.
Щоб змінити формат дати ви повинні налаштувати [[yii\validators\DateValidator::format]] та [[yii\jui\DatePicker::dateFormat]].
