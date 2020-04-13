<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: Application/Json");
include "../../../src/estimator.php";

        $reportedCases= filter($_POST['data-reported-cases']);
        $timeToElapse= filter($_POST['data-time-to-elapse']);
        $periodType= filter($_POST['data-period-type']);
        $totalHospitalBeds= filter($_POST['data-total-hospital-beds']);
        $name= filter($_POST['data-region-name']);
        $avgAge= filter($_POST['data-avgAge']);
        $avgDailyIncomePopulation= filter($_POST['data-avgDailyIncomePopulation']);
        $avgDailyIncomeInUSD= filter($_POST['data-avgDailyIncomeInUSD']);
        
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


    //filter function
    function filter($val){
        return filter_var($val, FILTER_SANITIZE_STRING);
    }
?>