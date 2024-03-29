<?php
include("connexion.php");

if (
    !empty($_POST["nom"])
    && !empty($_POST["prenom"])
    && !empty($_POST["telephone"])
    && !empty($_POST["adresse"])
){
    $sql = "INSERT INTO clients(nom, prenom, telephone, adresse) 
            VALUES (?, ?, ?, ?)";
    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['adresse']
    ));

    if ($req->rowCount() != 0) {
       $_SESSION['message']['text']='Client ajouté avec succès';
       $_SESSION['message']['type']='success';
    } else {
        $_SESSION['message']['text']="Une erreur s'est produite lors de l'ajout du clien";
        $_SESSION['message']['type']='danger';
    }

} else {
    $_SESSION['message']['text']="Une information obligatoire n'a pas été renseignée";
    $_SESSION['message']['type'] = 'danger';
}


header('Location: ../views/client.php');
