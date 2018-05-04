<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">


    <?php
    $form = ActiveForm::begin();
    /*
     * Two platform. The member is guest or admin.
     * Admin can make new admins, but guest no.
     */
    if(Yii::$app->user->isGuest){
        echo $form->field($model, 'username')->textInput(['maxlength' => true]);
        echo $form->field($model, 'name')->textInput(['maxlength' => true]);
        echo $form->field($model, 'email')->textInput(['maxlength' => true]);
        echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);
    }
    else if(!Yii::$app->user->identity->isAdmin() && !Yii::$app->user->isGuest){
        echo $form->field($model, 'name')->textInput(['maxlength' => true]);
    }
    else if (Yii::$app->user->identity->isAdmin()){
        echo $form->field($model, 'id')->textInput(['maxlength' => true]);
        echo $form->field($model, 'name')->textInput(['maxlength' => true]);
        echo $form->field($model, 'username')->textInput(['maxlength' => true]);
        echo $form->field($model, 'email')->textInput(['maxlength' => true]);
        echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);
        echo $form->field($model, 'admin')->checkbox();

    }

    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
/*
    $form->field($model, 'lastlog')->textInput()

    $form->field($model, 'registrationtime')->textInput()

    $form->field($model, 'admin')->checkbox()

    $form->field($model, 'authKey')->textInput(['maxlength' => true])
*/
?>

