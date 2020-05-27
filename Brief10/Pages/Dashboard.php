<?php
session_start();

if (isset($_SESSION['admin'])) {

    include "DataBase.php";

    function nmbrItms($item, $table)
    {
        global $db;
        $stmt2 = $db->prepare("SELECT COUNT($item) FROM $table");
        $stmt2->execute();
    
        return $stmt2->fetchColumn();
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../Style/Home.css">
    <link rel="stylesheet" href="../Style/Dashboard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>

    <?php include 'Header2.php'; ?>
    <br> <br>


    <div class="container text-center">
        <h1>This is dashbord page</h1>
        <br>
        <div class="container dashbord-table">
            <div>
                <h5>Management <br>des membres</h5>
                <a href="GestionMembers.php"><?php echo nmbrItms("CIN_Cl", "client"); ?></a>
            </div>
            <div>
                <h5>Management <br>des produits</h5>
                <a href="GestionProducts.php"><?php echo nmbrItms("Id_Prod", "produit"); ?></a>
            </div>
        </div>
        <br><br>

        </div>
    </div><br> <br>

<?php
    include "Footer.php";
} elseif (isset($_SESSION['user'])) {
    header('location: Products.php');
}else {
    header('location: Home.php');
}
?>

    </body>
</html>