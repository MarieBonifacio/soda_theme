const p = document.querySelector(".inscription"),
insc = document.querySelector(".insc"),
cross = document.querySelector(".fa-times");
p.addEventListener("click", ()=>{
    insc.classList.toggle("inscriptionAppear");
})
cross.addEventListener("click", ()=>{
    insc.classList.toggle("inscriptionAppear");
})

// animation of checked icon on the shield

const fill = document.querySelector(".fill");

setInterval(() => {
    fill.classList.add("glowing");
    setTimeout(() => {
        fill.classList.remove("glowing");
    }, 4000);
}, 10000);