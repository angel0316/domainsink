function DisableExitTraffic(){PreventExitSplash=!0}function addLoadEvent(e){var t=window.onload;window.onload="function"!=typeof window.onload?e:function(){t&&t(),e()}}function addClickEvent(e,t,i){"function"!=typeof e[t].onclick&&(e[t].onclick=i)}function DisplayExitSplash(){return 0==PreventExitSplash?(window.scrollTo(0,0),is_chrome||window.alert(exittraffic_splashalertmessage),PreventExitSplash=!0,is_chrome?timeout_variable=setTimeout("exittraffic_change_url();",1e3):document.location.href=exittraffic_RedirectUrl,exittraffic_splashalertmessage):void 0}function exittraffic_change_url(){disable_confirmation=!0,clearTimeout(timeout_variable),document.location.href=exittraffic_RedirectUrl}var is_chrome=navigator.userAgent.toLowerCase().indexOf("chrome")>-1;theBody=document.body,theBody||(theBody=document.getElementById("body"),theBody||(theBody=document.getElementsByTagName("body")[0]));for(var PreventExitSplash=!1,LightwindowOpening=!1,a=document.getElementsByTagName("A"),i=0;i<a.length;i++)"_blank"!==a[i].target?addClickEvent(a,i,function(){PreventExitSplash=!0}):addClickEvent(a,i,function(){PreventExitSplash=!1});disablelinksfunc=function(){for(var e=document.getElementsByTagName("A"),t=0;t<e.length;t++)"_blank"!==e[t].target?addClickEvent(e,t,function(){PreventExitSplash=!0}):addClickEvent(e,t,function(){PreventExitSplash=!1})},addLoadEvent(disablelinksfunc),disableformsfunc=function(){for(var e=document.getElementsByTagName("form"),t=0;t<e.length;t++)e[t].onclick?e[t].onsubmit||(e[t].onsubmit=function(){PreventExitSplash=!0}):e[t].onclick=function(){0==LightwindowOpening&&(PreventExitSplash=!0)}},addLoadEvent(disableformsfunc),window.onbeforeunload=DisplayExitSplash;