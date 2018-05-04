<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Ticket;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php
    if(!Yii::$app->user->identity->isAdmin() && !Yii::$app->user->isGuest){
        echo $form->field($model, 'title')->textInput(['maxlength' => true]);
        echo $form->field($model, 'priority')->dropDownList(Ticket::getPriorityArray());
        echo $form->field($model, 'problemTheme')->textInput(['maxlength' => true]);
        echo $form->field($model, 'shortDescribe')->textInput(['maxlength' => true]);
        echo $form->field($model, 'longDescribe')->textInput(['maxlength' => true]);
        echo $form->field($model, 'user_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false);
        echo $form->field($model, 'admin_id')->hiddenInput(['value'=>0])->label(false);
        echo $form->field($model, 'open')->hiddenInput(['value'=>0])->label(false);

    }
    else if (Yii::$app->user->identity->isAdmin()){
        echo $form->field($model, 'priority')->dropDownList(['0' => 'Normal', '1' => 'Urgent', '2' => 'Critical']);
        echo $form->field($model, 'admin_id')->dropDownList(['0'=>'NEW', Yii::$app->user->identity->id => Yii::$app->user->identity->name]);
        echo $form->field($model,'open')->dropDownList([ 0=>'Open', 1=>'Close']);
    }
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
/**
    $form->field($model, 'user_id')->textInput()
 *
 */
?>