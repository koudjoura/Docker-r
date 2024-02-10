<?php
    include ("entete.php");
   
   
    if (!empty($_GET['id'])) {
        $article = getArticle($_GET['id']);
    }
    
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifArticle.php" : "../model/ajoutArticle.php" ?>" method="post" enctype="multipart/form-data">

                <label for="nom_article">Nom de l'article</label>
                <input value="<?= !empty($_GET['id']) ? $article['nom_article'] : "" ?>" type="text" name="nom_article" id="nom_article" placeholder="Veuillez saisir le nom">

                <input value="<?= !empty($_GET['id']) ? $article['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="id_categorie">Catégorie</label>
                <select name="id_categorie" id="id_categorie">
                    <?php 
                        $categories=getCategorie();
                        if (!empty($categories) && is_array($categories)) {
                            foreach ($categories as $key=>$value) {
                         
                    ?>
                    <option <?= !empty($_GET['id']) && $article['id_categorie'] == $value['id'] ? "selected" : "" ?> value="<?=$value['id']?>"><?=$value['libelle_categorie']?></option>
                    <?php 
                            }
                        }
                    ?>
                </select>

                <label for="quantite">Quantité</label>
                <input value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="Veuillez entrer la quantité">

                <label for="prix_unitaire">Prix Unitaire</label>
                <input value="<?= !empty($_GET['id']) ? $article['prix_unitaire'] : "" ?>" type="number" name="prix_unitaire" id="prix_unitaire" placeholder="Veuillez entrer le prix">

                <label for="date_fabrication">Date de fabrication</label>
                <input value="<?= !empty($_GET['id']) ? $article['date_fabrication'] : "" ?>" type="date" name="date_fabrication" id="date_fabrication">

                <label for="date_expiration">Date d'expiration</label>
                <input value="<?= !empty($_GET['id']) ? $article['date_expiration'] : "" ?>" type="date" name="date_expiration" id="date_expiration">

                <label for="images">Image</label>
                <input value="<?= !empty($_GET['id']) ? $article['images'] : "" ?>" type="file" name="images" id="images">

                <button type="submit">Enregistrer</button>

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
                    <th>Nom article</th>
                    <th>Catégorie</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Date Fabrication</th>
                    <th>Date Expiration</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                <?php
                     $article = getArticle();
                     if (!empty($article) && is_array($article)) {
                        foreach ($article as $key => $value) {
                ?>
                <tr>
                    <td><?= $value['nom_article'] ?></td>
                    <td><?= $value['libelle_categorie'] ?></td>
                    <td><?= $value['quantite'] ?></td>
                    <td><?= $value['prix_unitaire'] ?></td>
                    <td><?= $value['date_fabrication'] ?></td>
                    <td><?= $value['date_expiration'] ?></td>
                    <td><img width="50" height="50" src="<?= isset($value['images']) ? $value['images'] : '' ?>" alt="<?= $value['nom_article']?>"></td>
                    <td><a href="?id=<?= isset($value['id']) ? $value['id'] : '' ?>"><i class='bx bx-edit-alt'></i></a></td>

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
