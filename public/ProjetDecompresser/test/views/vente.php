<?php
include ("entete.php");

if (!empty($_GET['id'])) {
    $ventes = getVente($_GET['id']);
}
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifVente.php" : "../model/ajoutVente.php" ?>" method="post">

            <input value="<?= !empty($_GET['id']) ? $clients['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="id_articles">Article</label>
                <select  onchange="setPrix()" name="id_articles" id="id_articles">
                    <?php
                    $articles = getArticle();
                    if (!empty($articles) && is_array($articles)) {
                        foreach ($articles as $key => $value) {
                            ?>
                            <option data-prix="<?= $value['prix_unitaire'] ?>" value="<?= $value['id'] ?>"><?= $value['nom_article'] . " - " . $value['quantite'] . " disponibles" ?></option>
                            <?php
                        }
                    } 
                    ?>
                </select>

                <label for="id_clients">Client</label>
                <select name="id_clients" id="id_clients">
                    <?php
                    $clients = getClient();
                    if (!empty($clients) && is_array($clients)) {
                        foreach ($clients as $key => $value) {
                            ?>
                            <option value="<?= $value['id'] ?>"><?= $value['nom'] . " " . $value['prenom'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
 
                <label for="quantite">Quantité</label>
                <input onkeyup="setPrix()" value="<?= !empty($_GET['id']) ? $ventes['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="Veuillez entrer la quantité">

                <label for="prix">Prix</label>
                <input value="<?= !empty($_GET['id']) ? $ventes['prix'] : "" ?>" type="number" name="prix" id="prix" placeholder="Veuillez entrer le prix">

                <button type="submit">Valider</button>

                <?php
                if (!empty($_SESSION["message"]["text"])) {
                    ?>
                    <div class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                    </div>
                    <?php
                }
                ?>
            </form>
        </div>
        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Article</th>
                    <th>Client</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php
                $ventes = getVente();

                if (!empty($ventes) && is_array($ventes)) {
                    foreach ($ventes as $key => $value) {
                ?>
                        <tr>
                            <td><?= $value['nom_article'] ?></td>
                            <td><?= $value['nom'] . " " . $value['prenom'] ?></td>
                            <td><?= $value['quantite'] ?></td>
                            <td><?= $value['prix'] ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($value['date_vente'])) ?></td>
                            <td>
                                <a href="recuVente.php?id=<?= $value['id']?>" ><i class='bx bx-receipt'></i> </a>
                                <a onclick="annuleVente(<?= $value['id']?>,<?= $value['idArticle']?>, <?= $value['quantite']?>)" style="color: red;"><i class='bx bx-comment-x'></i></a>
                            </td>
                          </tr>
                        <?php
                    }
                }
                
                ?>
            </table>
        </div>
    </div>
</div>

<?php
include ("pied.php");
?>

<script>

    function annuleVente(idVente, idArticle, quantite) {
        if (confirm("Voulez-vous vraiment annuler la vente ?")) {
            window.location.href = "../model/annuleVente.php?idVente=" + idVente + "&idArticle=" + idArticle + "&quantite=" + quantite;
        }
    }

    function setPrix(){
        var article = document.querySelector('#id_articles');
        var quantite = document.querySelector('#quantite');
        var prix = document.querySelector('#prix');

        var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');
        prix.value = Number(quantite.value) * Number(prixUnitaire);

    }
</script>
