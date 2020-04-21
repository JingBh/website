const mix = require('laravel-mix');

const publicBase = "../../public/vendor/jingbh/autozp";
mix.setPublicPath(publicBase);

mix.disableNotifications();
mix.version();

mix.extract(["axios", "jquery", "popper.js", "bootstrap"]);

mix.sass("resources/sass/app.scss", "css");

mix.js("resources/js/pages/verify_invite", "js");

mix.js("resources/js/pages/home.js", "js");

mix.copyDirectory("resources/img", publicBase + "/img");
