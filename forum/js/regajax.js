$(document).ready(function(){
			var datatopass;
			var vername=false;
			var veremail=false;
			var verpass=false;
			var vercpass=false;
			$("#name").keyup(function(event){
				newname=event.target.value;
				datatopass="action=checkname&name="+newname;
				$.ajax({
					url: "action/registration.php",
					data: datatopass,
					type: "post",
					dataType: "text",
					success: function(data){
						if(data=="length"){
							$("#name_error").html("*Username should be of atleast 3 characters.");
							$(".name").css("color","red");
							$("#name").css("background","rgba(255,0,0,.2)");
							if(vername==true) vername=false;
						}
						else if(data=="exist"){
							$("#name").css("background","rgba(255,0,0,.2)");
							$(".name").css("color","red");
							$("#name_error").html("*Username already exist.");
							if(vername==true) vername=false;
						}
						else{
							$("#name_error").html("&#10004");
							$(".name").css("color","green");
							$("#name").css("background","rgba(0,255,0,.2)");
							if(vername==false) vername=true;

						}
					}

				});	
			});
			
			$("#email").keyup(function(event){
				email=event.target.value;
				datatopass="action=checkemail&email="+email;
				
				$.ajax({
					url: "action/registration.php",
					data: datatopass,
					type: "post",
					dataType: "text",
					success: function(data){
						if(data=="invalid"){
							$("#email_error").html("*Invalid Email id.");
							$(".email").css("color","red");
							$("#email").css("background","rgba(255,0,0,.2)");
							if(veremail==true) veremail=false;
						}
						else if(data=="exist"){
							$("#email").css("background","rgba(255,0,0,.2)");
							$(".email").css("color","red");
							$("#email_error").html("*Email id already exist.");
							if(veremail==true) veremail=false;
						}
						else{
							$("#email_error").html("&#10004");
							$(".email").css("color","green");
							$("#email").css("background","rgba(0,255,0,.2)");
							if(veremail==false) veremail=true;

						}
					}

				});	
			});
			$("#pass").keyup(function(event){
				pass=event.target.value;
				datatopass="action=checkpass&pass="+pass;
				$("#cpass_error").html("*Does not match");
				$(".cpass").css("color","red");
				$("#cpass").css("background","rgba(255,0,0,.2)");
				$.ajax({
					url: "action/registration.php",
					data: datatopass,
					type: "post",
					dataType: "text",
					success: function(data){
						if(data=="length"){
							$("#pass_error").html("*Password should be of atleast 7 characters.");
							$(".pass").css("color","red");
							$("#pass").css("background","rgba(255,0,0,.2)");
							if(verpass==true) verpass=false;
						}
						else{
							$("#pass_error").html("&#10004");
							$(".pass").css("color","green");
							$("#pass").css("background","rgba(0,255,0,.2)");
							if(verpass==false) verpass=true;
							if($("#pass").val()==$("#cpass").val()){
								$("#cpass_error").html("&#10004");
								$(".cpass").css("color","green");
								$("#cpass").css("background","rgba(0,255,0,.2)");	
								if(vercpass==false) vercpass=true;
								
							}
						}
					}

				});	
			});
			$("#cpass").keyup(function(event){
				cpass=event.target.value;
				datatopass="action=checkmatch&pass="+pass+"&cpass="+cpass;

				$.ajax({
					url: "action/registration.php",
					data: datatopass,
					type: "post",
					dataType: "text",
					success: function(data){
						if(data=="miss"){
							$("#cpass_error").html("*Does not match");
							$(".cpass").css("color","red");
							$("#cpass").css("background","rgba(255,0,0,.2)");
							if(vercpass==true) vercpass=false;
						}
						else{
							$("#cpass_error").html("&#10004");
							$(".cpass").css("color","green");
							$("#cpass").css("background","rgba(0,255,0,.2)");
							if(vercpass==false) vercpass=true;
						}
					}

				});	
			});
			$("#Signup_but").click(function(){
				
				if(!vername){ alert("Error: Username is not acceptable!"); }
				else if(!veremail){ alert("Error: Email id is not acceptable!"); }
				else if(!verpass){ alert("Error:  Password should be of atleast 7 character!"); }
				else if(!vercpass){ alert("Error: Password and confirm password does not match!"); }
				else {
					var data = {
						name: $("#name").val(),
						email: $("#email").val(),
						pass: $("#pass").val()
					};
					$.post("action/register.php",data);
					window.location.assign('redirect.php');
				}
			});
		});
