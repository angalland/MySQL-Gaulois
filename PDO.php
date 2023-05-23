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


$sqlQuery = 
'SELECT * 
FROM personnage
INNER JOIN specialite
    ON personnage.id_specialite = specialite.id_specialite
INNER JOIN lieu
    ON personnage.id_lieu = lieu.id_lieu';
$personnagesStatement = $db->prepare($sqlQuery);
$personnagesStatement->execute();
$personnages = $personnagesStatement->fetchAll();

$sqlQuery1 = 'SELECT * FROM potion';
$potionStatement = $db->prepare($sqlQuery1);
$potionStatement->execute();
$potions = $potionStatement->fetchAll();

?>
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
            foreach ($personnages as $personnage) { ?>
        <tr>
            <td><?php echo $personnage['nom_personnage']; ?></td>
            <td><?php echo $personnage['nom_specialite']; ?></td>
            <td><?php echo $personnage['nom_lieu']; ?></td>               
            <?php
            }
            ?>
        </tr>
    </tbody>
</table>
</body>
</html>





