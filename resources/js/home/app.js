
window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');

require('bootstrap');

window.ScrollReveal = require("scrollreveal").default;

$(function() {
    ScrollReveal().reveal("#avatarContainer", {
        distance: "50px",
        scale: 0.85
    });
    ScrollReveal().reveal("#introContainer", {
        origin: "left",
        distance: "10px",
        delay: 300,
        useDelay: "once"
    });
    ScrollReveal().reveal("#introButtons", {
        rotate: {
            x: 90
        },
        delay: 600,
        useDelay: "once"
    });
    window.setTimeout(function() {
        ScrollReveal().reveal("#infoCard", {
            duration: 300,
        });
        window.setTimeout(function() {
            ScrollReveal().reveal("#infoArrow", {
                origin: "top",
                distance: "25px"
            });
            ScrollReveal().reveal("#infoTitleEdu, #infoTitleSkill", {
                origin: "top",
                distance: "25px",
                delay: 400,
                useDelay: "once"
            });
            window.setTimeout(function() {
                ScrollReveal().reveal(".data-edu", {
                    origin: "left",
                    distance: "10px",
                    interval: 200,
                });
                ScrollReveal().reveal(".data-skill-p", {
                    rotate: {
                        y: 10,
                        z: 10
                    },
                    interval: 100,
                });
            }, 600);
        }, 200);
        ScrollReveal().reveal("#projectsCard", {
            duration: 300
        });
        window.setTimeout(function() {
            ScrollReveal().reveal("#projectsArrow", {
                origin: "top",
                distance: "25px"
            });
            window.setTimeout(function() {
                ScrollReveal().reveal("#projectsList", {
                    origin: "left",
                    distance: "50px"
                });
                /* ScrollReveal().reveal(".mywork", {
                    reset: true,
                    distance: "50px",
                    origin: "left",
                    interval: 100,
                    beforeReveal: function(el) {
                        $(el).addClass("mywork-opened");
                    }
                }); */
            }, 600);
        }, 200);
        ScrollReveal().reveal(".ads");
    }, 1000);
    $(".mywork .mywork-flex").click(function() {
        const p = $(this).parents(".mywork");
        if (p.hasClass("mywork-open")) {
            p.removeClass("mywork-open");
            p.find(".mywork-content").stop().slideUp(300);
        } else {
            p.addClass("mywork-open");
            p.find(".mywork-content").stop().slideDown(300);
        }
    });
    $("[data-toggle='tooltip'], .data-skill[title]").tooltip();
});
