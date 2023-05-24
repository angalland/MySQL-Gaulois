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
$id = $_GET['id'];

try {   
    $db = new PDO(   
            'mysql:host=localhost;dbname=gaulois',  
            'root', 
            ''
        );

        $sqlQuery = 
        'SELECT * 
        FROM personnage
        INNER JOIN specialite
            ON personnage.id_specialite = specialite.id_specialite
        INNER JOIN lieu
            ON personnage.id_lieu = lieu.id_lieu
        LEFT JOIN prendre_casque
            ON personnage.id_personnage = prendre_casque.id_personnage
        LEFT JOIN bataille
            ON prendre_casque.id_bataille = bataille.id_bataille
        WHERE personnage.id_personnage ='. $id;
        

        $personnagesStatement = $db->prepare($sqlQuery); 
        $personnagesStatement->execute(); 
        $personnages = $personnagesStatement->fetchAll();

        echo '<table>',
                    '<thead>',
                        '<tr>',
                            '<th>Nom personnage</th>',
                            '<th>Specialite</th>',
                            '<th>Ville</th>',
                            '<th>Adresse</th>',
                            '<th>Bataille</th>',
                        '</tr>',
                    '</thead>',
                    '<tbody>';
        foreach ($personnages as $personnage){
            echo '<tr>',
                    '<td>'.$personnage['nom_personnage'].'</td>',
                    '<td>'.$personnage['nom_specialite'].'</td>',
                    '<td>'.$personnage['nom_lieu'].'</td>',
                    '<td>'.$personnage['adresse_personnage'].'</td>',
                    '<td>'.$personnage['nom_bataille'].'</td>',
                '</tr>';
        }
        echo '</tbody>',
        '</table>';
} catch (Execption $e)  {
    die('Erreur : ' . $e->getMessage());
}

?>
     
    </body>
</html>
