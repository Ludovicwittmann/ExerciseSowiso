<?php 
    if($_POST == null){
        echo "<p> New session </p>";
    }else{
        echo "<p>".$_SESSION['lastCalcul']." = ".$_SESSION["lastResult"]."</p>";
        if($_POST['responseH']==""){
            echo "<p> You did not given answer.";
        }else{
            echo "<p>Your answer was ".$_POST['responseH'];
            if($_POST['responseH'] == $_SESSION["lastResult"]){
                echo ". Felicitation !";
            }else{
                echo ". You were wrong !"; 
            }
        }
        echo " Try again!</p>"; 
        
        $_SESSION["lastAnswer"] = $_POST["responseH"];
    }
    $objCalulH = new CalculHard();
    $_SESSION["lastResult"] = $objCalulH->solution;
    $_SESSION["lastCalcul"] = $objCalulH->stringCalcul;
    
    
    echo "<p>".$_SESSION['lastCalcul']."</p>";
    //####################################################################################################################
    class CalculHard{
        private $operator = ["*","/","+","-"];
        private int $lenCalcul; //number of number in the calcul
        private int $lenCompCalcul; //number of number in the calcul
        public $stringCalcul = "10*(60*(20+30))"; //calcul in string
        public $solution;

        public function __construct(){
            $this->solveLoop($this->stringCalcul);
        }


        public function generateCalcul(){
            $lenCalcul = rand(2,6);
            $strCalcul = "";
            for ($i=0; $i < $lencalcul; $i++) { 
                $nextNumber = rand(1,10);
                
            }
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