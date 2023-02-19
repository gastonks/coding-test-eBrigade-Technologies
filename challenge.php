<?php

    /*
    Coding test for eBrigade Technologies
    19-02-2023
    By Romain Barré
    */

    /* the amount we want to break down to the minimum of banknotes and coins */
    $amount = $argv[1];

    /* table of the banknotes and the coins */
    $banknotesAndCoins = [0.10,0.20,0.50,1.00,2.00,5.00,10.00,20.00,50.00];
    $lengthTable = count($banknotesAndCoins) - 1;

    /* table to see how many times a banknote or coin is used */
    $banknotesAndCoinsUsed = array_fill(0, $lengthTable+1, 0.0);

    /* make a copy of the original amount to allow us to change its value */
    $X = $amount;

    $i = 0;
    while($X > 0 && $i <= $lengthTable){
        /* check if it is possible to break down the value with a certain coin */
        if((round($X - $banknotesAndCoins[$lengthTable - $i], 2)) >= 0){

            $numberOfBanknotesAndCoins = $X / $banknotesAndCoins[$lengthTable - $i];

            /* save the number of banknotes and coins used */
            $banknotesAndCoinsUsed[$lengthTable - $i] = floor($numberOfBanknotesAndCoins);
            
            /* update the value of the remaining amount */
            $X = round($X - ($banknotesAndCoinsUsed[$lengthTable - $i] * $banknotesAndCoins[$lengthTable - $i]), 2);

            $i++;
        }else{
            $i++;
        }
    }

    /*
    print a message about the breakdown of the amount

    print a different message if the amount is less than or equal to 0
    */ 
    if($amount > 0){
        echo("To break down " . $amount . " you need: ");
        for($j = 0; $j <= $lengthTable; $j++){
            if($banknotesAndCoinsUsed[$lengthTable - $j] != 0 && $banknotesAndCoins[$lengthTable - $j] >= 5){
                echo($banknotesAndCoinsUsed[$lengthTable - $j] . " banknote(s) of ". $banknotesAndCoins[$lengthTable - $j]." / ");
            }else if($banknotesAndCoinsUsed[$lengthTable - $j] != 0 && $banknotesAndCoins[$lengthTable - $j] < 5){
                echo($banknotesAndCoinsUsed[$lengthTable - $j] . " coin(s) of ". $banknotesAndCoins[$lengthTable - $j]." / ");
            }
        }
        echo(".");
    }else{
        echo("You don't need banknotes or coins to breakdown 0 or a negative value (or if it's a letter).");
    }
?>