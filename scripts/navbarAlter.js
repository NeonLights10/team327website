$(document).ready(function(){
    $(window).scroll(function() { // check if scroll event happened
        if ($(document).scrollTop() > 2) { // check if user scrolled more than 50 from top of the browser window
          $("ul.nav").css("background-color", "#000000"); // if yes, then change the color of class "navbar-fixed-top" to white (#f8f8f8)
        } else {
          $("ul.nav").css("background-color", "rgba(25,25,25,.8)"); // if not, change it back to transparent
        }
    });
});

