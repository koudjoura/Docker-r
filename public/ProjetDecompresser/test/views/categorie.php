<?php
    include ("entete.php");
   
   
    if (!empty($_GET['id'])) {
        $categories = getCategorie($_GET['id']);
    }
    
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifCategorie.php" : "../model/ajoutCategorie.php" ?>" method="post">

                <label for="libelle_categorie">Libelle</label>
                <input value="<?= !empty($_GET['id']) ? $categories['libelle_categorie'] : "" ?>" type="text" name="libelle_categorie" id="libelle_categorie" placeholder="Veuillez saisir le nom">

                <input value="<?= !empty($_GET['id']) ? $categories['id'] : "" ?>" type="hidden" name="id" id="id">

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
                    <th>Libelle</th>
                    <th>Action</th>
                </tr>
                <?php
                     $categoriess = getCategorie();

                     if (!empty($categoriess) && is_array($categoriess)) {
                        foreach ($categoriess as $key => $value) {
                ?>
                <tr>
                    <td><?= $value['libelle_categorie'] ?></td>
                    <td><a href="?id=<?= $value['id']?>"><i class='bx bx-edit-alt'></i></a></td>
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
