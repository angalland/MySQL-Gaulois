<!DOCTYPE html>
    <html lang="en">
        <head>

            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Specialite</title>

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
            // Connexion a la base de donné 
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
            // Requete SQL et récupération par php
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
            <!-- Lecture des données mise en forme tableau html -->
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