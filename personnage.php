<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO php</title>
</head>
<body>
<?php
try { // on effectue un "test" pour voir si on a bien connecté php a Mysql 
$db = new PDO(   // on se connecte a MySQL
    'mysql:host=localhost;dbname=gaulois', // on donne le nom d'hôte ici on est en local donc localhost, le nom de la base de donné : gaulois
    'root', // on indique ici le nom d'utilisateur
    ''  // on indique ici le mot de passe : ici il n y a pas de mot de passe donc ''
);

}
catch (Execption $e)  // si la connextion n'a pas eu lieu affichera ce message d'erreure
{
    die('Erreur : ' . $e->getMessage());
}


$sqlQuery = // Ici on fait la requete SQL que l'on souhaite obtenir et on la stocke dans une variable
'SELECT * 
FROM personnage
INNER JOIN specialite
    ON personnage.id_specialite = specialite.id_specialite
INNER JOIN lieu
    ON personnage.id_lieu = lieu.id_lieu';
$personnagesStatement = $db->prepare($sqlQuery); // On utilise PDO pour lire cette requete ici on assigne la requete a la variable nomStatement 
$personnagesStatement->execute(); // PDO execute la variable
$personnages = $personnagesStatement->fetchAll(); // PDO récupere les donnees sous forme de tableau

$sqlQuery1 = 
'SELECT nom_specialite, COUNT(id_personnage) AS nbPersonnages
FROM specialite
INNER JOIN personnage
    ON specialite.id_specialite = personnage.id_specialite
GROUP BY specialite.id_specialite
ORDER BY COUNT(id_personnage) DESC;';
$nbPersonnageSpecialiteStatement = $db->prepare($sqlQuery1);
$nbPersonnageSpecialiteStatement->execute();
$nbpersonnagesSpecialites = $nbPersonnageSpecialiteStatement->fetchAll();

$sqlQuery2 = 
'SELECT date_bataille, nom_bataille, nom_lieu
FROM bataille
INNER JOIN lieu
 	ON bataille.id_lieu = lieu.id_lieu
ORDER BY date_bataille DESC;';
$batailleLieuDateStatement = $db->prepare($sqlQuery2);
$batailleLieuDateStatement->execute();
$batailleLieuDates = $batailleLieuDateStatement->fetchAll();



?> <!-- on va restituer les données sous forme de tableau -->
<table>
    <thead>
        <tr>
            <th>Nom personnage</th>
            <th>Spécialité</th>
            <th>Ville</th>
        </tr>
    </thead>
    <tbody>
            <?php
            foreach ($personnages as $personnage) { ?> <!-- on fait une boucle pour lire le tableau $personnages-->
        <tr>
            <td><a href="personnage_gaulois.php"><?php echo $personnage['nom_personnage']; ?></a></td>
            <td><?php echo $personnage['nom_specialite']; ?></td>
            <td><?php echo $personnage['nom_lieu']; ?></td>               
            <?php
            }
            ?>
        </tr>
    </tbody>

    <table>
        <thead>
            <tr>
                <th>Spécialité</th>
                <th>Nombre de Gaulois</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($nbpersonnagesSpecialites as $nbpersonnagesSpecialite) { ?> <!-- on fait une boucle pour lire le tableau $nbpersonnagesSpecialites -->
                <tr>
                    <td><?php echo $nbpersonnagesSpecialite['nom_specialite']; ?></td>
                    <td><?php echo $nbpersonnagesSpecialite['nbPersonnages']; ?></td>
            <?php
            }
            ?>
                </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>Nom bataille</th>
                <th>Date de la bataille</th>
                <th>Lieu de la bataille</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($batailleLieuDates as $batailleLieuDate) { ?>
                <tr>
                    <td><?php echo $batailleLieuDate['nom_bataille'];?>
                    <td><?php
                    $date = $batailleLieuDate['date_bataille'];
                    $dt = DateTime::createFromFormat('Y-m-d', $date);
                    echo $dt->format('d/m/Y');
                    ?>
                    <td><?php echo $batailleLieuDate['nom_lieu'];?>
            <?php    
            }
            ?>
</body>
</html>





