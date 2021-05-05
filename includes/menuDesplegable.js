$(document).ready(main);

var contador = 1;
function main (){
$('.submenu').click(function(){
    if(contador == 1){
        $('.submenu').animate({
            opacity: '1',
            top: '75px',
            position:'static',
            visibility: 'visible'
        })
    }
});
}

$('.submenu').click(function(){
    $(this).children('.children').slideToggle();
});