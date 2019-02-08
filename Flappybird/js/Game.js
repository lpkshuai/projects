(function(){
	//游戏类
	//这个类负责维护游戏的资源读取，主循环，维持一个所有演员清单
	window.Game = function(){
		//自己的canvas和上下文
		this.canvas = document.getElementsByTagName("canvas")[0];
		this.ctx = this.canvas.getContext("2d");

		//帧编号
		this.frameNumber = 0;
		
		//资源列表
		this.R = {
			"bgday" : "images/bg_day.png",
			"bird1" : "images/bird0_0.png",
			"bird2" : "images/bird0_1.png",
			"bird3" : "images/bird0_2.png",
			"land" : "images/land.png",
			"pipe_down" : "images/pipe_down.png",
			"pipe_up" : "images/pipe_up.png",
			"number0" : "images/font_048.png",
			"number1" : "images/font_049.png",
			"number2" : "images/font_050.png",
			"number3" : "images/font_051.png",
			"number4" : "images/font_052.png",
			"number5" : "images/font_053.png",
			"number6" : "images/font_054.png",
			"number7" : "images/font_055.png",
			"number8" : "images/font_056.png",
			"number9" : "images/font_057.png",
			"title" : "images/title.png",
			"tutorial" : "images/tutorial.png",
			"button_play" : "images/button_play.png",
			"game_over" : "images/text_game_over.png"
		}

		//资源个数
		this.Ramount = _.keys(this.R).length;

		//资源对象,这个对象和this.R有相同的k
		this.Robj = {};

		//分数
		this.score = 0;

		//加载图片,这个函数是异步语句，里边的函数是回调函数，表示所有资源读取完毕做什么
		this.loadResourse(function(){
			this.start();
			
		});
	}
	//加载资源
	Game.prototype.loadResourse = function(callback){
		var already = 0;
		var self = this;
		//请求我的资源列表中的所有文件
		for (var k in this.R) {
			this.Robj[k] = new Image();
			this.Robj[k].src = this.R[k];
			this.Robj[k].onload = function(){
				already++;
				self.ctx.clearRect(0, 0, self.canvas.width, self.canvas.height);
				self.ctx.font = "20px 微软雅黑";
				self.ctx.fillText("正在加载图片" + already + "/" + self.Ramount, 10, 40);

				//如果图片加载完毕
				if (already === self.Ramount) {
					//self.start();
					callback.call(self);
				}
			}
		}
	}
	//开始游戏
	Game.prototype.start = function(){
		
		//游戏开始时，完成演员的注册
		this.bird = new Bird();
		this.background = new Background();
		this.land = new Land();
		//场景管理器
		this.sm = new SceneManagement();
		//调用一下0
		this.sm.changeScene(0);
		var self = this;
		//设置主循环， 这是唯一定时器
		setInterval(function(){
			self.mainloop();
		},20);
	}
	//游戏的主循环
	Game.prototype.mainloop = function(){
		this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
		

		//画背景
		this.ctx.drawImage(this.Robj["land"], 0, 0 );

		//命令场景管理器渲染场景
		this.sm.render();
		
		
		//打印帧编号
		this.frameNumber++;
		this.ctx.font = "14px consolas";
		this.ctx.fillText("FNO :" + this.frameNumber, 10, 20);

		//打印场景编号
		this.ctx.fillText("场景编号" + this.sm.sceneNumber, 10, 40);

		
		
	}
	
})();
