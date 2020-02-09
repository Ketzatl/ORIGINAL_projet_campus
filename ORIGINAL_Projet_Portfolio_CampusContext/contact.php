<?php

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', 'root');

if(isset($_POST['forminscription']))
{
    $prenom =htmlspecialchars($_POST['prenom']);
    $nom =htmlspecialchars($_POST['nom']);
    $entreprise =htmlspecialchars($_POST['entreprise']);
    $poste =htmlspecialchars($_POST['poste']);
    $mail =htmlspecialchars($_POST['mail']);
    $mail2 =htmlspecialchars($_POST['mail2']);
    $telephone =htmlspecialchars($_POST['telephone']);
    $message =htmlspecialchars($_POST['message']);

    if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['entreprise']) AND !empty($_POST['poste']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['prenom']) AND !empty($_POST['telephone']) AND !empty($_POST['message']))
    {

        $prenomlength = strlen($prenom);
        if($prenomlength <= 44)
        {
            $nomlength =strlen($nom);
            if($nomlength <= 44)
            {
                $entrepriselength =strlen($entreprise);
                if($entrepriselength <= 44)
                {
                    $postelength =strlen($poste);
                    if($postelength <= 44)
                    {
                        if($mail == $mail2)
                        {
                            if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                            {
                                $insertmember = $bdd->prepare("INSERT INTO membres(prenom, nom, entreprise, poste, mail, telephone, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
                                $insertmember->execute(array($prenom, $nom, $entreprise, $poste, $mail, $telephone, $message));
                                $erreur = "Merci, Votre Compte a bien été créé !";
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
                        $erreur = "L'intitulé de votre Poste doit être inférieur à 44 caractères !";
                    }
                }
                else
                {
                    $erreur = 'Le Nom de votre Entreprise doit être inférieur à 44 caractères !';
                }
            }
            else
            {
                $erreur = 'Votre nom doit être inférieur à 44 caractères !';
            }
        }
        else
        {
            $erreur = 'Votre prénom doit être inférieur à 44 caractères !';
        }

    }
    else
    {
        $erreur = 'Tous les champs doivent être renseignés !';
    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

    <!-- Animation Background -->

    <script src="three.r95.min.js"></script>
    <script src="vanta.birds.min.js"></script>

    <!-- ----------------------->

    <link rel="stylesheet" href="contact.css">


    <title>Formulaire de Contact - Morgan NOTT</title>
</head>
<body>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#18A2B8" fill-opacity="1" d="M0,64L10.4,58.7C20.9,53,42,43,63,48C83.5,53,104,75,125,74.7C146.1,75,167,53,188,42.7C208.7,32,230,32,250,58.7C271.3,85,292,139,313,138.7C333.9,139,355,85,376,85.3C396.5,85,417,139,438,138.7C459.1,139,480,85,501,96C521.7,107,543,181,563,218.7C584.3,256,605,256,626,218.7C647,181,668,107,689,74.7C709.6,43,730,53,751,90.7C772.2,128,793,192,814,181.3C834.8,171,856,85,877,69.3C897.4,53,918,107,939,149.3C960,192,981,224,1002,218.7C1022.6,213,1043,171,1064,154.7C1085.2,139,1106,149,1127,133.3C1147.8,117,1169,75,1190,58.7C1210.4,43,1231,53,1252,58.7C1273,64,1294,64,1315,53.3C1335.7,43,1357,21,1377,42.7C1398.3,64,1419,128,1430,160L1440,192L1440,0L1429.6,0C1419.1,0,1398,0,1377,0C1356.5,0,1336,0,1315,0C1293.9,0,1273,0,1252,0C1231.3,0,1210,0,1190,0C1168.7,0,1148,0,1127,0C1106.1,0,1085,0,1064,0C1043.5,0,1023,0,1002,0C980.9,0,960,0,939,0C918.3,0,897,0,877,0C855.7,0,835,0,814,0C793,0,772,0,751,0C730.4,0,710,0,689,0C667.8,0,647,0,626,0C605.2,0,584,0,563,0C542.6,0,522,0,501,0C480,0,459,0,438,0C417.4,0,397,0,376,0C354.8,0,334,0,313,0C292.2,0,271,0,250,0C229.6,0,209,0,188,0C167,0,146,0,125,0C104.3,0,83,0,63,0C41.7,0,21,0,10,0L0,0Z"></path>
</svg>

    <header>
        <center>
            <a class="retAccueil" href="index.html" alt="lien vers page d'Accueil" style="font-weight: bold"><button type="button" class="btn btn-secondary">Retour à l'Accueil</button></a>
        </center>
        <br>
    </header>

    <div align="center">
        <!--
        <br>
        <img class="ml15" src="pictures/campuslogo.png" alt="logo Campus Academy Morgan NOTT" width="5%">
        -->
        <h1 class="ml15">Me Contacter ou laisser une recommandation : </h1>
        <br>

        <?php
        if(isset($erreur))
        {
            echo '<font color="red" size="4em" > '. $erreur . "</font>";
        }
        ?>
        <br><br>
        <form method="POST" action="
        ">
            <table >
                <tr>
                    <th align="right">
                        <label for="prenom" >Votre Prénom :</label>
                    </th>

                    <td align="right">
                        <input id="prenom" type="text" placeholder="Votre Prénom : " name="prenom" value="<?php if(isset($prenom)) { echo $prenom;} ?>" >
                    </td>
                </tr>

                <tr>
                    <th align="right">
                        <label for="nom" >Votre Nom :</label>
                    </th>

                    <td align="right">
                        <input id="nom" type="text" placeholder="Votre Nom : " name="nom" value="<?php if(isset($nom)) { echo $nom;} ?>" >
                    </td>
                </tr>

                <tr>
                    <th align="right">
                        <label for="entreprise" >Votre Entreprise :</label>
                    </th>

                    <td align="right">
                        <input id="entreprise" type="text" placeholder="Votre Entreprise : " name="entreprise" value="<?php if(isset($entreprise)) { echo $entreprise;} ?>" >
                    </td>
                </tr>

                <tr>
                    <th align="right">
                        <label for="poste" >Votre Poste :</label>
                    </th>

                    <td align="right">
                        <input id="poste" type="text" placeholder="Votre Poste : " name="poste" value="<?php if(isset($poste)) { echo $poste;} ?>" >
                    </td>
                </tr>

                <tr>
                    <th align="right">
                        <label for="mail" >Votre Adresse Mail :</label>
                    </th>

                    <td align="right">
                        <input id="mail" type="email" placeholder="Votre Mail : " name="mail" value="<?php if(isset($mail)) { echo $mail;} ?>" >
                    </td>
                </tr>
                <tr>
                    <th align="right">
                        <label for="mail2" >Confirmez votre Mail :</label>
                    </th>

                    <td align="right">
                        <input id="mail2" type="email" placeholder="Confirmez votre Mail : " name="mail2">
                    </td>
                </tr>

                <tr>
                    <th align="right">
                        <label for="telephone" >Votre Téléphone :</label>
                    </th>

                    <td align="right">
                        <input id="telephone" type="tel" placeholder="Votre Télephone : " name="telephone" value="<?php if(isset($telephone)) { echo $telephone;} ?>" >
                    </td>
                </tr>

                <tr>
                    <th align="right">
                        <label for="message" >Votre Message ou Recommandation :</label>
                    </th>

                    <td align="right">
                        <input id="message" type="textarea" placeholder="Ecrivez ici : " name="message" value="<?php if(isset($message)) { echo $message;} ?>" >
                    </td>
                </tr>



            </table>
            <br>

            <!--
            <button type="button" name="forminscription" class="btn btn-info" value="Envoyer !">Envoyer !</button>
            -->

            <input type="submit" name="forminscription" value="Envoyer !">

        </form>

    </div>


    <footer style="background: #18A2B8" >
        <p class="copyright" align="center">Morgan NOTT©</p>
    </footer>
</body>
</html>

<!-- -------------------------- Javascript ------------------------------------- -->

<script>
    anime.timeline({loop: true})
        .add({
            targets: '.ml15 .word',
            scale: [14,1],
            opacity: [0,1],
            easing: "easeOutCirc",
            duration: 800,
            delay: (el, i) => 800 * i
        }).add({
        targets: '.ml15',
        opacity: 0,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1000
    });
</script>

