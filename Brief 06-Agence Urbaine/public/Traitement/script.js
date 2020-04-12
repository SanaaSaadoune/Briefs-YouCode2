let listImages = [{
        url: "../public/img/Images/activite1.jpg",
        title: "Journée internationale de la femme 2020"
    },
    {
        url: "../public/img/Images/activite2.jpg",
        title: "Annonce Droit d'accès à l'information"
    },
    {
        url: "../public/img/Images/activite3.jpg",
        title: "Bilan Août/Décembre 2019"
    }
];
let index = 0;


  
function switchImage() {
    document.getElementById("image").src = listImages[index].url;
    document.getElementById("image-title").innerHTML = listImages[index].title;

    for(let i = 0; i < document.querySelectorAll("#buttons div").length; i++){
       
        document.querySelectorAll("#buttons div")[i].classList.remove("active");
        
    }
    document.querySelectorAll("#buttons div")[index].classList.add("active");
    
}

function moveLeft() {

    if (index > 0) {
        index--;
    } else {
        index = listImages.length - 1;
    }
    switchImage();
}

function moveRight() {
    
    if (index < (listImages.length - 1)) {
        index++;
    } else {
        index = 0;
    }
    switchImage();
}


  

    
    