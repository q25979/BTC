<?php
namespace Home\Controller;

use Think\Controller;
use Common\Controller\AlismsController;
/**
 * 作者：新疆哥
 * 时间：2018年4月16日16:51:07
 * 功能：设定
 */
class SettingController extends VerifyController {
    public function index() {
        $this->display();
    }

   
    // 修改其他设定
    public function otherSetting() {
        $this->display();
    }

    /**
     * 绑定手机号/修改 
     * method: post
     * URL: /Home/Setting/bindPhone
     * @param tel       // 手机号
     * @param type      // 类型：1-为绑定手机 2-为修改手机
     * @param nonce_str // 随机数
     * @param sign      // md5签名
     */
    public function bindPhone() {
        $data = I('post.');
        $User = M('User');

        if (!\Common::verifyMd5($data['sign'], $data['nonce_str'].$data['tel']))
            $this->ajaxReturn(\StatusCode::code(-100));

        // 判断是修改手机还是绑定手机
        if ((int)$data['type'] == 1)
            $data['maincoin_id'] = EmailController::maincoinId();

        $map['user_id'] = $this->user_id;
        $info = $User->where($map)->save($data);

        $info > 0
            ? $this->ajaxReturn(\StatusCode::code(0))
            : $this->ajaxReturn(\StatusCode::code(-1));
    }
    
    /**
     * * 增改基本资讯
     * URL:/Home/Setting/addBasic
     *#parameter： user_name 
     **            birthdate
     *             certificate_type
     *             certificate_num
     *             nonce_str
     **
     */
    public function addBasic() {
        $getData =I('post.');        

        //md5验证
        $md5Str =  $getData['birthdate'] . $getData['certificate_num'] . $getData['certificate_type'] . $getData['nonce_str'];
        if (!\Common::verifyMd5($getData['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

        $arr = date_parse_from_format('Y-m-d',$getData['birthdate']);  
        $getData['birthdate'] = mktime(0,0,0,$arr['month'],$arr['day'],$arr['year']);

        $User=M('User');

        $getData['create_time'] = time();

        $map['user_id'] = $this->user_id;
        $data = $User
            ->where($map)
            ->save($getData);

        $result = \StatusCode::code(0);
        $result['data'] = $data;

        $this->ajaxReturn($result);
        
    }

    /**
     * 显示基本信息
     * URL: /Home/Setting/getInfo
     * method: get
     */
    public function getInfo() {
        $user = M('User');

        $map['user_id'] = $this->user_id;

        $row = $user->where($map)->field('birthdate,certificate_type,certificate_num')->select();
        foreach ($row as $data) {}
        if(!empty($data['birthdate']) && !empty($data['certificate_type']) && !empty($data['certificate_num'])) {
            $res = $user
                ->where($map)
                ->field('email,user_name,certificate_num,maincoin_id')
                ->select();
            $result = \StatusCode::code(0);
            $result['data'] = $res;
            $this->ajaxReturn($result);
        } else {
            $result = \StatusCode::code(1);
            $result['data'] = '请填写基本资讯';
            $this->ajaxReturn($result);
        }
    }

    /**
     * 判断上传顺序
     * URL: /Home/Setting/checkOrder
     * 
     */
    // public function checkOrder() {
    //     $check = M('Authentication');

    //     $map['user_id'] = $this->user_id;
    //     $map['is_deleted'] = IS_NOT_DELETED;
    //     $data = $check
    //         ->where($map)
    //         ->field('f_status_url,r_status_url')
    //         ->select();
    //     foreach ($data as $row) {}           
        
    //     if(!empty($row['f_status_url']) && !empty($row['r_status_url'])) {
    //         $result = \StatusCode::code(0);
    //         $result['msg'] = '可以上传手持身份证照片！';
    //         $this->ajaxReturn($result);
    //     } else {
    //         $result = \StatusCode::code(4000);
    //         $result['msg'] = '请先上传身份证正反面照片！';
    //         $this->ajaxReturn($result);
    //     }

    // }
    /**
     * 身份证审核状态
     * URL: /Home/Setting/getStatus
     * method: get 
     */
    public function getStatus() {
        $idCard = M('Authentication');
        $map['user_id'] = $this->user_id;

        $data = $idCard->where($map)->field(max(status))->field('status')->group('status')->select();
        foreach ($data as $row) {
        }

        $this->ajaxReturn($row); 
    }
    
    /**
     * 禁止重复上传手持身份证
     * URL：/Home/Setting/forbidUploadHand
     * method：get
     */
    // public function forbidUploadHand() {
    //     $forbid = M('Authentication');
    //     $map['user_id'] = $this->user_id;
    //     $map['is_deleted'] = IS_NOT_DELETED;
    //     $row = $forbid
    //             ->where($map)
    //             ->field('hand_status_url,status')
    //             ->field(max(status))
    //             ->group('status')
    //             ->select();
    //     foreach ($row as $data) {}
    //     if(!$data['hand_status_url'] == '') {
    //         $result = \StatusCode::code($data['status']);
    //         $this->ajaxReturn($result);
    //     } else {
    //         $this->ajaxReturn(\StatusCode::code(false));
    //     }
    // }

    /*
     * 上传手持身份证文件
     * url : /Home/Setting/getuploadIdCard
     * method: post
     * 参数 file_hand 上传文件信息  
     */
    // public function getuploadIdCard() {
    //     $info = I('post.');

    //     $attest =M ('Authentication');  

    //     $result = \StatusCode::code(0);
    //     $rule['user_id'] = $this->user_id;
    //     $map['hand_status_url'] = $info['file_hand'];
    //     $map['update_time'] = time();
               
    //     $data = $attest
    //         ->where($rule)
    //         ->save($map);
    //     if(!$data) {
    //         $this->ajaxReturn(\StatusCode::code(-1));
    //     } else {
    //         $this->ajaxReturn($result);
    //     }
    // }

    /**
     * 上传身份证
     * url: /Home/Setting/getIdCard
     * method: post 
     *  file_f 上传正面身份证URL 
     *  file_r 上传反面身份证URL
     *  file_hand 上传手持身份证URL  
     */
    public function getIdCard() {
        $info = I('post.');
 
        $attest =M ('Authentication'); 

        $result = \StatusCode::code(0);

        $map['authentication_id'] = \Common::generateId();
        $map['user_id'] = $this->user_id;
        $map['f_status_url'] = $info['file_f'];
        $map['r_status_url'] = $info['file_r'];
        $map['hand_status_url'] = $info['file_hand'];
        $map['is_deleted'] = IS_NOT_DELETED;
        $map['status'] = ATTEST_STATUS_AUTID;
        $map['update_time'] = time();
        $map['create_time'] = time();
        $data = $attest->add($map);
        if(!$data) {
			$this->ajaxReturn(\StatusCode::code(-1));
        } else {
            $this->ajaxReturn($result);
        }
    }

    /**
     * 上传文件
     * 
     */
    public function getUpload() {
        $upload = new \Think\Upload();
        $upload->maxSize   =     31457280;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        // 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; 
        $upload->savePath  =     'action/IDcard/';

        $info = $upload->uploadOne($_FILES['imgaddr']);
        
        if(!$info) {
            $this->error($upload->getError());
        } else {
            $file_name = $info['savepath'].$info['savename'];
            $file_address = HOST_PATH.'/Uploads/'.$file_name;   
        }
        $result = \StatusCode::code(0);
        $map['file_name'] = $file_name;
        $map['file_address'] = $file_address;
        $result['data'] = $map;
        $this->ajaxReturn($result);

    }

    //银行卡判断
    public function judgeBank(){
        $bankcade = M('User_account');
        $map['user_id'] = $this->user_id;

        $info = $bankcade->where($map)->field('bank_num')->select(); 

        if($info){
            $result = \StatusCode::code(0);
        }else{
            $result = \StatusCode::code(4000);
        }
        $this->ajaxReturn($result);
    }

    // 绑定银行卡
    // bank_num bank_name bank_branch  bank_account
    public function Bankcard(){
        $getdata = I('post.');

        //md5验证
        $md5Str = $getdata['bank_num'] . $getdata['nonce_str'];
        if (!\Common::verifyMd5($getdata['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

        $map['user_id'] = $this->user_id;

        $bankcade = M('User_account');
        $Bank = M('Bank');

        // 判断分行是空时
        if (!empty($getdata['bank_branch'])) {
            $Bank->startTrans();
            $bData['bank_id']     = \Common::generateId();
            $bData['bank_name']   = $getdata['bank_branch'];
            $bData['bank_type']   = 2;
            $bData['bank_parent'] = $getdata['bank_name'];
            $bData['create_time'] = time();

            $bInfo = $Bank->add($bData);
            $bInfo < 1 
                ? $this->ajaxReturn(\StatusCode::code(-1))
                : '';

            $getdata['bank_branch'] = $bData['bank_id'];
        }

        $getdata['update_time'] = time();
        $info = $bankcade->where($map)->save($getdata); 

        if($info){
            $result = \StatusCode::code(0);
        }else{
            $Bank->rollback();
            $result = \StatusCode::code(4000);
        }
        $result['aa'] = $getdata;

        $Bank->commit();
        $bankcade->commit();

        $this->ajaxReturn($result);
    }

    /**
     * 获取当前用户银行卡信息
     * 方式：POST
     * URL: /Home/Setting/userBank
     */
    
    public function userBank(){
        $getdata = I('post.');

        $Bank=M('User_account');

        $map['user_id'] = $this->user_id;

        $data =$Bank->where($map)->field('bank_num,bank_name,bank_branch, bank_account')->select();
        if($data[0]['bank_num'] == null){
            $result = \StatusCode::code(4000);
         }else{
            $result = \StatusCode::code(0);
            $result['data'] = $data;
         }
        $this->ajaxReturn($result);
    }

    //获取当前通知设定的状态
    public function emailDefult(){
        $set = M('User_set');
        $map['user_id'] = $this->user_id;
        $map['is_deleted'] = IS_NOT_DELETED;
        $data = $set->where($map)->field('email_login,email_get,email_buy')->select();
        $result = \StatusCode::code(0);
        $result['data'] = $data;
        $this->ajaxReturn($result);
    }

    /**
     * 郵件通知設定(登录成功)
     * mothod: post
     * url: /Home/Setting/emailLogin
     */
    public function emailSet() {
        $info = I('post.');

        $set = M('User_set');

        $map['user_id'] = $this->user_id;
        $map['is_deleted'] = IS_NOT_DELETED;

        $i = $set->where($map)->save($info);
        
        if (!$i) {
            $this->ajaxReturn(\StatusCode::code(-1));
        }
        
        $this->ajaxReturn(\StatusCode::code(0));
    }
    
    /**
     * 郵件通知查询
     * mothod: get
     * url: /Home/Setting/getEmailStatus
     */
    public function getEmailStatus() {

        $set = M('User_set');

        $map['user_id'] = $this->user_id;
        $map['is_deleted'] = IS_NOT_DELETED;

        $data = $set->where($map)->field("
            email_login,
            email_get,
            email_buy
            ")->select();

        $result['data'] = $data[0];

        $this->ajaxReturn($result);
    }

    /**
     * 获取手机号码
     * URL：/Home/Setting/updatePhone
     * method: get
     */
    public function updatePhone() {
        $user = M('User');

        $map['user_id'] = $this->user_id;
        $info = $user->where($map)->field('tel')->select();
        foreach ($info as $data) {}
        $result = \StatusCode::code(0);
        $result['data'] = $data;
        $this->ajaxReturn($result);
    }
    /**
     * 获取银行信息
     * URL：/Home/Setting/getBankInfo
     * method: get
     */
    public function getBankInfo() {
        $bank = M('Bank');
        $data = I('get.');

        $data['is_deleted'] = IS_NOT_DELETED;

        $info = $bank
			->where($data)
			->field('
            bank_name,
            bank_id
            ')
			->order('bank_name asc')
			->select();
        $result = \StatusCode::code(0);
        $result['data'] = $info;
        $result['type'] = $data['type'];
        $this->ajaxReturn($result);
    }

    /**
     *短信验证
     *method: get
     *url: /Home/Setting/sendCode
     * 
     */
    public function sendCode(){
        $user = M('User');
        $map['user_id'] = $this->user_id;
        $data = $user->where($map)->field('tel')->select();
        foreach ($data as $row) {}
        $tel = explode("-",$row['tel']);
        $verify = new AlismsController(); //此类存放在Common\Controller\
        $verify->code($tel[1],$msg);
        $code = session('code');
        $result = \StatusCode::code(0);
        $result['msg'] = $msg; 
        $result['code'] = $code;
        $this->ajaxReturn($result);
    }
    /**
     * 短信验证开启判断
     * method: get
     * url: /Home/Setting/msgStatus
     */
    public function msgStatus() {
        $msg = M('Message');
        $data = $msg->field('status')->select();
        foreach ($data as $row) {}
        $result = \StatusCode::code(0);
        $result['status'] = $row['status'];
        $this->ajaxReturn($result);
    }

    /**
     * 短信验证码判断
     * method： post
     * url: /Home/Setting/msgCode
     * 参数： code 输入的验证码
     * @return 0-验证码正确 1-验证码错误
     */
    public function msgCode() {
        $info = I('post.');
        $getCode = $info['code'];
        $code = session('code');
        if($code == $getCode) {
            $this->ajaxReturn('0');
        } else {
            $this->ajaxReturn('1');
        }
    }
}

    