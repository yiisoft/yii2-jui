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
    protected function setUp()
    {
        $this->mockWebApplication([
            'components' => [
                'assetManager' => [
                    'basePath' => '@yiiunit/extensions/jui/data/web/assets',
                    'baseUrl' => '/assets',
                    'appendTimestamp' => true,
                ],
            ]
        ]);
    }

    public function testLanguageAsset()
    {
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
        static::assertRegExp(
            '~<script src="/assets/[0-9a-f]+/ui/i18n/datepicker-ru.js\?v=\d+"></script>~',
            $out,
            'There should be language asset registered with timestamp appended.'
        );
    }
}
