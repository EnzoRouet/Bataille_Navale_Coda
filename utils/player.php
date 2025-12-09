<?php
session_start();

$fichier = "../data/etat_joueurs.json";

if (!file_exists($fichier)) {
  file_put_contents($fichier, json_encode(["j1" => null, "j2" => null]));
}

$etat = json_decode(file_get_contents($fichier), true);

if (isset($_SESSION["role"])) {
  if ($_SESSION["role"] === "Joueur 1" && $etat["j1"] !== session_id()) {
    unset($_SESSION["role"]);
  }
  if ($_SESSION["role"] === "Joueur 2" && $etat["j2"] !== session_id()) {
    unset($_SESSION["role"]);
  }
}

function save_state($file, $data)
{
  file_put_contents($file, json_encode($data));
}

if (isset($_POST["reset_total"])) {
  $etat = ["j1" => null, "j2" => null];
  save_state($GLOBALS['fichier'], $etat);

  session_unset();
  session_destroy();

  header("Location: player.php");
  exit;
}

if (isset($_SESSION["role"])) {
  if ($_SESSION["role"] === "Joueur 1") {
    if (isset($_POST["joueur2"])) {
      exit("❌ Vous êtes déjà Joueur 1 !");
    }
  }

  if ($_SESSION["role"] === "Joueur 2") {
    if (isset($_POST["joueur1"])) {
      exit("❌ Vous êtes déjà Joueur 2 !");
    }
  }
}


if (isset($_POST["joueur1"])) {
  if ($etat["j1"] === null) {
    $etat["j1"] = session_id();
    $_SESSION["role"] = "Joueur 1";
    save_state($fichier, $etat);
  }
}

if (isset($_POST["joueur2"])) {
  if ($etat["j2"] === null) {
    $etat["j2"] = session_id();
    $_SESSION["role"] = "Joueur 2";
    save_state($fichier, $etat);
  }
}

if (isset($_SESSION["role"]) && $_SESSION["role"] !== null) {
  if ($etat["j1"] !== null && $etat["j2"] !== null) {
    header("Location: ../GUI/GUI_matrice.php");
    exit;
  }
}

// Détection automatique du rôle (si déjà assigné avant refresh)
$role = $_SESSION["role"] ?? "Aucun rôle";

header('refresh:5');

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Joueur 1 / Joueur 2</title>
</head>

<body>
  <h1>Connexion aux rôles</h1>
  <h2>Votre rôle actuel : <strong><?= $role ?></strong></h2>
  <p>
    Joueur 1 : <?= $etat["j1"] ? "🟢 Occupé" : "🔴 Libre" ?><br>
    Joueur 2 : <?= $etat["j2"] ? "🟢 Occupé" : "🔴 Libre" ?>
  </p>

  <form method="post">

    <?php
    $disableJ1 = "";
    $disableJ2 = "";

    if ($etat["j1"] !== null) {
      $disableJ1 = "disabled";
    }

    if ($etat["j2"] !== null) {
      $disableJ2 = "disabled";
    }

    if (isset($_SESSION["role"])) {
      $disableJ1 = "disabled";
      $disableJ2 = "disabled";
    }
    ?>

    <button type="submit" name="joueur1" <?= $disableJ1 ?>>
      🎮 Devenir Joueur 1
    </button>

    <button type="submit" name="joueur2" <?= $disableJ2 ?>>
      🎮 Devenir Joueur 2
    </button>

    <button type="submit" name="reset_total">
      ❌ Fin de partie (RESET)
    </button>

  </form>

</body>

</html>