# TPr209
### Nous avons du réaliser un site de covoiturage en cour avec un temps limité de 5 jours 

---

## Wiki - Site de covoiturage Tutucar

#### Liste des fonctions utilisées

##### Fonctions globales

- `cookies()` : Vérifie si des cookies sont présents, et si oui s'ils sont valides pour connecter l'utilisateur (fonction placée dans l'entête des pages)
- `connexion()` : Gère la connexion d'un utilisateur (formulaire + session + cookie)
- `modif_profile()` : Permet à un utilisateur de modifier ses informations de profil
- `inscription()` : Valide les données et crée un nouvel utilisateur avec mot de passe haché

##### Classe `users`

- `get()` : Récupère la liste des utilisateurs depuis un fichier JSON
- `count()` : Retourne le nombre d'utilisateurs
- `put()` : Sauvegarde la liste modifiée dans le fichier JSON
- `addUser($data)` : Ajoute un nouvel utilisateur
- `removeUser($id)` : Supprime un utilisateur par ID
- `unser_exists($id)` : Vérifie l'existence d'un utilisateur
- `icon()` : Retourne l'icône à afficher selon le rôle ou véhicule de l'utilisateur

##### Classe `annonces`

- `get()` : Récupère les annonces depuis le fichier JSON
- `put()` : Sauvegarde les annonces dans le fichier JSON
- `remove($id)` : Supprime une annonce à partir de son ID
- `count()` : Retourne le nombre d'annonces
- `add()` : Ajoute une annonce à partir de données POST
- `nbr_inscrit($id_annonce)` : Retourne le nombre d'inscrits à une annonce
- `reservation($nom_user)` : Gère l'ajout ou le retrait d'une réservation
- `user_event()` : Retourne un JSON des trajets réservés par un utilisateur (pour le calendrier)

##### Classe `page`

- `parametres($title)` : Charge les paramètres globaux de la page (titre, balises meta)
- `entete()` : Affiche le header avec avatar et connexion
- `nav()` : Affiche la barre de navigation selon le rôle connecté
- `active()` : Détermine la page active
- `pieddepage()` : Affiche le footer avec date, IP, port, heure

---

#### Liste des identifiants / mots de passe de test

| Utilisateur | Mot de passe | Rôle  |
|-------------|--------------|-------|
| admin       | motdepasse   | admin |
| modo        | motdepasse   | modo  |
| user        | motdepasse   | user  |
| tristan     | bonjour      | user  |

> Les comptes sont définis dans `data/r209-tp_utilisateurs.json`.

---

#### Ce qui fonctionne ✅

- Connexion, déconnexion, cookie
- Création de compte avec validation des données
- Ajout, modification, suppression d'annonces (selon droits)
- Réservations sur annonces (ajout/retrait)
- Affichage d’un calendrier dynamique (FullCalendar) des trajets réservés
- Affichage des actions selon l'utilisateur connecté (rôle ou propriétaire)
- Navigation dynamique avec Bootstrap et templates

---

#### Ce qui ne fonctionne pas ou limitations ❌

- Pas d'historique ou de notifications pour les réservations
- Pas de système de confirmation *(Sauf suppression des utilisateurs pour les admins)*
- Le système d’inscription ne vérifie pas les doublons d’e-mail
- Aucune pagination ni recherche dynamique (hors front-end)

---

#### Subtilités et remarques techniques ℹ️

- Les données sont stockées en JSON (pas de base de données)
- Les cookies sont sécurisés avec un `hash_hmac()` pour éviter la falsification
- `users::icon()` choisit une icône selon le rôle (admin/modo) ou véhicule (user)
- Le calendrier utilise `FullCalendar` et charge les données via `user_event()`
- Bootstrap 5 est utilisé pour toute la mise en page
- L'accès à certaines fonctionnalités est strictement basé sur le rôle via `$_SESSION["role"]`

---

Ce document est à jour avec le fichier `functions.php` actuel. Il peut servir de référence pour les développeurs, testeurs ou relecteurs du projet.
