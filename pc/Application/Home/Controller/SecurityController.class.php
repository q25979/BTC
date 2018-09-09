<?php
namespace Home\Controller;

/**
 * 作者：新疆哥
 * 时间：2018年4月16日16:51:07
 * 功能：安全
 */
class SecurityController extends VerifyController {
    public function index() {
        $this->display();

    }


    /**
     * 判斷安全指数強度
     * url: /Home/Security/Passwordstrength
     * method: get
     */ 
    public function Passwordstrength(){
        $UserSet = M('UserSet');
        $User    = M('User');

        $map['user_id'] = $this->user_id;
        $usInfo = $UserSet
            ->field('password_hint_one, password_hint_two, password_hint_three')
            ->where($map)
            ->find();
        $uInfo  = $User
            ->field('birthdate, certificate_num')
            ->where($map)
            ->find();
        $exponent = 20;
        $strength = 3;
        $num = 1;

        // 判断安装指数
        if (!empty($usInfo['password_hint_one'])) $exponent += 10;
        if (!empty($usInfo['password_hint_one'])
            && !empty($usInfo['password_hint_two'])) $exponent += 20;
        if (!empty($usInfo['password_hint_one'])
            && !empty($usInfo['password_hint_two'])
            && !empty($usInfo['password_hint_three'])) {

            $exponent += 30;
            $num = 0;
        }

        if (!empty($uInfo['birthdate'])) $exponent += 10;
        if (!empty($uInfo['certificate_num'])) $exponent += 10;
        if ($exponent > 100) $exponent = 95;

        $result = \StatusCode::code(0);
        $result['data']['percentage'] = $exponent;
        $result['data']['strength']   = $strength;
        $result['data']['num']   = $num;
        $this->ajaxReturn($result);
    }


    //判断原密码
    public function getpass(){
        $getdata = I('post.');
        
        //md5验证
        $md5Str =  $getdata['nonce_str'] . $getdata['password'] ;
        if (!\Common::verifyMd5($getdata['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

        //获取当前用户ID
        $update = M('User');

        $map['user_id'] = $this->user_id;
        $info = $update->where($map)->getField('password');
        
        if($info == $getdata['password']){
            $result = \StatusCode::code(0);
        }else{
            $result = \StatusCode::code(4000);
        }
        $result['data'] = $info;
        $this->ajaxReturn($result);
    }

    // 修改密码
    public function Passwordupdate() {

        $getdata = I('post.');

        //md5验证
        $md5Str =  $getdata['newpassword'] . $getdata['nonce_str'];
        if (!\Common::verifyMd5($getdata['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

        //判断是否为空
        if(empty($getdata['newpassword'])){
            $result = \StatusCode::code(4000);
            $this->ajaxReturn($result);
        }

        $data['update_time'] = time();
        $data['password'] = $getdata['newpassword'];
        //获取当前用户ID
        $map['user_id'] = $this->user_id;

        $update = M('User');

        $info = $update->where($map)->save($data);

        if($info){
            $result = \StatusCode::code(0);

        }else{
            $result = \StatusCode::code(4000);
        }

        $this->ajaxReturn($result);

    } 

    // 启用安全保护
    public function Securityenable() {
        $getdata = I('post.');

        $update = M(User_set);

        $map['user_id'] = $this->user_id;

        $getdata['update_time'] = time();

        $info = $update->where($map)->save($getdata);

        if($info){
            $result = \StatusCode::code(0);
        }else{
            $result = \StatusCode::code(4000);
        }

        $this->ajaxReturn($result);
    }
}
