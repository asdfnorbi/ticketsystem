<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */


$this->title = 'Regisztráció';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-registration">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        Itt tud regisztralni.

    </p>



</div>

