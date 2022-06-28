<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html> 
    <head>
        <title>Exercise Sowiso Harder</title>
        <link href="style.css" rel="stylesheet"/>
    </head>
    <body>
        <header>
            <nav>
                <button><a href="./Index.php">Easier</a></button>
            </nav>
        </header>
        <main>
            <div class="calcul">
                <?php 

                include "./CalculHarder.php"?>
                <form action="./index.php" method="post">
                    <input type="number" step="0.01" name="responseH" class="inputAnswer">
                    <br>
                    <input type="submit" name="validate" value="Validate"class="inputSubmit">

                </form>
            </div>
            
        </main>
    </body>
</html>