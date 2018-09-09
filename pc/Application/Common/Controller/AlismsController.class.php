<?php
namespace Common\Controller;
use Think\Controller;
use Aliyun\DySDKLite\SignatureHelper;
require_once "Api/SignatureHelper.php"; //第一步中阿里云接口存放SignatureHelper.php的路径
class AlismsController extends Controller {
    
    public function _initialize(){
        $this->accessKeyId = $this->getAccessKeyId(); //AccessKeyId
        $this->accessKeySecret = $this->getAccessKeySecret(); //AccessKeySecret
        $this->SignName = $this->getSignName(); //签名
        $this->CodeId = $this->getCodeId(); //验证码模板ID
    }
    
    //获取accessKeyId
    public function getAccessKeyId() {
        $msg = M('Message');
        $data = $msg->field('appid')->select();
        foreach ($data as $row) {}
        return $row['appid'];
    }
    
    //获取accessKeySecret
    public function getAccessKeySecret() {
        $msg = M('Message');
        $data = $msg->field('appkey')->select();
        foreach ($data as $row) {}
        return $row['appkey'];
    }
    
    //获取签名
    public function getSignName() {
        $msg = M('Message');
        $data = $msg->field('sign')->select();
        foreach ($data as $row) {}
        return $row['sign'];
    }

    //获取验证码模板ID
    public function getCodeId() {
        $msg = M('Message');
        $data = $msg->field('template_id')->select();
        foreach ($data as $row) {}
        return $row['template_id'];
    }

    //发送验证码
    public function code($phone,&$msg){
        
        if(!$this->isphone($phone)){
            $msg = "手机号不正确";
            return false;
        }
        
        $params["PhoneNumbers"] = $phone; 
        $params["TemplateCode"] = $this->CodeId; //模板
        
        //记录存储验证码
        $code = rand(100000,999999);
        session("iphone",$phone);//session存储手机号
        session("code",$code);//session存储验证码
        $params['TemplateParam'] = ["code" => $code]; //验证码
        
        return $this->send($params,$msg);        
    }
    
    //验证手机号是否正确
    public function isphone($phone){
       if (!is_numeric($phone)) {
            return false;
        }
        return preg_match("/^1[34578]{1}\d{9}$/", $phone) ? true : false;
    }

    //发送短信消息
    public function send($params=[],&$msg){
        
        $params["SignName"] = $this->SignName;
        
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }
         $helper = new SignatureHelper();
        $content = $helper->request(
            $this->accessKeyId,
            $this->accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            ))
        );
        
        if($content===false){
            $msg = "发送异常";
            return false;
        }else{
            $data = (array)$content;
            if($data['Code']=="OK"){
                $msg = "发送成功";
                return true;
            }else{
                $msg = "发送失败 ".$data['Message'];
                return false;
            }
        }        
    }
}