<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Image */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];

?>
<div class="image-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    echo Html::a('Törlés', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]);
?>
    <br><br>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                    'attribute' => 'fileName',
                    'value' => Yii::getAlias('@fileNameUrl').'/'.$model->fileName,
                    'format'=>['image', ['width'=>'500','height'=>'500']]
            ],
            'tickett_id',
        ],
    ]) ?>

</div>


