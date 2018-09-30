/**
 * 作者：@671
 * 时间：2018年1月30日17:35:22
 * 功能：公共js文件
 */

/**
 * 随机数
 *
 * @param   length  长度
 * @returns string  返回随机串
 */
var nonceStr = function(length) {
    length = length || 16;

    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    var randomstring = '';

    for (var i = 0; i < length; i++) {
        randomstring += possible.charAt( Math.floor(Math.random() * possible.length));
    }
    return randomstring;
}


// +---------------------------------
// | 拾光网络
// +---------------------------------
// | 时间：2018年5月4日00:36:18
// +---------------------------------
// | 作者：671 <277161542@qq.com>
// +---------------------------------


var sg = {

	/**
	 * 页面跳转
	 *
	 * @param string url 跳转的地址
	 */
	jump: function(url) {
		// 跳转
		window.location.href = url;
	},

	/**
	 * 刷新页面
	 */
	reload: function() {
		window.location.reload() || location.reload();
	},

	/**
	 * 是空的
	 * 
	 * @param  string  param 需要判空的参数
	 * @return bool    true为空
	 */
	isEmpty: function(param) {
		if ( param == ''
			|| param == null
			|| param == 'null'
			|| param == undefined
			|| param == 'undefined' ) {

			return true;
		}

		return false;
	},

	/**
	 * 按钮加载动画(如注册按钮)
	 * 
	 * @param  string element 元素如($('#elem'))
	 */
	loading: function(element) {
		// 图标地址
		var icon = config.host_path+'/Uploads/static/basics/load.png';

		element.addClass('sg-loading');
		element.attr('disabled', 'true');
		element.html('<img src="'+ icon +'" />');
	},

	/**
	 * 隐藏加载动画(如注册按钮)
	 * 
	 * @param  string element 元素如($('#elem'))
	 * @param  string text    按钮文字
	 */
	hideLoading: function(element, text) {
		element.removeClass('sg-loading');
		element.removeAttr('disabled');
		element.html(text);
	},

	/**
	 * html文本转换渲染页面
	 * 
	 * @param  string html html文本
	 * @return string 转换后的html
	 */
	htmlShow: function(html) {
        var arrEntities = {
        	'lt': '<',
        	'gt': '>',
        	'nbsp': ' ',
        	'amp' : '&',
        	'quot': '"'
        };

        html = html.replace(/&(lt|gt|nbsp|amp|quot);/ig, function(all, t) {

        	return arrEntities[t];
        });

        return html;
	},

	/**
	 * 获取汇率
	 *
	 * @callback object 率会比回调
	 */
	exchange: function(callback) {
		$.get(config.host_path+'/Float/Index/exchange', function(res) {
			callback(res)
		})
	},
};






