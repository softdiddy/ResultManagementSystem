function signIn(){
	
	document.getElementById("error").style.width = "100%";
	//document.getElementById("myNav").style.width = "100%";
	var uname=document.getElementById("un").value;
	var pass=document.getElementById("pass").value;
	var token="login";
    var dataString = 'uname=' + uname + '&pass=' + pass + '&token=' + token;
    
if($.trim(uname).length >0 && $.trim(pass).length >0)
{
	$.ajax({
type: "POST",
url: "php/loginscript.php",
data: dataString,
cache: false,
success: function(data){
	
	if(data=="1"){
	$("body").load("dashboard.php").hide().fadeIn(1500).delay(6000);
//or

window.location.href = "dashboard.php";	

	}else{
		document.getElementById("error").innerHTML='<div class="alert alert-danger" role="alert" style="top:20px;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>Invalid username or password</div>';		
		//document.getElementById("myNav").style.width = "0%";
		$('#error').fadeIn('fast').delay(1000).fadeOut('fast');
	}
	
}
});
}else{
	document.getElementById("error").innerHTML='<p style="color:red;">Error: Enter Username and Password</p>';
	document.getElementById("myNav").style.width = "0%";
	$('#error').fadeIn('fast').delay(1000).fadeOut('fast');
	
}
}


function resetPassword(){
  
	document.getElementById("error").innerHTML='<p style="color:red;">Plese Wait...</p>';

	var uname=document.getElementById("un").value;
	var token="resetpassword";
    var dataString = 'uname=' + uname + '&token=' + token;
if($.trim(uname).length > 0 )
{
	$.ajax({
type: "POST",
url: "php/ResetPawword.php",
data: dataString,
cache: false,
success: function(data){
	document.getElementById("error").innerHTML=data;	
}
});
}else{
	document.getElementById("error").innerHTML='<p style="color:red;">Error: Enter Username</p>';
	
}
}



function staff_logout(){
    var token="logout";
    var dataString = 'token=' + token;
	$.ajax({
type: "POST",
url: "php/loginscript.php",
data: dataString,
cache: false,
success: function(data){
	if(data=="1"){
	$("body").load("desktop.php").hide().fadeIn(1500).delay(6000);
//or

window.location.href = "index.php";	

	}
}
});

}
