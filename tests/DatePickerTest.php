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
        $this->resetApplication();
    }

    protected function resetApplication()
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
        $this->checkDatePickerAsset('zh-Hant-CN', 'zh-CN');
        $this->checkDatePickerAsset('zh-CN', 'zh-CN');
        $this->checkDatePickerAsset('ru_RU', 'ru');
        $this->checkDatePickerAsset('sr_Latn_SR_REVISED@currency=USD', 'sr-SR');
        $this->checkDatePickerAsset('nonexisting', false);
    }

    protected function checkDatePickerAsset($language, $expectedAssetLanguage)
    {
        DatePicker::$counter = 0;
        $out = DatePicker::widget([
            'name' => 'test',
            'value' => '2015-04-09',
            'language' => $language,
            'dateFormat' => 'yyyy-MM-dd',
        ]);

        $out = Yii::$app->view->renderFile('@yiiunit/extensions/jui/data/views/layout.php', [
            'content' => $out,
        ]);

        // https://github.com/yiisoft/yii2-jui/issues/6
        if ($expectedAssetLanguage === false) {
            static::assertNotRegExp(
                '~<script src="/assets/[0-9a-f]+/ui/i18n/datepicker-~',
                $out,
                'There should be no attempt to register non-existing language asset.'
            );
        } else {
            static::assertRegExp(
                '~<script src="/assets/[0-9a-f]+/ui/i18n/datepicker-' . $expectedAssetLanguage . '\.js\?v=\d+"></script>~',
                $out,
                'There should be "' . $expectedAssetLanguage . '" language asset registered with timestamp appended.'
            );
        }
        $this->resetApplication();
    }
}
