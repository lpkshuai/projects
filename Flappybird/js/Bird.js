(function(){
	window.Bird = function(){
		//图片序列
		this.imageArr = [game.Robj["bird1"],game.Robj["bird2"],game.Robj["bird3"]];
		//翅膀状态，1，2，3
		this.wing = 0;
		//位置
		this.x = game.canvas.width / 3;
		this.y = 100;
		//内部计时器
		this.f = 0;
		//角度
		this.angle = 0;
		//有限状态机，就是信号量
		this.state = "A";//A下落B上升
		
	
	}
	Bird.prototype.flyHigh = function(){
		this.state = "B";
		//计数器清零
		this.f = 0;
	}
	//更新，这个方法每帧执行
	Bird.prototype.update = function() {
		if (game.sm.sceneNumber == 2) {
			this.y += 10;
			if (this.y >= 360) {
				this.y = 360;
			}
			return;
		}
		if (game.frameNumber % 10 == 0) {
		 	this.wing = ++this.wing % 3;
		 }
		 if (this.state == "A") {
		 	//计数
			this.f ++;
			//下落,除的数越大，下落越慢
			this.y += Math.pow(this.f, 2) / 20;
			//下落旋转,除的数越小旋转越快
			this.angle = this.f / 20;
		 }else if(this.state == "B"){
		 	//可以自定义上飞的帧数
		 	this.f ++;
		 	//上升，上升时第一时间变化量最大，到自定义（此处25帧）时变化量为零
		 	//除的数越大，跳的高度越小
		 	this.y -= Math.pow((25-this.f), 2) / 80;
		 	//鸟头朝上
		 	this.angle = -(25 - this.f) / 30;
		 	if (this.f > 25) {
		 		this.state = "A";
		 		this.f = 0;
		 	}
		 }
		 //判定坠毁
		 if (this.y > 300) {
		 	game.sm.changeScene(2);
		 }
	};
	//渲染，这个方法每帧执行
	Bird.prototype.render = function() {
		//备份
		game.ctx.save();
		//先translate，把坐标原点移动到鸟的中心
		game.ctx.translate(this.x + 24, this.y + 24);
		game.ctx.rotate(this.angle);
		game.ctx.drawImage(this.imageArr[this.wing], -24, -24);
		
		//恢复
		game.ctx.restore();
	};
})();