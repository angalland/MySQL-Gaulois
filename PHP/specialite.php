<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav>
        <ul>
            <li><a href='personnage.php'>Personnage</a></li>
            <li><a href='specialite.php'>Specialite</a></li>
            <li><a href='bataille.php'>Bataille</a></li>
            <li><a href='liste_personnage.php'>Liste des personnages</a></li>
        </ul>
    </nav>
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
?>

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


</body>
</html>