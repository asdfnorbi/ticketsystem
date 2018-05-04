<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Képek';

?>
<div class="image-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            [
                    'attribute' => 'id',
                'contentOptions' => ['style' => 'font-size:20px;'],
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data['id'],['image/view','id' =>$data->id]);
                },
            ],
            [
                'attribute' => 'fileName',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(Yii::getAlias('@fileNameUrl').'/'. $data['fileName'],
                        ['width' => '120px']);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'options'=>['style'=>'width:50px;'],
                'template'=>'<div class="btn-group btn-group-sm" role="group" aria-label="...">{comment}</div>',
                'buttons' => [
                    'comment'=>function($url,$model,$key){

                    }
                ]
            ],
        ],
    ]); ?>
</div>
