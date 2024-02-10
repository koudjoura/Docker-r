<?php 
include("connexion.php");

if (
    !empty($_GET["idVente"]) &&
    !empty($_GET["idArticle"]) &&
    !empty($_GET["quantite"])
) {
    // Mettez à jour le nom de la table ici, de "vente" à "ventes"
    $sql = "UPDATE ventes SET etat=? WHERE id=?";
    $req = $connexion->prepare($sql);
    $req->execute(array(0, $_GET["idVente"]));

    if ($req->rowCount() != 0) {
        // Mettez à jour le nom de la table ici, de "article" à "articles"
        $sql = "UPDATE articles SET quantite=quantite+? WHERE id=?";
        $req = $connexion->prepare($sql);
        $req->execute(array($_GET["quantite"], $_GET["idArticle"]));
    }
}

header("Location: ../views/vente.php");
