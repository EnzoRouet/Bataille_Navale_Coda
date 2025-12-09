<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="CSS/style.css">
  <title>Bataille Navale</title>
</head>

<body>
  <form method="post">
    <label>Taille : </label>
    <input type="number" name="tailleMatrice" placeholder="10" min="10" max="20">
    <button type="submit">Créer !</button>
  </form>

  <table>
    <?php
    require_once("../index.php");
    for ($i = 0; $i < $tailleMatrice; $i++) {
      echo "<tr>";
      for ($j = 0; $j < $tailleMatrice; $j++) {
        $valeur = $matrice[$i][$j];
        if ($valeur === "X"){
          $classe = "touché";
        } elseif ($valeur === "O"){
          $classe = "plouf";
        } elseif ($valeur === 0){
          $classe = "vide";
        } else {
          $classe = "bateau";
        }

        $attribut_js = '';
        if ($valeur != "X" && $valeur != "O"){
          $classe .= " clickable";
          $attribut_js = "data-x='$j' data-y='$i' ";
        }

        echo "<td class='$classe' $attribut_js></td>";
      }
      echo "</tr>";
    }
    ?>
  </table>
</body>

<script src="JS/index.js"></script>
</html>