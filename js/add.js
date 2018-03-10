$("#submit").click(function(){
	$.post($("#myform").attr("action"), $("#myform :input").serializeArray();, function(info){ $(#result).html(info); }); 
});

$("#myform").submit(function(){
	return false;
})
