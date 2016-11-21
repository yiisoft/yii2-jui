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

        ob_start();
        Selectable::begin([
            'id' => 'myselectableitems',
            'clientOptions' => [
                'filter' => 'myselectableitem',
                'tolerance' => 'touch',
            ]
        ]);
        $out = ob_get_clean();

        $out .= join("\n", [
            '<ul>',
                '<li class="myselectableitem">Item 1</li>',
                '<li class="myselectableitem">Item 2</li>',
                '<li class="noselectableitem">Item 3</li>',
                '<li class="myselectableitem">Item 4</li>',
            '</ul>',
            '<div>',
                '<div>',
                    '<div class="myselectableitem">Another item</div>',
                '</div>',
            '</div>',
        ]);

        ob_start();
        Selectable::end();
        $out .= ob_get_clean();

        $out = Yii::$app->view->renderFile('@yiiunit/extensions/jui/data/views/layout.php', [
            'content' => $out,
        ]);

        // https://github.com/yiisoft/yii2-jui/issues/46
        static::assertRegExp(
            '~<div id="myselectableitems">\n<ul>\n<li class="myselectableitem">Item 1</li>\n<li class="myselectableitem">Item 2</li>\n<li class="noselectableitem">Item 3</li>\n<li class="myselectableitem">Item 4</li>\n</ul>\n<div>\n<div>\n<div class="myselectableitem">Another item</div>\n</div>\n</div></div>~',
            $out,
            'There should be a div with class myselectableitems enclosing html between begin()` and `end()` methods');
        static::assertRegExp(
            '~<script type="text/javascript">jQuery\(document\)\.ready\(function \(\) \{\njQuery\(\'#myselectableitems\'\)\.selectable\(\{\"filter"\:"myselectableitem","tolerance"\:"touch"\}\);\n\}\);</script>~',
            $out,
            'There should be the jQuery UI Selectable plugin initialization for myselectableitems');
    }
}
