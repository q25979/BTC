<?php
namespace Demo\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use Think\Controller;
header('Content-type:text/html; charset=utf-8');
/**
 * 作者：亮哥
 * 时间：2018年4月16日16:51:07
 * 功能：联系我们
 */
class ContactUsController extends Controller {
    public function index() {
        $this->display();

    }
    
 	/**
     * 用户发送联系我们的内容
     * 方式：post
     * URL：/Home/ContactUs/getInfo
     * 参数：有
     * @param user_id  用户id
     * @param system_order 交易ID(选填)
     * @param email 邮箱
     * @param name  名字
     * @param topic  问题题目
     * @param content 问题内容
     * @param file_status 文件状态 
     * @param photo  上传文件字段域
     */
    public function getInfo() {
    	$info = I('post.');  
        $contact = M('Problem');
        $attach = M('Problem_attach');
        $upload = new \Think\Upload();
        $upload->maxSize   =     100000000;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  =      './Uploads/'; 
        $upload->savePath  =      '';

        $row = $upload->uploadOne($_FILES['photo']);

        echo "<pre>";
            print_r($info);
        echo "</pre>";
        exit;
        $rule['user_id'] = $info['user_id'];
        $rule['email'] = $info['email'];
        $rule['name'] = $info['name'];
        $rule['topic'] = $info['topic'];
        $rule['content'] = $info['content']; 
        $rule['system_order'] = $info['system_order'];
        $rule['create_time'] = time();
        $rule['problem_id'] = \Common::generateOrder();
        $rule['is_deleted'] = IS_NOT_DELETED;
        
        if($info['file_status'] == 1) {
            if(!$row){
                $this->ajaxReturn(\StatusCode::code('上传失败！'));
            } else {
                foreach ($row as $file) {
                    $file_name = $file['savepath'].$file['savename'];
                    $file_address = '/Uploads/'.$file_name;
                }

                $map['attach_id'] = \Common::generateId();
                $map['problem_id'] = $rule['problem_id'];
                $map['file_name'] = $file_name;
                $map['file_address'] = $file_address;
                $map['create_time'] = time();
                $map['is_deleted'] = IS_NOT_DELETED;

                $result_content = $contact->add($rule); 
                $result_file = $attach->add($map);
                if(isset($result_file) && isset($result_content)) {
                    $this->ajaxReturn(\StatusCode::code(0));
                } else {
                    $this->ajaxReturn(\StatusCode::code('error'));
                }
            }
                    
            
        }
        // if($info['file_status'] == 0) {
        //     $data = $contact->add($rule);
        //     if($data) {
        //         $this->ajaxReturn(\StatusCode::code(0));
        //     } else {
        //         $this->ajaxReturn(\StatusCode::code('error'));
        //     }
        // }            
        
    }


}
