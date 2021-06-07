<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Url::to('@web/image/favicon32.png')]);

$navLeftItems = NULL;
$navRightItems = NULL;
if (Yii::$app->user->isGuest) {
    $navRightItems = [
        [
            'label' => Html::tag('span', '', ['class' => 'glyphicon glyphicon-log-in']) . ' Login',
            'url' => ['/user/security/login']
        ],
    ];
} else {
    $navLeftItems = [
        [
            'label' => 'Home',
            'url' => ['/site/index'],
            'active' => in_array(\Yii::$app->controller->id, ['site']),
        ],
        [
            'label' => 'System',
            'active' => in_array(\Yii::$app->controller->id, [
                'firmware', 'log',
                'network', 'status'
            ]),
            'items' => [
                //['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                //'<li class="divider"></li>',
                //'<li class="dropdown-header">Dropdown Header</li>',
                [
                    'label' => 'Firmware',
                    'url' => ['/firmware'],
                    'active' => in_array(\Yii::$app->controller->id, ['firmware']),
                ],
                /*
                  [
                  'label' => 'Log',
                  'url' => ['/log'],
                  'active' => in_array(\Yii::$app->controller->id, ['log']),
                  ],
                 */
                [
                    'label' => 'Network',
                    'url' => ['/network'],
                    'active' => in_array(\Yii::$app->controller->id, ['network']),
                ],
                [
                    'label' => 'Status',
                    'url' => ['/status'],
                    'active' => in_array(\Yii::$app->controller->id, ['status']),
                ],
                [
                    'label' => 'Reboot',
                    'url' => ['/system/reboot'],
                    'linkOptions' => [
                        'data-method' => 'post',
                        'data-confirm' => 'Are you sure to reboot system?',
                    ]
                ],
                [
                    'label' => 'Shutdown',
                    'url' => ['/system/shutdown'],
                    'linkOptions' => [
                        'data-method' => 'post',
                        'data-confirm' => 'Are you sure to shutdown system?',
                    ]
                ],
            ],
        ]
    ];
    $navRightItems = [
        [
            'label' => Html::tag('span', '', ['class' => 'glyphicon glyphicon-log-out']) . ' Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/user/security/logout'],
            'linkOptions' => [
                'data-method' => 'post',
                'data-confirm' => 'Are you sure to logout?',
            ]
        ],
    ];
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' =>
            Html::img('@web/image/Router-48x48-white.png', ['alt' => Yii::$app->name, 'class' => 'pull-left', 'style' => 'margin-right: 2px; margin-top: -13px;']) . Yii::$app->name,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        if (isset($navLeftItems)) {
            echo Nav::widget([
                'encodeLabels' => false,
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => $navLeftItems,
            ]);
        }
        if (isset($navRightItems)) {
            echo Nav::widget([
                'encodeLabels' => false,
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $navRightItems,
            ]);
        }
        NavBar::end();
        ?>

        <div class="container">
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>