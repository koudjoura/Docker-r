<?php
include("connexion.php");

function getArticle($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT nom_article, libelle_categorie, quantite, prix_unitaire, date_fabrication, date_expiration,images, id_categorie,a.id 
                FROM articles AS a, categorie_article AS c
                WHERE a.id_categorie = c.id AND a.id=?";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT nom_article, libelle_categorie, quantite, prix_unitaire, date_fabrication, date_expiration,images, id_categorie, a.id
                FROM articles AS a, categorie_article AS c
                WHERE a.id_categorie = c.id ";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute();

        return $req->fetchAll();
    }
}


function getClient($id=null){
    if(!empty($id)){
        $sql="SELECT * FROM clients where id=?";
        $req=$GLOBALS["connexion"]->prepare($sql);
        $req->execute(array($id));

        return $req->fetch();
    }else{
        $sql="SELECT * FROM clients";
        $req=$GLOBALS["connexion"]->prepare($sql);
        $req->execute();

        return $req->fetchAll();
    }
}
function getVente($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT a.nom_article, c.nom, c.prenom, v.quantite, v.prix, v.date_vente, v.id, a.prix_unitaire, c.adresse, c.telephone
                FROM clients AS c
                JOIN ventes AS v ON v.id_clients = c.id
                JOIN articles AS a ON v.id_articles = a.id
                WHERE v.id=?";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
        $sql = "SELECT a.nom_article, c.nom, c.prenom, v.quantite, v.prix, v.date_vente, v.id, a.id AS idArticle
                FROM clients AS c
                JOIN ventes AS v ON v.id_clients = c.id
                JOIN articles AS a ON v.id_articles = a.id
                WHERE v.etat=?";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute(array(1));
        return $req->fetchAll();
    }
}

function getFournisseur($id=null){
    if(!empty($id)){
        $sql="SELECT * FROM fournisseurs where id=?";
        $req=$GLOBALS["connexion"]->prepare($sql);
        $req->execute(array($id));

        return $req->fetch();
    }else{
        $sql="SELECT * FROM fournisseurs";
        $req=$GLOBALS["connexion"]->prepare($sql);
        $req->execute();

        return $req->fetchAll();
    }
}

function getCommande($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT a.nom_article, c.nom, c.prenom, co.quantite, co.prix, co.date_commande, co.id, a.prix_unitaire, c.adresse, c.telephone
                FROM fournisseurs AS c, commandes AS co, articles AS a 
                WHERE co.id_articles = a.id AND co.id_fournisseurs = c.id AND co.id = ?";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
        $sql = "SELECT a.nom_article, c.nom, c.prenom, co.quantite, co.prix, co.date_commande, co.id, a.id AS idArticle
                FROM fournisseurs AS c, commandes AS co, articles AS a 
                WHERE co.id_articles = a.id AND co.id_fournisseurs = c.id";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

//la function pour dynamiser les commandes , vente, Article et CHIFFRE d'affaire CA sur dasboard
function getAllCommande()
{
    $sql = "SELECT COUNT(*) AS nbre FROM commandes";
    $req = $GLOBALS["connexion"]->prepare($sql);
    $req->execute();
    return $req->fetch();
}
function getAllVente()
{
    $sql = "SELECT COUNT(*) AS nbre FROM ventes WHERE etat=?";
    $req = $GLOBALS["connexion"]->prepare($sql);
    $req->execute(array(1));
    return $req->fetch();
}
function getAllArticle()
{
    $sql = "SELECT COUNT(*) AS nbre FROM articles";
    $req = $GLOBALS["connexion"]->prepare($sql);
    $req->execute();
    return $req->fetch();
}
  
function getAllCA()
{
    $sql = "SELECT SUM(prix) AS prix FROM ventes  WHERE etat=?";
    $req = $GLOBALS["connexion"]->prepare($sql);
    $req->execute(array(1));
    return $req->fetch();
}

//afficher les ventes recentes par ordre decroissant
function getLastVente()
{
    
        $sql = "SELECT a.nom_article, c.nom, c.prenom, v.quantite, v.prix, v.date_vente, v.id, a.id AS idArticle
                FROM clients AS c
                JOIN ventes AS v ON v.id_clients = c.id
                JOIN articles AS a ON v.id_articles = a.id
                WHERE v.etat=? ORDER BY date_vente DESC LIMIT 10";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute(array(1));
        return $req->fetchAll();
}
function getMesVentes()
{
    
        $sql = "SELECT nom_article, prix
                FROM clients AS c, ventes AS v, articles AS a
                WHERE v.id_articles=a.id AND v.id_clients=c.id AND v.etat=?
                GROUP BY a.id
                ORDER BY SUM(prix) DESC LIMIT 10";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute(array(1));
        return $req->fetchAll();
}

function getCategorie($id=null){
    if(!empty($id)){
        $sql="SELECT * FROM categorie_article where id=?";
        $req=$GLOBALS["connexion"]->prepare($sql);
        $req->execute(array($id));

        return $req->fetch();
    }else{
        $sql="SELECT * FROM categorie_article";
        $req=$GLOBALS["connexion"]->prepare($sql);
        $req->execute();

        return $req->fetchAll();
    }
}
?>





