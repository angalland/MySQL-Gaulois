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
try {
$db = new PDO(
    'mysql:host=localhost;dbname=gaulois',
    'root',
    ''
);

}
catch (Execption $e)
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

$sqlQuery1 = 'SELECT * FROM specialite';
$specialiteStatement = $db->prepare($sqlQuery1);
$specialiteStatement->execute();
$specialites = $specialiteStatement->fetchAll();

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





