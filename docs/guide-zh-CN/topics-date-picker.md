使用 DatePicker 处理日期输入
=======================================

使用 [[yii\jui\DatePicker|DatePicker]] 小部件，从而便捷的使用户进行日期输入。
在下面的例子中，我们将使用一个 `Task` 模型（model），它有一个 `deadline` 属性，用户通过 [ActiveForm](https://github.com/yiisoft/yii2/blob/master/docs/guide/input-forms.md) 进行输入。 属性值将作为 unix 时间戳存储在数据库中。

在这种情况下，有3个组件一起使用：

- [[yii\jui\DatePicker|DatePicker]] 用于在表单中显示模型属性的输入字段。
- [formatter](https://github.com/yiisoft/yii2/blob/master/docs/guide/output-formatting.md) ，负责向用户显示日期格式。
- [DateValidator](https://github.com/yiisoft/yii2/blob/master/docs/guide/tutorial-core-validators.md#date) 用于验证用户输入并将其转换为unix时间戳。

首先，我们通过 [[yii\widgets\ActiveField::widget()|widget()]] 方法将日期选择器添加到表单中：

```php
<?= $form->field($model, 'deadline')->widget(\yii\jui\DatePicker::className(), [
    // if you are using bootstrap, the following line will set the correct style of the input field
    'options' => ['class' => 'form-control'],
    // ... you can configure more DatePicker properties here
]) ?>
```

然后在 [模型验证规则](https://github.com/yiisoft/yii2/blob/master/docs/guide/input-validation.md#declaring-rules) 中配置日期验证器：

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

我们还添加了一个 [默认值过滤](https://github.com/yiisoft/yii2/blob/master/docs/guide/input-validation.md#handling-empty-inputs) ，以确保在数据库中将空值存储为 `NULL` 。
如果的日期值为 [必填](https://github.com/yiisoft/yii2/blob/master/docs/guide/tutorial-core-validators.md#required)）则可忽略此项。

日期选择器和日期验证器的默认格式是 `Yii::$app->formatter->dateFormat` 的值，因此可以使用此属性来配置整个应用程序的日期格式。
要更改日期格式，可通过配置 [[yii\validators\DateValidator::format]] 和 [[yii\jui\DatePicker::dateFormat]] 。
