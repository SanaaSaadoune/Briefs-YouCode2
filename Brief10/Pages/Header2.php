
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
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light style=background-color:#cacaca">
            <img src="../Images/logo.png">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" style="color:#EBBE2A;" href="Dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                
                <li class="nav-item">
                  <a class="nav-link" style="color: white;" href="GestionMembers.php">Gestion des membres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: white;" href="GestionProducts.php">Gestion de produits</a>
                  </li>
              </ul>
              <span class="navbar-text">
                  <a  href="Logout.php"><button class="btnConnexion"> Se déconnecter </button></a>
              </span>
            </div>
        </nav>
    </header>