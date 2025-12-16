# 🕹️ Project: Coda (Real-Time Game Engine)

### 👥 Collaboration
Ce projet est le fruit d'un travail collaboratif intensif entre **Enzo** et **[@kenzotrindade](https://github.com/kenzotrindade)**.  
La synergie de notre équipe a permis de coupler une logique backend robuste à une interface utilisateur fluide.

---

## 📝 Présentation du Projet
**Coda** est une application web de jeu multijoueur local conçue pour démontrer la gestion d'états asynchrones en PHP. 

L'objectif était de créer une expérience utilisateur sans couture où le passage de la phase de préparation (sélection des joueurs) à la phase de gameplay (plateau) se fait de manière totalement automatique et dynamique.

### Points Clés :
* **Architecture Event-Driven (Simulée) :** Utilisation d'un bus de données JSON pour synchroniser l'état des joueurs sans base de données lourde.
* **Logique de Routage Dynamique :** Moteur de rendu conditionnel qui injecte les composants (`plateau` vs `selection`) selon le contexte de la session.

---

## 🛠️ Défis Techniques & Apprentissages

Au cours du développement, nous avons été confrontés à des problématiques réelles de production que nous avons résolues avec succès :

### 1. Synchronisation de l'État (Race Conditions)
**Défi :** Comment s'assurer que deux joueurs se connectant simultanément ne corrompent pas l'état global ?  
**Solution :** Mise en place d'une structure de données persistante en JSON avec vérifications d'intégrité à chaque cycle d'exécution, garantissant que la partie ne commence que si $j1$ ET $j2$ sont instanciés.

### 2. Gestion du Cycle de Vie HTTP (The Loop Challenge)
**Défi :** Gérer le rafraîchissement automatique de l'interface sans créer de boucles de redirection infinies (Erreurs HTTP 310).  
**Solution :** Implémentation d'un système de **Polling Conditionnel**. Le script analyse l'état du serveur avant de décider s'il doit ordonner au client de se rafraîchir, optimisant ainsi la stabilité du navigateur.
### 3. Stack Environnementale (DevOps)
**Défi :** Configurer un environnement **Nginx / PHP-FPM** sur Ubuntu pour gérer les communications via Sockets Unix.  
**Solution :** Maîtrise de la configuration des blocs `location` et gestion fine des permissions système (`www-data`) pour permettre l'écriture sécurisée des données de jeu.

---

## 🚀 Stack Technique
* **Backend :** PHP 8.x (Session management, JSON parsing)
* **Frontend :** Architecture modulaire (Inclusion de composants dynamiques)
* **Serveur :** Nginx, PHP-FPM sur Ubuntu
* **Data :** JSON Persistence

---

## 📈 Évolutions Possibles
* Migration vers **WebSockets** (Ratchet PHP) pour supprimer le polling et passer sur du temps réel pur.
* Implémentation d'un système de **Matchmaking** via une base de données relationnelle.

---

**Envie d'en savoir plus sur notre méthodologie de travail ?** N'hésitez pas à nous contacter ou à consulter nos autres dépôts.

