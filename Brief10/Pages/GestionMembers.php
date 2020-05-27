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

function redirect($errorMsg, $second = 3, $page = "GestionMembers")
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

        $stmt = $db->prepare("SELECT * FROM client");
        $stmt->execute(array());

        $rows = $stmt->fetchAll();
        
?>

    <?php include 'Header2.php'?>

    <br> <br>

    <div class="container">
            <h1 class="text-center">Gestion des Membres</h1><br>
            <div class="table-responsive table-center text-center">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#CIN</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom </th>
                            <th scope="col">Email</th>
                            <th scope="col">Mot de passe</th>
                            <th scope="col">Date d'inscription</th>
                            <th scope="col">Opérations</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($rows as $row) {
                    ?>
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo $row->CIN_Cl ?></th>
                                <td><?php echo $row->Nom_Cl ?></td>
                                <td><?php echo $row->Prenom_Cl ?></td>
                                <td><?php echo $row->Email_Cl ?></td>
                                <td> <?php echo $row->Password_Cl ?> </td>
                                <td> <?php echo $row->Date_Insc ?> </td>
                                <td>
                                    <a href="?do=edit&CIN_Cl=<?php echo $row->CIN_Cl ?>" class="btn btn-success" title="modifier"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a href="?do=delete&CIN_Cl=<?php echo $row->CIN_Cl ?>" class="btn btn-danger confirm" title="supprimer"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                </table>
            </div>
            <a href="?do=add" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add user</a>
    </div>
    <div style="height:200px"> </div>
    <?php include "Footer.php";?>

    <?php
    } elseif ($do == 'add') {
        include 'Header2.php'
    ?>
        <br> <br>
        <h1 class="text-center">Ajouter user</h1>
        <div class="blank"></div>
        <div class="container">
            <form action="?do=insert" method="POST">
                <div class="form-group">
                    <label for="formGroupExampleInput">CIN</label>
                    <input name="CIN_Cl" type="text" class="form-control" id="CIN_Cl" placeholder="CIN_Cl" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Nom</label>
                    <input name="Nom_Cl" type="text" class="form-control" id="Nom_Cl" placeholder="Nom_Cl" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput4">Prenom</label>
                    <input name="Prenom_Cl" type="text" class="form-control" id="formGroupExampleInput4" autocomplete="off" placeholder="Prenom_Cl">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Password</label>
                    <input name="Password_Cl" type="password" class="form-control" id="formGroupExampleInput2" autocomplete="off" placeholder="Mot de passe">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput3">Email</label>
                    <input name="Email_Cl" type="email" class="form-control" id="formGroupExampleInput3" autocomplete="off" placeholder="Email" required>
                </div>
                
                <div class="form-group">
                    <input type="submit" value="Ajouter" class="btn btn-primary">
                </div>
            </form>
        </div>

        <?php } elseif ($do == 'insert') {

        // echo $_POST['Nom_Cl'] . " " . $_POST['Password_Cl'] . " " . $_POST['Email_Cl'] . " " . $_POST['Prenom_Cl'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            echo '<h1 class="text-center">ADD Les Membres</h1>';
            echo '<div class="blank"></div>';
            $CIN_Cl   = $_POST['CIN_Cl'];
            $Nom_Cl   = $_POST['Nom_Cl'];
            $Password_Cl   = $_POST['Password_Cl'];
            $Email_Cl      = $_POST['Email_Cl'];
            $Prenom_Cl   = $_POST['Prenom_Cl'];
            $hashedpass = sha1($Password_Cl);

            $errorMsg = array();

            if ((checkIfExists("CIN_Cl", "client", $CIN_Cl)) === 0) {
                $stmt = $db->prepare("INSERT INTO `client` ( CIN_Cl, Nom_Cl, Password_Cl, Email_Cl, Prenom_Cl, Date_Insc) VALUES (?, ?, ?, ?, ?, now())");
                $stmt->execute(array($CIN_Cl, $Nom_Cl, $hashedpass, $Email_Cl, $Prenom_Cl));
                $nombreModif = $stmt->rowCount();

                echo '<div class="alert alert-success" role="alert">L\'ajout est fait avec succes , nombre des ajouts est: ' .  $nombreModif . '</div>';
                echo '<div class="container text-center">';
                echo '<a class="btn btn-primary text-center" href="GestionMembers.php">RETOUR</a>';
                echo '</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">CIN existe existe déja</div>';
                echo '<div class="container text-center">';
                echo '<a class="btn btn-primary text-center" href="GestionMembers.php">RETOUR</a>';
                echo '</div>';
            }
        } else {

                $errorMsg = 'Tu ne peux pas accéder directement à cette page';

                redirect($errorMsg, 5);
            }
        }

        elseif ($do == 'edit') { // edit page 

            $CIN_Cl = $_GET ['CIN_Cl'] ;
            $stmt = $db->prepare("SELECT * FROM client WHERE CIN_Cl = ? LIMIT 1");
            $stmt->execute(array($CIN_Cl));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
    
            if ($count > 0) {
                include 'Header2.php'
            ?>
                <br> <br>
                <h1 class="text-center">Modifier les infos de l'user</h1>
                <div class="blank"></div>
                <div class="container">
                    <form action="?do=update" method="POST">
                        <input type="hidden" name="CIN_Cl" value="<?php echo $CIN_Cl; ?>">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Nom</label>
                            <input name="Nom_Cl" type="text" class="form-control" id="Nom_Cl" value="<?php echo $row->Nom_Cl ?>" autocomplete="off" placeholder="Nom" required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput4">Prenom</label>
                            <input name="Prenom_Cl" type="text" class="form-control" id="formGroupExampleInput4" value="<?php echo $row->Prenom_Cl ?>" autocomplete="off" placeholder="Fullname">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Password</label>
                            <input name="oldpassword" type="hidden" class="form-control" value="<?php echo $row->Password_Cl ?>" id="formGroupExampleInput2" autocomplete="off" placeholder="Password">
                            <input name="newpassword" type="password" class="form-control" id="formGroupExampleInput2" autocomplete="off" placeholder="Si vous pas voulez changer le mot de pass laisse ce champ vide">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput3">Email</label>
                            <input name="Email_Cl"  type="email" class="form-control" id="formGroupExampleInput3" value="<?php echo $row->Email_Cl ?>" autocomplete="off" placeholder="Email" required>
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
        }
        
        elseif ($do == 'update') {


            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
                echo '<h1 class="text-center">Update Des Membres</h1>';
                echo '<div class="blank"></div>';
    
                $Password_Cl = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
    
                $CIN_Cl         = $_POST['CIN_Cl'];
                $Nom_Cl   = $_POST['Nom_Cl'];
                $Prenom_Cl      = $_POST['Prenom_Cl'];
                $Email_Cl   = $_POST['Email_Cl'];
    
                $errorMsg = array();
    
                if (strlen($Nom_Cl) < 4 || strlen($Nom_Cl) > 10) {
                    $errorMsg[] = "Name doit etre entre 4 et 10 charactéres";
                }
                if (!empty($email)) {
                    $errorMsg[] = "email can't be empty";
                }
                if (!empty($fullname)) {
                    $errorMsg[] = "Name can't be empty";
                }
    
                foreach ($errorMsg as $err) {
                    // echo $err . "<br>";
                    echo '<div class="alert alert-danger" role="alert">' . $err . '</div>';
                }
    
                if (empty($errorMsg)) {
                        $stmt = $db->prepare("UPDATE client SET Nom_Cl=? , Prenom_Cl =? , Email_Cl=?, Password_Cl=? WHERE CIN_Cl=?");
                        $stmt->execute(array($Nom_Cl, $Prenom_Cl, $Email_Cl, $Password_Cl, $CIN_Cl));
                        $nombreModif = $stmt->rowCount();
    
                        echo '<div class="alert alert-success" role="alert">Modification faite avec succes , nombre des modifications est: ' .  $nombreModif . '</div>';
                        echo '<div class="container text-center">';
                        echo '<a class="btn btn-primary text-center" href="GestionMembers.php">RETOUR</a>';
                        echo '</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Email existe deja </div>';
                        echo '<div class="container text-center">';
                        echo '<a class="btn btn-primary text-center" href="GestionMembers.php">RETOUR</a>';
                        echo '</div>';
                    }
                }
             else {
    
                $errorMsg = 'Tu peut pas entrer directement dans cette page';
                redirect($errorMsg, 5);
            }
        } 


        elseif ($do == 'delete') {

            $CIN_Cl = $_GET['CIN_Cl'];
    
            // echo '<h1 class="text-center">' . $count .'</h1>';
    
            $countID = checkIfExists("CIN_Cl", "client", $CIN_Cl);
    
            if ($countID > 0) {
                $stmt = $db->prepare("DELETE FROM client WHERE CIN_Cl = ?");
                $stmt->execute(array($CIN_Cl));
                $count = $stmt->rowCount();
                echo '<h1 class="text-center">DELETED !!</h1>';
                echo '<div class="blank"></div>';
                echo '<div class="alert alert-success" role="alert">La suppression est faite avec succes , ' .  $count . ' éléments suprimmé' . '</div>';
                echo '<div class="container text-center">';
                echo '<a class="btn btn-primary" href="GestionMembers.php">RETOUR</a>';
                echo '</div>';
            } else {
                $errorMsg = 'Y\'a pas un membre avec ce CIN';
    
                redirect($errorMsg, 5, "members");
            }
        } else {
    
            $errorMsg = 'Tu peut pas entrer directement dans cette page';
    
            redirect($errorMsg, 5);
        }




    }

    else {
    header('location: index.php');
    }
   


?>
