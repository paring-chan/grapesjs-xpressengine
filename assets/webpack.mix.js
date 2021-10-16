const mix = require("laravel-mix")
const path = require("path");

mix.js("src/editor/index.js", "editor/js/index.js")

mix.sass("src/editor/index.scss", "dist/editor/css/index.css")

mix.setPublicPath(path.join(__dirname, 'dist')).setResourceRoot('/plugins/grapes_js/assets/dist')
