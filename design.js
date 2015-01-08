$(document).ready(function(){
	$(".select").click(function(){
		var id = $(this).attr('id');
		var selector="."+id; 
		$("#bkpopup").fadeIn(3600);
		$(selector).fadeIn(3600);
		return;
	});
	$("a#popupClose").click(function(){
		var id = $(this).attr('class');
		var selector="."+id; 
		$(selector).fadeOut(1000);
		$("#popup").fadeOut(1000);
		$("#bkpopup").fadeOut(1000);
		return;
	});
	$("#bkpopup").click(function(){
		$("#popup").fadeOut(1000);
		$("#bkpopup").fadeOut(1000);
		return;
	});
});
