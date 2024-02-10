<?php
    include ("entete.php");
   
   
    if (!empty($_GET['id'])) {
        $fournisseurs = getFournisseur($_GET['id']);
    }
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifFournisseur.php" : "../model/ajoutFournisseur.php" ?>" method="post">

                <label for="nom">Nom </label>
                <input value="<?= !empty($_GET['id']) ? $fournisseurs['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder="Veuillez saisir le nom">
                <input value="<?= !empty($_GET['id']) ? $fournisseurs['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="nom">Prénom </label>
                <input value="<?= !empty($_GET['id']) ? $fournisseurs['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder="Veuillez saisir le prenom">


                <label for="telephone">N° de telephone</label>
                <input value="<?= !empty($_GET['id']) ? $fournisseurs['telephone'] : "" ?>" type="text" name="telephone" id="telephone" placeholder="Veuillez entrer le N° de telephone">

                <label for="adresse">Adresse</label>
                <input value="<?= !empty($_GET['id']) ? $fournisseurs['adresse'] : "" ?>" type="adresse" name="adresse" id="adresse" placeholder="Veuillez entrer l'adresse">


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
                    <th>Nom </th>
                    <th>Prénom</th>
                    <th>Telephone</th>
                    <th>Adresse</th>
                    <th>Action</th>
                </tr>
                <?php
                     $fournisseurs = getFournisseur();

                     if (!empty($fournisseurs) && is_array($fournisseurs)) {
                        foreach ($fournisseurs as $key => $value) {
                ?>
                <tr>
                    <td><?= $value['nom'] ?></td>
                    <td><?= $value['prenom'] ?></td>
                    <td><?= $value['telephone'] ?></td>
                    <td><?= $value['adresse'] ?></td>
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
