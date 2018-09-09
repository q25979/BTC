var popupVm = new Vue({
    el: '#announcement',
    data:{
        bulletinLit:[],
        marginTops: 0,
        heights: 0,
        timer: '',
        count: 0,
        rollLength: 4,
    },
    created: function(){

        this.getData();

    },
    methods: {
        /*
        * 获取公告栏数据
        * */
        getData: function () {
            var _this = this;
            var url = config.host_path + '/Home/PopupWindow/getBulletin';

            $.get(url, function (res) {
				
				for(var i in res.data) {
                	_this.bulletinLit.push(res.data[i]);
					_this.count += 1;
				}
				
				_this.noticeRoll(res.data.length);
            });
        },

        /**
         * 关闭公告栏
         */
        close: function (){
            $('#announcement').animate({'left':'-200px'});
        },
        /**
         * 点击公告详情
         * @param bulletinId 公告Id
         */
        getBulletinContent: function (bulletinId){
            window.location.href=config.host_path + "/Home/PopupWindow/bulletinContent.html?bulletin_id=" + bulletinId; 
        },
        
        /**
         * 鼠标移入事件
         */
        rollStop: function() {
			
			if (this.count < 4) {return ;}
        	clearInterval(this.timer)
        },
        
        /**
         * 鼠标移出事件
         */
        rollOpen: function() {
			var _this = this;
			if (this.count < 4) {return ;}
                this.timer = setInterval(function(){
	                _this.marginTops -= 1;
	                if(_this.marginTops <= -_this.heights){
	                    _this.marginTops = 90;
	                }
	                $("#announcement-info-box").css( "marginTop", _this.marginTops+"px");
            }, 50);
        },

        /**
         * 公告滚动
         */
        noticeRoll: function (length) {
            if (length < this.rollLength) {return ;}

            // 设置高度
            $('#announcement-bd').css({ 'height': '110px' });

            divMarginTop = $("#announcement-info-box ul").css("marginTop");//偏移量
            var reg = new RegExp("px","g");
            var marginTop = divMarginTop.replace(reg, "");

            marginTop = parseInt(marginTop);

            var divHeight = $("#announcement-info-box").css("height");//获取容器高度
            var height = divHeight.replace(reg, "");

            height = parseInt(height)+100;

            this.timer = setInterval(function(){
                marginTop -= 1;
                if(marginTop <= -height){
                    marginTop = 90;
                }
                $("#announcement-info-box").css("marginTop",marginTop+"px");
            }, 50);

			this.marginTops = marginTop;
			this.heights = height;
        }
    }

});
