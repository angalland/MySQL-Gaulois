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


$sqlQuery = 'SELECT * FROM personnage';
$gauloisStatement = $db->prepare($sqlQuery);
$gauloisStatement->execute();
$gaulois = $gauloisStatement->fetchAll();


foreach ($gaulois as $gauloi) {
    ?>
    <p><?php echo $gauloi['nom_personnage']; ?></p>
<?php
}





?>
</body>
</html>





