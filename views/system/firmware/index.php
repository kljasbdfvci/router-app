<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Firmware */

$this->title = 'Firmware';
$this->params['breadcrumbs'][] = ['label' => 'System'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<div class="firmware-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="firmware-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="panel-group">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Application
                        <?php if ($isAppUpdated) { ?>
                            <span class='text-primary h4'>
                                System Will Update After Reboot.
                            </span>
                        <?php } ?>
                    </h4>
                </div>
                <div class="panel-body">
                    <p>Current Version: <?= $appCurrentVersion ?></p>
                    <p>New Version: <?= $appNewVersion ?></p>
                    <?php if (strcmp($appCurrentVersion, $appNewVersion) == 0) { ?>
                        <?= $form->field($model, 'app')->checkbox(['disabled' => 'disabled']) ?>
                    <?php } else { ?>
                        <?= $form->field($model, 'app')->checkbox() ?>
                    <?php } ?>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        System
                        <?php if ($isOsUpdated) { ?>
                            <span class='text-primary h4'>
                                System Will Update After Reboot.
                            </span>
                        <?php } ?>
                    </h4>
                </div>
                <div class="panel-body">
                    <p>Current Version: <?= $osCurrentVersion ?></p>
                    <p>New Version: <?= $osNewVersion ?></p>
                    <?php if (strcmp($osCurrentVersion, $osNewVersion) == 0) { ?>
                        <?= $form->field($model, 'os')->checkbox(['disabled' => 'disabled']) ?>
                    <?php } else { ?>
                        <?= $form->field($model, 'os')->checkbox() ?>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>