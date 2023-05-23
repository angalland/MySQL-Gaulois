<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>personnage Gaulois</title>
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
'SELECT nom_personnage, adresse_personnage, nom_lieu, nom_specialite, nom_bataille
FROM personnage
INNER JOIN specialite
    ON personnage.id_specialite = specialite.id_specialite
INNER JOIN lieu
    ON personnage.id_lieu = lieu.id_lieu
INNER JOIN prendre_casque
	ON personnage.id_personnage = prendre_casque.id_personnage
INNER JOIN bataille
	ON  prendre_casque.id_bataille = bataille.id_bataille
ORDER BY nom_personnage';
$personnagesStatement = $db->prepare($sqlQuery); // On utilise PDO pour lire cette requete ici on assigne la requete a la variable nomStatement 
$personnagesStatement->execute(); // PDO execute la variable
$personnages = $personnagesStatement->fetchAll(); // PDO récupere les donnees sous forme de tableau

$sqlQuery1 = 
'SELECT nom_personnage, nom_bataille
FROM prendre_casque
INNER JOIN personnage
	ON prendre_casque.id_personnage = personnage.id_personnage
INNER JOIN bataille
	ON prendre_casque.id_bataille = bataille.id_bataille';
$bataillePersonnageStatement = $db->prepare($sqlQuery1);
$bataillePersonnageStatement->execute();
$bataillePersonnages = $bataillePersonnageStatement->fetchAll();


?> <!-- on va restituer les données sous forme de tableau -->
<table>
    <thead>
        <tr>
            <th>Nom personnage</th>
            <th>Spécialité</th>
            <th>Ville</th>
            <th>Bataille</th>
        </tr>
    </thead>
    <tbody>
            <?php
            foreach ($personnages as $personnage) { ?> <!-- on fait une boucle pour lire le tableau $personnages-->
        <tr>
            <td><?php echo $personnage['nom_personnage'][1]; ?></td>
            <td><?php echo $personnage['nom_specialite'][0]; ?></td>
            <td><?php echo $personnage['nom_lieu'][0]; ?></td>               
            <td><?php echo $personnage['nom_bataille'][0]; ?></td>
            <?php
            }
            ?>
        </tr>
    </tbody>

  
</body>
</html>