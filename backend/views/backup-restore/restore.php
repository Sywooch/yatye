<?php
use yii\helpers\Html;

?>
<h1>
	<?php //echo  $this->action->id; ?>
</h1>

<p>
	<?php if(isset($error)) echo $error; else echo 'Done';?>
</p>
<p>
    
       <?= Html::a('View site', ['index'], ['class' => 'btn btn-warning']) ?>        
    
    
	<?php //echo Html::link('View Site',Yii::app()->HomeUrl)?>
</p>
