// clock animation -> hands of clock rotation

let rotateBigHand = -30;
let rotateLittleHand = -120;
const bigHand = document.querySelector("#Vector_106");
const littleHand = document.querySelector("#Vector_107");

setInterval(() => {
    rotateBigHand +=6;
    rotateLittleHand +=0.5;
    bigHand.style.transform = `rotate(${rotateBigHand}deg)`;
    littleHand.style.transform = `rotate(${rotateLittleHand}deg)`;
}, 50);

//file input animation

const realBtn = document.querySelector("#real-file");
const fakeBtn = document.querySelector("#custom-button");
const span = document.querySelector("#custom-text");
/*
regex to analyse: 

/ 
first character : [ matches  "/"  or  "\"  before the name of the file ]
then a character ( [ matches any word characters "\w"  or  "\d" or whitespaces "\s"  or  special characters among  "\." _ "\-" _ "\(" _ "\)" -> between one and unlimited characters "+" ] )
$ -> end of regex 
/   

*/

fakeBtn.addEventListener("click", ()=>{
    realBtn.click();
});

realBtn.addEventListener("change", ()=>{
    if(realBtn.value)
    {
        // match() method get a correlation table between a regular expression (image path -> realBtn.value)  and a rational expression (regex)
        span.innerHTML = realBtn.value.replace(/C:\\fakepath\\/, '');
    }
    else
    {
        span.innerHTML = "Aucune image séléctionnée";
    }
})