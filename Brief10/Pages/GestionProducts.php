<?php
session_start();

function checkIfExists($select, $from, $value)
{
    global $db;
    $statement = $db->prepare(("SELECT $select FROM $from WHERE $select = ?"));
    $statement->execute(array($value));

    $check = $statement->rowCount();
    // echo $check;
    return $check;
}

function redirect($errorMsg, $second = 3, $page = "GestionProducts")
{
    echo '<div class="alert alert-danger text-center" role="alert">' . $errorMsg . '</div>';
    echo '<div class="alert alert-primary text-center" role="alert">Redirect à la page ' . $page . ' dans ' . $second . ' seconds</div>';

    header("refresh:$second; url=$page.php");
    exit();
}


if (isset($_SESSION['admin'])) {

    include "DataBase.php"; 

    $do = isset($_GET['do']) ? $_GET['do'] : 'manage';

    if ($do == 'manage') {

        $stmt = $db->prepare("SELECT * FROM produit");
        $stmt->execute(array());

        $rows = $stmt->fetchAll();
?>
        <?php include 'Header2.php' ?> <br> <br>
        <div class="container">
            <h1 class="text-center">Gestion des produits</h1>
            <br> <br>
            <div class="table-responsive table-center text-center">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Image de produit</th>
                            <th scope="col">Nom de produit</th>
                            <th scope="col">Catégorie </th>
                            <th scope="col">Prix</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Opérations</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($rows as $row) {
                    ?>
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo $row->Id_Prod ?></th>
                                <td ><img height="100px" width="150px" id="img_product" src="../Images/Products/<?php echo $row->Nom_Prod ?>.png" alt=""></td>
                                <td><?php echo $row->Nom_Prod ?></td>
                                <td><?php echo $row->Categorie ?></td>
                                <td><?php echo $row->Prix_Prod ?> DH</td>
                                <td><?php echo $row->Quantite_Prod ?></td>
                                <td>
                                    <a href="?do=edit&Id_Prod=<?php echo $row->Id_Prod ?>" class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a href="?do=delete&Id_Prod=<?php echo $row->Id_Prod ?>" class="btn btn-danger confirm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                  
                                </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                </table>
            </div><br> <br>
            <a href="?do=add" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Ajouter un produit</a><br> <br>
        </div>

    <?php

    } elseif ($do == 'add') {
    ?>
        <?php include 'Header2.php' ?> <br> <br>
        <h1 class="text-center">Ajouter un produit</h1>
        <br>
        <div class="container">
            <form action="?do=insert" method="POST">
                <input type="hidden" name="Id_Ad" >
                <div class="form-group">
                    <label for="formGroupExampleInput">Nom du produit</label>
                    <input name="Nom_Prod" type="text" class="form-control" id="Nom_Prod" placeholder="Nom du produit" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Catégorie du produit</label>
                    <input name="Categorie" type="text" class="form-control" id="Categorie" placeholder="Catégorie du produit" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Prix du produit</label>
                    <input name="Prix_Prod" type="number" class="form-control" id="Prix_Prod" placeholder="Prix du produit" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Quantité du produit</label>
                    <input name="Quantite_Prod" type="number" class="form-control" id="Quantite_Prod" placeholder="Quantité du produit" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Ajouter le produit" class="btn btn-primary">
                </div>
            </form>
        </div>

        <?php

    } elseif ($do == 'insert') {
        include 'Header2.php';
        echo ' <br> <br> <h1 class="text-center">Ajouter un produit</h1>';
        $Nom_Prod           = $_POST['Nom_Prod'];
        $Categorie          = $_POST['Categorie'];
        $Prix_Prod          = $_POST['Prix_Prod'];
        $Quantite_Prod      = $_POST['Quantite_Prod'];

        if ((checkIfExists("Nom_Prod", "produit", $Nom_Prod)) === 0) {
            $stmt = $db->prepare("INSERT INTO produit ( Nom_Prod, Categorie, Prix_Prod, Quantite_Prod) VALUES (?, ?, ?, ?)");
            $stmt->execute(array($Nom_Prod, $Categorie, $Prix_Prod,$Quantite_Prod ));
            $nombreModif = $stmt->rowCount();

            echo '<br> <br> <div class="alert alert-success" role="alert">' .  $nombreModif . " produit ajouté" . '</div>';
            echo '<div class="container text-center">';
            echo '<a class="btn btn-primary text-center" href="GestionProducts.php">RETOUR</a>';
            echo '</div> <br> <br>';
        } else {
            echo '<br> <br> <div class="alert alert-danger" role="alert">Le nom de ce produit existe déjà </div>';
            echo '<div class="container text-center">';
            echo '<a class="btn btn-primary text-center" href="GestionProducts.php">RETOUR</a>';
            echo '</div> <br> <br>';
        }
    } elseif ($do == 'edit') { // edit page 
        $Id_Prod = isset($_GET['Id_Prod']) && is_numeric($_GET['Id_Prod']) ? intval($_GET['Id_Prod']) : 0;

        $stmt = $db->prepare("SELECT * FROM produit WHERE Id_Prod = ? LIMIT 1");
        $stmt->execute(array($Id_Prod));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();

        if ($count > 0) {

        ?>
            <?php include 'Header2.php'; ?>
            <br> <br>
            <h1 class="text-center">Modifier le produit</h1>
            <div class="blank"></div>
            <div class="container">
                <form action="?do=update" method="POST">
                    <input type="hidden" name="Id_Prod" value="<?php echo $Id_Prod; ?>">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Le nom du produit</label>
                        <input name="Nom_Prod" type="text" class="form-control" id="Nom_Prod" value="<?php echo $row->Nom_Prod ?>" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">La catégorie du produit</label>
                        <input name="Categorie" type="text" class="form-control" id="Categorie" value="<?php echo $row->Categorie ?>" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Le prix du produit</label>
                        <input name="Prix_Prod" type="number" class="form-control" id="Prix_Prod" value="<?php echo $row->Prix_Prod ?>" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">La quantité du produit</label>
                        <input name="Quantite_Prod" type="number" class="form-control" id="Quantite_Prod" value="<?php echo $row->Quantite_Prod ?>" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Save" class="btn btn-primary">
                    </div>
                </form>
            </div>
<?php
        } else {
            $errorMsg = 'Tu ne peux pas entrer directement à cette page';
            redirect($errorMsg, 5);
        }
    } elseif ($do == 'update') {


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            echo ' <br> <br> <h1 class="text-center">Modifier le produit</h1>';
            echo '<br> <br>';

            $Id_Prod             = $_POST['Id_Prod'];
            $Nom_Prod           = $_POST['Nom_Prod'];
            $Categorie    = $_POST['Categorie'];
            $Prix_Prod          = $_POST['Prix_Prod'];
            $Quantite_Prod          = $_POST['Quantite_Prod'];


            $stmt = $db->prepare("UPDATE produit SET Nom_Prod=? , Categorie =? , Prix_Prod=?, Quantite_Prod=?  WHERE Id_Prod=?");
            $stmt->execute(array($Nom_Prod, $Categorie, $Prix_Prod,$Quantite_Prod, $Id_Prod));
            $nombreModif = $stmt->rowCount();

            echo '<div class="alert alert-success" role="alert">Modification faite avec succes , nombre des modifications est: ' .  $nombreModif . '</div>';
            echo '<div class="container text-center">';
          
            echo '</div>';
            header("Location: GestionProducts.php");
        }
    } elseif ($do == 'delete') {
        $Id_Prod = $_GET['Id_Prod'];

        // echo '<h1 class="text-center">' . $count .'</h1>';

        $countID = checkIfExists("Id_Prod", "produit", $Id_Prod);

        if ($countID > 0) {
            $stmt = $db->prepare("DELETE FROM produit WHERE Id_Prod = ?");
            $stmt->execute(array($Id_Prod));
            $count = $stmt->rowCount();
            // echo '<h1 class="text-center">Lasu</h1>';
            include 'Header2.php';
            echo '<br> <br> ';
            echo '<div class="alert alert-success" role="alert">La suppression est faite avec succes , ' .  $count . ' élément supprimé' . '</div>';
            echo '<div class="container text-center">';
            echo '<a class="btn btn-primary" href="GestionProducts.php">RETOUR</a>';
            echo '</div> <br> <br> <br>';
        } else {
            $errorMsg = 'Y\'a pas un produit avec cet ID';

            redirect($errorMsg, 5, "GestionProducts");
        }

    }
    include "footer.php";
} else {
    header('location: Home.php');
}
