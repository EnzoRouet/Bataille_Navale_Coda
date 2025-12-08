<?php

$matrice = array_fill(0, 10, array_fill(0, 10, 0));


function placer($grille, $taille){
    for ($i = 0; $i < $taille; $i++){
        $grille[$i][0] = $taille;
    }
    return $grille;
}

$matrice = placer($matrice, 3);
var_dump($matrice);

?>