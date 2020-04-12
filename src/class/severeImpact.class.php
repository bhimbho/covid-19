<?php
class severeImpact
{
    public function __construct($data) {
        $this->reportedCases = 10;
        $this->days = $data[1];
        $this->totalHospitalBeds = $data[2];
    }
    public function currentlyInfected()
    {
      return $this->reportedCases * 50;
    }  
    public function infectionsByRequestedTime()
    {
        $factor=(int)($this->days / 3);
      return SELF::currentlyInfected() * pow(2,$factor);
    } 
    // public function severeCasesByRequestedTime()
    // {
    //   return SELF::infectionsByRequestedTime() * (15/100);
    // }  
    // public function hospitalBedsByRequestedTime($totalHospitalBeds)
    // {
    //   return SELF::severeCasesByRequestedTime() * (35/100);
    // }  
}
?>