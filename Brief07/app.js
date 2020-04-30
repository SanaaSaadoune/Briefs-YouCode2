var path=require('path');
var express = require('express');
var session = require('cookie-session'); // Charge le middleware de sessions
var bodyParser = require('body-parser'); // Charge le middleware de gestion des paramètres
var urlencodedParser = bodyParser.urlencoded({ extended: false });
var hbs = require('hbs');

var app = express();

app.set('view engine','hbs');

var path_jsonfile = 'public/Traitement/JSON/InfosUser.json';
var LoadData = require('./Modale/Readandwrite');
var InfosUser = LoadData.LoadJson(path_jsonfile);

var path_jsonfile2 ='public/Traitement/JSON/Reservations.json';
var LoadData = require('./Modale/Readandwrite');
var Reservations = LoadData.LoadJson(path_jsonfile2);

var path_jsonfile3 ='public/Traitement/JSON/Maisons.json';
var LoadData = require('./Modale/Readandwrite');
var Maisons = LoadData.LoadJson(path_jsonfile3);

var InfosSession ;

app.use("/public/css",express.static("./public/css"))
app.use("/public/traitement",express.static("./public/traitement"))
app.use("/public/img",express.static("./public/img"))

app.get("/", function(req,res){
    res.render("Location");
});
app.get("/Reservation.hbs", function(req,res){
    res.render("Reservation");
});
app.get("/Location.hbs", function(req,res){
    res.render("Location");
});
app.get("/Location2.hbs", function(req,res){
    res.render("Location2",{InfosSession,Maisons});
});
app.get("/PageErreur.hbs", function(req,res){
    res.render("PageErreur");
});
app.get("/Admin.hbs", (req, res) => {
    res.render('Admin');
});

//Vérification login
app.post("/LOGIN",urlencodedParser,function(req,res){  
    var listEmails = [];
    var listMdps =[];
    var j=0;
    InfosUser.forEach(element => {
        listEmails[j]=element.email;
        listMdps[j]=element.mdp;
        j++;
       
    });
    var trouve=false;
    for(var i=0;i<listEmails.length;i++)
    {
        if(req.body.email==listEmails[i] && req.body.mdp==listMdps[i] )
        {
            InfosSession=  InfosUser[i] ;
            trouve=true;
            break;
        }
    }
    if(trouve)
    {
        if(InfosSession.email=="ADMIN")
        {
            res.render("Admin",{InfosUser,Reservations});
        }
        else{
            res.render("Location2",{InfosSession,Maisons});
        }
    }
    else{
        console.log("EMAIL OU MDP INCORRECT");
        res.render("PageErreur");
    }
});



//Supprimer user
app.post("/DELETE",urlencodedParser,function(req,res){  
    var listEmails = [];
    var j=0;
    InfosUser.forEach(element => {
        listEmails[j]=element.email;
        j++;
    });
    var trouve=false;
    for(var i=0;i<listEmails.length;i++)
    {
        if(req.body.email==listEmails[i])
        {
            console.log(InfosUser[i]);
            delete InfosUser[i];
            trouve=true;
        }
    }
    if(trouve)
    {
        console.log("Infos user now" , InfosUser);
        res.render("Admin",{InfosUser,Reservations});
    }
    else{
        console.log("Email introuvable !");
        res.render("Admin",{InfosUser,Reservations});
    }

    var listUsers=[];
    
    for(var i=0;i<InfosUser.length;i++ )
    {
        if(InfosUser[i]!=null)
        {
            listUsers[i] = InfosUser[i];
        }
    }

    var infos = JSON.stringify(listUsers);
    LoadData.SaveJson(path_jsonfile,infos);
    

});



//Modifier user
app.post("/UPDATE",urlencodedParser,function(req,res){  

    var trouve=false;
    for(var i=0;i<InfosUser.length;i++)
    {
        if(req.body.email == InfosUser[i].email)
        {
            InfosUser[i].mdp = req.body.passw;   
        }
    }
 
    var infos = JSON.stringify(InfosUser);
    LoadData.SaveJson(path_jsonfile,infos);
    res.render("Admin",{InfosUser,Reservations});
});


//Enregistrer les infos des users dans un fichier json
app.post("/Location.hbs",urlencodedParser,function(req,res){  
    console.log(InfosUser);
    console.log(req.body);
    var data=SaveData(req.body.nom,req.body.prenom,req.body.age,req.body.tel,req.body.email,req.body.mdp);
    res.render('Location',{data});
});

function SaveData(nom,prenom,age,tel,email,mdp)
{
    var data = 
        { 
            nom: nom, 
            prenom : prenom,
            age: age,
            tel: tel,
            email:email,
            mdp :mdp 
        };
        InfosUser.push(data);
        console.log(data);

    var infos = JSON.stringify(InfosUser);
    LoadData.SaveJson(path_jsonfile,infos);
    return data;
}



//Enregistrer les reservations dans un fichier json
app.post("/Reservation.hbs",urlencodedParser,function(req,res){  
    console.log(Reservations);
    console.log(req.body);
    var data2=SaveData2(req.body.CIN,req.body.nom,req.body.age,req.body.datedebut,req.body.datefin,req.body.nbrPers);
    res.render('Reservation',{data2});
});

function SaveData2(CIN,nom,age,datedebut,datefin,nbrPers)
{
    var data2 = 
        { 
            CIN: CIN, 
            nom : nom,
            age: age,
            datedebut:datedebut,
            datefin: datefin,
            nbrPers:nbrPers
        };
        Reservations.push(data2);
        console.log(data2);

    var reserv = JSON.stringify(Reservations);
    LoadData.SaveJson(path_jsonfile2,reserv);
    return data2;
}

//Ajouter des maisons dans un fichier json
app.post("/ADD",urlencodedParser,function(req,res){  
    var data3=SaveData3(req.body.image,req.body.description,req.body.adresse,req.body.prix);
    res.render('Location2',{Maisons});
});

function SaveData3(image,description,adresse,prix)
{
    var data3= 
        { 
            image:"../public/img/"+image, 
            description : description,
            adresse: adresse,
            prix: prix
        };
        Maisons.push(data3);
        console.log("voici la data ajoutée " ,data3);

    var infosMaisons = JSON.stringify(Maisons);
    LoadData.SaveJson(path_jsonfile3,infosMaisons);
    return data3; 
}


app.listen(3030);

