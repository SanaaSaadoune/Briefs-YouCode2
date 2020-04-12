let listImages = [{
    url: "../public/img/mais1.jpg"
},
{
    url: "../public/img/mais2.jpg"
},
{
    url: "../public/img/mais3.jpg"
},
{
    url: "../public/img/mais4.jpg"
},
{
     url: "../public/img/mais5.jpg"
},
{
    url: "../public/img/mais6.jpg"
}
];

let listImages1 = [{
    url: "../public/img/maison2.jpg"
},
{
    url: "../public/img/maison3.jpg"
},
{
    url: "../public/img/maison4.jpg"
},
{
    url: "../public/img/maison5.jpg"
},
{
     url: "../public/img/maison6.jpg"
},
{
    url: "../public/img/maison7.jpg"
}
];

let listImages2 = [{
    url: "../public/img/maiso1.jpg"
},
{
    url: "../public/img/maiso2.jpg"
},
{
    url: "../public/img/maiso3.jpg"
},
{
    url: "../public/img/maiso4.jpg"
},
{
     url: "../public/img/maiso5.jpg"
},
{
    url: "../public/img/maiso6.jpg"
}
];



let listImages3 = [{
    url: "../public/img/m1.jpg"
},
{
    url: "../public/img/m2.jpg"
},
{
    url: "../public/img/m3.jpg"
},
{
    url: "../public/img/m4.jpg"
},
{
     url: "../public/img/m5.jpg"
},
{
    url: "../public/img/m6.jpg"
}
];



let listImages4 = [{
    url: "../public/img/ma1.jpg"
},
{
    url: "../public/img/ma2.jpg"
},
{
    url: "../public/img/ma3.jpg"
},
{
    url: "../public/img/ma4.jpg"
},
{
     url: "../public/img/ma5.jpg"
},
{
    url: "../public/img/ma6.jpg"
}
];




let listImages5 = [{
    url: "../public/img/mai1.jpg"
},
{
    url: "../public/img/mai2.jpg"
},
{
    url: "../public/img/mai3.jpg"
},
{
    url: "../public/img/mai4.jpg"
},
{
     url: "../public/img/mai5.jpg"
},
{
    url: "../public/img/mai6.jpg"
}
];


let listImages6 = [{
    url: "../public/img/maison11.jpg"
},
{
    url: "../public/img/maison12.jpg"
},
{
    url: "../public/img/maison13.jpg"
},
{
    url: "../public/img/maison14.jpg"
},
{
    url: "../public/img/maison15.jpg"
},
{
     url: "../public/img/maison16.jpg"
}
];



let listImages7 = [{
    url: "../public/img/maison111.jpg"
},
{
    url: "../public/img/maison112.jpg"
},
{
    url: "../public/img/maison113.jpg"
},
{
    url: "../public/img/maison114.jpg"
},
{
    url: "../public/img/maison115.jpg"
},
{
     url: "../public/img/maison116.jpg"
}
];



let listImages8 = [{
    url: "../public/img/maison1111.jpg"
},
{
    url: "../public/img/maison1112.jpg"
},
{
    url: "../public/img/maison1113.jpg"
},
{
    url: "../public/img/maison1114.jpg"
},
{
    url: "../public/img/maison1115.jpg"
},
{
     url: "../public/img/maison1116.jpg"
}
];



let listImages9 = [{
    url: "../public/img/h1.jpg"
},
{
    url: "../public/img/h2.jpg"
},
{
    url: "../public/img/h3.jpg"
},
{
    url: "../public/img/h4.jpg"
},
{
     url: "../public/img/h5.jpg"
},
{
    url: "../public/img/h6.jpg"
}
];


let listImages10 = [{
    url: "../public/img/hom1.jpg"
},
{
    url: "../public/img/hom2.jpg"
},
{
    url: "../public/img/hom3.jpg"
},
{
    url: "../public/img/hom4.jpg"
},
{
     url: "../public/img/hom5.jpg"
},
{
    url: "../public/img/hom6.jpg"
}
];


let listImages11 = [{
    url: "../public/img/home1.jpg"
},
{
    url: "../public/img/home2.jpg"
},
{
    url: "../public/img/home3.jpg"
},
{
    url: "../public/img/home4.jpg"
},
{
     url: "../public/img/home5.jpg"
},
{
    url: "../public/img/home6.jpg"
}
];


const allImages = [
    listImages,
    listImages1,
    listImages2,
    listImages3,
    listImages4,
    listImages5,
    listImages6,
    listImages7,
    listImages8,
    listImages9,
    listImages10,
    listImages11
]
let indexes = [0,0,0,0,0,0,0,0,0,0,0,0];

let right = document.getElementsByClassName('fa-chevron-right');
let left = document.getElementsByClassName('fa-chevron-left');
// 
for (let i = 0; i < right.length; i++) {
    right[i].addEventListener('click',()=>{
        if (indexes[i] < allImages[i].length - 1)
            indexes[i]++;
        else 
            indexes[i] = 0;
        // 
        switchImage(i);
    });
    left[i].addEventListener('click',()=>{
        if (indexes[i] > 0)
            indexes[i]--;
        else 
            indexes[i] = allImages[i].length - 1;
        // 
        switchImage(i);
    });
}
// 
function switchImage(pos){
    let name = "image";
    if(pos > 0)
        name += pos;
    document.getElementById(name).src = allImages[pos][indexes[pos]].url;
}



/*  let index = 0;
function switchImage() {
    document.getElementById("image").src = listImages[index].url;
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
}*/





// ******************** PAGE RESERVATION ************************

var btns = document.getElementsByClassName('reservBtn');
for (let i = 0; i < btns.length; i++) {
    btns[i].addEventListener('click',()=>{
        sessionStorage.setItem("image", `${allImages[i][0].url}`);
    });
}



var slideIndex = 0;
carousel();

// console.log(sessionStorage.getItem("image"));
document.getElementById('imgPreview').style = "background-image:url('"+sessionStorage.getItem("image")+"');";

function carousel() {
  var i;
  var x = document.getElementsByClassName("slide");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > x.length) {slideIndex = 1}
  x[slideIndex-1].style.display = "block";
  setTimeout(carousel, 2000); // Change image every 2 seconds
}