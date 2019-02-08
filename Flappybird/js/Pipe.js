(function(){
	window.Pipe = function(){
		// 自己的图片
		this.image1 = game.Robj["pipe_down"];
		this.image2 = game.Robj["pipe_up"];

		this.kaikou = 120;
		//随机一个高度，这里的高度指的是上管子的高度
		this.height1 = _.random(100,300);
		this.height2 = 400 - this.kaikou - this.height1;

		//自己的X值
		this.x = 300;

		//已经通过的管子
		this.alreadyPass = false;

		
	}
	//更新，这个方法每帧执行
	Pipe.prototype.update = function() {
		this.x -= 2;
		//如果自己出屏幕，自杀
		if (this.x < -52) {
			
			game.sm.pipes = _.without(game.sm.pipes,this);
		}
		

		//碰撞检测,四个数就可以检测小鸟是否撞到上管子
		if ((this.x < game.bird.x + 7 + 28) && (this.height1 > game.bird.y + 7) && (this.x > game.bird.x - 48)) {
			game.sm.changeScene(2);
		}else if ((this.x < game.bird.x + 7 + 28) && (400 - this.height2 < game.bird.y + 7 + 28) && (this.x > game.bird.x - 48)) {
			game.sm.changeScene(2);
		}

		//加分检测
		if (!this.alreadyPass && (this.x + 52 < game.bird.x)) {
			this.alreadyPass = true;
			game.score ++;
		}

	};
	//渲染，这个方法每帧执行
	Pipe.prototype.render = function() {
		//渲染图片,在渲染一张猫腻图片
		game.ctx.drawImage(this.image1, 0, 320 - this.height1, 52, this.height1, this.x, 0, 52, this.height1);
		game.ctx.drawImage(this.image2, 0, 0, 52, this.height2, this.x, 400 - this.height2, 52, this.height2);
		
	};
})();