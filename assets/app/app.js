import user from "./user.js";
import utility from './utility.js'

var app = {
    init: function(){
        user.init();
    }
}

$(document).ready(function () {
    $('.sidebar-menu').tree();

    app.init(); 
});