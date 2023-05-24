<!DOCTYPE html>
    <html lang="en">
        <head>

            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Specialite</title>

            <link rel="stylesheet" href="css/style.css">

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
                    foreach ($nbpersonnagesSpecialites as $nbpersonnagesSpecialite) { ?> 
                        <tr>
                            <td><?php echo $nbpersonnagesSpecialite['nom_specialite']; ?></td>
                            <td><?php echo $nbpersonnagesSpecialite['nbPersonnages']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </body>
    </html>