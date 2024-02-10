<?php
    include ("entete.php");
   
   
    if (!empty($_GET['id'])) {
        $clients = getClient($_GET['id']);
    }
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifClient.php" : "../model/ajoutClient.php" ?>" method="post">

                <label for="nom">Nom </label>
                <input value="<?= !empty($_GET['id']) ? $clients['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder="Veuillez saisir le nom">
                <input value="<?= !empty($_GET['id']) ? $clients['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="nom">Prénom </label>
                <input value="<?= !empty($_GET['id']) ? $clients['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder="Veuillez saisir le prenom">


                <label for="telephone">N° de telephone</label>
                <input value="<?= !empty($_GET['id']) ? $clients['telephone'] : "" ?>" type="text" name="telephone" id="telephone" placeholder="Veuillez entrer le N° de telephone">

                <label for="adresse">Adresse</label>
                <input value="<?= !empty($_GET['id']) ? $clients['adresse'] : "" ?>" type="adresse" name="adresse" id="adresse" placeholder="Veuillez entrer l'adresse">


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
                     $clients = getClient();

                     if (!empty($clients) && is_array($clients)) {
                        foreach ($clients as $key => $value) {
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
