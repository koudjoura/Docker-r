
<?php
include("connexion.php");
include("function.php");

if (
    !empty($_POST["id_articles"])
    && !empty($_POST["id_fournisseurs"])
    && !empty($_POST["quantite"])
    && !empty($_POST["prix"])
){
            $sql = "INSERT INTO commandes(id_articles, id_fournisseurs, quantite, prix)
                    VALUES (?, ?, ?, ?)";
            $req = $connexion->prepare($sql);
            $req->execute(array(
                $_POST['id_articles'],
                $_POST['id_fournisseurs'],
                $_POST['quantite'],
                $_POST['prix']
            ));

            if ($req->rowCount() != 0) {
                $sql = "UPDATE articles SET quantite = quantite+? WHERE id = ?";
                $req = $connexion->prepare($sql);
                $req->execute(array(
                    $_POST["quantite"],
                    $_POST["id_articles"],
                ));

                if ($req->rowCount() != 0) {
                    $_SESSION['message']['text'] = 'commande effectuée avec succès';
                    $_SESSION['message']['type'] = 'success';
                } else {
                    $_SESSION['message']['text'] = "Impossible de faire cette commande";
                    $_SESSION['message']['type'] = 'danger';
                }
            } else {
                $_SESSION['message']['text'] = "Une erreur s'est produite lors de la commande";
                $_SESSION['message']['type'] = 'danger';
            }
    

} else {
    $_SESSION['message']['text'] = "Impossible de faire cette vente";
    $_SESSION['message']['type'] = 'danger';
}

header('Location: ../views/commande.php');
