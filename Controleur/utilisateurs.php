<?php

include ('Modele/requetes.utilisateurs.php');


if (!isset($_GET ['fonction']) || empty($_GET['fonction']))
    {
        $function ="acceuil";
    }
else 
    {
        $function=$_GET['function'];
    }
    
switch ($function)
    {
        case "acceuil":
            /*
             affichage de la vue de l'acceuil
             */
            $vue="acceuil";
            $title="Accueil";
            break;
            
        case "connexion":
            /*
             affichage de la vue de connexion
             */
            $vue="connexion";
            $alerte=false;
            $title="Connexion";
            /*
             * ce code est appel� sie le formulaire � �t� post�
             */
            if (isset($_POST['email']) and isset($_POST['password']))
            {
                $values=[
                        'email'=> $_POST['email'],
                        'password' => cryptpassword($_POST['password'])
                        ];
                $user=login($bdd, $values);
                /*
                 * ce test verifie que les identifiant de l'utilisateur sont correcte
                 */
                if (!empty($user))
                {
                    
                    $vue="profil";
                    /*
                     * fonction qui r�cup�re la table de l'utilisateur dans la base de donn�e
                     */
                    searchuser($bdd, $values);
                    /*
                     * fontion searchuser � r�aliser
                     */
                }
                else
                {
                    $alerte="l'identifiant ou le mot des passe sont �ronn�s";
                }
            }
            break;
            
        case "inscription":
            /*
             affichage de la vue inscription
             */
            $vue="inscription";
            $alerte=false;
            $title="Inscription";
            break;
    }
 
include ('Vue/header.php');
include ('Vue/' . $vue . '.php');
include ('Vue/footer.php');