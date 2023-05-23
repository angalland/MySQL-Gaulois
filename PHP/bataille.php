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

    $sqlQuery2 = 
    'SELECT date_bataille, nom_bataille, nom_lieu
    FROM bataille
    INNER JOIN lieu
         ON bataille.id_lieu = lieu.id_lieu
    ORDER BY date_bataille DESC;';
    $batailleLieuDateStatement = $db->prepare($sqlQuery2);
    $batailleLieuDateStatement->execute();
    $batailleLieuDates = $batailleLieuDateStatement->fetchAll();
?>

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