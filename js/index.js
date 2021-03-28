import * as _ from 'lodash';
import '../scss/styles.scss';
import * as $ from 'jquery';

// jQuery event listener functions go in here
$("document").ready(function(){

    $( "#navbutton" ).on( "click", function() {
        $('#verticalnav').toggleClass('show');
    });

});

window.onscroll =  function() {display_nav()};

function display_nav(){
    if (document.body.scrollTop > 65 || document.documentElement.scrollTop > 65){
        document.getElementById("verticalnav").className = "visible";
    } else {
        document.getElementById("verticalnav").className = "";
    }
}


// A bit of code I found on stackoverflow that makes buttons unfocus after you press them. Handy!
document.addEventListener('click', function(e) { if(document.activeElement.toString() == '[object HTMLButtonElement]'){ document.activeElement.blur(); } });