<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Ticket;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TicketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ticketeim:';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if(!Yii::$app->user->identity->isAdmin()){
            echo Html::a('Ticket elkészítése', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions'=> function($model){
            if($model->priority==1){
                return ['class' => 'warning'];
            }
            else if($model->priority==2){
                return ['class' => 'danger'];
            }
        },
        'options' => ['style' => 'font-size:13px;'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:2%'],
            ],
            [
                'attribute' => 'title',
                'contentOptions' => ['style' => 'font-size:20px;'],
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data['title'],['ticket/view','id' =>$data->id]);
                },
            ],
            'shortDescribe',
            [
                'attribute' => 'user_id',
                'value' => 'user.username',
                'contentOptions' => ['style' => 'font-size:20px;'],
            ],
            [
                'attribute' => 'priority',
                'value' => function($data){
                    return Ticket::getPriorityString($data->priority);

                },

            ],
            [
                'attribute' => 'admin_id',
                'value' => function($data){

                    if($data->admin_id==0){
                        return "[NEW]";
                    }
                    else {
                        return $data->admin->username;
                    }
                }

            ],
            [
                    'attribute' => 'open',
                'value' => function($data){
                    if($data->open == 0){
                        return "OPEN";
                    }
                    else {
                        return "CLOSED";
                    }
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'options'=>['style'=>'width:120px;'],
                'template'=>'<div class="btn-group btn-group-sm" role="group" aria-label="...">{comment}</div>',
                'buttons' => [
                    'comment'=>function($url,$model,$key){
                        return Html::a('Kommentek megtekintése', ['comment/index', 'id' => $model->id], ['class' => 'btn btn-primary']);
                    }
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'options'=>['style'=>'width:50px;'],
                'template'=>'<div class="btn-group btn-group-sm" role="group" aria-label="...">{comment}</div>',
                'buttons' => [
                    'comment'=>function($url,$model,$key){
                        if(!Yii::$app->user->isGuest ){
                            return Html::a('Comment', ['comment/create', 'id' => $model->id], ['class' => 'btn btn-primary']);
                        }
                        else if (Yii::$app->user->identity->isAdmin()){
                            return Html::a('Comment', ['comment/create', 'id' => $model->id], ['class' => 'btn btn-primary']);
                        }
                    }
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'options'=>['style'=>'width:50px;'],
                'template'=>'<div class="btn-group btn-group-sm" role="group" aria-label="...">{comment}</div>',
                'buttons' => [
                    'comment'=>function($url,$model,$key){
                        if(!Yii::$app->user->isGuest ){
                            return Html::a('Kép feltöltés', ['image/create', 'id' => $model->id], ['class' => 'btn btn-primary']);
                        }

                    }
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'options'=>['style'=>'width:50px;'],
                'template'=>'<div class="btn-group btn-group-sm" role="group" aria-label="...">{comment}</div>',
                'buttons' => [
                    'comment'=>function($url,$model,$key){
                        if(!Yii::$app->user->isGuest ){
                            return Html::a('Kép', ['image/index', 'id' => $model->id], ['class' => 'btn btn-primary']);
                        }
                        else if (Yii::$app->user->identity->isAdmin()){
                            return Html::a('Kép', ['image/index', 'id' => $model->id], ['class' => 'btn btn-primary']);
                        }
                    }
                ]
            ],

            //'longDescribe',
            //'problemTheme',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

