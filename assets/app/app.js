import employe from "./employe.js";
import user from "./user.js";

var app = {
    init: function(){
        user.init();
        employe.init();
    }
}

$(document).ready(function () {
    $('.sidebar-menu').tree();

    app.init(); 
});