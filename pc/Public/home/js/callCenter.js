
    new Vue({
        el: '#call-callCenter',
        data:{
            callCenterList: [],
            height: 0,
            count: 0
        },
        created:function(){
            this.getData();
        },
        methods: {
            getData: function () {
                var _this = this;
                var url = config.host_path + '/Home/PopupWindow/getCallCenter';

                $.get(url,function(res){

                    for(var i in res) {
                        _this.callCenterList.push(res[i]);
                        _this.count += 1;
                    }

                    _this.height = _this.count * 40 + 40 + 'px';
                    $('.call-callCenter').css({'height': _this.height});
                });
            }
        }

    });

