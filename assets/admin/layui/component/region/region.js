/*
 * @Name: layui.region
 * @Author: Raven
 * @Date: 2019-09-22 22:49:36
 * @Last Modified by: Raven
 * @Last Modified time: 2019-09-30 18:31:01
 */

;!function(){
	"use strict";

	var isLayui = window.layui && layui.define,
	ready = {
	  getPath: function(){
		var jsPath = document.currentScript ? document.currentScript.src : function(){
		  var js = document.scripts
		  ,last = js.length - 1
		  ,src;
		  for(var i = last; i > 0; i--){
			if(js[i].readyState === 'interactive'){
			  src = js[i].src;
			  break;
			}
		  }
		  return src || js[last].src;
		}();
		return jsPath.substring(0, jsPath.lastIndexOf('/') + 1);
	  }()

	  //获取节点的style属性值
	  ,getStyle: function(node, name){
		var style = node.currentStyle ? node.currentStyle : window.getComputedStyle(node, null);
		return style[style.getPropertyValue ? 'getPropertyValue' : 'getAttribute'](name);
	  }

	  //载入CSS配件
	  ,link: function(href, fn, cssname){

		//未设置路径，则不主动加载css
		if(!layregion.path) return;

		var head = document.getElementsByTagName("head")[0], link = document.createElement('link');
		if(typeof fn === 'string') cssname = fn;
		var app = (cssname || href).replace(/\.|\//g, '');
		var id = 'layuicss-'+ app, timeout = 0;

		link.rel = 'stylesheet';
		link.href = layregion.path + href;
		link.id = id;

		if(!document.getElementById(id)){
		  head.appendChild(link);
		}

		if(typeof fn !== 'function') return;

		//轮询css是否加载完毕
		(function poll() {
		  if(++timeout > 8 * 1000 / 100){
			return window.console && console.error('region.css: Invalid');
		  };
		  parseInt(ready.getStyle(document.getElementById(id), 'width')) === 1989 ? fn() : setTimeout(poll, 100);
		}());
	  }
	}

	,layregion = {
	  v: '0.0.1'
	  ,config: {} //全局配置项
	  ,index: (window.layregion && window.layregion.v) ? 100000 : 0
	  ,path: ready.getPath

	  //设置全局项
	  ,set: function(options){
		var that = this;
		that.config = lay.extend({}, that.config, options);
		return that;
	  }

	  //主体CSS等待事件
	  ,ready: function(fn){
		var cssname = 'layregion', ver = ''
		,path = 'region.css?v='+ layregion.v + ver;
		ready.link(path, fn, cssname);
		return this;
	  }
	}

	//操作当前实例
	,thisRegion = function(){
	  var that = this;
	  return {
		//提示框
		hint: function(content){
		  that.hint.call(that, content);
		}
		,config: that.config
	  };
	}

	//字符常量
	,MOD_NAME = 'layregion', ELEM = '.layui-layregion', THIS = 'layui-this', SHOW = 'layui-show', HIDE = 'layui-hide', DISABLED = 'layregion-disabled', TIPS_OUT = '开始日期超出了结束日期<br>建议重新选择', LIMIT_YEAR = [100, 200000]

	,ELEM_STATIC = 'layui-layregion-static', ELEM_LIST = 'layui-layregion-list', ELEM_SELECTED = 'layregion-selected', ELEM_HINT = 'layui-layregion-hint', ELEM_PREV = 'layregion-day-prev', ELEM_NEXT = 'layregion-day-next', ELEM_FOOTER = 'layui-layregion-footer', ELEM_CONFIRM = '.layregion-btns-confirm', ELEM_TIME_TEXT = 'layregion-time-text', ELEM_TIME_BTN = '.layregion-btns-time'

	//组件构造器
	,Class = function(options){
	  var that = this;
	  that.index = ++layregion.index;
	  that.config = lay.extend({}, that.config, layregion.config, options);
	  layregion.ready(function(){
		that.init();
	  });
	}

	//DOM查找
	,lay = function(selector){
	  return new LAY(selector);
	}

	//DOM构造器
	,LAY = function(selector){
	  var index = 0
	  ,nativeDOM = typeof selector === 'object' ? [selector] : (
		this.selector = selector
		,document.querySelectorAll(selector || null)
	  );
	  for(; index < nativeDOM.length; index++){
		this.push(nativeDOM[index]);
	  }
	};


	/*
	  lay对象操作
	*/

	LAY.prototype = [];
	LAY.prototype.constructor = LAY;

	//普通对象深度扩展
	lay.extend = function(){
	  var ai = 1, args = arguments
	  ,clone = function(target, obj){
		target = target || (obj.constructor === Array ? [] : {});
		for(var i in obj){
		  //如果值为对象，则进入递归，继续深度合并
		  target[i] = (obj[i] && (obj[i].constructor === Object))
			? clone(target[i], obj[i])
		  : obj[i];
		}
		return target;
	  }

	  args[0] = typeof args[0] === 'object' ? args[0] : {};

	  for(; ai < args.length; ai++){
		if(typeof args[ai] === 'object'){
		  clone(args[0], args[ai])
		}
	  }
	  return args[0];
	};

	//ie版本
	lay.ie = function(){
	  var agent = navigator.userAgent.toLowerCase();
	  return (!!window.ActiveXObject || "ActiveXObject" in window) ? (
		(agent.match(/msie\s(\d+)/) || [])[1] || '11' //由于ie11并没有msie的标识
	  ) : false;
	}();

	//中止冒泡
	lay.stope = function(e){
	  e = e || window.event;
	  e.stopPropagation
		? e.stopPropagation()
	  : e.cancelBubble = true;
	};

	//对象遍历
	lay.each = function(obj, fn){
	  var key
	  ,that = this;
	  if(typeof fn !== 'function') return that;
	  obj = obj || [];
	  if(obj.constructor === Object){
		for(key in obj){
		  if(fn.call(obj[key], key, obj[key])) break;
		}
	  } else {
		for(key = 0; key < obj.length; key++){
		  if(fn.call(obj[key], key, obj[key])) break;
		}
	  }
	  return that;
	};

	//创建元素
	lay.elem = function(elemName, attr){
	  var elem = document.createElement(elemName);
	  lay.each(attr || {}, function(key, value){
		elem.setAttribute(key, value);
	  });
	  return elem;
	};

	//追加字符
	LAY.addStr = function(str, new_str){
	  str = str.replace(/\s+/, ' ');
	  new_str = new_str.replace(/\s+/, ' ').split(' ');
	  lay.each(new_str, function(ii, item){
		if(!new RegExp('\\b'+ item + '\\b').test(str)){
		  str = str + ' ' + item;
		}
	  });
	  return str.replace(/^\s|\s$/, '');
	};

	//移除值
	LAY.removeStr = function(str, new_str){
	  str = str.replace(/\s+/, ' ');
	  new_str = new_str.replace(/\s+/, ' ').split(' ');
	  lay.each(new_str, function(ii, item){
		var exp = new RegExp('\\b'+ item + '\\b')
		if(exp.test(str)){
		  str = str.replace(exp, '');
		}
	  });
	  return str.replace(/\s+/, ' ').replace(/^\s|\s$/, '');
	};

	//查找子元素
	LAY.prototype.find = function(selector){
	  var that = this;
	  var index = 0, arr = []
	  ,isObject = typeof selector === 'object';

	  this.each(function(i, item){
		var nativeDOM = isObject ? [selector] : item.querySelectorAll(selector || null);
		for(; index < nativeDOM.length; index++){
		  arr.push(nativeDOM[index]);
		}
		that.shift();
	  });

	  if(!isObject){
		that.selector =  (that.selector ? that.selector + ' ' : '') + selector
	  }

	  lay.each(arr, function(i, item){
		that.push(item);
	  });

	  return that;
	};

	//DOM遍历
	LAY.prototype.each = function(fn){
	  return lay.each.call(this, this, fn);
	};

	//添加css类
	LAY.prototype.addClass = function(className, type){
	  return this.each(function(index, item){
		item.className = LAY[type ? 'removeStr' : 'addStr'](item.className, className)
	  });
	};

	//移除css类
	LAY.prototype.removeClass = function(className){
	  return this.addClass(className, true);
	};

	//是否包含css类
	LAY.prototype.hasClass = function(className){
	  var has = false;
	  this.each(function(index, item){
		if(new RegExp('\\b'+ className +'\\b').test(item.className)){
		  has = true;
		}
	  });
	  return has;
	};

	//添加或获取属性
	LAY.prototype.attr = function(key, value){
	  var that = this;
	  return value === undefined ? function(){
		if(that.length > 0) return that[0].getAttribute(key);
	  }() : that.each(function(index, item){
		item.setAttribute(key, value);
	  });
	};

	//移除属性
	LAY.prototype.removeAttr = function(key){
	  return this.each(function(index, item){
		item.removeAttribute(key);
	  });
	};

	//设置HTML内容
	LAY.prototype.html = function(html){
	  return this.each(function(index, item){
		item.innerHTML = html;
	  });
	};

	//设置值
	LAY.prototype.val = function(value){
	  return this.each(function(index, item){
		  item.value = value;
	  });
	};

	//追加内容
	LAY.prototype.append = function(elem){
	  return this.each(function(index, item){
		typeof elem === 'object'
		  ? item.appendChild(elem)
		:  item.innerHTML = item.innerHTML + elem;
	  });
	};

	//移除内容
	LAY.prototype.remove = function(elem){
	  return this.each(function(index, item){
		elem ? item.removeChild(elem) : item.parentNode.removeChild(item);
	  });
	};

	//事件绑定
	LAY.prototype.on = function(eventName, fn){
	  return this.each(function(index, item){
		item.attachEvent ? item.attachEvent('on' + eventName, function(e){
		  e.target = e.srcElement;
		  fn.call(item, e);
		}) : item.addEventListener(eventName, fn, false);
	  });
	};

	//解除事件
	LAY.prototype.off = function(eventName, fn){
	  return this.each(function(index, item){
		item.detachEvent
		  ? item.detachEvent('on'+ eventName, fn)
		: item.removeEventListener(eventName, fn, false);
	  });
	};


	/*
	  组件操作
	*/

	//默认配置
	Class.prototype.config = {
	  value: '' //默认
	  ,isInitValue: true //用于控制是否自动向元素填充初始值（需配合 value 参数使用）
	  ,trigger: 'focus' //呼出控件的事件
	  ,show: false //是否直接显示，如果设置true，则默认直接显示控件
	  ,position: null //控件定位方式定位, 默认absolute，支持：fixed/absolute/static
	  ,zIndex: null //控件层叠顺序
	  ,done: null //控件选择完毕后的回调
	  ,change: null //值改变后的回调
	  ,source: []
	  ,dataAll: {}
	  ,pid: 0
	};

	//初始准备
	Class.prototype.init = function(){
	  var that = this
	  ,options = that.config
	  ,isStatic = options.position === 'static';
	  options.elem = lay(options.elem);
	  options.eventElem = lay(options.eventElem);

	  if(!options.elem[0]) return;

	  //如果不是input|textarea元素，则默认采用click事件
	  if(!that.isInput(options.elem[0])){
		if(options.trigger === 'focus'){
		  options.trigger = 'click';
		}
	  }

	  //设置唯一KEY
	  if(!options.elem.attr('lay-key')){
		options.elem.attr('lay-key', that.index);
		options.eventElem.attr('lay-key', that.index);
	  }

	  that.elemID = 'layui-layregion'+ options.elem.attr('lay-key');

	  that.parseSource();
	  if(options.show || isStatic) that.render();
	  isStatic || that.events();

	  //默认赋值
	  if(options.value && options.isInitValue){
		that.setValue(options.value);
	  }
	};

	//控件主体渲染
	Class.prototype.render = function(){
	  var that = this
	  ,options = that.config
	  ,isStatic = options.position === 'static'

	  //主面板
	  ,elem = that.elem = lay.elem('div', {
		id: that.elemID
		,'class': [
		  'layui-layregion'
		  ,isStatic ? (' '+ ELEM_STATIC) : ''
		].join('')
	  })

	  //主区域
	  ,elemMain = that.elemMain = []
	  ,elemHeader = that.elemHeader = []
	  ,elemCont = that.elemCont = []

	  if(options.zIndex) elem.style.zIndex = options.zIndex;


	  lay.each(new Array(1), function(i){

		//头部区域
		var divHeader = lay.elem('div', {
		  'class': 'layui-layregion-header'
		})

		,headerChild =lay.elem('ul')
		//内容区域
		,divContent = lay.elem('div', {
		  'class': 'layui-layregion-content'
		})
		,ul = lay.elem('ul');

		headerChild.innerHTML = '<li class="active"><span>请选择</span><i class="layui-icon layui-icon-down"></i></li>';
		divHeader.appendChild(headerChild);

		var listData = options.dataAll[options.pid] || [];
		lay.each(listData, function(i, rowData){ //表体
			//console.log(arguments)
			var li = lay.elem('li'),
				span = lay.elem('span');
			span.innerHTML = rowData.shortname;
			li.appendChild(span);
			ul.appendChild(li);
		});
		divContent.appendChild(ul);

		elemMain[i] = lay.elem('div', {
		  'class': 'layui-layregion-main layregion-main-list-'+ i
		});

		elemMain[i].appendChild(divHeader);
		elemMain[i].appendChild(divContent);

		elemHeader.push(headerChild);
		elemCont.push(divContent);
	  });

	  //插入到主区域
	  lay.each(elemMain, function(i, main){
		elem.appendChild(main);
	  });

	  //移除上一个控件
	  that.remove(Class.thisElemDate);

	  //如果是静态定位，则插入到指定的容器中，否则，插入到body
	  isStatic ? options.elem.append(elem) : (
		document.body.appendChild(elem)
		,that.position() //定位
	  );

	  that.checkValue().calendar(); //初始校验
	  that.changeEvent(); //日期切换

	  Class.thisElemDate = that.elemID;

	  typeof options.ready === 'function' && options.ready(lay.extend({}, options.dateTime, {
		month: options.dateTime.month + 1
	  }));
	};

	//控件移除
	Class.prototype.remove = function(prev){
	  var that = this
	  ,options = that.config
	  ,elem = lay('#'+ (prev || that.elemID));
	  if(!elem.hasClass(ELEM_STATIC)){
		that.checkValue(function(){
		  elem.remove();
		});
	  }
	  return that;
	};

	//定位算法
	Class.prototype.position = function(){
	  var that = this
	  ,options = that.config
	  ,elem = that.bindElem || options.elem[0]
	  ,rect = elem.getBoundingClientRect() //绑定元素的坐标
	  ,elemWidth = that.elem.offsetWidth //控件的宽度
	  ,elemHeight = that.elem.offsetHeight //控件的高度

	  //滚动条高度
	  ,scrollArea = function(type){
		type = type ? 'scrollLeft' : 'scrollTop';
		return document.body[type] | document.documentElement[type];
	  }
	  ,winArea = function(type){
		return document.documentElement[type ? 'clientWidth' : 'clientHeight']
	  }, margin = 5, left = rect.left, top = rect.bottom;

	  //如果右侧超出边界
	  if(left + elemWidth + margin > winArea('width')){
		left = winArea('width') - elemWidth - margin;
	  }

	  //如果底部超出边界
	  if(top + elemHeight + margin > winArea()){
		top = rect.top > elemHeight //顶部是否有足够区域显示完全
		  ? rect.top - elemHeight
		: winArea() - elemHeight;
		top = top - margin*2;
	  }

	  if(options.position){
		that.elem.style.position = options.position;
	  }
	  that.elem.style.left = left + (options.position === 'fixed' ? 0 : scrollArea(1)) + 'px';
	  that.elem.style.top = top + (options.position === 'fixed' ? 0 : scrollArea()) + 'px';
	};

	//提示
	Class.prototype.hint = function(content){
	  var that = this
	  ,div = lay.elem('div', {
		'class': ELEM_HINT
	  });

	  if(!that.elem) return;

	  div.innerHTML = content || '';
	  lay(that.elem).find('.'+ ELEM_HINT).remove();
	  that.elem.appendChild(div);

	  clearTimeout(that.hinTimer);
	  that.hinTimer = setTimeout(function(){
		lay(that.elem).find('.'+ ELEM_HINT).remove();
	  }, 3000);
	};

	//获取递增/减后的年月
	Class.prototype.getAsYM = function(Y, M, type){
	  type ? M-- : M++;
	  if(M < 0){
		M = 11;
		Y--;
	  }
	  if(M > 11){
		M = 0;
		Y++;
	  }
	  return [Y, M];
	};

	//系统消息
	Class.prototype.systemDate = function(newDate){
	  var thisDate = newDate || new Date();
	  return {
		year: thisDate.getFullYear() //年
		,month: thisDate.getMonth() //月
		,date: thisDate.getDate() //日
		,hours: newDate ? newDate.getHours() : 0 //时
		,minutes: newDate ? newDate.getMinutes() : 0 //分
		,seconds: newDate ? newDate.getSeconds() : 0 //秒
	  }
	};

	//日期校验
	Class.prototype.checkValue = function(fn){
	  var that = this
	  ,options = that.config
	  ,error
	  ,elem = that.bindElem || options.elem[0]
	  //,valType = that.isInput(elem) ? 'val' : 'html'
	  ,value = that.isInput(elem) ? elem.value : (options.position === 'static' ? '' : elem.innerHTML)

	  if(error && value){
		that.setValue(that.parse());
	  }
	  fn && fn();
	  return that;
	};

	//公历重要日期与自定义备注
	Class.prototype.mark = function(td, YMD){
	  var that = this
	  ,mark, options = that.config;
	  lay.each(options.mark, function(key, title){
		var keys = key.split('-');
		if((keys[0] == YMD[0] || keys[0] == 0) //每年的每月
		&& (keys[1] == YMD[1] || keys[1] == 0) //每月的每日
		&& keys[2] == YMD[2]){ //特定日
		  mark = title || YMD[2];
		}
	  });
	  mark && td.html('<span class="laydate-day-mark">'+ mark +'</span>');

	  return that;
	};

	//无效日期范围的标记
	Class.prototype.limit = function(elem, date, index, time){
	  var that = this
	  ,options = that.config, timestrap = {}
	  ,dateTime = options[index > 41 ? 'endDate' : 'dateTime']
	  ,isOut, thisDateTime = lay.extend({}, dateTime, date || {});
	  lay.each({
		now: thisDateTime
		,min: options.min
		,max: options.max
	  }, function(key, item){
		timestrap[key] = that.newDate(lay.extend({
		  year: item.year
		  ,month: item.month
		  ,date: item.date
		}, function(){
		  var hms = {};
		  lay.each(time, function(i, keys){
			hms[keys] = item[keys];
		  });
		  return hms;
		}())).getTime();  //time：是否比较时分秒
	  });

	  isOut = timestrap.now < timestrap.min || timestrap.now > timestrap.max;
	  elem && elem[isOut ? 'addClass' : 'removeClass'](DISABLED);
	  return isOut;
	};

	//日历表
	Class.prototype.calendar = function(value){
	  var that = this
	  ,options = that.config

	  ,isAlone = options.type !== 'date' && options.type !== 'datetime'
	  ,index = value ? 1 : 0
	  ,tds = lay(that.table[index]).find('td')
	  ,elemYM = lay(that.elemHeader[index][2]).find('span');

	  //记录初始值
	  if(!that.firstDate){
		that.firstDate = lay.extend({}, dateTime);
	  }

	  //赋值日
	  lay.each(tds, function(index, item){
		var YMD = [dateTime.year, dateTime.month], st = 0;
		item = lay(item);
		item.removeAttr('class');
		if(index < startWeek){
		  st = prevMaxDate - startWeek + index;
		  item.addClass('laydate-day-prev');
		  YMD = that.getAsYM(dateTime.year, dateTime.month, 'sub');
		} else if(index >= startWeek && index < thisMaxDate + startWeek){
		  st = index - startWeek;
		  if(!options.range){
			st + 1 === dateTime.date && item.addClass(THIS);
		  }
		} else {
		  st = index - thisMaxDate - startWeek;
		  item.addClass('laydate-day-next');
		  YMD = that.getAsYM(dateTime.year, dateTime.month);
		}
		YMD[1]++;
		YMD[2] = st + 1;
		item.attr('lay-ymd', YMD.join('-')).html(YMD[2]);
		that.mark(item, YMD).limit(item, {
		  year: YMD[0]
		  ,month: YMD[1] - 1
		  ,date: YMD[2]
		}, index);
	  });

	  //同步头部年月
	  lay(elemYM[0]).attr('lay-ym', dateTime.year + '-' + (dateTime.month + 1));
	  lay(elemYM[1]).attr('lay-ym', dateTime.year + '-' + (dateTime.month + 1));

	  if(options.lang === 'cn'){
		lay(elemYM[0]).attr('lay-type', 'year').html(dateTime.year + '年')
		lay(elemYM[1]).attr('lay-type', 'month').html((dateTime.month + 1) + '月');
	  } else {
		lay(elemYM[0]).attr('lay-type', 'month').html(lang.month[dateTime.month]);
		lay(elemYM[1]).attr('lay-type', 'year').html(dateTime.year);
	  }

	  //初始默认选择器
	  if(isAlone){
		if(options.range){
		  value ? that.endDate = (that.endDate || {
			year: dateTime.year + (options.type === 'year' ? 1 : 0)
			,month: dateTime.month + (options.type === 'month' ? 0 : -1)
		  }) : (that.startDate = that.startDate || {
			year: dateTime.year
			,month: dateTime.month
		  });
		  if(value){
			that.listYM = [
			  [that.startDate.year, that.startDate.month + 1]
			  ,[that.endDate.year, that.endDate.month + 1]
			];
			that.list(options.type, 0).list(options.type, 1);
			//同步按钮可点状态
			options.type === 'time' ? that.setBtnStatus('时间'
			  ,lay.extend({}, that.systemDate(), that.startTime)
			  ,lay.extend({}, that.systemDate(), that.endTime)
			) : that.setBtnStatus(true);
		  }
		}
		if(!options.range){
		  that.listYM = [[dateTime.year, dateTime.month + 1]];
		  that.list(options.type, 0);
		}
	  }

	  //通过检测当前有效日期，来设定确定按钮是否可点
	  if(!options.range) that.limit(lay(that.footer).find(ELEM_CONFIRM), null, 0, ['hours', 'minutes', 'seconds']);

	  //标记选择范围
	  if(options.range && value && !isAlone) that.stampRange();
	  return that;
	};

	//生成年月时分秒列表
	Class.prototype.list = function(type, index){
	  var that = this
	  ,options = that.config
	  ,dateTime = options.dateTime
	  ,lang = that.lang()
	  ,isAlone = options.range && options.type !== 'date' && options.type !== 'datetime' //独立范围选择器

	  ,ul = lay.elem('ul', {
		'class': ELEM_LIST + ' ' + ({
		  year: 'laydate-year-list'
		  ,month: 'laydate-month-list'
		  ,time: 'laydate-time-list'
		})[type]
	  })
	  ,elemHeader = that.elemHeader[index]
	  ,elemYM = lay(elemHeader[2]).find('span')
	  ,elemCont = that.elemCont[index || 0]
	  ,haveList = lay(elemCont).find('.'+ ELEM_LIST)[0]
	  ,isCN = options.lang === 'cn'
	  ,text = isCN ? '年' : ''

	  ,listYM = that.listYM[index] || {}
	  ,hms = ['hours', 'minutes', 'seconds']
	  ,startEnd = ['startTime', 'endTime'][index];

	  if(listYM[0] < 1) listYM[0] = 1;

	  if(type === 'year'){ //年列表
		var yearNum, startY = yearNum = listYM[0] - 7;
		if(startY < 1) startY = yearNum = 1;
		lay.each(new Array(15), function(i){
		  var li = lay.elem('li', {
			'lay-ym': yearNum
		  }), ymd = {year: yearNum};
		  yearNum == listYM[0] && lay(li).addClass(THIS);
		  li.innerHTML = yearNum + text;
		  ul.appendChild(li);
		  if(yearNum < that.firstDate.year){
			ymd.month = options.min.month;
			ymd.date = options.min.date;
		  } else if(yearNum >= that.firstDate.year){
			ymd.month = options.max.month;
			ymd.date = options.max.date;
		  }
		  that.limit(lay(li), ymd, index);
		  yearNum++;
		});
		lay(elemYM[isCN ? 0 : 1]).attr('lay-ym', (yearNum - 8) + '-' + listYM[1])
		.html((startY + text) + ' - ' + (yearNum - 1 + text));
	  } else if(type === 'month'){ //月列表
		lay.each(new Array(12), function(i){
		  var li = lay.elem('li', {
			'lay-ym': i
		  }), ymd = {year: listYM[0], month: i};
		  i + 1 == listYM[1] && lay(li).addClass(THIS);
		  li.innerHTML = lang.month[i] + (isCN ? '月' : '');
		  ul.appendChild(li);
		  if(listYM[0] < that.firstDate.year){
			ymd.date = options.min.date;
		  } else if(listYM[0] >= that.firstDate.year){
			ymd.date = options.max.date;
		  }
		  that.limit(lay(li), ymd, index);
		});
		lay(elemYM[isCN ? 0 : 1]).attr('lay-ym', listYM[0] + '-' + listYM[1])
		.html(listYM[0] + text);
	  } else if(type === 'time'){ //时间列表
		//检测时分秒状态是否在有效日期时间范围内
		var setTimeStatus = function(){
		  lay(ul).find('ol').each(function(i, ol){
			lay(ol).find('li').each(function(ii, li){
			  that.limit(lay(li), [{
				hours: ii
			  }, {
				hours: that[startEnd].hours
				,minutes: ii
			  }, {
				hours: that[startEnd].hours
				,minutes: that[startEnd].minutes
				,seconds: ii
			  }][i], index, [['hours'], ['hours', 'minutes'], ['hours', 'minutes', 'seconds']][i]);
			});
		  });
		  if(!options.range) that.limit(lay(that.footer).find(ELEM_CONFIRM), that[startEnd], 0, ['hours', 'minutes', 'seconds']);
		};
		if(options.range){
		  if(!that[startEnd]) that[startEnd] = {
			hours: 0
			,minutes: 0
			,seconds: 0
		  };
		} else {
		  that[startEnd] = dateTime;
		}
		lay.each([24, 60, 60], function(i, item){
		  var li = lay.elem('li'), childUL = ['<p>'+ lang.time[i] +'</p><ol>'];
		  lay.each(new Array(item), function(ii){
			childUL.push('<li'+ (that[startEnd][hms[i]] === ii ? ' class="'+ THIS +'"' : '') +'>'+ lay.digit(ii, 2) +'</li>');
		  });
		  li.innerHTML = childUL.join('') + '</ol>';
		  ul.appendChild(li);
		});
		setTimeStatus();
	  }

	  //插入容器
	  if(haveList) elemCont.removeChild(haveList);
	  elemCont.appendChild(ul);

	  //年月
	  if(type === 'year' || type === 'month'){
		//显示切换箭头
		lay(that.elemMain[index]).addClass('laydate-ym-show');

		//选中
		lay(ul).find('li').on('click', function(){
		  var ym = lay(this).attr('lay-ym') | 0;
		  if(lay(this).hasClass(DISABLED)) return;

		  if(index === 0){
			dateTime[type] = ym;
			if(isAlone) that.startDate[type] = ym;
			that.limit(lay(that.footer).find(ELEM_CONFIRM), null, 0);
		  } else { //范围选择
			if(isAlone){ //非date/datetime类型
			  that.endDate[type] = ym;
			} else { //date/datetime类型
			  var YM = type === 'year'
				? that.getAsYM(ym, listYM[1] - 1, 'sub')
			  : that.getAsYM(listYM[0], ym, 'sub');
			  lay.extend(dateTime, {
				year: YM[0]
				,month: YM[1]
			  });
			}
		  }

		  if(options.type === 'year' || options.type === 'month'){
			lay(ul).find('.'+ THIS).removeClass(THIS);
			lay(this).addClass(THIS);

			//如果为年月选择器，点击了年列表，则切换到月选择器
			if(options.type === 'month' && type === 'year'){
			  that.listYM[index][0] = ym;
			  isAlone && (that[['startDate', 'endDate'][index]].year = ym);
			  that.list('month', index);
			}
		  } else {
			that.checkValue('limit').calendar();
			that.closeList();
		  }

		  that.setBtnStatus(); //同步按钮可点状态
		  options.range || that.done(null, 'change');
		  lay(that.footer).find(ELEM_TIME_BTN).removeClass(DISABLED);
		});
	  } else {
		var span = lay.elem('span', {
		  'class': ELEM_TIME_TEXT
		}), scroll = function(){ //滚动条定位
		  lay(ul).find('ol').each(function(i){
			var ol = this
			,li = lay(ol).find('li')
			ol.scrollTop = 30*(that[startEnd][hms[i]] - 2);
			if(ol.scrollTop <= 0){
			  li.each(function(ii, item){
				if(!lay(this).hasClass(DISABLED)){
				  ol.scrollTop = 30*(ii - 2);
				  return true;
				}
			  });
			}
		  });
		}, haveSpan = lay(elemHeader[2]).find('.'+ ELEM_TIME_TEXT);
		scroll()
		span.innerHTML = options.range ? [lang.startTime,lang.endTime][index] : lang.timeTips
		lay(that.elemMain[index]).addClass('laydate-time-show');
		if(haveSpan[0]) haveSpan.remove();
		elemHeader[2].appendChild(span);

		lay(ul).find('ol').each(function(i){
		  var ol = this;
		  //选择时分秒
		  lay(ol).find('li').on('click', function(){
			var value = this.innerHTML | 0;
			if(lay(this).hasClass(DISABLED)) return;
			if(options.range){
			  that[startEnd][hms[i]]  = value;
			} else {
			  dateTime[hms[i]] = value;
			}
			lay(ol).find('.'+ THIS).removeClass(THIS);
			lay(this).addClass(THIS);

			setTimeStatus();
			scroll();
			(that.endDate || options.type === 'time') && that.done(null, 'change');

			//同步按钮可点状态
			that.setBtnStatus();
		  });
		});
	  }

	  return that;
	};

	//记录列表切换后的年月
	Class.prototype.listYM = [];

	//关闭列表
	Class.prototype.closeList = function(){
	  var that = this
	  ,options = that.config;

	  lay.each(that.elemCont, function(index, item){
		lay(this).find('.'+ ELEM_LIST).remove();
		lay(that.elemMain[index]).removeClass('laydate-ym-show laydate-time-show');
	  });
	  lay(that.elem).find('.'+ ELEM_TIME_TEXT).remove();
	};

	//检测结束日期是否超出开始日期
	Class.prototype.setBtnStatus = function(tips, start, end){
	  var that = this
	  ,options = that.config
	  ,isOut, elemBtn = lay(that.footer).find(ELEM_CONFIRM)
	  ,isAlone = options.range && options.type !== 'date' && options.type !== 'time';
	  if(isAlone){
		start = start || that.startDate;
		end = end || that.endDate;
		isOut = that.newDate(start).getTime() > that.newDate(end).getTime();

		//如果不在有效日期内，直接禁用按钮，否则比较开始和结束日期
		(that.limit(null, start) || that.limit(null, end))
		  ? elemBtn.addClass(DISABLED)
		: elemBtn[isOut ? 'addClass' : 'removeClass'](DISABLED);

		//是否异常提示
		if(tips && isOut) that.hint(
		  typeof tips === 'string' ? TIPS_OUT.replace(/日期/g, tips) : TIPS_OUT
		);
	  }
	};

	//转义为规定格式的日期字符
	Class.prototype.parse = function(state, date){
	  var that = this
	  ,options = that.config
	  ,dateTime = date || (state
		? lay.extend({}, that.endDate, that.endTime)
	  : (options.range ? lay.extend({}, that.startDate, that.startTime) : options.dateTime))
	  ,format = that.format.concat();

	  //转义为规定格式
	  lay.each(format, function(i, item){
		if(/yyyy|y/.test(item)){ //年
		  format[i] = lay.digit(dateTime.year, item.length);
		} else if(/MM|M/.test(item)){ //月
		  format[i] = lay.digit(dateTime.month + 1, item.length);
		} else if(/dd|d/.test(item)){ //日
		  format[i] = lay.digit(dateTime.date, item.length);
		} else if(/HH|H/.test(item)){ //时
		  format[i] = lay.digit(dateTime.hours, item.length);
		} else if(/mm|m/.test(item)){ //分
		  format[i] = lay.digit(dateTime.minutes, item.length);
		} else if(/ss|s/.test(item)){ //秒
		  format[i] = lay.digit(dateTime.seconds, item.length);
		}
	  });

	  //返回日期范围字符
	  if(options.range && !state){
		return format.join('') + ' '+ options.range +' ' + that.parse(1);
	  }

	  return format.join('');
	};


	Class.prototype.parseSource = function(source){
		var that = this
			,options = that.config
			,source = source || options.source || ''
			,dataAll = {};

		$.ajax({
			url: source,
			//data: {pageNum: pageNum, pageSize: pageSize},
			dataType: 'json',
		}).done(function(res) {
			if(res.code) {
				lay.each(res.data.list, function(i, obj) {
					if(dataAll[obj.pid] === undefined) {
						dataAll[obj.pid] = [];
					}
					dataAll[obj.pid].push(obj);
				});
				options.dataAll = dataAll;
			}

		});
	}


	//创建指定日期时间对象
	Class.prototype.newDate = function(dateTime){
	  dateTime = dateTime || {};
	  return new Date(
		dateTime.year || 1
		,dateTime.month || 0
		,dateTime.date || 1
		,dateTime.hours || 0
		,dateTime.minutes || 0
		,dateTime.seconds || 0
	  );
	};

	//赋值
	Class.prototype.setValue = function(value){
	  var that = this
	  ,options = that.config
	  ,elem = that.bindElem || options.elem[0]
	  ,valType = that.isInput(elem) ? 'val' : 'html'

	  options.position === 'static' || lay(elem)[valType](value || '');
	  return this;
	};

	//执行done/change回调
	Class.prototype.done = function(param, type){
	  var that = this
	  ,options = that.config
	  ,start = lay.extend({}, that.startDate ? lay.extend(that.startDate, that.startTime) : options.dateTime)
	  ,end = lay.extend({}, lay.extend(that.endDate, that.endTime))

	  lay.each([start, end], function(i, item){
		if(!('month' in item)) return;
		lay.extend(item, {
		  month: item.month + 1
		});
	  });

	  param = param || [that.parse(), start, end];
	  typeof options[type || 'done'] === 'function' && options[type || 'done'].apply(options, param);

	  return that;
	};

	//选择日期
	Class.prototype.choose = function(td){
	  var that = this
	  ,options = that.config
	  ,dateTime = options.dateTime

	  ,tds = lay(that.elem).find('td')
	  ,YMD = td.attr('lay-ymd').split('-')

	  ,setDateTime = function(one){
		var thisDate = new Date();

		//同步dateTime
		one && lay.extend(dateTime, YMD);

		//记录开始日期
		if(options.range){
		  that.startDate ? lay.extend(that.startDate, YMD) : (
			that.startDate = lay.extend({}, YMD, that.startTime)
		  );
		  that.startYMD = YMD;
		}
	  };

	  YMD = {
		year: YMD[0] | 0
		,month: (YMD[1] | 0) - 1
		,date: YMD[2] | 0
	  };

	  if(td.hasClass(DISABLED)) return;

	  //范围选择
	  if(options.range){

		lay.each(['startTime', 'endTime'], function(i, item){
		  that[item] = that[item] || {
			hours: 0
			,minutes: 0
			,seconds: 0
		  };
		});

		if(that.endState){ //重新选择
		  setDateTime();
		  delete that.endState;
		  delete that.endDate;
		  that.startState = true;
		  tds.removeClass(THIS + ' ' + ELEM_SELECTED);
		  td.addClass(THIS);
		} else if(that.startState){ //选中截止
		  td.addClass(THIS);

		  that.endDate ? lay.extend(that.endDate, YMD) : (
			that.endDate = lay.extend({}, YMD, that.endTime)
		  );

		  //判断是否顺时或逆时选择
		  if(that.newDate(YMD).getTime() < that.newDate(that.startYMD).getTime()){
			var startDate = lay.extend({}, that.endDate, {
			  hours: that.startDate.hours
			  ,minutes: that.startDate.minutes
			  ,seconds: that.startDate.seconds
			});
			lay.extend(that.endDate, that.startDate, {
			  hours: that.endDate.hours
			  ,minutes: that.endDate.minutes
			  ,seconds: that.endDate.seconds
			});
			that.startDate = startDate;
		  }

		  options.showBottom || that.done();
		  that.stampRange(); //标记范围内的日期
		  that.endState = true;
		  that.done(null, 'change');
		} else { //选中开始
		  td.addClass(THIS);
		  setDateTime();
		  that.startState = true;
		}
		lay(that.footer).find(ELEM_CONFIRM)[that.endDate ? 'removeClass' : 'addClass'](DISABLED);
	  } else if(options.position === 'static'){ //直接嵌套的选中
		setDateTime(true);
		that.calendar().done().done(null, 'change');
	  } else if(options.type === 'date'){
		setDateTime(true);
		that.setValue(that.parse()).remove().done();
	  } else if(options.type === 'datetime'){
		setDateTime(true);
		that.calendar().done(null, 'change');
	  }
	};

	//底部按钮
	Class.prototype.tool = function(btn, type){
	  var that = this
	  ,options = that.config
	  ,dateTime = options.dateTime
	  ,isStatic = options.position === 'static'
	  ,active = {
		//选择时间
		datetime: function(){
		  if(lay(btn).hasClass(DISABLED)) return;
		  that.list('time', 0);
		  options.range && that.list('time', 1);
		  lay(btn).attr('lay-type', 'date').html(that.lang().dateTips);
		}

		//选择日期
		,date: function(){
		  that.closeList();
		  lay(btn).attr('lay-type', 'datetime').html(that.lang().timeTips);
		}

		//清空、重置
		,clear: function(){
		  that.setValue('').remove();
		  isStatic && (
			lay.extend(dateTime, that.firstDate)
			,that.calendar()
		  )
		  options.range && (
			delete that.startState
			,delete that.endState
			,delete that.endDate
			,delete that.startTime
			,delete that.endTime
		  );
		  that.done(['', {}, {}]);
		}

		//现在
		,now: function(){
		  var thisDate = new Date();
		  lay.extend(dateTime, that.systemDate(), {
			hours: thisDate.getHours()
			,minutes: thisDate.getMinutes()
			,seconds: thisDate.getSeconds()
		  });
		  that.setValue(that.parse()).remove();
		  isStatic && that.calendar();
		  that.done();
		}

		//确定
		,confirm: function(){
		  if(options.range){
			if(!that.endDate) return that.hint('请先选择日期范围');
			if(lay(btn).hasClass(DISABLED)) return that.hint(
			  options.type === 'time' ? TIPS_OUT.replace(/日期/g, '时间') : TIPS_OUT
			);
		  } else {
			if(lay(btn).hasClass(DISABLED)) return that.hint('不在有效日期或时间范围内');
		  }
		  that.done();
		  that.setValue(that.parse()).remove()
		}
	  };
	  active[type] && active[type]();
	};

	//统一切换处理
	Class.prototype.change = function(index){
	  var that = this
	  ,options = that.config
	  ,dateTime = options.dateTime
	  ,isAlone = options.range && (options.type === 'year' || options.type === 'month')

	  ,elemCont = that.elemCont[index || 0]
	  ,listYM = that.listYM[index]
	  ,addSubYeay = function(type){
		var startEnd = ['startDate', 'endDate'][index]
		,isYear = lay(elemCont).find('.laydate-year-list')[0]
		,isMonth = lay(elemCont).find('.laydate-month-list')[0];

		//切换年列表
		if(isYear){
		  listYM[0] = type ? listYM[0] - 15 : listYM[0] + 15;
		  that.list('year', index);
		}

		if(isMonth){ //切换月面板中的年
		  type ? listYM[0]-- : listYM[0]++;
		  that.list('month', index);
		}

		if(isYear || isMonth){
		  lay.extend(dateTime, {
			year: listYM[0]
		  });
		  if(isAlone) that[startEnd].year = listYM[0];
		  options.range || that.done(null, 'change');
		  that.setBtnStatus();
		  options.range || that.limit(lay(that.footer).find(ELEM_CONFIRM), {
			year: listYM[0]
		  });
		}
		return isYear || isMonth;
	  };

	  return {
		prevYear: function(){
		  if(addSubYeay('sub')) return;
		  dateTime.year--;
		  that.checkValue('limit').calendar();
		  options.range || that.done(null, 'change');
		}
		,prevMonth: function(){
		  var YM = that.getAsYM(dateTime.year, dateTime.month, 'sub');
		  lay.extend(dateTime, {
			year: YM[0]
			,month: YM[1]
		  });
		  that.checkValue('limit').calendar();
		  options.range || that.done(null, 'change');
		}
		,nextMonth: function(){
		  var YM = that.getAsYM(dateTime.year, dateTime.month);
		  lay.extend(dateTime, {
			year: YM[0]
			,month: YM[1]
		  });
		  that.checkValue('limit').calendar();
		  options.range || that.done(null, 'change');
		}
		,nextYear: function(){
		  if(addSubYeay()) return;
		  dateTime.year++
		  that.checkValue('limit').calendar();
		  options.range || that.done(null, 'change');
		}
	  };
	};

	//日期切换事件
	Class.prototype.changeEvent = function(){
	  var that = this
	  ,options = that.config;

	  //日期选择事件
	  lay(that.elem).on('click', function(e){
		lay.stope(e);
	  });

	  //年月切换
	  lay.each(that.elemHeader, function(i, header){
		//上一年
		lay(header[0]).on('click', function(e){
		  that.change(i).prevYear();
		});

		//上一月
		lay(header[1]).on('click', function(e){
		  that.change(i).prevMonth();
		});

		//选择年月
		lay(header[2]).find('span').on('click', function(e){
		  var othis = lay(this)
		  ,layYM = othis.attr('lay-ym')
		  ,layType = othis.attr('lay-type');

		  if(!layYM) return;

		  layYM = layYM.split('-');

		  that.listYM[i] = [layYM[0] | 0, layYM[1] | 0];
		  that.list(layType, i);
		  lay(that.footer).find(ELEM_TIME_BTN).addClass(DISABLED);
		});

		//下一月
		lay(header[3]).on('click', function(e){
		  that.change(i).nextMonth();
		});

		//下一年
		lay(header[4]).on('click', function(e){
		  that.change(i).nextYear();
		});
	  });

	  //点击日期
	  lay.each(that.table, function(i, table){
		var tds = lay(table).find('td');
		tds.on('click', function(){
		  that.choose(lay(this));
		});
	  });

	  //点击底部按钮
	  lay(that.footer).find('span').on('click', function(){
		var type = lay(this).attr('lay-type');
		that.tool(this, type);
	  });
	};

	//是否输入框
	Class.prototype.isInput = function(elem){
	  return /input|textarea/.test(elem.tagName.toLocaleLowerCase());
	};

	//绑定的元素事件处理
	Class.prototype.events = function(){
	  var that = this
	  ,options = that.config

	  //绑定呼出控件事件
	  ,showEvent = function(elem, bind){
		elem.on(options.trigger, function(){
		  bind && (that.bindElem = this);
		  that.render();
		});
	  };

	  if(!options.elem[0] || options.elem[0].eventHandler) return;

	  showEvent(options.elem, 'bind');
	  showEvent(options.eventElem);

	  //绑定关闭控件事件
	  lay(document).on('click', function(e){
		if(e.target === options.elem[0]
		|| e.target === options.eventElem[0]
		|| e.target === lay(options.closeStop)[0]){
		  return;
		}
		that.remove();
	  });

	  //自适应定位
	  lay(window).on('resize', function(){
		if(!that.elem || !lay(ELEM)[0]){
		  return false;
		}
		that.position();
	  });

	  options.elem[0].eventHandler = true;
	};


	//核心接口
	layregion.render = function(options){
	  var inst = new Class(options);
	  return thisRegion.call(inst);
	};


	//暴露lay
	window.lay = window.lay || lay;

	//加载方式
	isLayui ? (
	  layregion.ready()
	  ,layui.define(function(exports){ //layui加载
		layregion.path = layui.cache.dir;
		exports(MOD_NAME, layregion);
	  })
	) : (
	  (typeof define === 'function' && define.amd) ? define(function(){ //requirejs加载
		return layregion;
	  }) : function(){ //普通script标签加载
		layregion.ready();
		window.layregion = layregion
	  }()
	);

  }();
