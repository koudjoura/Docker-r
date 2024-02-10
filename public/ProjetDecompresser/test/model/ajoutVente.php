<?php
include("connexion.php");
include("function.php");

if (
    !empty($_POST["id_articles"])
    && !empty($_POST["id_clients"])
    && !empty($_POST["quantite"])
    && !empty($_POST["prix"])
){

    $article = getArticle($_POST["id_articles"]);

    if (!empty($article) && is_array($article)) {
        if ($_POST["quantite"] > $article["quantite"]) {
            $_SESSION["message"]['text'] = "La quantité à vendre n'est pas disponible";
            $_SESSION["message"]['type'] = 'danger';
        } else {
            $sql = "INSERT INTO ventes(id_articles, id_clients, quantite, prix)
                    VALUES (?, ?, ?, ?)";
            $req = $connexion->prepare($sql);
            $req->execute(array(
                $_POST['id_articles'],
                $_POST['id_clients'],
                $_POST['quantite'],
                $_POST['prix']
            ));

            if ($req->rowCount() != 0) {
                $sql = "UPDATE articles SET quantite = quantite - ? WHERE id = ?";
                $req = $connexion->prepare($sql);
                $req->execute(array(
                    $_POST["quantite"],
                    $_POST["id_articles"],
                ));

                if ($req->rowCount() != 0) {
                    $_SESSION['message']['text'] = 'Vente effectuée avec succès';
                    $_SESSION['message']['type'] = 'success';
                } else {
                    $_SESSION['message']['text'] = "Impossible de faire cette vente";
                    $_SESSION['message']['type'] = 'danger';
                }
            } else {
                $_SESSION['message']['text'] = "Une erreur s'est produite lors de la vente";
                $_SESSION['message']['type'] = 'danger';
            }
        }
    }
} else {
    $_SESSION['message']['text'] = "Impossible de faire cette vente";
    $_SESSION['message']['type'] = 'danger';
}

header('Location: ../views/vente.php');
