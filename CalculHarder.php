<?php 
    $objCalulH = new CalculHard();
    echo "<p>".$objCalulH->stringCalcul."</p>";
    $objCalulH->solveLoop($objCalulH->stringCalcul);
    echo "<p>".$objCalulH->solution."</p>";

    //####################################################################################################################
    class CalculHard{
        private $operator = ["*","/","+","-"];
        private int $lenCalcul; //number of number in the calcul
        private int $lenCompCalcul; //number of number in the calcul
        public $stringCalcul = "10*(60*(20+30))"; //calcul in string
        public $solution;

        public function __construct(){
            
        }
        public function solveLoop($strCalcul){
            while(str_contains($strCalcul, "(")){
                $posOfLastParOpen = strrpos($strCalcul, "(");
                $subStr = substr($strCalcul, $posOfLastParOpen);
                $posOfLastParClose = strpos($subStr, ")");
                $subStr = substr($subStr, 1, $posOfLastParClose-1);
                $subStr = $this->solve($subStr);
                $strCalcul = substr($strCalcul,0, $posOfLastParOpen).$subStr.substr($strCalcul, $posOfLastParClose+$posOfLastParOpen+1, strlen($strCalcul)-$posOfLastParClose-$posOfLastParOpen);
            }
            $this->solution = $this->solve($strCalcul);
        }
        public function solve($strCalcul){
            while(str_contains($strCalcul, "*")){
                $posStar = strpos($strCalcul, "*");

                $numberA = $this->getNumberBefore($strCalcul, $posStar);
                $lenNumberA = strlen($numberA);
                $numberB = $this->getNumberAfter($strCalcul, $posStar);
                $lenNumberB = strlen($numberB);
                $numberResult = $numberA*$numberB;
                
                $strCalcul = substr($strCalcul,0, $posStar-$lenNumberA).$numberResult.substr($strCalcul,$posStar+$lenNumberB+1, strlen($strCalcul));
            }
            while(str_contains($strCalcul, "/")){
                $posStar = strpos($strCalcul, "/");

                $numberA = $this->getNumberBefore($strCalcul, $posStar);
                $lenNumberA = strlen($numberA);
                $numberB = $this->getNumberAfter($strCalcul, $posStar);
                $lenNumberB = strlen($numberB);
                $numberResult = $numberA/$numberB;
                
                $strCalcul = substr($strCalcul,0, $posStar-$lenNumberA).$numberResult.substr($strCalcul,$posStar+$lenNumberB+1, strlen($strCalcul));
            }
            while(str_contains($strCalcul, "+")){
                $posStar = strpos($strCalcul, "+");

                $numberA = $this->getNumberBefore($strCalcul, $posStar);
                $lenNumberA = strlen($numberA);
                $numberB = $this->getNumberAfter($strCalcul, $posStar);
                $lenNumberB = strlen($numberB);
                $numberResult = $numberA+$numberB;
                
                $strCalcul = substr($strCalcul,0, $posStar-$lenNumberA).$numberResult.substr($strCalcul,$posStar+$lenNumberB+1, strlen($strCalcul));
            }
            while(str_contains($strCalcul, "-")){
                $posStar = strpos($strCalcul, "-");

                $numberA = $this->getNumberBefore($strCalcul, $posStar);
                $lenNumberA = strlen($numberA);
                $numberB = $this->getNumberAfter($strCalcul, $posStar);
                $lenNumberB = strlen($numberB);
                $numberResult = $numberA-$numberB;
                
                $strCalcul = substr($strCalcul,0, $posStar-$lenNumberA).$numberResult.substr($strCalcul,$posStar+$lenNumberB+1, strlen($strCalcul));
            }
            return $strCalcul;
        }

        //##########################################################################################################################
        private function getNumberBefore($strCalcul, $posOperator){
            $n=1;
            $strNumber = "";
            while($this->checkIfNumeric($strCalcul,$posOperator-$n)){
                $strNumber = $strCalcul[$posOperator-$n].$strNumber;
                $n += 1;
            }
            $Number = intval($strNumber);
            return $Number;
        }

        private function getNumberAfter($strCalcul, $posOperator){
            $n=1;
            $strNumber = "";
            while($this->checkIfNumeric($strCalcul,$posOperator+$n)){
                $strNumber = $strNumber.$strCalcul[$posOperator+$n];
                $n += 1;
            }
            $Number = intval($strNumber);
            return $Number;
        }

        private function checkIfNumeric($s, $p){
            if($p < strlen($s) && $p >=0){
                if($s[$p] == "," || $s[$p] =="."){
                    return true;
                }
                return is_numeric($s[$p]);
            }
            return false;
        }
    }
?>