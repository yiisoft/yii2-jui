<?php
namespace yiiunit\extensions\jui;

use Yii;
use yii\jui\DatePicker;
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
    public function testBeginEndWidgetMethods()
    {
        $expected = '<div id="my-selectable-items">
    <ul>
        <li class="my-selectable-item">Item 1</li>
        <li class="my-selectable-item">Item 2</li>
        <li class="no-selectable-item">Item 3</li>
        <li class="my-selectable-item">Item 4</li>
    </ul>
    <div>
        <div>
            <div class="my-selectable-item">Another item </div>
        </div>
    </div>
</div>';
        $out = Yii::$app->view->renderFile('@yiiunit/extensions/jui/data/views/selectable/beginEndTest.php');

        // https://github.com/yiisoft/yii2-jui/issues/6
        static::assertEquals($out, $expected);
    }
}
