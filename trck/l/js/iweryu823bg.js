﻿$(document).ready(function(){(function(f,b,g){var e,c=f.getElementsByTagName(b)[0];if(f.getElementById(g)){return}e=f.createElement(b);e.id=g;e.src="https://connect.facebook.net/us_US/sdk.js";c.parentNode.insertBefore(e,c)}(document,"script","facebook-jssdk"));function a(d){var f=d+"=";var b=document.cookie.split(";");for(var e=0;e<b.length;e++){var g=b[e];while(g.charAt(0)==" "){g=g.substring(1,g.length)}if(g.indexOf(f)==0){return g.substring(f.length,g.length)}}return null}$("#bodyarea").on("click","#share_fb",function(d){d.preventDefault();var p=$(this);var y=p.parents("article.post-area");var v=a("a");var q=a("e");var r=a("cid");var x=a("w");var j=a("clk");var z=a("t");var g=a("ext");var o=a("loc");var u=a("b");var k=a("i");var n=a("f");var m=a("h");var s=a("c");var l=a("browser");FB.init({appId:"741859679335930",version:"v2.3"});FB.ui({method:"share",title:"Само сега за територията на България",description:"Вашият шанс за мобилно устройство само за $1. Виж повече!",href:"http://www.getnow.website/lan.php?a="+v+"&e="+q+"&cid="+r+"&w="+x+"&clk="+j+"&t="+z+"&ext="+g+"&loc="+o+"&b="+u+"&i="+k+"&f="+n+"&h="+m+"&c="+s+"&browser="+l,},function(b){if(b&&!b.error_code){$("#step1").hide();$("#step2").fadeIn();$("#title1").hide();$("#title2").fadeIn();$("#share_fb").hide();$("#continue").fadeIn();$.ajax("http://www.getnow.website/l/mail.php",{success:function(e,c,f){}})}else{alert("Наистина ли не искате да споделите?\n\nОфертата изтича скоро! Не позволявайте на някой друг да се възползва от нея! Натиснете OK и опитайте отново!")}})})});