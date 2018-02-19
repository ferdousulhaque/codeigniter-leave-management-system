function replaceEnterKeyWithTab(){
  if(event.keyCode == 13)//13 is enter key
  {
       alert("test");
	   event.keyCode=9; //return 9 the tab key
  } 
 }
 
 
 	// $(document).ready(function(){
		// $(".tabs > ul").tabs();
	// });
	
	// $(document).ready(function(){
	// $(".tabs > ul").tabs();
	// });
	
	// function preventEnterSubmit(e) {
		// if (e.which == 13) {
			// var $targ = $(e.target);
			// if (!$targ.is("textarea") && !$targ.is(":button,:submit")) {
				// var focusNext = false;
				// $(this).find(":input:visible:not([disabled],[readonly]), a").each(function(){
					// if (this === e.target) {
						// focusNext = true;
					// }
					// else if (focusNext){
						// $(this).focus();
						// return false;
					// }
				// });
				// return false;
			// }
		// }
	// }
	
	
	// function enterToTab(e) {
		// var intKey = window.event ? event.keyCode: e.which;
	 
		// if(intKey == 13){
			// //alert("test");
			// e.cancelBubble = true;
			// e.preventDefault();
			// e.returnValue = false;
			// return false;
		// }
	// }
	
	
	$(function() {
	$('input:text:first').focus();
	var $inp = $('input:text');
	$inp.bind('keydown', function(e) {
	 var key = e.which;
		if (key == 13) {
		e.preventDefault();
		var nextIndex = $('input:text').index(this) + 1;
		var maxIndex = $('input:text').length;
		if (nextIndex < maxIndex) {
		$('input:text:eq(' + nextIndex+')').focus();
		}
		if  (nextIndex == maxIndex ) {
		$('input:submit').focus();
		}
		}
				 
		});
	});
	
	// function convertEnterKey(obj) {
		// var k;
		// if(window.event.which) {
			// k = window.event.which.keyCode;
		// } else {
			// // needed for IE
			// k = window.event.keyCode;
		// }
		// if (k == 13){
			// nextTabIndex = obj.tabIndex + 1;
			// for(i=0;i<document.frmSubmit.elements.length;i++){
				// if(document.frmSubmit.elements(i).tabIndex==nextTabIndex){
					// document.frmSubmit.elements(i).focus();
					// break;
				// }
			// }
		// }
	// }

	// function test(){
		// var file = document.getElementById('flup');
		// var ext = this.value.match(/\.([^\.]+)$/)[1];
		// switch(ext)
		// {
			// case 'mdb':
				// alert('allowed');
				// break;
			// default:
				// alert('not allowed');
				// this.value='';
		// }
	// }
	
	function FocusOnInput()
	 {
		$('input:text:eq(0)').focus();
		//document.getElementById("PasswordInput").focus();
	 }