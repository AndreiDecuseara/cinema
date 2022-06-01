import $ from "jquery";
window.jQuery = window.$ = $;
import Alpine from 'alpinejs'
window.Alpine = Alpine
import persist from '@alpinejs/persist'

require("./custom");

Alpine.plugin(persist)
Alpine.start();
