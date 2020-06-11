require("./redirect");

window.$ = window.jQuery = require("jquery");

require("bootstrap");

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
  ScrollReveal().reveal("[id$='Card']", {
    duration: 300,
  })

  window.setTimeout(() => {
    ScrollReveal().reveal("[id$='Arrow']", {
      origin: "top",
      distance: "25px"
    })
  }, 200)

  window.setTimeout(() => {

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

  window.setTimeout(() => {
    ScrollReveal().reveal(".timeline li", {
      origin: "top",
      distance: "30px",
      interval: 200
    })

  }, 800)

  window.setTimeout(function () {
    ScrollReveal().reveal("#projectsList", {
      origin: "left",
      distance: "50px"
    })
  }, 800)

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
