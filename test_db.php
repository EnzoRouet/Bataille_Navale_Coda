<?php
try {
  $db = new PDO('mysql:host=127.0.0.1;dbname=bataille_navale;charset=utf8', 'root', '1808');
  echo "Connexion OK";
} catch (Exception $e) {
  die('Erreur : ' . $e->getMessage());
}
