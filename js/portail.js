window.addEventListener('load', function (e) {
    function avatarCircle(){
        $("body .content .home .dashboard .actu #buddypress img").css("border-radius","0");
        $("img[src*='avatar']").each(function(){
            $(this).css('min-witdh','auto');
            $(this).css('min-height','auto');
            $(this).css('witdh','auto');
            $(this).css('height','auto');
            $(this).addClass('avatarCircle');
            let imgWidth = $(this).width();
            let imgHeight = $(this).height();

            if(imgWidth <= imgHeight){
                $(this).parent().addClass('portrait');
                $(this).width("100%");
                $(this).height("auto");
            }else{
                $(this).parent().addClass('landscape');
                $(this).width("auto");
                $(this).height("100%");
            }
            $(this).parent().css("width", "30px");
            $(this).parent().css("height", "30px");
            $(this).parent().css("border-radius", "50%");

            if($(this).closest('form#profil').length){
                $(this).parent().css("width", "150px");
                $(this).parent().css("height", "150px");
            }else if($(this).siblings('.dropMenuProfile').length){
                $(this).parent().css("width", "45px");
                $(this).parent().css("height", "45px");

            }else if($(this).closest('div').length){
                $(this).closest('div').css("border-radius", "50%");
                $(this).closest('div').css("overflow", "hidden");
                $(this).closest('div').css("width", "40px");
                $(this).closest('div').css("height", "40px");
            }
        });
        $(".avatarCirle").each(function(){
        });
    }
    avatarCircle();

    const delai = (e.timeStamp/1000);
    const wave1 = document.querySelector(".wave1");
    const wave2 = document.querySelector(".wave2");
    let percentage = 30;
    wave1.style.transition = delai + "s";
    wave2.style.transition = delai + "s";
    wave1.style.bottom = percentage + "%";
    wave2.style.bottom = percentage + "%";
    const loader = document.querySelector(".loader");

    loader.addEventListener("transitionend", ()=>{
        loader.classList.add("loaderFinished");
        setTimeout(() => {
        loader.remove();
        }, 300);
    })

    var urlNotif = myScriptDir.theme_directory;
    var homeNotif = myScriptDir.home_url;
    var xmlhttpNotif = new XMLHttpRequest();
    xmlhttpNotif.onreadystatechange = function () {
    if(this.readyState == 4 && this.status == 200)
    {
        var notifTable = JSON.parse(this.responseText),
        number = notifTable.nombre,
        articles = notifTable.article,
        modules = notifTable.module,
        quiz = notifTable.quiz;
        const bell = document.querySelector(".fa-bell"),
        nbrNotifs = document.querySelector(".nbr_notifs"),
        notifs = document.querySelector(".notifs");
        notifs.innerHTML='';
        bell.addEventListener("click", ()=>{
            // window.location = urlNotif  + '/notif_checked.php';
            if(notifs.classList.contains("notifsAppear"))
            {
                notifs.classList.remove("notifsAppear")
                var xmlhttpNotifChecked = new XMLHttpRequest();
                xmlhttpNotifChecked.onreadystatechange = function () {
                    if(this.readyState == 4 && this.status == 200)
                    {
                        // window.location.reload();
                        number = 0;
                        nbrNotifs.innerHTML = number;
                        notifs.innerHTML = "Vous n'avez pas de notifications";
                    }
                    else
                    {
                    }
                };

                // url a trouver
                xmlhttpNotifChecked.open("GET", urlNotif  + '/notif_checked.php', true);
                xmlhttpNotifChecked.send();
            }
            else
            {
                notifs.classList.add("notifsAppear")
            }
        })
        if(number > 0)
        {
            nbrNotifs.innerHTML = number;
            if(articles.length > 0)
            {
                for (let i = 0; i < articles.length; i++) {
                    notifs.innerHTML += `
                        <p>L'article <a href="${articles[i].guid}}"><span>${articles[i].post_title}</span></a> a été publié(e) le <span>${articles[i].post_date}</span></p>
                    `;
                }
            }
            if(quiz.length > 0)
            {
                for (let j = 0; j < quiz.length; j++) {
                    notifs.innerHTML += `
                        <p>Le quiz <a href="${homeNotif}/menu-quiz/"><span>${quiz[j].name}</span></a> a été créé le <span>${quiz[j].created_at}</span></p>
                    `;
                }
            }
            if(modules.length > 0)
            {
                for (let f = 0; f < modules.length; f++) {
                    notifs.innerHTML += `
                        <p>Le module <a href="${homeNotif}/menu-module/"><span>${modules[f].title}</span></a> a été créé le <span>${modules[f].created_at}</span></p>
                    `;
                }
            }
        }
        else
        {
            nbrNotifs.innerHTML = number;
            notifs.innerHTML = "Vous n'avez pas de notifications";
        }

        // click event for dropDown list menu
        const dropMenus = document.querySelectorAll(".dropMenu");
        const arrows = document.querySelectorAll(".drop");

        arrows.forEach(arrow => {
            arrow.addEventListener("click", (e)=>{
                let id = e.target.dataset.id;
                let menu = document.querySelector(`#${id}`);
                dropMenus.forEach(dropMenu => {
                    if(dropMenu.id == id)
                    {
                        if(menu.classList.contains("dropMenuAppear"))
                        {
                            menu.classList.remove("dropMenuAppear");
                        }
                        else
                        {
                            menu.classList.add("dropMenuAppear");
                        }
                    }
                    else if(dropMenu.id != id)
                    {
                        dropMenu.classList.remove("dropMenuAppear");
                    }
                });
            })
        });

        const profil = document.querySelector(".circle"),
        dropMenuProfile = document.querySelector(".dropMenuProfile");

        profil.addEventListener("click", ()=>{
            if(dropMenuProfile.classList.contains("dropMenuProfileAppear"))
            {
                dropMenuProfile.classList.remove("dropMenuProfileAppear");
            }
            else
            {
                dropMenuProfile.classList.add("dropMenuProfileAppear");
            }
        })

        // click event on the arrow which will activate the growth side nav or shrink it

        const arrow = document.querySelector(".arrow");
        const p = document.querySelectorAll("#p");
        const sideNav = document.querySelector(".side");
        const contenu = document.querySelector(".content");

        // if(window.innerWidth>1100)
        // {
            arrow.addEventListener("click", ()=>{
                if(arrow.classList.contains("fa-arrow-left"))
                {
                    arrow.classList.remove("fa-arrow-left");
                    arrow.classList.add("fa-arrow-right");
                    sideNav.classList.remove("shrink");
                    p.forEach(p => {
                        p.classList.remove("para");
                    });
                    contenu.classList.add("big");
                    sideNav.classList.remove("sideNavLeft");
                }
                else
                {
                    arrow.classList.remove("fa-arrow-right");
                    arrow.classList.add("fa-arrow-left");
                    sideNav.classList.add("shrink");
                    p.forEach(p => {
                        p.classList.add("para");
                    });
                    contenu.classList.remove("big");
                    sideNav.classList.add("sideNavLeft");
                }
                dropMenus.forEach(menu => {
                    if(menu.classList.contains("dropMenuAppear"))
                    {
                        menu.classList.remove("dropMenuAppear")
                    }
                });
            });
    }
    else
    {
    }
    };

    // url a trouver
    xmlhttpNotif.open("GET", urlNotif  + '/notification.php', true);
    xmlhttpNotif.send();
});
