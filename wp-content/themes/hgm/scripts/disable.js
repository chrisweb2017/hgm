jQuery(document).ready(function($){
	console.log("Disabling inputs...");
	$(".inputLock").each(function(){
		$(this).find('input').prop('disabled',true);
	});
});