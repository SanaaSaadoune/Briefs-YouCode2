<?php
    session_start(); 
    if (isset($_SESSION['admin'])) { // si il y'a une session ouvert
        header('location: Dashboard.php'); // redirect vers la page dashbord
        exit();
    } elseif (isset($_SESSION['user'])) {
        header('location: Products.php');
        exit();
    }

    if(isset($_POST['Connexion'])){
        include 'DataBase.php';
        global $db;
    
        $user = $_POST['EmailSession'];
        $mdp = $_POST['MdpSession'];
        $shapassword = sha1($mdp);

        $stmt = $db->prepare("SELECT CIN_Cl, Email_Cl, Nom_Cl, Prenom_Cl, Password_Cl FROM client WHERE Email_Cl = ? AND Password_Cl = ? ");
        $stmt->execute(array($user, $shapassword));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();

        if ($count > 0) {
            $_SESSION['user'] = $row->Nom_Cl ." ". $row->Prenom_Cl  ;// SESSION USERNAME
            $_SESSION['CIN'] = $row->CIN_Cl ;// CIN USER
            header('location: Products.php'); // REDIRECT VERS PAGE PRODUCTS
            exit();
        } 

        $stmt2 = $db->prepare("SELECT Email_Ad, Nom_Ad, Password_Ad FROM admin1 WHERE Email_Ad = ? AND Password_Ad = ?");
        $stmt2->execute(array($user, $shapassword));
        $row2 = $stmt2->fetch();
        $count2 = $stmt2->rowCount();

        if ($count2 > 0) {
            $_SESSION['admin'] = $row2->Nom_Ad; // SESSION ADMIN
            header('location: Dashboard.php'); // REDIRECT VERS PAGE DASHBORD
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../Style/Login.css">
    <link rel="stylesheet" href="../Style/Home.css">
</head>
<body>
   
    <?php include 'Header1.php' ?>
    <br>

    <div class="form">
        <ul class="tab-group">
        <li class="tab active"><a href="#signup">Inscription</a></li>
        <li class="tab"><a href="#login">Connexion</a></li>
        </ul>
        <div class="tab-content">
            <div id="signup">   
                <h1>Inscris-toi gratuitement</h1>
                
                <form  method="post">
                    <div class="top-row">
                        <div class="field-wrap">
                            <input name="Nom" type="text" placeholder="Nom" required autocomplete="off" />
                        </div>
                        <div class="field-wrap">
                            <input name="Prenom" placeholder="Prenom" type="text"required autocomplete="off"/>
                        </div>
                    </div>

                    <div class="field-wrap">
                        <input name="Email" placeholder="Email " type="email"required autocomplete="off"/>
                    </div>

                    <div class="field-wrap">
                        <input name="CIN" placeholder="CIN" type="text"required autocomplete="off"/>
                    </div>
                    
                    <div class="field-wrap">
                        <input  name="Mdp"  placeholder="Mot de passe" type="password"required autocomplete="off"/>
                    </div>
                    
                    <button type="submit" name="Inscription" class="button button-block">S'inscrire</button>
                </form>
            </div>
        
            <div id="login">   
                <h1>Bienvenue!</h1>

                <form  method="post">
                    <div class="field-wrap">
                    <input type="email" placeholder="Email" name="EmailSession" required autocomplete="off"/>
                    </div>
                    
                    <div class="field-wrap">
                    <input type="password" placeholder="Mot de passe" name="MdpSession" required autocomplete="off"/>
                    </div>
                    
                    <p class="forgot"><a href="#">Forgot Password?</a></p>
                    <button type="submit" name="Connexion" class="button button-block">Se connecter</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../JS/jquery.js"></script>
    <script>
        //Sign in, Sign up
        $(".form")
        .find("input, textarea")
        .on("keyup blur focus", function (e) {
            var $this = $(this),
            label = $this.prev("label");

            if (e.type === "keyup") {
            if ($this.val() === "") {
                label.removeClass("active highlight");
            } else {
                label.addClass("active highlight");
            }
            } else if (e.type === "blur") {
            if ($this.val() === "") {
                label.removeClass("active highlight");
            } else {
                label.removeClass("highlight");
            }
            } else if (e.type === "focus") {
            if ($this.val() === "") {
                label.removeClass("highlight");
            } else if ($this.val() !== "") {
                label.addClass("highlight");
            }
            }
        });

        $(".tab a").on("click", function (e) {
        e.preventDefault();

        $(this).parent().addClass("active");
        $(this).parent().siblings().removeClass("active");

        target = $(this).attr("href");

        $(".tab-content > div").not(target).hide();

        $(target).fadeIn(600);
        });
    </script>


    <?php   
        if(isset($_POST['Inscription'])){
                    include 'DataBase.php';
                    global $db;

                    $Nom   = $_POST['Nom'];
                    $Prenom   = $_POST['Prenom'];
                    $Email      = $_POST['Email'];
                    $CIN   = $_POST['CIN'];
                    $Mdp   = $_POST['Mdp'];
                    $HashedMdp = sha1($Mdp);

                    $q = $db->prepare("INSERT INTO client(Nom_Cl, Prenom_Cl, Email_Cl, CIN_Cl, Password_Cl, Date_Insc) VALUES (:nom,:prenom,:email,:cin,:mdp,:datee)");
                    $q->execute(array(
                        'nom' => $Nom,
                        'prenom' => $Prenom,
                        'email' => $Email,
                        'cin' => $CIN,
                        'mdp' => $HashedMdp,
                        'datee' => date('Y-m-d H:i:s')
                    ));

                    ?>
                    <p style="text-align:center; font-size:20px;color:red;">
                        <?php  
                            echo "Inscription effectuée !";
                        ?> 
                    </p>
                    <?php 
        } 

       
        ?>

    <br><br>
    <?php include 'Footer.php' ?>
</body>
</html>


