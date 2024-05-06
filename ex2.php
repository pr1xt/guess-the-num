<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="ex2.css?v=<?php echo time(); ?>">
</head>
<body>
    <h1>Try to count how many times your number appears in list!</h1>
    <form method="get">
        <input type="submit" name="generate_array" value="Generate New Array">
        <input type="submit" name="show_array" value="Show Array">
        <?php 
        
            if(isset($_GET['show_array'])) {
            $cookie_value = $_COOKIE['random_array'];
            $arr_from_cookie = explode(", ", $cookie_value);
            echo implode(", ", $arr_from_cookie);        
            }


            if(isset($_GET['hide_array'])) {
                header("Location: " . $_SERVER['PHP_SELF']);
            }

        ?>
        <input type="submit" name="hide_array" value="Hide Array"><br><br><br>
        <label for="input_number">Choose your number</label>
        <input type="number" name="input_number" value="1" min="1" max="4"><br>
        <label for="count_number">Guess count of your number</label>
        <input type="number" name="count_number" value="1" min="0" max="20"><br>
        <input type="submit" name="guess" value="Guess!">
        
        
    </form>



    <?php

    if(isset($_GET['guess'])) {
        $num = $_GET['input_number'];
        $cnt_num = $_GET['count_number'];
         
        $cookie_value = $_COOKIE['random_array'];
        $arr_from_cookie = explode(", ", $cookie_value);

        $cnt = count(array_filter($arr_from_cookie,function($a){
            global $num;
            return $a == $num;
        }));
        if ($cnt_num == $cnt){
            echo "Yes number $num appears in list $cnt times";
        }else{
            echo "No number $num appears in list not $cnt_num times";
        }

    
    }

    if(isset($_GET['generate_array'])) {
        $arr = ran_arr();
        $string_arr = implode(", ", $arr);
        setcookie("random_array", $string_arr, time() + (86400 * 30), "/");        
        header("Location: " . $_SERVER['PHP_SELF']);
    
    }


    function ran_arr($arr = []){
        if(count($arr) == 20){
            return $arr;
        }
        array_push($arr,rand(1,4));
        return ran_arr($arr);
    }
    ?>
</body>
</html>