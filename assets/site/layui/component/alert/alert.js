/**

 @Name : layui.alert ��ʾ���
 @Author��Raven
 @License��MIT

 */

layui.define(function(exports){
	"use strict";

	var $ = layui.$;

  var doc = document
  ,id = 'getElementById'
  ,tag = 'getElementsByTagName'


  ,MOD_NAME = 'alert', ELEM = '.layui-alert', SHOW = 'layui-show', HIDE = 'layui-hide', ELEM_CLOSE = '>.close'


  ,Class = function(options){
  };

	Class.prototype.render = function(){
		var elemClose = $(ELEM + ELEM_CLOSE);
		elemClose.on('click', function(){
			$(this).parents(ELEM).addClass(HIDE);
		});
	}

	var alert = new Class();
	alert.render();

	//主体CSS等待事件
	var getCss = function(){
    var getPath = function (){
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


		var head = document.getElementsByTagName("head")[0], link = document.createElement('link');
		var path = getPath + 'alert.css';
		var id = 'layuicss-alert';


		link.rel = 'stylesheet';
		link.href = path;
		link.id = id;

		if(!document.getElementById(id)){
			head.appendChild(link);
		}

	}
	getCss();



  exports(MOD_NAME, alert);
});
