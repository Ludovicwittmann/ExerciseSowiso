<?php
// Start the session
session_start();
?>


<!DOCTYPE html>
<html> 
    <head>
        <title>Exercise Sowiso</title>
        <link href="style.css" rel="stylesheet"/>
    </head>
    <body>
        <header>
            <nav>
                <a href="./IndexSecond.php"><button>Harder</button></a>
            </nav>
        </header>
        <main>
            <div class="calcul">
                <?php 

                include "./calcul.php"?>
                <form action="./index.php" method="post">
                    <input type="number" step="0.01" name="response" class="inputAnswer">
                    <br>
                    <input type="submit" name="validate" value="Validate"class="inputSubmit">

                </form>
            </div>
            <div class="historic">
                <?php
                    if(!isset($_SESSION["historic"])){
                        $_SESSION["historic"] = array();
                    }else{
                        array_push($_SESSION["historic"], $_SESSION["lastCalcul"].$_SESSION["lastResult"]." Your answer was : ".$_SESSION["lastAnswer"].".");
                        for ($i=sizeof($_SESSION["historic"])-2; $i > sizeof($_SESSION["historic"])-10; $i--) { 
                            echo "<p>".$_SESSION["historic"][$i]."</p>";
                        }
                    }
                
                ?>
            </div>
        </main>
    </body>
</html>