var dropList1 = document.getElementById('drop_list1');

var navbars = document.getElementById('navbarlist').getElementsByTagName("li");


function showList () {
	for (var i = 0; i <= navbars.length; i++) {
		var nav = navbars[i];
		nav.onmouseover = function () {
			dropList1.style.display = "block";
			// dropList1.style.visibility = "visible";
			dropList1.style.animation = "show";
			
			
		}
		nav.onmouseout = function () {
			dropList1.style.display = "none";
			// dropList1.style.visibility = 'hidden';
		}
	}
	
}
window.onload = showList;