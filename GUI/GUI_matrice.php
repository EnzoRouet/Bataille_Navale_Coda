<?php
session_start();
require_once("../data/DB.php");
require_once("../utils/logique_partie.php"); 


// if (!isset($_SESSION['user_id']) || !isset($_SESSION['game_id'])) {
//     header("Location: ../utils/player.php");
//     exit;
// }

$game_id = $_SESSION['game_id'];
$mon_id = $_SESSION['user_id'];
$adversaire_id = recuperer_id_adversaire($pdo, $game_id, $mon_id);
$tailleMatrice = isset($_SESSION['taille_grille']) ? $_SESSION['taille_grille'] : 10;

if (isset($_GET['x']) && isset($_GET['y'])) {
    $tir_x = (int)$_GET['x'];
    $tir_y = (int)$_GET['y'];

    tirer($pdo, $game_id, $mon_id, $adversaire_id, $tir_x, $tir_y);

    header("Location: GUI_matrice.php");
    exit;
}

$grille_defense = creerMatrice($tailleMatrice);
$grille_defense = placer($pdo, $grille_defense, $game_id, $mon_id);
$grille_defense = recuperer_historique_tirs($pdo, $game_id, $adversaire_id, $grille_defense);


$grille_attaque = creerMatrice($tailleMatrice);
$grille_attaque = placer_epave($pdo, $grille_attaque, $game_id, $adversaire_id); 
$grille_attaque = recuperer_historique_tirs($pdo, $game_id, $mon_id, $grille_attaque); 


header('refresh:5');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="CSS/style.css">
  <title>Bataille Navale - Combat</title>
  <style>
      .game-container { display: flex; justify-content: center; gap: 50px; padding: 20px; }
      .board-title { text-align: center; color: white; margin-bottom: 10px; }
      .board-defense table { border: 4px solid #4CAF50; }
      .board-attack table { border: 4px solid #F44336; }
  </style>
</head>

<body>

<div class="game-container">

    <div class="board-defense">
        <h2 class="board-title">Ma Flotte</h2>
        <table>
            <?php
            for ($i = 0; $i < $tailleMatrice; $i++) {
                echo "<tr>";
                for ($j = 0; $j < $tailleMatrice; $j++) {
                    $valeur = $grille_defense[$i][$j];
                    
                    if ($valeur === "X") $c = "touche";
                    elseif ($valeur === "O") $c = "plouf";
                    elseif ($valeur != 0 && $valeur != "EPAVE") $c = "bateau"; 
                    else $c = "vide";

                    echo "<td class='$c'></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <div class="board-attack">
        <h2 class="board-title">Radar de Tir</h2>
        <table>
            <?php
            for ($i = 0; $i < $tailleMatrice; $i++) {
                echo "<tr>";
                for ($j = 0; $j < $tailleMatrice; $j++) {
                    $valeur = $grille_attaque[$i][$j];
                    

                    if ($valeur === "X") $c = "touche";
                    elseif ($valeur === "O") $c = "plouf";
                    elseif ($valeur === "EPAVE") $c = "epave"; 
                    else $c = "vide";

                    $js = "";
                    if ($valeur !== "X" && $valeur !== "O") {
                        $c .= " clickable";
                        $js = "data-x='$j' data-y='$i'";
                    }

                    echo "<td class='$c' $js></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>

</div>

<form method="post" id="abandonForm" action="../utils/player.php" style="text-align:center; margin-top:20px;">
    <button type="button" onclick="confirmAbandon()">❌ Abandonner la partie</button>
</form>

<script>
    function confirmAbandon() {
      if (confirm("Voulez-vous vraiment abandonner ?")) {
        let form = document.getElementById("abandonForm");
        let input = document.createElement("input");
        input.type = "hidden";
        input.name = "reset_total";
        input.value = "1";
        form.appendChild(input);
        form.submit();
      }
    }
</script>

<script src="JS/index.js"></script>

</body>
</html>