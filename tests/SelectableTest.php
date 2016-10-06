<?php
namespace yiiunit\extensions\jui;

use Yii;
use yii\jui\Selectable;
use yii\web\AssetManager;
use yii\web\View;

/**
 * Tests for Selectable widget
 *
 * @group selectable
 */
class SelectableTest extends TestCase
{
    public function testBeginEnd()
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

        $out = Selectable::begin([
            'id' => 'my-selectable-items',
            'clientOptions' => [
                'filter' => 'my-selectable-item',
                'tolerance' => 'touch',
            ]
        ]);

        $out .= join('\n', [
            '<ul>',
                '<li class="my-selectable-item">Item 1</li>',
                '<li class="my-selectable-item">Item 2</li>',
                '<li class="no-selectable-item">Item 3</li>',
                '<li class="my-selectable-item">Item 4</li>',
            '</ul>',
            '<div>',
                '<div>',
                    '<div class="my-selectable-item">Another item</div>',
                '</div>',
            '</div>',
        ]);

        $out .= Selectable::end();

        $out = Yii::$app->view->renderFile('@yiiunit/extensions/jui/data/views/layout.php', [
            'content' => $out,
        ]);

        // https://github.com/yiisoft/yii2-jui/issues/46
        static::assertRegExp(
            '~<li class="my-selectable-item ui-selectee">Item 1</li>~',
            $out,
            'There should be selectable items li with class my-selectable-item ui-selectee');
        static::assertRegExp(
            '~<div class="my-selectable-item ui-selectee">Another item</div>~',
            $out,
            'There should be selectable items div with class my-selectable-item ui-selectee');
        static::assertRegExp(
            '~<li class="no-selectable-item">Item 3</li>~',
            $out,
            'There should be not selectable items li with class no-selectable-item and no ui-selectee class');
    }
}
