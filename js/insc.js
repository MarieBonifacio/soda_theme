const p = document.querySelector(".inscription"),
insc = document.querySelector(".insc"),
cross = document.querySelector(".fa-times");
p.addEventListener("click", ()=>{
    if(insc.classList.contains("inscriptionAppear"))
    {
        insc.classList.remove("inscriptionAppear");
    }
    else
    {
        insc.classList.add("inscriptionAppear");
    }
})
cross.addEventListener("click", ()=>{
    if(insc.classList.contains("inscriptionAppear"))
    {
        insc.classList.remove("inscriptionAppear");
    }
    else
    {
        insc.classList.add("inscriptionAppear");
    }
})

window.addEventListener("resize", ()=>{
    if(window.innerWidth < 1024)
    {
    }
})

// animation of checked icon on the shield

const fill = document.querySelector(".fill");

setInterval(() => {
    fill.classList.add("glowing");
    setTimeout(() => {
        fill.classList.remove("glowing");
    }, 4000);
}, 10000);