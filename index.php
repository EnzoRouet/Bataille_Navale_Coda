<?php

require "test_db.php";

$matrice = array_fill(0, 10, array_fill(0, 10, 0));


function placer($grille, $taille, $depart_x, $depart_y, $direction){
    for ($i = 0; $i < $taille; $i++){
        if ($direction == "horizontale"){
            $grille[$depart_y][$depart_x + $i] = $taille;
        } elseif ($direction == "verticale"){
            $grille[$depart_y + $i][$depart_x] = $taille;
        } else {
            echo "Veuillez entrer une direction valide !";
            break;
        }
    }
    return $grille;
}

function tirer($grille, $x, $y){
    if ($grille[$y][$x] != 0){
        $grille[$y][$x] = "X";
    } else {
        $grille[$y][$x] = "O";
    }
    return $grille;
}

$matrice = placer($matrice, 3, 2, 3,"horizontale");
var_dump($matrice);
$matrice = tirer($matrice,2,3);

?>