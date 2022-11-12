<?php

// $a = 3;
// $b = array("0"=>"Even","1"=>"Odd");

// // $a = $a % 2;
// echo $b[$a%2];

// $numbers = array(5, 3, 7, 9, 6, 8);
// sort($numbers);
// echo $numbers[count($numbers) - 2]; 

// $k = 1;

// for($i=1; $i<=5; $i++){
//     for($j=1; $j<$i; $j++){
//         echo $k;
//         $k++;
//     }echo "<br>";
// }


// for($i=1;$i<=5;$i++){
//     for($j=1;$j<=$i;$j++){
//         echo " ";
//         echo $j;
//         echo " ";
        
//     }echo "<br>";
// }





function monthName($intMonth){

switch($intMonth){

    case 1:
        echo "Jan";
        break;
    case 2:
        echo "Feb";
        break;
    case 3:
        echo "Mar";
        break;
    case 4:
        echo "Apr";
        break;
    case 5:
        echo "May";
        break;
    case 6:
        echo "Jun";
        break;
    case 7:
        echo "Jul";
        break;
    case 8:
        echo "Aug";
        break;
    case 9:
        echo "Sep";
        break;
    case 10:
        echo "Oct";
        break;
    case 11:
        echo "Nov";
        break;
    case 12:
        echo "Dec";
        break;
    case "Jan":
        return "1";
        break;
    case "Feb":
        return "2";
        break;
    case "Mar":
        return "3";
        break;
    case "Apr":
        return "4";
        break;
    case "May":
        return "5";
        break;
    case "Jun":
        return "6";
        break;
    case "Jul":
        return "7";
        break;
    case "Aug":
        return "8";
        break;
    case "Sep":
        return "9";
        break;
    case "Oct":
        return "10";
        break;
    case "Nov":
        return "11";
        break;
    case "Dec":
        return "12";
        break;
    default:
        return "No data";
}
}
?>