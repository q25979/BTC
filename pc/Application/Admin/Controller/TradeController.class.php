<?php
namespace Admin\Controller;

// +---------------------------------------------------
// | 作者：dong
// +---------------------------------------------------
// | 时间：2018年4月23日19:56:32
// +---------------------------------------------------
// | 功能：出售购买
// +---------------------------------------------------

class TradeController extends VerifyController {

    // 继承构造函数
    public function index() {
        $this->display();
    }

    public function trade(){
        $getdata = I('get.');

        $logo = M('Home_info');
        $map['id'] = HOME_INFO_ID;

        $info = $logo->where($map)->select();

        $info = $this->setStatus($info);

        if($info){
            $result = \StatusCode::code(0);
        }else{
            $result = \StatusCode::code(4002);
        }

        $result['data'] = $info;
        $this->ajaxReturn($result);
    }

    public function tradeUpdate(){
        $getdata = I('post.');
        $getdata['id'] = HOME_INFO_ID;

        //md5验证
        if(isset($getdata['buy_float'])){

            $md5Str = $getdata['buy_float'] . $getdata['nonce_str'] ;
            if (!\Common::verifyMd5($getdata['sign'], $md5Str)) {
                $result = \StatusCode::code(-100);
                $this->ajaxReturn($result);
            }
        }else{

            $md5Str = $getdata['nonce_str'] . $getdata['sell_float'] ;
            if (!\Common::verifyMd5($getdata['sign'], $md5Str)) {
                $result = \StatusCode::code(-100);
                $this->ajaxReturn($result);
            }
       }

        //校验ID是否存在
        if (empty($getdata['id'])) {
            $result = \StatusCode::code(4003);
            $result['msg'] = "修改失败";
            $this->ajaxReturn($result);
        }

        $logo = M('Home_info');

        $map['id'] = $getdata['id'];
        $getdata['update_time'] = time();

        $logo->create();
        $info = $logo->where($map)->save($getdata);

        if($info){
            $result = \StatusCode::code(0);
        }else{
            $result = \StatusCode::code(4000);
        }

        $this->ajaxReturn($result);
    }

    //状态设置
    private function setStatus($info){

        foreach ($info as $key => $value) {

            $info[$key]['create_time'] = date('Y-m-d', $value['create_time']);

            if($value['type'] ==BTC){
                $info[$key]['type_name'] = 'BTC';
            }else{
                $info[$key]['type_name'] = 'ETH';
            }
        }
        return $info;
    }

}