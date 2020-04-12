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
    res.render("Location2",{InfosSession});
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
            res.render("Admin",{InfosUser});
        }
        else{
            res.render("Location2",{InfosSession});
        }
    }
    else{
        console.log("EMAIL OU MDP INCORRECT");
        res.render("PageErreur");
    }
});




//Enregistrer les infos des users
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





app.listen(3030);

