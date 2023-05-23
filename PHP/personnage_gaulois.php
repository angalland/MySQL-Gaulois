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

session_start();


// if (isset($_GET['action=lien'])){

    

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
        'SELECT nom_personnage, adresse_personnage, nom_lieu, nom_specialite, nom_bataille
        FROM personnage
        INNER JOIN specialite
            ON personnage.id_specialite = specialite.id_specialite
        INNER JOIN lieu
            ON personnage.id_lieu = lieu.id_lieu
        LEFT JOIN prendre_casque
            ON personnage.id_personnage = prendre_casque.id_personnage
        LEFT JOIN bataille
            ON  prendre_casque.id_bataille = bataille.id_bataille';
        $personnagesStatement = $db->prepare($sqlQuery); 
        $personnagesStatement->execute(); 
        $personnages = $personnagesStatement->fetchAll();

        
    
        
        
    // }
    echo 
    "<table>
        <thead>
            <tr>
                <th>Nom personnage</th>
                <th>Spécialité</th>
                <th>Ville</th>
                <th>Bataille</th>
            </tr>
        </thead>
        <tbody>";
                
                foreach ($personnages as $index => $personnage) {  
            echo "<tr>",
                "<td>",
                $personnage['nom_personnage'];
                "</td>";
                
                }
            
            echo "</tr>
        </tbody>
    </table>";  
?>
<p>test</p>
    
    </body>
</html>
