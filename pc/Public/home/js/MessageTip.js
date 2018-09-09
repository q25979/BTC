var messagePage = 1;
var pageCount;
var informationId;


var vm = new Vue({
    el: '#notifications',
    data: {
        notificationsLit: []
    },
    methods: {
        postData: function (data) {
            var _this = this;
            _this.notificationsLit = [];
            var url = config.host_path + '/Home/MessageTip/News';
            var _data = {
                
                page: messagePage,
                limit: 15
            };
            $.get(url, _data,{
                emulateJOSN:true
            }).then(function (res){
                pageCount = Math.ceil(res.count / _data.limit);

                for(var i in res.data){
                    _this.notificationsLit.push(res.data[i]);
                }


            });
        },
        messageTip: function (index) {

            window.location.href = config.host_path + "/Home/MessageTip/messageContent?information_id=" + this.notificationsLit[index].information_id;
        }
    }
});
vm.postData();

$('#messageNext').click(function(){
    if (messagePage > 0 && messagePage < pageCount) {
        messagePage += 1;
        vm.postData();
    }else {
        $(this).attr("disabled",true);
    }
});

$('#messageprev').click(function(){
    if (messagePage > 1) {
        messagePage -= 1;
        vm.postData();
    }else {
        $(this).attr("disabled",true);
    }
});


