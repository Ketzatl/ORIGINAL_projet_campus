<?php

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', 'root');

if(isset($_POST['forminscription']))
{

    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $entreprise = htmlspecialchars($_POST['entreprise']);
    $poste = htmlspecialchars($_POST['poste']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $tel = htmlspecialchars($_POST['tel']);
    //$mdp = sha1($_POST['mdp']);
    //$mdp2 = sha1($_POST['mdp2']);
    $message = htmlspecialchars($_POST['message']);

    if(!empty($_POST['prenom']) AND !empty($_POST['nom']))
    {
        $prenomlength = strlen($prenom);
        $nomlength = strlen($nom);
        if($prenomlength <= 44 OR $nomlength <= 44)
        {
           if($mail == $mail2)
           {
               if(filter_var($mail, FILTER_VALIDATE_EMAIL))
               {


                   $insertmbr = $bdd->prepare('INSERT INTO membres(prenom, nom, entreprise, poste, mail, telephone, mot_de_passe, message) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
                   $insertmbr->execute(array($prenom, $nom, $entreprise, $poste, $mail, $tel, $message));
                   $erreur = 'Inscription Validée !';
                   header('Location: index.html');


               }
               else
               {
                   $erreur = "Votre Adresse Mail n'est pas valide !";
               }
           }
           else
           {
               $erreur = 'Vos Adresses Mail ne correspondent pas !';
           }
        }
        else
            {
           $erreur = 'Votre prénom ne doit pas dépasser 44 caractères ! ';
        }

    }
    else
    {
        $erreur = "Tous les champs doivent être complétés !";
    }
}

?>





<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Me contacter</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="contact.css">
</head>

<body>

<header>

    <p><a id="retInd" href="index.html">- Retour vers l'Accueil -</a> </p>



</header>



<form method="POST" >
    <div class="contact-form" style="background: lightgrey">
        <h1>Me Contacter</h1>

        <?php
        if(isset($erreur))
        {
            echo '<font color="red">'.$erreur.'</font>';
        }
        ?>

        <br/>



        <div class="txtb" style="background: white">
            <label for="prenom" >Prénom :</label>
            <input type="text" name="prenom" id="prenom" value="<?php if(isset($prenom)) { echo $prenom;} ?>" >

            <label for="nom" >Nom :</label>
            <input type="text" name="nom" id="nom" placeholder="" value="<?php if(isset($nom)) { echo $nom;} ?>">
        </div>

        <div class="txtb">
            <label>Entreprise :</label>
            <input type="text" name="entreprise" id="entreprise" placeholder="" value="<?php if(isset($entreprise)) { echo $entreprise;} ?>">

            <label>Poste :</label>
            <input type="text" name="poste" id="poste" placeholder="" value="<?php if(isset($poste)) { echo $poste;} ?>">
        </div>

        <div class="txtb" style="background: white">
            <label>Votre Email :</label>
            <input type="email" name="email" id="email" placeholder="" value="<?php if(isset($mail)) { echo $mail;} ?>">

            <label>Confirmez votre Email :</label>
            <input type="email" name="email2" id="email2" placeholder="" value="<?php if(isset($mail2)) { echo $mail2;} ?>">
        </div>

        <div class="txtb">
            <label>Télephone :</label>
            <input type="text" name="tel" id="tel" placeholder="" value="<?php if(isset($tel)) { echo $tel;} ?>">
        </div>
            <!--
            <div class="txtb" style="background: white">
                <label>Votre Mot de Passe :</label>
                <input type="password" name="mdp" id="mdp" placeholder="">
            </div>
            -->
            <div class="txtb">
                <label>Entrez votre Message :</label>
                <textarea id="message" name="message" value="<?php if(isset($message)) { echo $message;} ?>"></textarea>
            </div>

            <input type="submit" name="forminscription" value="Envoyer !">

    </div>
</form>


    <br>

</body>
</html>
