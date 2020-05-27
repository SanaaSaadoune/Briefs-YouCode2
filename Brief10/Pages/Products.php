<?php
session_start();




if (isset($_SESSION['user']) || isset($_SESSION['admin']) ) 
{
    include "DataBase.php"; // include init

    $do = isset($_GET['do']) ? $_GET['do'] : 'welcome';

    if ($do == 'welcome') {

        $stmt = $db->prepare("SELECT * FROM produit");
        $stmt->execute(array());

        $rows = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Style/Home.css">
    <link rel="stylesheet" href="../Style/Products.css">
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
                        <a class="nav-link" style="color: #EBBE2A;" href="#">Products <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        <a  href="Logout.php"><button class="btnConnexion"> Se déconnecter </button></a>
                    </span>
                    </div>
                </nav>
        </header>

        <div id="Succes" style="display:none">
                <div class="alert alert-success" role="alert"> Commande effectuée ! </div>
                <div class="container text-center">
                <a class="btn btn-primary" href="Products.php">Ok</a>
                </div> 
        </div><br> <br>

        <div class="container product-container">
            <?php foreach ($rows as $row) {

            ?>            
                <div class="product-parent-div">
                    <div class="product-div">
                        <div class="img-product">
                            <img src="../Images/Products/<?php echo $row->Nom_Prod ?>.png" alt="">
                        </div>
                        <input type="text" hidden name="IdProduit" id="IdProduit" value="<?php echo $row->Id_Prod ?>">
                        <div class="info-product">
                            <div class="details">
                                <div class="name-product">
                                    <h3><?php echo $row->Nom_Prod ?></h3>
                                </div>
                                <div class="description-product">
                                    <h6><?php echo $row->Categorie ?></h6>
                                </div>
                            </div>
                            <div class="quantity">
                                <span style="margin-left:2px;color:red; font-weight:bold" class="Prix" id="<?php echo $row->Prix_Prod ?>"><?php echo $row->Prix_Prod ?></span>  <b style="color:red">DH</b>
                                <span  class="PrixFixe" style="display:none;" ><?php echo $row->Prix_Prod ?></span>
                                <input style=" width: 50px;" type="number" name="quantite" class="quantite" min="1" max="<?php echo $row->Quantite_Prod ?>" step="1" value="1">
                              
                            </div>
                        </div>
                    </div>
                    <div class="btn btn-success" style="margin-bottom:10px;border-color:black;background-color:black;color:white;"> 
                        Ajouter au panier<input style="height:20px;width:40px;margin-left:10px;" type="checkbox" name="produit" id="<?php echo $row->Id_Prod?>" > 
                     </div>
                </div>
            <?php } ?>
        </div>
        <br><br>

        <p style="text-align:center;">
        <button id="btnConsulter" onclick="Panier()" name="Consulter" style="width:200px;height:50px;border-style:none;text-align:center;background-color:#EBBE2A;color:white;font-size:20px;border-radius:25px"> Calculer le total </button>

        <br><br>

        <p id ="Totalprix" style="text-align:center; color:red; font-weight:bold;"> </p>
        <br> 

        <!-- Button confirmer Modal -->
        <p style="text-align:center; display:none;"  id="confirmer"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Confirmer
        </button></p>

        <!-- Modal -->
        <form method="POST" >
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation de la demande</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span class="form-control" id="nom" disabled><?php echo $_SESSION['user']?></span><br>
                    <span class="form-control" id="FormPrix" disabled></span><br>
                    <input type="text" id="prixTotal" name="prixTotal" class="form-control" hidden><br>
                    <input type="text" hidden name="TotalQuantite" id="TotalQuantite">
                    <input type="text" hidden name="TotalId" id="TotalId">


                    <select class="form-control" id="methodeP" name="methodeP">
                        <option value="" selected disabled hidden> Choisir méthode de paiement </option>
                        <option value="CarteBanquaire"> Carte banquaire </option>
                        <option value="Especes"> Paiement à la livraison </option>
                    </select><br>
                    <input  style="display:none;" type="text" class="form-control" id="code" placeholder="Entrez le code de votre Carte"> <br>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <input type="submit"  name="Valider" class="btn btn-primary" value="Confirmer">
                </div>
                </div>
            </div>
            </div>
        </form>

        
        <?php   
        if(isset($_POST['Valider']) && isset($_POST['prixTotal']) && isset($_POST['TotalQuantite']) && isset($_POST['TotalId'])  ){
                include 'DataBase.php';
                global $db;
                $QTE =[];
                $Ids =[];

                $CIN   = $_SESSION['CIN'];
                $methodep      = $_POST['methodeP'];
                $facture   = $_POST['prixTotal'];
                $QTE = explode("_", $_POST['TotalQuantite']);
                $Ids = explode("_", $_POST['TotalId']);

                $stmt = $db->prepare("INSERT INTO commande(Date_Cmd,CIN_Cl,Facture,MethodePaiement) VALUES (:datee,:cin,:facture,:methodep)");
                $stmt->execute(array(
                    'datee' => date('Y-m-d H:i:s'),
                    'cin' => $CIN,
                    'facture' => $facture,
                    'methodep' => $methodep
                ));

                $reqID='SELECT MAX(commande.Id_Cmd) FROM commande';
                $response = $db->query($reqID);
                        $iDcmd=$response->fetchColumn();
                        
                        
                $problemStock=false;
                $collectionQTE=[];
                        
                for($i=1;$i<count($Ids);$i++)
                {
                        
                        $tempQte;
                        $req='SELECT `Quantite_Prod` FROM `produit` WHERE  `Id_Prod`= '.$Ids[$i];
                            $reponse = $db->query($req);
                            $tempQte=$reponse->fetchColumn();
                            

                            // si la quantité en stock est superieure a celle commandée
                                if(($tempQte-$QTE[$i])<0)
                                {
                                    $problemStock=true;
                                     
                                break;
                                }
                            array_push($collectionQTE,$tempQte-$QTE[$i]);
                            

                }
                $r=0;
                for($i=0;$i<count($Ids);$i++)
                        {
                            if($Ids[$i]!="" && $QTE[$i]!="")
                            {
                                $sql = "INSERT INTO ligne_commande (Id_Cmd, Id_Prod, Quantite)VALUES ($iDcmd, $Ids[$i],$QTE[$i])";
                                $db->query($sql);
                                // echo'<br>' .$sql;
                                $sql = "UPDATE produit set produit.Quantite_Prod= $collectionQTE[$r]  where Id_Prod=".$Ids[$i];
                                $r++;
                                $db->query($sql);
                                // echo'<br>' .$sql;
                            }
                         

                        }

                

                
                // $stmt2 = $db->prepare("ALTER TABLE produit set Quantite_Prod=? where Nom_Prod=?");
                // $stmt2->execute(array($quantite, $Nom_Prod));



                echo "<script> 
                        document.getElementById('Succes').style.display ='block'; 
                        document.getElementsByClassName('container product-container')[0].style.display='none';
                        document.getElementById('btnConsulter').style.display ='none';
                    </script>" ;
        }    
        ?>

        <?php
        } 
         
        } else {
            header('location: Home.php');
        }
        ?>


        <br><br>
        <?php include 'Footer.php'; ?>


        <script>
            function Panier(){
                var produit = document.getElementsByName('produit');
                var produitSelect =[];
                var j=0;
                var prix = document.getElementsByClassName('Prix');
                var Totalprix = document.getElementById('Totalprix');
                var Somme=0;
                var select = document.getElementById('methodeP');
                var TotalQuantite = document.getElementById('TotalQuantite');
                var quantite= document.getElementsByName('quantite');
                var ATotalQuantite ="";

                var TotalId = document.getElementById('TotalId');
                var IdProduit= document.getElementsByName('IdProduit');
                var ATotalId ="";

                for (var i=0;i<produit.length;i++)
                {
                    if(produit[i].checked)
                    {
                        produitSelect[j]=produit[i].id;
                        Somme += Number(prix[i].innerHTML);   
                        ATotalQuantite =  ATotalQuantite + '_'+ quantite[i].value;
                        ATotalId =  ATotalId + '_'+ IdProduit[i].value;
                        j++;

                    }
                }
                Totalprix.innerText = "Le prix total est : "+ Somme + "DHS";
                document.getElementById("confirmer").style.display = "block";
                document.getElementById('FormPrix').innerText = Somme +" DHS";
                
                document.getElementById('prixTotal').value= Somme;
                Totalprix.value= Somme;
                
                TotalQuantite.value = ATotalQuantite;
                TotalId.value = ATotalId;

                document.getElementById('methodeP').addEventListener('change', function (e) {
                if (e.target.value === "CarteBanquaire") {
                    document.getElementById('code').style.display ="block";
                }else{
                    document.getElementById('code').style.display ="none";
                }
                });
             
            }
        </script>


        <!-- CALCUL PRIX TOTAL  --> <!-- CALCUL PRIX TOTAL  --> <!-- CALCUL PRIX TOTAL  --> <!-- CALCUL PRIX TOTAL  -->
        <script src="../JS/jquery.js"></script>
        <script>
            jQuery('<div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div>').insertAfter('.quantity .quantite');
            jQuery('.quantity').each(function() {
                var spinner = jQuery(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max');

            btnUp.click(function() {
                var prixFixe = $(this).prev().prev('.PrixFixe').text();
                var oldValue = parseFloat(input.val());
                if (oldValue >= max) {
                var newVal = oldValue;
                } else {
                var newVal = oldValue + 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
                $(this).prev().prev().prev().prev('.Prix').text(parseInt(prixFixe * newVal)); 
            });

            btnDown.click(function() {
                var prixFixe = $(this).prev().prev().prev('.PrixFixe').text();
                var oldValue = parseFloat(input.val());
                if (oldValue <= min) {
                var newVal = oldValue;
                } else {
                var newVal = oldValue - 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
                $(this).prev().prev().prev().prev().prev('.Prix').text(parseInt(prixFixe * newVal)); 
            });
        
            });   
             

            $(".quantite").on('keyup keypress blur change', function(e) {
                var prixFixe = $(this).prev('.PrixFixe').text();
                if($(this).val() > <?php echo $row->Quantite_Prod ?> ){
                $(this).val('<?php echo $row->Quantite_Prod ?>');
                return false;
                } 
                else if($(this).val()=="")
                {
                    $(this).val(0);
                }
                
                $(this).prev().prev().prev('.Prix').text(prixFixe * $(this).val()); 
            });
            



        </script>
            