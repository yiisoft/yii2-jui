<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\jui;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Selectable renders a selectable jQuery UI widget.
 *
 * For example:
 *
 * ```php
 * echo Selectable::widget([
 *     'items' => [
 *         'Item 1',
 *         [
 *             'content' => 'Item2',
 *         ],
 *         [
 *             'content' => 'Item3',
 *             'options' => [
 *                 'tag' => 'li',
 *             ],
 *         ],
 *     ],
 *     'options' => [
 *         'tag' => 'ul',
 *     ],
 *     'itemOptions' => [
 *         'tag' => 'li',
 *     ],
 *     'clientOptions' => [
 *         'tolerance' => 'fit',
 *     ],
 * ]);
 * ```
 *
 * Selectable in begin mode.
 *
 * ```php
 * Selectable::begin([
 *     'clientOptions' => [
 *         'filter' => 'my-selectable-item',
 *         'tolerance' => 'touch',
 *     ],
 * ]);
 * ```
 * <ul>
 *      <li class="my-selectable-item">Item 1</li>
 *      <li class="my-selectable-item">Item 2</li>
 *      <li class="no-selectable-item">Item 3</li>
 *      <li class="my-selectable-item">Item 4</li>
 * </ul>
 * <div>
 *      <div>
 *          <div class="my-selectable-item">Another item</div>
 *      </div>
 * </div>
 *
 * ```php
 * Selectable::end();
 * ```
 *
 * @see http://api.jqueryui.com/selectable/
 * @author Alexander Kochetov <creocoder@gmail.com>
 * @since 2.0
 */
class Selectable extends Widget
{
    const MODE_DEFAULT = 'MODE_DEFAULT';
    const MODE_BEGIN = 'MODE_BEGIN';

    /**
     * @var string the mode used to render the widget.
     */
    public $mode = self::MODE_DEFAULT;
    /**
     * @var array the HTML attributes for the widget container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "ul", the tag name of the container tag of this widget.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];
    /**
     * @var array list of selectable items. Each item can be a string representing the item content
     * or an array of the following structure:
     *
     * ~~~
     * [
     *     'content' => 'item content',
     *     // the HTML attributes of the item container tag. This will overwrite "itemOptions".
     *     'options' => [],
     * ]
     * ~~~
     */
    public $items = [];
    /**
     * @var array list of HTML attributes for the item container tags. This will be overwritten
     * by the "options" set in individual [[items]]. The following special options are recognized:
     *
     * - tag: string, defaults to "li", the tag name of the item container tags.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $itemOptions = [];


    /**
     * Begins a widget.
     * This method creates an instance of the calling class setting the MODE_BEGIN mode. Any item between
     * [[begin()]] and [[end()]] which match the filter attribute, will be selectable.
     * It will apply the configuration
     * to the created instance. A matching [[end()]] call should be called later.
     * As some widgets may use output buffering, the [[end()]] call should be made in the same view
     * to avoid breaking the nesting of output buffers.
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @return static the newly created widget instance
     * @see end()
     */
    public static function begin($config = []) {
        $config['mode'] = self::MODE_BEGIN;
        parent::begin($config);
    }
    
    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        if ($this->mode === self::MODE_BEGIN) {
            echo Html::beginTag('div', $this->options) . "\n";
        }
    }
    
    /**
     * Renders the widget.
     */
    public function run()
    {
        if ($this->mode === self::MODE_BEGIN) {
            echo Html::endTag('div') . "\n";
        } else {
            $options = $this->options;
            $tag = ArrayHelper::remove($options, 'tag', 'ul');
            echo Html::beginTag($tag, $options) . "\n";
            echo $this->renderItems() . "\n";
            echo Html::endTag($tag) . "\n";
        }
        
        $this->registerWidget('selectable');
    }
    
    /**
     * Renders selectable items as specified on [[items]].
     * @return string the rendering result.
     * @throws InvalidConfigException.
     */
    public function renderItems()
    {
        $items = [];
        foreach ($this->items as $item) {
            $options = $this->itemOptions;
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            if (is_array($item)) {
                if (!array_key_exists('content', $item)) {
                    throw new InvalidConfigException("The 'content' option is required.");
                }
                $options = array_merge($options, ArrayHelper::getValue($item, 'options', []));
                $tag = ArrayHelper::remove($options, 'tag', $tag);
                $items[] = Html::tag($tag, $item['content'], $options);
            } else {
                $items[] = Html::tag($tag, $item, $options);
            }
        }
        return implode("\n", $items);
    }
}
