jQuery(document).ready(function($) {
     $('select').select2();
    
});
function spinner() {
    $('.loader').css({
    	'display': 'block',
    	'z-index': "99999",
      position:"fixed",
	});
    $('#loader').css({
    	display: 'block',
	    width: '100%',
	    height: '100%',
	    background: '#00000047',
	    'z-index': "9999",
      position:"fixed",
    });
}
// window.onload = function () { 
//         document.getElementsByClassName("loader")[0].style.display = "none";
//     }
function show_alert() {
  if(confirm("Confimez-vous cette operation ?")){
    document.forms[0].submit();
   }
  else{
    return false;
  }
}