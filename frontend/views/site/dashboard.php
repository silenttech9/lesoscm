<?php
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */

$this->title = 'LesoSCM';
?>
<div class="row">
    <div class="col-md-6">

        <div class="portlet light ">

                                    <?php 

                                    $year = date('Y');
                                    $bulan = date('m');
                                    $bulanM = date('F');

                                   if (empty($model)) {

                                      $user_sales = $total_sales =0 ;
                                        $xAxis = $user_sales; 
                                        $yAxis = $total_sales;

                                     # code...
                                   } else {

                                      foreach ($model as $key => $value) {
                                            $user_sales[] = $value['user_sales'];
                                           $total_sales[] = (int)$value['total_sales'];

                                        }
                                   }

                                        $xAxis = $user_sales; 
                                        $yAxis = $total_sales;

                                    echo Highcharts::widget([
                                       'options' => [
                                          'title' => ['text' => 'Sales Activity ('.$bulanM.')'],
                                          'chart' => [
                                                'type' => 'column',
                                            ],
                                          'xAxis' => [
                                             'categories' => $xAxis
                                          ],
                                          'yAxis' => [
                                             'title' => ['text' => 'Total']
                                          ],
                                          'plotOptions' => [
                                            'column' => [
                                                'stacking' => 'normal',
                                                'dataLabels' => [
                                                    'enabled' => true,

                                                ],
                                            ],
                                          ],

                                          'series' => [
                                             [
                                              'name' => 'User', 
                                              'colorByPoint' => true,
                                              'data' => $yAxis
                                             
                                             ],

                                          ]
                                       ]
                                    ]) ?>


        </div>
    </div>

    <div class="col-md-6">

        <div class="portlet light ">
                                    <?php 


                                   if (empty($model2)) {

                                      $state_quotation = $total_quotation =0 ;
                                        $xAxis2 = $state_quotation; 
                                        $yAxis2 = $total_quotation;


                                     # code...
                                   } else {
                                      foreach ($model2 as $key => $value2) {
                                           $state_quotation[] = $value2['state_quotation'];
                                           $total_quotation[] = (int)$value2['total_quotation'];

                                        }
                                        $xAxis2 = $state_quotation; 
                                        $yAxis2 = $total_quotation;




                                   }




                                    echo Highcharts::widget([
                                       'options' => [
                                          'title' => ['text' => 'Quotation ('.$bulanM.')'],
                                          'chart' => [
                                                'type' => 'column',
                                            ],
                                          'xAxis' => [
                                             'categories' => $xAxis2
                                          ],
                                          'yAxis' => [
                                             'title' => ['text' => 'Total']
                                          ],
                                          'plotOptions' => [
                                            'column' => [
                                                'stacking' => 'normal',
                                                'dataLabels' => [
                                                    'enabled' => true,

                                                ],
                                            ],
                                          ],

                                          'series' => [
                                             [
                                              'name' => 'State',
                                              'colorByPoint' => true,
                                               'data' => $yAxis2
                                              
                                             ],

                                          ]
                                       ]
                                    ]) ?>

        </div>
    </div>


</div>

<div class="row">
    <div class="col-md-6">

        <div class="portlet light ">
                                    <?php 

                                   if (empty($model3)) {

                                      $user_telemarketing = $total_telemarketing =0 ;
                                        $xAxis3 = $user_telemarketing; 
                                        $yAxis3 = $total_telemarketing;

                                     # code...
                                   } else {

                                      foreach ($model3 as $key => $value3) {
                                            $user_telemarketing[] = $value3['user_telemarketing'];
                                           $total_telemarketing[] = (int)$value3['total_telemarketing'];

                                        }
                                   }

                                        $xAxis3 = $user_telemarketing; 
                                        $yAxis3 = $total_telemarketing;


                                    echo Highcharts::widget([
                                       'options' => [
                                          'title' => ['text' => 'Telemarketing ('.$bulanM.')'],
                                          'chart' => [
                                                'type' => 'column',
                                            ],
                                          'xAxis' => [
                                             'categories' => $xAxis3
                                          ],
                                          'yAxis' => [
                                             'title' => ['text' => 'Total']
                                          ],
                                          'plotOptions' => [
                                            'column' => [
                                                'stacking' => 'normal',
                                                'dataLabels' => [
                                                    'enabled' => true,

                                                ],
                                            ],
                                          ],

                                          'series' => [
                                             [
                                              'name' => 'User', 
                                              'colorByPoint' => true,
                                              'data' => $yAxis3
                                             
                                             ],

                                          ]
                                       ]
                                    ]) ?>

        </div>
    </div>

    <div class="col-md-6">

        <div class="portlet light ">


                                    <?php 


                                   if (empty($model4)) {

                                      $user_pending = $total_pending =0 ;
                                        $xAxis4 = $user_pending; 
                                        $yAxis4 = $total_pending;


                                     # code...
                                   } else {

                                      foreach ($model4 as $key => $value4) {
                                            $user_pending[] = $value4['user_pending'];
                                           $total_pending[] = (int)$value4['total_pending'];

                                        }
                                   }

                                        $xAxis4 = $user_pending; 
                                        $yAxis4 = $total_pending;

                                    echo Highcharts::widget([
                                       'options' => [
                                          'title' => ['text' => 'Pending Message By User'],
                                          'chart' => [
                                                'type' => 'column',
                                            ],
                                          'xAxis' => [
                                             'categories' => $xAxis4
                                          ],
                                          'yAxis' => [
                                             'title' => ['text' => 'Total']
                                          ],
                                          'plotOptions' => [
                                            'column' => [
                                                'stacking' => 'normal',
                                                'dataLabels' => [
                                                    'enabled' => true,

                                                ],
                                            ],
                                          ],

                                          'series' => [
                                             [
                                              'name' => 'User', 
                                              'colorByPoint' => true,
                                              'data' => $yAxis4
                                              
                                             ],

                                          ]
                                       ]
                                    ]) ?>

        </div>
    </div>


</div>