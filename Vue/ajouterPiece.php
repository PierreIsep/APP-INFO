<!DOCTYPE html>
<html>
    <head>
        <title>Page Pièces</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/ajouterPiece.css">
    </head>
    
    <body>
        <h1 class="text-logo"><span class=""></span> Gestion des pièces <span class=""></span></h1>
        <div class="container admin">
            <div class="row">
                <h1><strong>Liste des pièces   </strong><a href="index.php?cible=building&fonction=ajout" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
                <table class="table table-dark">
                  <thead>
                    <tr>
                      <th>Pièces</th>
                      
                      <th>Superficie(en m²)</th>
                      
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        
                        
                        $statement = $bdd->query('SELECT id, name, superficie FROM piece WHERE users_id= \'' . $_SESSION['id'] .'\'');
                        while($item = $statement->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $item['name'] . '</td>';
                            
                           
                            echo '<td>'. $item['superficie'] . '</td>';
                            echo '<td width=300>';
                            //echo '<a class="btn btn-default" href="view.php?id='.$item['id'].'"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                            echo ' ';
                            //echo '<a class="btn btn-primary" href="update.php?id='.$item['id'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                            echo ' ';
                            echo '<form method="POST" id="suprimmer" action="index.php?cible=building&fonction=supprimer"><button value="'.$item['id'].'" class="btn btn-danger" name="supr" id="supr"><span class="glyphicon glyphicon-remove"></span> Supprimer /></form>';
                            echo '</td>';

                            echo '</tr>';
                        }
                        
                      ?>
                  </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
