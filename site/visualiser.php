<?php
session_start();
include "scripts/functions.php";

page::parametres("Visualiser - Tutucar");
page::entete();
page::nav();
?>


    <h1 class="my-4 text-center">Liste des annonces</h1 >

    <div class="container ">
    <table class="table">
        <thead>
        <tr>
            <th>
                Pseudo
            </th>
            <th>
                Date
            </th>
            <th>
                Depart
            </th>
            <th>
                Arrivee
            </th>
            <th>
                Places
            </th>
            <th>
                Commentaire
            </th>
            <th>
                Inscrits
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (annonces::get() as $id => $info) {
            $liste = !empty($info['Inscrits']) ? implode(', ', $info['Inscrits']) : '-';
            $com = !empty($info['Commentaire']) ? $info['Commentaire'] : '-';
            ?>
            <tr>
                <td><?= $info['Pseudo'] ?></td>
                <td><?= $info['Date'] ?></td>
                <td><?= $info['Depart'] ?></td>
                <td><?= $info['Arrivee'] ?></td>
                <td><?= $info['Places'] ?></td>
                <td><?= $com ?></td>
                <td><?= $liste ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>

<?php
page::pieddepage();
