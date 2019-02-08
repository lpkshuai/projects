	//我的京东显示隐藏
	function showDiv () {
		var alllist = document.getElementById("lis1");
		alllist.style.display = "block";
		var ljd = document.getElementById("l_myjd");
		ljd.style.backgroundColor = "#fff";
		ljd.className = 'border';

	}
	function hideDiv () {
		var alllist = document.getElementById("lis1");
		alllist.style.display = "none"; 
		var ljd = document.getElementById("l_myjd");
		ljd.style.background = "#e3e4e5";
		ljd.className = '';
	}
	//显示隐藏商品列表
	var lis = document.getElementById('grid_c1');
	var lis1 = lis.getElementsByTagName('li')[0];
	var box1 = document.getElementById('grid_c1_hide');
	lis1.onmouseover = function () {		
		box1.style.display = 'block';
	}
	lis1.onmouseout = function () {		
		box1.style.display = 'none';
	}
	box1.onmouseover = function () {		
		box1.style.display = 'block';
		lis1.className = "bg";
	}
	box1.onmouseout = function () {		
		box1.style.display = 'none';
		lis1.className = "";
	}
	//促销公告tab
	var title1 = document.getElementById('news_t_1');
	var title2 = document.getElementById('news_t_2');
	var news1 = document.getElementById('news_b_1');
	var news2 = document.getElementById('news_b_2');
	var line1 = document.getElementById('underline1');
	var line2 = document.getElementById('underline2');
	title1.onmouseover = function () {
		news1.style.display = 'block';
		news2.style.display = 'none';
		line1.className = 'underline';
		line2.className = '';
	}
	title1.onmouseout = function () {
		line1.className = 'underline';
	}
	title2.onmouseover = function () {
		news1.style.display = 'none';
		news2.style.display = 'block';
		line2.className = 'underline';
		line1.className = '';
	}
	title2.onmouseout = function () {
		line2.className = 'underline';
	}
	//轮播图
	var imgBox = document.getElementById('grid_c2_l');
	var img = document.getElementById('img');
	var circles = document.getElementById('circle').getElementsByTagName('li');
	var arrowl = document.getElementById('arrow_l');
	var arrowr = document.getElementById('arrow_r');
	    //当前显示图片
	var currentPage = 0;
	circles[0].style.backgroundColor = '#fff';
	var timer = setInterval(scrollMove, 3000);
	function scrollMove () {
		currentPage++;
		if (currentPage == 8) {
			currentPage = 0;
		}
		img.src = 'images/' + currentPage + '.jpg';
		for (var i = 0; i < circles.length; i++) {
			circles[i].style.backgroundColor = '';
		}
		circles[currentPage].style.backgroundColor = '#fff';

	}
	imgBox.onmouseover = function () {
		clearInterval(timer);
		arrowl.style.display = 'block';
		arrowr.style.display = 'block';
	};
	imgBox.onmouseout = function () {
		timer = setInterval(scrollMove, 3000);
		arrowl.style.display = 'none';
		arrowr.style.display = 'none';
	};
	arrowl.onclick = function () {
		currentPage--;
		if (currentPage == -1) {
			currentPage = 7;
		}
		img.src = 'images/' + currentPage + '.jpg';
		for (var i = 0; i < circles.length; i++) {
			circles[i].style.backgroundColor = '';
		}
		circles[currentPage].style.backgroundColor = '#fff';
	};
	arrowr.onclick = function () {
		currentPage++;
		if (currentPage == 8) {
			currentPage = 0;
		}
		img.src = 'images/' + currentPage + '.jpg';
		for (var i = 0; i < circles.length; i++) {
			circles[i].style.backgroundColor = '';
		}
		circles[currentPage].style.backgroundColor = '#fff';
	};
	for (var i = 0; i < circles.length; i++) {	
		circles[i].onmouseover = function () {
			//圆点内有透明颜色的序号，通过序号确定经过具体哪个圆点。
			currentPage = parseInt(this.innerHTML) - 1;
			// console.log(currentPage);
			img.src = 'images/' + currentPage + '.jpg';
			for (var i = 0; i < circles.length; i++) {
				circles[i].style.backgroundColor = '';
			}
			circles[currentPage].style.backgroundColor = '#fff';
		};
	}

	
	
	