(function (window) {
	var MyScroll = function (config) {
		var that = this;
		//默认配置项
		defaultConfig = {
			"showBar": true,
			"color": "rgb(10, 116, 218)", //进度条颜色
			"height": "3px", //进度条高度
			"debug": false, //调试模式
			"event": []
		};
		//合并配置项
		var mergeConfig = this.config = this.extend(config, defaultConfig);
		//事件
		this.event = mergeConfig.event;
		//渲染dom
		if (mergeConfig.showBar) {
			this.loadBar();
		}
		this.preHeight = this.getScrollTop();
		this.nextHeight = this.getScrollTop();
		//监听
		var t;
		window.onscroll = function () {
			// 窗口可视范围的高度
			var height = that.getClientHeight(),
				// 窗口滚动条高度
				theight = that.getScrollTop(),
				// 窗口可视范围的高度
				rheight = that.getScrollHeight(),
				// 滚动条距离底部的高度
				bheight = rheight - theight - height;
			var per = (theight / (theight + bheight)).toFixed(4) * 100 + '%';
			if (that.config.showBar) {
				document.getElementById('progressBar').style.width = per;
			}
			if (that.config.debug) {
				document.getElementById('debugShow').innerHTML = '此时浏览器可见区域高度为：' + height + '<br />此时文档内容实际高度为：' + rheight + '<br />此时滚动条距离顶部的高度为：' + theight + '<br />此时滚动条距离底部的高度为：' + bheight;
			}
			that.preHeight = that.nextHeight;
			that.nextHeight = theight;
			that.checkEvent();
		}
	}

	/**以下为公共方法**/
	//extend方法，与$.extend()相同
	MyScroll.prototype.extend = function (p1, p2) {
		var p = (function loop(p1, p2) {
			var p = {}; //返回值
			for (var item in p2) {
				//如果是对象再次递归调用函数
				if (typeof p2[item] === 'object' && p2[item].__proto__ != Array.prototype) {
					p[item] = loop(p1[item], p2[item]);
				} else {
					/**自定义配置项覆盖默认配置**/
					if ((typeof p1) != 'undefined' && (typeof p1[item]) != 'undefined') {
						p[item] = p1[item];
					} else {
						p[item] = p2[item];
					}
				}
			}
			return p;
		})(p1, p2);
		return p;
	};
	//获取窗口可视范围的高度
	MyScroll.prototype.getClientHeight = function () {
		var clientHeight = 0;
		if (document.body.clientHeight && document.documentElement.clientHeight) {
			var clientHeight = (document.body.clientHeight < document.documentElement.clientHeight) ? document.body.clientHeight : document.documentElement.clientHeight;
		} else {
			var clientHeight = (document.body.clientHeight > document.documentElement.clientHeight) ? document.body.clientHeight : document.documentElement.clientHeight;
		}
		return clientHeight;
	};
	//窗口滚动条高度
	MyScroll.prototype.getScrollTop = function () {
		var scrollTop = 0;
		if (document.documentElement && document.documentElement.scrollTop) {
			scrollTop = document.documentElement.scrollTop;
		} else if (document.body) {
			scrollTop = document.body.scrollTop;
		}
		return scrollTop;
	};
	//窗口可视范围的高度
	MyScroll.prototype.getScrollHeight = function () {
		return Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
	};
	//渲染dom
	MyScroll.prototype.loadBar = function () {
		var config = this.config;
		var style = 'position: fixed;top: 0px;left: 0px;'
		style += 'background-color: ' + config.color + ';height: ' + config.height;
		var dom = '<div id="progressBar" style="' + style + '"></div>';
		document.write(dom);
		//调试模式
		if (config.debug) {
			this.loadDebug();
		}
	};
	//渲染调试dom
	MyScroll.prototype.loadDebug = function () {
		var dom = '<div id="debugShow" style="position: fixed;bottom:50px;background:rgba(0,0,0,0.7);border-radius:5px;padding:20px;color:#fff">⚝</div>';
		document.write(dom);
	};
	//执行触发的事件
	MyScroll.prototype.checkEvent = function () {
		event = this.event;
		if (!isEmpty(event)) {
			//筛选符合条件的事件
			this.filterEvent();
		}
	};
	//筛选
	MyScroll.prototype.filterEvent = function () {
		event = this.event; //配置对象
		var preHeight = this.preHeight;
		var nextHeight = this.nextHeight;
		for (var e in event) {
			var value = event[e];
			var index = (value.height || '0').indexOf("px");
			var type = value.type ? value.type : 'up-down'; //获取类型
			var height = 0;
			var totalHeight = 0;
			if (index != -1) {
				//高度为px
				height = value.height.substring(0, index);
			} else {
				//高度为百分比 总高度
				totalHeight = this.getScrollHeight() - this.getClientHeight();
			}
			var isConfirm = false;
			if (value.el) {
				if (isInViewPort(value.el, height)) {
					isConfirm = true;
				}
			} else {
				if (type == "up-down" || type == "all") {
					if (height && preHeight < height && nextHeight >= height) {
						isConfirm = true;
					} else if (totalHeight && (preHeight / totalHeight).toFixed(2) < toPoint(value.height) && (nextHeight / totalHeight).toFixed(2) >= toPoint(value.height)) {
						isConfirm = true;
					}
				}
				if (type == "down-up" || type == "all") {
					if (height && preHeight > height && nextHeight <= height) {
						isConfirm = true;
					} else if (totalHeight && (preHeight / totalHeight).toFixed(2) > toPoint(value.height) && (nextHeight / totalHeight).toFixed(2) <= toPoint(value.height)) {
						isConfirm = true;
					}
				}
			}
			if (isConfirm) {
				value.func();
				if (!value.loop) {
					delete this.event[e];
				}
			}
		}
	};
	//判断数组是否为{}或null 空返回true
	function isEmpty(obj) {
		for (var name in obj) {
			return false;
		}
		return true;
	};
	//百分比转小数
	function toPoint(percent) {
		var str = percent.replace("%", "");
		str = str / 100;
		return str;
	}
	//是否可是窗口能看到(仅支持从上到下滚动)
	//el: 目标元素
	//height: 与目标元素距离 正数=>距离目标元素下方指定距离时触发 负数=>距离目标元素上方指定距离时触发
	function isInViewPort(el, height) {
		el = getSelector(el);
		const viewPortHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight
		const top = el.getBoundingClientRect() && el.getBoundingClientRect().top
		return top <= viewPortHeight - height
	}
	//获取selector
	function getSelector(el) {
		if (el instanceof Node) {
			return el;
		} else if (typeof el == 'string') {
			return document.querySelector(el);
		} else {
			console.warn("[MyScroll] warn Invalid element", el)
		}
	}

	window.MyScroll = MyScroll;
})(window)