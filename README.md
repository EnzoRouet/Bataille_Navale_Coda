# Web Battleship

Un jeu de stratégie navale multijoueur en temps réel développé avec une architecture PHP native.

## 🛠️ Stack Technique

* **Frontend :** JavaScript Vanilla (ES6+), Fetch API, Manipulation du DOM
* **Backend :** PHP 8.x (Architecture MVC, POO)
* **Base de données :** MariaDB (SQL) via PDO
* **Serveur :** Nginx / Apache

## 📋 Prérequis

* PHP 8.0 ou supérieur
* MariaDB 10.x ou supérieur
* Un serveur web local (WAMP, XAMPP, MAMP, ou Docker)

## ⚙️ Installation

1.  **Cloner le dépôt**
    ```bash
    git clone [https://github.com/ton-pseudo/web-battleship.git](https://github.com/ton-pseudo/web-battleship.git)
    cd web-battleship
    ```

2.  **Configuration**
    Copiez le fichier d'exemple de configuration et renseignez vos accès BDD.
    ```bash
    cp config/db.example.php config/db.php
    ```
    *(Éditez `config/db.php` avec vos identifiants MariaDB : host, user, password)*

3.  **Initialisation de la Base de Données**
    Ce projet intègre un script d'installation automatique qui génère les tables nécessaires.
    
    Lancez votre serveur local et accédez à l'URL d'installation :
    > `http://localhost/web-battleship/data/install.php`
    *(⚠️ Adaptez ce chemin selon la structure de vos dossiers)*

    Une fois le message de succès affiché, la base de données est prête.

4.  **Lancer le jeu**
    Redirigez-vous vers l'accueil :
    > `http://localhost/web-battleship/`

## 🏗️ Architecture & API

### Communication Client-Serveur
L'application utilise une stratégie de **Polling** (requêtes périodiques) pour simuler le temps réel sans rechargement de page.

| Méthode | Fichier (Endpoint) | Description |
| :--- | :--- | :--- |
| `POST` | `/data/save_placement.php` | Valide les coordonnées des bateaux et les enregistre en BDD. |
| `GET` | `/data/get_state.php` | Récupère l'état actuel de la partie (tour du joueur, tirs, grilles). |
| `POST` | `/data/fire.php` | Traite la logique de tir et met à jour la matrice de jeu. |

### Gestion des Données
* **Parties (Games) :** Stockées avec des états (`WAITING`, `IN_PROGRESS`, `FINISHED`) pour gérer le matchmaking simple.
* **Mouvements (Moves) :** Chaque tir est enregistré individuellement pour éviter les doublons et permettre l'historique.

## 👥 Contributeurs

* **Enzo** - *Développeur Full Stack* - [Github](https://github.com/ton-profil)
* **@kenzotrindade** - *Co-développeur* - [Github](https://github.com/kenzotrindade)

---
*Projet développé dans le cadre du Bachelor Full Stack à l'école Coda.*
