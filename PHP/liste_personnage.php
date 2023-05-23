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

    try {

        $db = new PDO('mysql:host=localhost;dbname=gaulois', 'root', '');

        $results = $db->query(
            'SELECT nom_personnage, adresse_personnage, nom_lieu, nom_specialite, nom_bataille
            FROM personnage
            INNER JOIN specialite
                ON personnage.id_specialite = specialite.id_specialite
            INNER JOIN lieu
                ON personnage.id_lieu = lieu.id_lieu
            LEFT JOIN prendre_casque
                ON personnage.id_personnage = prendre_casque.id_personnage
            LEFT JOIN bataille
                ON  prendre_casque.id_bataille = bataille.id_bataille'
        );

        echo '<table>',
                '<thead>',
                    '<tr>',
                        '<th>Nom personnage</th>',
                        '<th>Specialite</th>',
                        '<th>Ville</th>',
                    '</tr>',
                '</thead>',
                '<tbody>';
        while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>',
                    '<td>'. $row['nom_personnage'].'</td>',
                    '<td>'. $row['nom_specialite'].'</td>',
                    '<td>'. $row['nom_lieu'].'</td>',
                 '</tr>';
        }
        
        echo '</tbody>',
            '</table>';

    } catch (Execption $e) {
        die('Erreur : '. $e->getMessage());
    }
    ?>
</body>
</html>