<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charser=utf8;','root','');
if(isset($_POST['envoi'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
        $pseudo=htmlspecialchars($_POST['pseudo']);
        $mdp = sha1($_POST['mdp']);
        $insertUser = $bdd->prepare('insert into users(pseudo,mdp) values (?, ?)');
        $insertUser->execute($arrayName = array($pseudo,$mdp));

        $recupUser = $bdd->prepare('select * from users where pseudo = ? and mdp = ?');
        $recupUser->execute(array($pseudo,$mdp));
        if ($recupUser->rowCount() > 0) {
            $_SESSION['pseudo']=$pseudo;
            $_SESSION['mdp']=$mdp;
            $_SESSION['id']=$recupUser->fetch()['id'];
        }
            echo  $_SESSION['id'];
       
    }else {
        echo" Veuillez completer tous les champs !";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color : #031430;">
    <div id="form">
    <h2 style="color: white; margin-top: 10px;"  align="center">Login</h2>
    <form action="" method="post" align="center">
        <input type="text" name="pseudo" autocomplete="off" style="margin-botom : 20px" placeholder="Nom de l'utilisateur"><br>
        <input type="password" name="mdp" autocomplete="off" style="margin-top : 20px" placeholder="Mot de passe">
        <br><br>
        <input type="submit" name="envoi" value="Envoi">
    </form>
    </div>
</body>
</html>