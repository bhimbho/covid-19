<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: Application/Json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include "../../../../src/estimator.php";
    // if(isset($_POST['submit'])){
        $reportedCases= filter($_REQUEST['data-reported-cases']);
        $timeToElapse= filter($_REQUEST['data-time-to-elapse']);
        $periodType= filter($_REQUEST['data-period-type']);
        $totalHospitalBeds= filter($_REQUEST['data-total-hospital-beds']);
        $name= filter($_REQUEST['data-region-name']);
        $avgAge= filter($_REQUEST['data-avgAge']);
        $avgDailyIncomePopulation= filter($_REQUEST['data-avgDailyIncomePopulation']);
        $avgDailyIncomeInUSD= filter($_REQUEST['data-avgDailyIncomeInUSD']);
$data=['reportedCases'=>$reportedCases,'timeToElapse'=>$timeToElapse,'periodType'=>$periodType,'totalHospitalBeds'=>$totalHospitalBeds,
    'region'=>[
            'name' =>  $name,
            'avgAge'=> $avgAge,
            'avgDailyIncomeInUSD'=>  $avgDailyIncomeInUSD,
            'avgDailyIncomePopulation'=>$avgDailyIncomePopulation,
          ]
];
echo json_encode(covid19ImpactEstimator($data));
    // }

    function filter($val){
        return filter_var($val, FILTER_SANITIZE_STRING);
    }
?>