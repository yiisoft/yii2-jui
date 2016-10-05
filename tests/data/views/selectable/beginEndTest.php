<?php
/* @var $this \yii\web\View */
?>
<?php \yii\jui\Selectable::begin([
    'id' => 'my-selectable-items',
    'clientOptions' => [
        'filter' => 'my-selectable-item',
         'tolerance' => 'touch',
     ],
 ]); ?>
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
<?php \yii\jui\Selectable::end(); ?>

