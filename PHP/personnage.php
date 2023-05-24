<!DOCTYPE html>
    <html lang="en">
        <head>

            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>personnage</title>

            <link rel="stylesheet" href="../CSS/style.css">

        </head>
        <body>
            <!-- Nav bar -->
            <nav>
                <ul>
                    <li><a href='personnage.php'>Personnage</a></li>
                    <li><a href='specialite.php'>Specialite</a></li>
                    <li><a href='bataille.php'>Bataille</a></li>
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


            $sqlQuery = // Ici on fait la requete SQL que l'on souhaite obtenir et on la stocke dans une variable
            'SELECT * 
            FROM personnage
            INNER JOIN specialite
                ON personnage.id_specialite = specialite.id_specialite
            INNER JOIN lieu
                ON personnage.id_lieu = lieu.id_lieu
            ORDER BY personnage.nom_personnage';
            $personnagesStatement = $db->prepare($sqlQuery); // On utilise PDO pour lire cette requete ici on assigne la requete a la variable nomStatement 
            $personnagesStatement->execute(); // PDO execute la variable
            $personnages = $personnagesStatement->fetchAll(); // PDO récupere les donnees sous forme de tableau

            // On affiche les données via un tableau html
            echo '<table>',
                    '<thead>',
                        '<tr>',
                            '<th>Nom personnage</th>',
                            '<th>Spécialité</th>',
                            '<th>Ville</th>',
                        '</tr>',
                    '</thead>',
                    '<tbody>';
                        foreach ($personnages as $personnage) { // On fait une boucle sur le tableau $personnages pour le lire
                            $id = $personnage['id_personnage']; // On récupère l'id_personnage qu'on met dans une variable
                            $url = 'personnage_gaulois.php?id='. $id; //On ajoute l'id_personnage a l'url de la page de destination qu'on stocke dans une variable
                            echo '<tr>',
                                    '<td><a href="'.$url.'">'.$personnage['nom_personnage'].'</a></td>', //On fait un lien vers la page avec pour href la variable url
                                    '<td>'.$personnage['nom_specialite'].'</td>',
                                    '<td>'.$personnage['nom_lieu'].'</td>',
                                '</tr>';
                        }
                echo '</tbody>',
                '</table>';
            ?>            
        </body>
    </html>





