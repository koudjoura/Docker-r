<?php
include ("entete.php");

if (!empty($_GET['id'])) {
    $ventes = getVente($_GET['id']);
}
?>

<div class="home-content">
    <button class="hidden-print" id="btnPrint" style="position: relative; left: 70%;"><i class='bx bxs-printer'></i>Imprimer</button>
    <div class="page">
        <div class="cote-a-cote">
            <h2> D-CLIC STOCK</h2>
            <div>
                <p>Reçu N° #:<?= $ventes['id']?></p>
                <p>Date:<?= date('d/m/Y H:i:s', strtotime($ventes['date_vente'])) ?></p>
            </div>
        </div>
        <div class="cote-a-cote" style="width: 30%;">
            <p>Nom:</p>
            <p><?= $ventes['nom'] . "" . $ventes['prenom'] ?></p>
        </div>
        <div class="cote-a-cote" style="width: 33%;">
            <p>Phone:</p>
            <p><?= $ventes['telephone']?></p>
        </div>
        <div class="cote-a-cote" style="width: 20%;">
            <p>Adresse:</p>
            <p><?= $ventes['adresse']?></p>
        </div>
        <br><br>
        <table class="mtable">
                <tr>
                    <th>Designation</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Prix Total</th>
                </tr>
                <tr>
                    <td><?= $ventes['nom_article'] ?></td>
                    <td><?= $ventes['quantite'] ?></td>
                    <td><?= $ventes['prix_unitaire'] ?></td>
                    <td><?= $ventes['prix'] ?></td>
                </tr>
        </table>
    </div>
</div>

<?php
include ("pied.php");
?>

<script>
    //cette variable permet d'imprimer le reçu en appelant Window.print du windows
    var btnPrint = document.querySelector("#btnPrint");
    btnPrint.addEventListener("click", () => {
        window.print();
    });

    //cette function permet de calculer le prix :  une fois fois entre la quatite et le prix unitaire
    function setPrix() {
        var article = document.querySelector('#id_articles');
        var quantite = document.querySelector('#quantite');
        var prix = document.querySelector('#prix');

        var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');
        prix.value = Number(quantite.value) * Number(prixUnitaire);
    }
</script>
