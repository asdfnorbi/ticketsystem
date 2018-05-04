<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Comment;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Kommentek';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'options' => ['style' => 'font-size:13px;'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                    'attribute' => 'author_id',
                'value' => 'author.username',
                'contentOptions' => ['style' => 'font-size:20px;'],
                'headerOptions' => ['style' => 'width:2%'],
            ],
            'content',
            'commenttime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

