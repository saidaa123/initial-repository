function checkuser(){emailvalid=!0,""!=$("#emailid").val()&&regexp.test($("#emailid").val())&&($("#erremail").addClass("hidden"),$.get("checkuser.php",{action:"checkemail",email:$("#emailid").val()},function(e){0==e?($("#regfail").removeClass("hidden").show(),emailvalid=!1):$("#regfail").hide()}))}function validate(){return valid=!0,""==$("#upasswd").val()||$("#upasswd").val().length<6?(valid=!1,$("#upasswd").attr("placeholder","Create Password").css("border-color","#f00")):$("#errupwd").html(""),""!=$("#emailid").val()&&regexp.test($("#emailid").val())?$("#erremail").html(""):(valid=!1,$("#emailid").attr("placeholder","Enter Email ID").css("border-color","#f00")),0==$("#agreement").prop("checked")?(valid=!1,$("#errterms").css("color","#f00")):$("#errterms").css("color","#000"),0==emailvalid&&$("#invemail").html("User Already Exists, Pls Login!"),valid&&emailvalid}function validateLogin(){valid=!0,""!=$("#userid").val()&&regexp.test($("#userid").val())?$("#errluname").html(""):(valid=!1,$("#userid").attr("placeholder","Enter Email ID").css("border-color","#f00")),""==$("#passwd").val()||$("#passwd").val().length<6?(valid=!1,$("#passwd").attr("placeholder","Enter Password").css("border-color","#f00")):$("#errlupwd").html(""),valid&&($("#preloader_login").removeClass("hidden").show(),$.post("ajax_login.php",$("#loginform").serialize(),function(e){$("#preloader_login").hide(),"0"==e||"-1"==e?(++failed_login_attempts,$("#result_login").html("Invalid Email ID or Password").removeClass("hidden").show(),failed_login_attempts>1&&($("#result_login,#fgtp").hide(),$("#loginhelp").removeClass("hidden").show())):"2"==e?$("#result_login").html("You registered at Tuitionroom.com via FB/GMail. Please login with FB/Gmail to continue.").removeClass("hidden").show():($("#result_login,#loginhelp").hide(),location.href=e)}))}function validateFGP(){valid=!0,""!=$("#fgpuserid").val()&&regexp.test($("#fgpuserid").val())?($("#erruname").html(""),$("#fgpwderr").css("padding-top","100px")):(valid=!1,$("#erruname").html("Enter Valid Email ID"),$("#fgpwderr").css("padding-top","180px")),valid&&($("#preloader").removeClass("hidden").show("slow"),$.post("checknsendpassword.php",{userid:$("#fgpuserid").val()},function(e){$("#fgpwderr").css("padding-top","180px"),$("#preloader").addClass("hidden").hide("fast"),"1"==e?$("#result").html("Your password is send to your Email Id. Thank You.").removeClass("hidden"):$("#result").html("Unknown User. Enter Valid User Id").removeClass("hidden"),$("#fgpuserid").val("")}))}function selectUser(e){$("#teacher_user,#student_user").addClass("checkboximg"),$("#recform").removeClass("hide").show(),$("#accept").val(e),"Student"==e?($("#studnt").removeClass("hide").show(),$("#techr").hide()):($("#techr").removeClass("hide").show(),$("#studnt").hide())}$(document).ready(function(){var e=$("[data-toggle=collapse-side]"),a=e.attr("data-target"),l=e.attr("data-target-2");e.click(function(e){$(a).toggleClass("in"),$(l).toggleClass("out")})});var signup_hidden=!0;$(document).ready(function(){if($.get("ajax_featured_teachers.php",null,function(e){$("#fteachers").html(e)}),$("#regform").bind("submit",validate),$("#emailid").bind("blur",checkuser),$("#loginform").bind("submit",function(){return validateLogin(),!1}),$("#fgpwdform").bind("submit",function(){return validateFGP(),!1}),$("#userid,#passwd,#upasswd,#emailid").bind("keypress",function(){$(this).css("border","1px solid #ccc")}),""!=location.search){var e=location.search.split("&");2==e.length?($("#plan").val(e[0].split("=")[1]),"T"==e[1].split("=")[1]?$("#utype1").prop("checked","checked"):$("#utype2").prop("checked","checked")):(e=location.search,$("#utype2").prop("checked","checked"),$("#redirect").val(e.split("=")[1]))}else $("#utype2").prop("checked","checked")});var emailvalid,valid,regexp=new RegExp(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/),failed_login_attempts=0;