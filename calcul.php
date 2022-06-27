<?php 

    if($_POST == null){
        echo "<p> New session </p>";
    }else{
        echo "<p>".$_SESSION['lastCalcul'].$_SESSION["lastResult"]."</p>";
        if($_POST['response']==""){
            echo "<p> You did not given answer.";
        }else{
            echo "<p>Your answer was ".$_POST['response'];
            if($_POST['response'] == $_SESSION["lastResult"]){
                echo ". Felicitation !";
            }else{
                echo ". You were wrong !"; 
            }
        }
        echo " Try again!</p>"; 
        
        $_SESSION["lastAnswer"] = $_POST["response"];
    }
    $objCalcul = new Calcul();
    $_SESSION["lastResult"] = $objCalcul->getSolution();
    $_SESSION["lastCalcul"] = $objCalcul->getCalculString();
    
    
    echo "<p>".$_SESSION['lastCalcul']."</p>";

    class Calcul{
        private $operator = ["*","/","+","-"];
        private int $lenCalcul; //number of number in the calcul
        private int $lenCompCalcul; //number of number in the calcul
        private $stringCalcul = ""; //calcul in string
        private $compCalcul; //calcul in array
        private $solution;

        public function getSolution(){
            return $this->solution;
        }
        public function getCalculString(){
            return $this->stringCalcul;
        }

        public function __construct(){
            $this->lenCalcul = rand(2,4);
            $this->lenCompCalcul = $this->lenCalcul*2;
            $this->compCalcul = array($this->lenCompCalcul);
            $this->generateCompCalcul();
            $this->CalculSolution();
            //echo "<p>".$this->stringCalcul.$this->solution." </p>";
        }

        public function generateCompCalcul(){
            for($i = 0; $i < $this->lenCompCalcul; $i+=2 ){
                $this->compCalcul[$i]= rand(1,10);
                if($i<$this->lenCompCalcul-2){
                    $this->compCalcul[$i+1] = $this->operator[rand(0,3)];
                }
                else{
                    $this->compCalcul[$i+1] = "=";
                }
                $this->stringCalcul.= $this->compCalcul[$i] ." ". $this->compCalcul[$i+1]." ";
            }
            
        }
        public function printCalcul($i){
            echo "<p>";//.$i."#";
            foreach($this->compCalcul as $element){
                echo $element;
            }
            echo "</p>";
        }
        public function CalculSolution(){
            while(in_array("*", $this->compCalcul)){
                $posStar = array_search("*", $this->compCalcul);
                $this->compCalcul[$posStar-1]=$this->compCalcul[$posStar-1]*$this->compCalcul[$posStar+1];
                array_splice($this->compCalcul,$posStar,2);
            }
            while(in_array("/", $this->compCalcul)){
                $posSlash = array_search("/", $this->compCalcul);
                $this->compCalcul[$posSlash-1]=$this->compCalcul[$posSlash-1]/$this->compCalcul[$posSlash+1];
                array_splice($this->compCalcul,$posSlash,2);
            }
            while(in_array("+", $this->compCalcul)){
                $posPlus = array_search("+", $this->compCalcul);
                $this->compCalcul[$posPlus-1]=$this->compCalcul[$posPlus-1]+$this->compCalcul[$posPlus+1];
                array_splice($this->compCalcul,$posPlus,2);
            }
            while(in_array("-", $this->compCalcul)){
                $posMinus = array_search("-", $this->compCalcul);
                $this->compCalcul[$posMinus-1]=$this->compCalcul[$posMinus-1]-$this->compCalcul[$posMinus+1];
                array_splice($this->compCalcul,$posMinus,2);
            }
            $this->solution = $this->compCalcul[0];
        }
    }
?>