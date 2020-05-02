require("./redirect");

window.$ = window.jQuery = require('jquery');

require('bootstrap');

window.ScrollReveal = require("scrollreveal").default;

ScrollReveal().reveal("#avatarContainer", {
    distance: "50px",
    scale: 0.85
})

ScrollReveal().reveal("#introContainer", {
    origin: "left",
    distance: "10px",
    delay: 300,
    useDelay: "once"
})

ScrollReveal().reveal("#introButtons", {
    rotate: {
        x: 90
    },
    delay: 600,
    useDelay: "once"
})

window.setTimeout(() => {
    ScrollReveal().reveal("#infoCard", {
        duration: 300,
    })

    window.setTimeout(() => {
        ScrollReveal().reveal("#infoArrow", {
            origin: "top",
            distance: "25px"
        })

        ScrollReveal().reveal("#infoTitleEdu, #infoTitleSkill", {
            origin: "top",
            distance: "25px",
            delay: 400,
            useDelay: "once"
        })

        window.setTimeout(() => {
            ScrollReveal().reveal(".data-edu", {
                origin: "left",
                distance: "10px",
                interval: 200,
            })

            ScrollReveal().reveal(".data-skill-p", {
                rotate: {
                    y: 10,
                    z: 10
                },
                interval: 100,
            })

        }, 600)

    }, 200)

    ScrollReveal().reveal("#projectsCard", {
        duration: 300
    })

    window.setTimeout(function() {
        ScrollReveal().reveal("#projectsArrow", {
            origin: "top",
            distance: "25px"
        })

        window.setTimeout(function() {
            ScrollReveal().reveal("#projectsList", {
                origin: "left",
                distance: "50px"
            })
        }, 600)

    }, 200)

}, 1000)

$(".mywork .mywork-flex").on("click", (event) => {
    const p = $(event.currentTarget).parents(".mywork");
    const works = p.find(".mywork-content");
    if (p.hasClass("mywork-open")) {
        p.removeClass("mywork-open");
        works.stop().slideUp(300);
    } else {
        p.addClass("mywork-open");
        works.stop().slideDown(300);
    }
})

$("[data-toggle='tooltip'], .data-skill[title]").tooltip()
