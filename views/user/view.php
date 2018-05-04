<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Szerkesztés', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Törlés', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

    </p>
<?php
if(Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin() ){
     echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'username',
            'email:email',
            'password',
            'lastlog',
            'registrationtime',
        ],
    ]);
}
else {
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'username',
            'email:email',
            'password',
            'lastlog',
            'registrationtime',
            'admin:boolean',
        ],
    ]);
}

?>
</div>
