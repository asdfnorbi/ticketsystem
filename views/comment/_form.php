<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Ticket;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false);?>

    <?php echo $form->field($model, 'ticket_id')->hiddenInput(['value'=>$id])->label(false); ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'open')->hiddenInput(['value'=>0])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
