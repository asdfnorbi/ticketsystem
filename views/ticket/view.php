<?php


use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Ticket;
use app\models\Comment;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if(Yii::$app->user->identity->isAdmin()){
            echo Html::a('Szerkesztés', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo Html::a('Törlés', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            [
                'attribute' => 'priority',
                'value' => function($data){
                    return Ticket::getPriorityString($data->priority);

                },
            ],
            'shortDescribe',
            'longDescribe',
            'problemTheme',
            [
                'attribute' => 'admin_id',
                'value' => function($data) {

                    if ($data->admin_id == 0) {
                        return "[NEW]";
                    } else {
                        return $data->admin->username;
                    }
                }
            ],
            [
                'attribute'=>'open',
                'value' => function($data){

                    if($data->open==0){
                        return "Open";
                    }
                    else {
                        return "Close";
                    }
                }
            ],
            'ticketmodify',
        ],
    ]) ?>
</div>






