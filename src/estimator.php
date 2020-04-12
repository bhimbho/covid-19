<?php
function covid19ImpactEstimator($data)
{
  $impact=array();
    //challenge One
    $impact['currentlyInfected'] = $data['reportedCases'] * 10;
    $timetoelapse=period_checker($data['periodType'],$data['timeToElapse']);
    $impact['infectionsByRequestedTime']=(int)($impact['currentlyInfected'] * pow(2,factorCalc($timetoelapse)));
    
    //chanllenge two for impact
    $impact['severeCasesByRequestedTime']= (int)($impact['infectionsByRequestedTime'] * 0.15);
    $impact['hospitalBedsByRequestedTime'] = (int)(($data['totalHospitalBeds'] * 0.35) - $impact['severeCasesByRequestedTime']);

    //challenge three for impact
    $impact['casesForICUByRequestedTime'] = (int)$impact['infectionsByRequestedTime']*(0.05);
    $impact['casesForVentilatorsByRequestedTime'] = (int)($impact['infectionsByRequestedTime']*(0.02));
    $impact['dollarsInFlight'] = (int) (($impact['infectionsByRequestedTime'] * $data['region']['avgDailyIncomeInUSD'] * $data['region']['avgDailyIncomePopulation']) / $timetoelapse);

  $severeImpact=array();
  //challenge One for severeImpact
    $severeImpact['currentlyInfected'] = $data['reportedCases'] * 50;
    $timetoelapse=period_checker($data['periodType'],$data['timeToElapse']);
    $severeImpact['infectionsByRequestedTime']=(int)($severeImpact['currentlyInfected'] * pow(2,factorCalc($timetoelapse)));

    //chanllenge two for severeImpact
    $severeImpact['severeCasesByRequestedTime']= (int)($severeImpact['infectionsByRequestedTime'] * 0.15);
    $severeImpact['hospitalBedsByRequestedTime']= (int)(($data['totalHospitalBeds'] * 0.35) - $severeImpact['severeCasesByRequestedTime']);

    //challenge three for severeImpact
    $severeImpact['casesForICUByRequestedTime'] = (int)$severeImpact['infectionsByRequestedTime']*(0.05);
    $severeImpact['casesForVentilatorsByRequestedTime'] = (int)($severeImpact['infectionsByRequestedTime']*(0.02));
    $severeImpact['dollarsInFlight'] = (int)(($severeImpact['infectionsByRequestedTime'] * $data['region']['avgDailyIncomeInUSD'] * $data['region']['avgDailyIncomePopulation']) / $timetoelapse);

    return ['data'=>$data,'impact'=>$impact,'severeImpact'=>$severeImpact];
}
function factorCalc($days){
    return (int)($days/3);
}
function period_checker($periodType,$periods){
  switch ($periodType){
    case 'weeks':
      return $period=$periods*7;
    break;
    case 'months':
      return $period=$periods*30;
    break;
    default:
      return $periods;
  }
}
$data=['reportedCases'=>2747,'timeToElapse'=>38,'periodType'=>'days','totalHospitalBeds'=>678874,
    'region'=>[
            'name' => 'Africa',
            'avgAge'=> 19.7,
            'avgDailyIncomeInUSD'=> 4,
            'avgDailyIncomePopulation'=>0.73,
          ]
];

// echo covid19ImpactEstimator(10)['impact']->currentlyInfected();
// var_dump(covid19ImpactEstimator(10)['impact']);
// echo covid19ImpactEstimator(10)['impact']->severeCasesByRequestedTime();

// echo covid19ImpactEstimator(10)['severeImpact']->currentlyInfected();
// echo covid19ImpactEstimator(10)['severeImpact']->infectionsByRequestedTime();
// echo covid19ImpactEstimator(10)['severeImpact']->severeCasesByRequestedTime();
?>