# Bataille Navale

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
    git clone [https://github.com/ton-pseudo/bataille_navale.git](https://github.com/ton-pseudo/bataille_navale.git)
    cd bataille_navale
    ```

2.  **Configuration**
    Si un fichier de configuration est requis (ex: `conf.php` ou `db.php`), renseignez vos accès BDD dedans.

3.  **Initialisation de la Base de Données**
    Ce projet intègre un script d'installation automatique qui génère les tables nécessaires.
    
    Lancez votre serveur local et accédez à l'URL d'installation.
    Par exemple :
    > `http://localhost/bataille_navale/data/install_DB.php`

    Une fois le message de succès affiché, la base de données est prête.

4.  **Lancer le jeu**
    Redirigez-vous vers l'accueil :
    > `http://localhost/bataille_navale/`

## 🏗️ Architecture & API

### Communication Client-Serveur
L'application utilise une stratégie de **Polling** (requêtes périodiques) via `Fetch API` pour simuler le temps réel.

| Méthode | Fichier (Endpoint) | Description |
| :--- | :--- | :--- |
| `POST` | `/data/save_placement.php` | Valide les coordonnées des bateaux et les enregistre en BDD. |
| `GET` | `/data/etat.php` | Récupère l'état actuel de la partie (tour, tirs). |
| `POST` | `/data/tir.php` | Traite la logique de tir et met à jour la matrice. |

### Gestion des Données
* **Parties :** Stockées avec des états pour gérer le matchmaking.
* **Mouvements :** Chaque tir est enregistré individuellement pour éviter les doublons et permettre l'historique.

## 👥 Contributeurs

* **Enzo** - *Développeur Full Stack* - [Github](https://github.com/ton-profil)
* **@kenzotrindade** - *Co-développeur* - [Github](https://github.com/kenzotrindade)

---
*Projet développé dans le cadre du Bachelor Full Stack à l'école Coda.*

