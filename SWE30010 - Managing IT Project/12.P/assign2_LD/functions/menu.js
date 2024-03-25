//handle the responsive menu
//display menu as a dropdown list when click on Hamburger icon

$(document).ready(function(){
    $('.menu-toggle').click(function(){
        $('.menu-toggle').toggleClass('active')
        $('nav').toggleClass('active')
    })
})