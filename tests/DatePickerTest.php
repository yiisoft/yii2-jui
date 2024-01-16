<?php
namespace yiiunit\extensions\jui;

use Yii;
use yii\jui\DatePicker;
use yii\web\AssetManager;
use yii\web\View;

/**
 * Tests for DatePicker widget
 *
 * @group datepicker
 */
class DatePickerTest extends TestCase
{
    public function testLanguageAsset()
    {
        if (version_compare(str_replace('-dev', '', Yii::getVersion()), '2.0.3', '<')) {
            $this->markTestSkipped('This feature is only available since Yii 2.0.3.');
        }

        $this->mockWebApplication([
            'components' => [
                'assetManager' => [
                    'basePath' => '@yiiunit/extensions/jui/data/web/assets',
                    'baseUrl' => '/assets',
                    'appendTimestamp' => true,
                ],
            ]
        ]);

        DatePicker::$counter = 0;
        $out = DatePicker::widget([
            'name' => 'test',
            'value' => '2015-04-09',
            'language' => 'ru-RU',
            'dateFormat' => 'yyyy-MM-dd',
        ]);

        $out = Yii::$app->view->renderFile('@yiiunit/extensions/jui/data/views/layout.php', [
            'content' => $out,
        ]);

        // https://github.com/yiisoft/yii2-jui/issues/6
        $this->assertMatchesRegularExpression(
            '~<script src="/assets/[0-9a-f]+/ui/i18n/datepicker-ru.js\?v=\d+"></script>~',
            $out,
            'There should be language asset registered with timestamp appended.',
        );
    }

    public function invalidDateInputProvider()
    {
        return [
            ['0000!'],
            ['Ноя 2, 2016'],
            ['12. Dezember 2016'],
            ['invalid date'],
        ];
    }

    /**
     * No exception should be thrown by the formatter, instead the value should stay as is in this case
     * @dataProvider invalidDateInputProvider
     */
    public function testInvalidDateValue($value)
    {
        $this->mockWebApplication([
            'components' => [
                'assetManager' => [
                    'basePath' => '@yiiunit/extensions/jui/data/web/assets',
                    'baseUrl' => '/assets',
                ],
            ]
        ]);

        ob_start();
        echo DatePicker::widget([
            'value' => $value
        ]);
        $output = ob_get_clean();
        $this->assertStringContainsString($value, $output);
    }
}
