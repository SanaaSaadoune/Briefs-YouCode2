const path = require('path');
const Joi = require('joi');
const express = require("express");
const hbs = require('hbs');
const app = express();
const partialsPath = path.join(__dirname, './partials');
var bodyParser = require('body-parser'),

client = "",
path_jsonfile = 'public/Traitement/JSON/Question.json',
LoadData = require('./Modale/Readandwrite');
var data = LoadData.LoadJson('public/Traitement/JSON/service.json');
var data3 = LoadData.LoadJson('public/Traitement/JSON/Question.json');
urlencodedParser = bodyParser.urlencoded({ extended: false });
// *Define paths for express config
const viewPath = path.join(__dirname, './views');
// *setup handlebars engine and views location
app.set('view engine', 'hbs');
// app.set('view engine', 'html');
// app.engine('html', require('hbs').__express);
// app.set('view engine', 'hbs');
// Pointing express to my custom directory
app.set('views', viewPath)
hbs.registerPartials(partialsPath)
// registerPartials take the path to the direcotory where my partials leaves
app.use("/public/css",express.static("./public/css"))
app.use("/public/Traitement",express.static("./public/Traitement"))
app.use("/public/img",express.static("./public/img"))
// Lancement des pages
app.get("/questionnement.hbs", (req, res) => {
  res.render('questionnement');
});
app.get("/Reclamation.hbs", (req, res) => {
    res.render('Reclamation',{data});
  });
app.get("/home.hbs", (req, res) => {
    res.render('home',{data3});
  });
// Port
var port = process.env.PORT || 3000;
app.listen(port,() => console.log(`Listening on port ${port}...`));
/*server local*/
// /*Use Post data*/
app.post("/questionnement.hbs",urlencodedParser,function(req,res){  
    SaveData(req.body.CIN,req.body.Date,req.body.Description,req.body.service);
   
    res.render('questionnement');
});
//button recherche
app.post("/Reclamation.hbs",urlencodedParser,function(req,res){  
var Question = LoadData.LoadJson(path_jsonfile);
var data2 = [{ID:null,CIN:null,datequestion:null,description:null,Nom_service:null}];
var j = 0;
for(var i = 0;i<Question.length;i++){
  if(req.body.service == Question[i].Nom_service){
data2[j] = Question[i];
j++;
}
}
res.render('Reclamation.hbs',{data2,data});
});
// /*Save Data in json file */
function SaveData(cin,date_question,description,id_service){

    var id;
    Question = LoadData.LoadJson(path_jsonfile);
    if(Question[Question.length - 1].ID != null){
      id  = Question[Question.length - 1].ID + 1;
    }else{
        id = 1;
    }
    var data = 
        { 
            ID: id,
            CIN: cin, 
            datequestion : date_question,
            description: description,
            Nom_service: id_service 
        };
        Question.push(data);

    var question = JSON.stringify(Question);
    LoadData.SaveJson(path_jsonfile,question);
    
}


