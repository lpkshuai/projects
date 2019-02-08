(function () {
	
	//场景管理器。这个类的实例在game中只有一个。
	window.SceneManagement = function(){
		//当前场景编号
		this.sceneNumber = 0;
		
		//小计数器（帧数），记录当前场景已经到第几帧
		this.f = 0;
		//自己的管子清单
		this.pipes = [];
	}
	//更换场景
	SceneManagement.prototype.changeScene = function(n){
		//每次更换场景重新记帧
		this.f = 0;
		//更换场景
		this.sceneNumber = n;
		//更换场景的一瞬间做的事情
		if (this.sceneNumber == 0) {
			game.ctx.drawImage(game.Robj["title"], game.canvas.width / 2 - 89, 189);
			//game.ctx.drawImage(game.Robj["tutorial"], game.canvas.width / 2 - 57, 110);
			var self = this;
			//添加场景0的监听

			game.canvas.onmousedown = function(event){
				var mousex = event.offsetX;
				var mousey = event.offsetY;
				if (mousex > game.canvas.width / 2 - 58 && mousex < game.canvas.width / 2 + 58) {
					if (mousey > 340 && mousey < 410) {
						self.changeScene(1);
					}
				}
			}
		}else if(this.sceneNumber == 1){
			//复原鸟
			game.bird = new Bird();
			//清空管子
			this.pipes = [];
			//添加场景1的监听
			game.canvas.onmousedown = function(event){
				game.bird.flyHigh();
			}
		}else if (this.sceneNumber == 2) {
			var self = this;
			game.canvas.onmousedown = function(event){
				self.changeScene(0);
			}
		}
	}
	//渲染当前场景的元素
	SceneManagement.prototype.render = function(){
		//小帧数加一
		this.f ++;
		
		//每个场景要做的事情
		if (this.sceneNumber == 0) {
			//渲染背景
			game.background.render();
			//title的动画，20帧下落，20帧之后停住
			if (this.f < 20) {
				game.ctx.drawImage(game.Robj["title"], game.canvas.width / 2 - 89, this.f*6);
			} else {
				game.ctx.drawImage(game.Robj["title"], game.canvas.width / 2 - 89, 120);
			}
			//游戏说明动画，闪烁动画，从20帧之后出现
			//按钮也是20帧之后出现
			if (this.f > 20) {
				game.ctx.save();
				game.ctx.globalAlpha = this.f % 10 / 10;
				game.ctx.drawImage(game.Robj["tutorial"], game.canvas.width / 2 - 57, 210);
				game.ctx.restore();

				game.ctx.drawImage(game.Robj["button_play"], game.canvas.width / 2 - 58, 340)
			}	
		}else if (this.sceneNumber == 1) {
			//渲染背景
			game.background.update();
			game.background.render();
			//渲染大地
			game.land.update();
			game.land.render();
			//每20帧就创建新管子
			if (game.frameNumber % 100 == 0) {
				this.pipes.push(new Pipe());
			}
			//每帧渲染管子
			_.each(this.pipes,function(pipe){
				pipe.update();
				pipe.render();
			});
			//渲染鸟
			game.bird.update();
			game.bird.render();
			//打印分数
			var weishu = game.score.toString().length;
			for (var i = 0; i < weishu ; i++) {
				//这一位的数字是多少
				var zheyiwei = game.score.toString().charAt(i);
				game.ctx.drawImage(game.Robj["number" + zheyiwei], game.canvas.width / 2 - 15 * weishu + i * 30, 60);
			}
		}else if (this.sceneNumber == 2) {
			//渲染背景
			game.background.render();
			//渲染大地
			game.land.render();
			//每帧渲染管子
			_.each(this.pipes,function(pipe){
				
				pipe.render();
			});
			//渲染鸟
			game.bird.update();
			game.bird.render();

			
			//进行其他动画
			game.ctx.drawImage(game.Robj["game_over"], game.canvas.width / 2 - 102, 100);
			game.ctx.fillText("分数" + game.score, 100, 270);
			//显示文字
			game.ctx.fillText("点击任意地方继续", 100, 300);
			

		}
	}

})();