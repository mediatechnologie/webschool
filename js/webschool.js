// General webkit javascript

$(document).ready(function() {
	$("header #headertoggle").mouseover(function()
	{
		var vlak = 'header';
		var nummer = Math.floor(Math.random()*6) + 1;
		var kleuren = new Array("#330066", "#660000", "#006600", "#006666", "#666600", "#663300", "#560066");
	
		$(vlak).css("background-color", kleuren[nummer]);
	});
	
	$("#headertoggle").click(function () {
		$("header #logo").slideToggle("slow");
	});
	
	$(".box h3").click(function () {
		$(this).parent().find(".boxcontent").slideToggle("slow");
	});
	
	$(".noticifation").click(function () {
		$(this).fadeOut("slow");
	});
	
	
	$(".box table").tablesorter(); 
});