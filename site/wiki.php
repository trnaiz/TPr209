<?php
include "scripts/functions.php";
page::parametres("Wiki - Tutucar");
?>
<h1>Wiki - Site de covoiturage Tutucar</h1>

<h2>Liste des fonctions utilisées</h2>

<h3>Fonctions globales</h3>
<ul>
    <li><code>cookies()</code> : Vérifie si des cookies sont présents, et si oui si ils sont legit pour connecter l'utilisateur (Fontion placée dans l'entête des pages)</li>
    <li><code>connexion()</code> : Gère la connexion d'un utilisateur (formulaire + session + cookie).</li>
    <li><code>modif_profile()</code> : Permet à un utilisateur de modifier ses informations de profil.</li>
    <li><code>inscription()</code> : Valide les données et crée un nouvel utilisateur avec mot de passe haché.</li>
</ul>

<h3>Classe <code>users</code></h3>
<ul>
    <li><code>get()</code> : Récupère la liste des utilisateurs depuis un fichier JSON.</li>
    <li><code>count()</code> : Retourne le nombre d'utilisateurs.</li>
    <li><code>put()</code> : Sauvegarde la liste modifiée dans le fichier JSON.</li>
    <li><code>addUser($data)</code> : Ajoute un nouvel utilisateur.</li>
    <li><code>removeUser($id)</code> : Supprime un utilisateur par ID.</li>
    <li><code>unser_exists($id)</code> : Vérifie l'existence d'un utilisateur.</li>
    <li><code>icon()</code> : Retourne l'icône à afficher selon le rôle ou véhicule de l'utilisateur.</li>
</ul>

<h3>Classe <code>annonces</code></h3>
<ul>
    <li><code>get()</code> : Récupère les annonces depuis le fichier JSON.</li>
    <li><code>put()</code> : Sauvegarde les annonces dans le fichier JSON.</li>
    <li><code>remove($id)</code> : Supprimer une annonces à partir de son ID.</li>
    <li><code>count()</code> : Retourne le nombre d'annonces.</li>
    <li><code>add()</code> : Ajoute une annonce à partir de données POST.</li>
    <li><code>nbr_inscrit($id_annonce)</code> : Retourne le nombre d'inscrits à une annonce.</li>
    <li><code>reservation($nom_user)</code> : Gère l'ajout ou le retrait d'une réservation.</li>
    <li><code>user_event()</code> : Retourne un JSON des trajets réservés par un utilisateur (pour le calendrier).</li>
</ul>

<h3>Classe <code>page</code></h3>
<ul>
    <li><code>parametres($title)</code> : Charge les paramètres globaux de la page (titre, balises meta).</li>
    <li><code>entete()</code> : Affiche le header avec avatar et connexion.</li>
    <li><code>nav()</code> : Affiche la barre de navigation selon le rôle connecté.</li>
    <li><code>active()</code> : Détermine la page active.</li>
    <li><code>pieddepage()</code> : Affiche le footer avec date, IP, port, heure.</li>
</ul>

<hr />

<h2>Liste des identifiants / mots de passe de test</h2>

<table>
    <thead>
    <tr><th>Utilisateur</th><th>Mot de passe</th><th>Rôle</th></tr>
    </thead>
    <tbody>
    <tr><td>admin</td><td>motdepasse</td><td>admin</td></tr>
    <tr><td>modo</td><td>motdepasse</td><td>modo</td></tr>
    <tr><td>user</td><td>motdepasse</td><td>user</td></tr>
    <tr><td>tristan</td><td>bonjour</td><td>user</td></tr>
    </tbody>
</table>

<blockquote><p>Les comptes sont définis dans <code>data/r209-tp_utilisateurs.json</code>.</p></blockquote>

<hr />

<h2>Ce qui fonctionne ✅</h2>

<ul>
    <li>Connexion, déconnexion, cookie</li>
    <li>Création de compte avec validation des données</li>
    <li>Ajout, modification, suppression d'annonces (selon droits)</li>
    <li>Réservations sur annonces (ajout/retrait)</li>
    <li>Affichage d’un calendrier dynamique (FullCalendar) des trajets réservés</li>
    <li>Affichage des actions selon l'utilisateur connecté (rôle ou propriétaire)</li>
    <li>Navigation dynamique avec Bootstrap et templates</li>
</ul>

<hr />

<h2>Ce qui ne fonctionne pas ou limitations ❌</h2>

<ul>
    <li>Pas d'historique ou de notifications pour les réservations</li>
    <li>Pas de système de confirmation <i>(Sauf suppression des utilisateurs pour les admins)</i></li>
    <li>Le système d’inscription ne vérifie pas les doublons d’e-mail</li>
    <li>Aucune pagination ni recherche dynamique (hors front-end)</li>
</ul>

<hr />

<h2>Subtilités et remarques techniques ℹ️</h2>

<ul>
    <li>Les données sont stockées en JSON (pas de base de données)</li>
    <li>Les cookies sont sécurisés avec un <code>hash_hmac()</code> pour éviter la falsification</li>
    <li><code>users::icon()</code> choisit une icône selon le rôle (admin/modo) ou véhicule (user)</li>
    <li>Le calendrier utilise <code>FullCalendar</code> et charge les données via <code>user_event()</code></li>
    <li>Bootstrap 5 est utilisé pour toute la mise en page</li>
    <li>L'accès à certaines fonctionnalités est strictement basé sur le rôle via <code>$_SESSION["role"]</code></li>
</ul>

<hr />
<p>Ce document est à jour avec le fichier <code>functions.php</code> actuel. Il peut servir de référence pour les développeurs, testeurs ou relecteurs du projet.</p>
