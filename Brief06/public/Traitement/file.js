//variable
var select = document.getElementById("select");
var url = "http://localhost:3000/public/Traitement/JSON/service.json";
var url2 = "http://localhost:3000/public/Traitement/JSON/Client.json";
var request = new XMLHttpRequest();
var data_service = "";
var E_rror = document.createElement("div");
var client;
//Traitement animation
$(".error").css("display","block !important");
$('.contact').click(()=>{
$('.contact').addClass("active");
$('.question').removeClass("active");
    $('html').animate({
        scrollTop: $(".Contact").offset().top
       
        
    },'slow');


});
$(".question").click(()=>{
$('.contact').removeClass("active");
$('.question').addClass("active");
    $('html').animate({
        scrollTop: $(".Question").offset().top
        
    },'slow');
});

//Load data to object javascript using AJAX
window.onload = function() {
  this.LoadDataService();
}

//function
function LoadDataService(){
    request.open("GET", url);
    request.onload = function() {
        if (request.status == 200) {
            data_service = JSON.parse(request.responseText);
            RemplirSelect(data_service);

        }
    };
    request.send(null);
}
//remplir select box using javascript 
var gnrl;
function RemplirSelect(data){
    gnrl = data;
    console.log(gnrl);
    for(var  i = 0;i<data.length;i++){
        var option = document.createElement("option");
        option.innerText = data[i].Nom_service;
        select.appendChild(option);
    }
}

$(".close").click(()=>{
    $("body").css("overflowY","visible");
    $(".bg-modal-2").css("display","none");
})
//validation forme 
$("#btn").click((e)=>{
    e.preventDefault();
    E_rror.classList.add("alert");
    E_rror.classList.add("alert-danger");
if($("#CIN").val() === "" || $("#select").val() === "Choisir" || $("#Date").val() === "" || $("#Description").val() === ""){
$(".container>.alert").remove();
E_rror.innerText = "vous devez remplir tous les champs possible";
$(".container").append(E_rror);
}else{
    $(".container>.alert").remove();
        $( ".frm" ).submit();
}
});










