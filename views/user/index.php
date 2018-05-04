<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $userSearch app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Felhasználók';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php


    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $userSearch,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
              'attribute' => 'name',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data['name'],['ticket/ticketfromuser','id' =>$data->id]);
                },
            ],
            'username',
            'email:email',
            'password',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>
</div>
