<?php


require('requetes.generiques.php');


$table='users';


/*
 ajoute un nouvel utilisateur dans la base de donn�es
 .
 */
function adduser(PDO $bdd, array $user)
{
    $query= 'INSERT INTO users(email, password, lastname, name, birthdate, phonenumber, adress, postalcode) VALUES (:email, :password, :lastname, :name, :birthdate, :phonenumber, :adress, :postalcode)';
    $donnees= $bdd->prepare($query);
    $donnees->bindParam(":email", $user['email']);
    $donnees->bindParam(":password", cryptpassword($user['password']));
    $donnees->bindParam(":lastname", $user['lastname']);
    $donnees->bindParam(":name", $user['name']);
    $donnees->bindParam(":birthdate", $user['birthdate']);
    $donnees->bindParam(":phonenumber", $user['phonenumber']);
    $donnees->bindParam(":adress", $user['adress']);
    $donnees->bindParam(":postalcode", $user['postalcode']); 
    return $donnees->execute();
}

/*
 * fonction pour v�rifi� si l'utilisateur existe dans la base de donn�es
 */
function login(PDO $bdd, array $user) 

{
    $query= 'SELECT password FROM users WHERE email= :email';
    $data = $bdd->prepare($query);
    $data -> bindParam (":email",$user['email'],PDO::PARAM_STR);
    $data->execute();
    $password=$data->fetchAll();
    if (password_verify($user['password'], $password[0][0])==true)
    {
        $query= 'SELECT id,nom,prenom,admin,gestionnaire FROM users WHERE email= :email';
        $data = $bdd->prepare($query);
        $data -> bindParam (":email",$user['email'],PDO::PARAM_STR);
        $data->execute();
        return $data->fetchAll();    
}
}



function chat(PDO $bdd, array $echange)
{
	$req= $bdd->prepare( 'INSERT INTO chat(pseudo, message, date_message) VALUES (:pseudo, :message, NOW())');
	$req->execute(array(
			"pseudo" =>$echange['pseudo'],
			"message" => $echange['message'],
			));
	//$bdd->exec('INSERT INTO chat (date-message) VALUES ( NOW() )');	
}
