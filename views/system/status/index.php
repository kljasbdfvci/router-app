<?php
/* @var $this yii\web\View */

use miloschuman\highcharts\Highstock;
use yii\web\JsExpression;

$rangeSelector = [
    'buttons' => [
            [
            'type' => 'hour',
            'count' => '1',
            'text' => '1h',
        ],
            [
            'type' => 'day',
            'count' => '1',
            'text' => '1D',
        ],
            [
            'type' => 'all',
            'count' => '1',
            'text' => 'All'
        ],
    ],
    'inputEnabled' => false,
    'selected' => 0
];

$this->title = 'Status';
$this->params['breadcrumbs'][] = ['label' => 'System'];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="site-index">

    <div class="row">

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?=
                    Highstock::widget([
                        'options' => [
                            'time' => [
                                'timezoneOffset' => (-1) * (date('Z') / 60),
                            ],
                            'rangeSelector' => $rangeSelector,
                            'title' => [
                                'text' => 'CPU Usage'
                            ],
                            'yAxis' => [
                                'min' => '0',
                            ],
                            'series' => [
                                    [
                                    //'name' => 'CPU Usage',
                                    'data' => $cpuData,
                                    'type' => 'areaspline',
                                    'threshold' => null,
                                    'tooltip' => [
                                        'valueDecimals' => 2,
                                        'valueSuffix' => '%',
                                    ],
                                    'fillColor' => [
                                        'linearGradient' => [
                                            'x1' => 0,
                                            'y1' => 0,
                                            'x2' => 0,
                                            'y2' => 1,
                                        ],
                                        'stops' => [
                                                [0, new JsExpression('Highcharts.getOptions().colors[0]')],
                                                [1, new JsExpression('Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get("rgba")')]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ])
                    ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?=
                    Highstock::widget([
                        'options' => [
                            'time' => [
                                'timezoneOffset' => (-1) * (date('Z') / 60),
                            ],
                            'rangeSelector' => $rangeSelector,
                            'title' => [
                                'text' => 'Memory Usage'
                            ],
                            'yAxis' => [
                                'min' => '0',
                            ],
                            'series' => [
                                    [
                                    //'name' => 'Memory Usage',
                                    'data' => $memoryData,
                                    'type' => 'areaspline',
                                    'threshold' => null,
                                    'tooltip' => [
                                        'valueDecimals' => 2,
                                        'valueSuffix' => '%',
                                    ],
                                    'fillColor' => [
                                        'linearGradient' => [
                                            'x1' => 0,
                                            'y1' => 0,
                                            'x2' => 0,
                                            'y2' => 1,
                                        ],
                                        'stops' => [
                                                [0, new JsExpression('Highcharts.getOptions().colors[0]')],
                                                [1, new JsExpression('Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get("rgba")')]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ])
                    ?>
                </div>
            </div>
        </div>

    </div>

    <?php
    for ($i = 0; $i < sizeof($adapters); $i++) {
        $adapter = $adapters[$i];
        ?>
        <div class="row">

            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?=
                        Highstock::widget([
                            'options' => [
                                'time' => [
                                    'timezoneOffset' => (-1) * (date('Z') / 60),
                                ],
                                'rangeSelector' => $rangeSelector,
                                'title' => [
                                    'text' => "Network Interface " . ($i + 1) . " Transmit Usage"
                                ],
                                'yAxis' => [
                                    'min' => '0',
                                ],
                                'series' => [
                                        [
                                        //'name' => 'CPU Usage',
                                        'data' => $networksData["networks_{$adapter}_tx"],
                                        'type' => 'areaspline',
                                        'threshold' => null,
                                        'tooltip' => [
                                            'valueDecimals' => 2,
                                            'valueSuffix' => ' kB/s',
                                        ],
                                        'fillColor' => [
                                            'linearGradient' => [
                                                'x1' => 0,
                                                'y1' => 0,
                                                'x2' => 0,
                                                'y2' => 1,
                                            ],
                                            'stops' => [
                                                    [0, new JsExpression('Highcharts.getOptions().colors[0]')],
                                                    [1, new JsExpression('Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get("rgba")')]
                                            ]
                                        ]
                                    ],
                                ]
                            ]
                        ])
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?=
                        Highstock::widget([
                            'options' => [
                                'time' => [
                                    'timezoneOffset' => (-1) * (date('Z') / 60),
                                ],
                                'rangeSelector' => $rangeSelector,
                                'title' => [
                                    'text' => "Network Interface " . ($i + 1) . " Receive Usage"
                                ],
                                'yAxis' => [
                                    'min' => '0',
                                ],
                                'series' => [
                                        [
                                        //'name' => 'CPU Usage',
                                        'data' => $networksData["networks_{$adapter}_rx"],
                                        'type' => 'areaspline',
                                        'threshold' => null,
                                        'tooltip' => [
                                            'valueDecimals' => 2,
                                            'valueSuffix' => ' kB/s',
                                        ],
                                        'fillColor' => [
                                            'linearGradient' => [
                                                'x1' => 0,
                                                'y1' => 0,
                                                'x2' => 0,
                                                'y2' => 1,
                                            ],
                                            'stops' => [
                                                    [0, new JsExpression('Highcharts.getOptions().colors[0]')],
                                                    [1, new JsExpression('Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get("rgba")')]
                                            ]
                                        ]
                                    ],
                                ]
                            ]
                        ])
                        ?>
                    </div>
                </div>
            </div>

        </div>
    <?php } ?>

</div>