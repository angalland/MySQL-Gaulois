<!DOCTYPE html>
    <html lang="en">
        <head>

            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Bataille</title>

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
            // Connexion a la base de donne
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

            // Requete SQL et récupération php
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

            <!-- Lecture des données mise en forme de tableau -->
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
                            <td><?php echo $batailleLieuDate['nom_bataille'];?></td>
                            <td>
                                <?php
                                $date = $batailleLieuDate['date_bataille'];
                                $dt = DateTime::createFromFormat('Y-m-d', $date);
                                echo $dt->format('d/m/Y');
                                ?>
                            </td>
                            <td><?php echo $batailleLieuDate['nom_lieu'];?></td>
                        </tr>
                    <?php    
                    }
                    ?>
                </tbody>
            </table>
        </body>
    </html>