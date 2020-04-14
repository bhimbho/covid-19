<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: Application/xml");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include "../../../../../estimator.php";
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

$test_array = (covid19ImpactEstimator($data));
$xml = new SimpleXMLElement('<rootTag/>');
to_xml($xml, $test_array);
print $xml->asXML();
    // }


    //filter function
    function filter($val){
        return filter_var($val, FILTER_SANITIZE_STRING);
    }
    
    //xml
    function to_xml(SimpleXMLElement $object, array $data)
{   
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $new_object = $object->addChild($key);
            to_xml($new_object, $value);
        } else {
            // if the key is an integer, it needs text with it to actually work.
            if ($key == (int) $key) {
                $key = "$key";
            }

            $object->addChild($key, $value);
        }   
    }   
}   
?>