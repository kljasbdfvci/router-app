<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log';
$this->params['breadcrumbs'][] = ['label' => 'System'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="extension-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            'datetime',
                [
                'attribute' => 'level',
                'value' => function($model) {
                    return app\models\Log::getLevelList()[$model->level];
                },
            ],
                [
                'attribute' => 'process',
                'value' => function($model) {
                    return ucwords($model->process);
                },
            ],
            'message',
        ],
    ]);
    ?>
</div>
