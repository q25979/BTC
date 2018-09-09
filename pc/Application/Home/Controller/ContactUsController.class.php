<?php
namespace Home\Controller;

/**
 * 作者：新疆哥
 * 时间：2018年4月16日16:51:07
 * 功能：联系我们
 */
class ContactUsController extends LoginController {
    public function index() {
        $this->display();
    }
    
 	/**
     * 用户发送联系我们的内容
     * 方式：post
     * URL：/Home/ContactUs/getInfo
     * 参数：有 
     * @param system_order 交易ID(选填)
     * @param email 邮箱
     * @param name  名字
     * @param topic  问题题目
     * @param content 问题内容
     * @param file_status 文件状态
     * @param file_name
     * @param file_address 
     */
    public function getInfo() {
    	$info = I('post.'); 
       
        $contact = M('Problem');
        $attach = M('Problem_attach');      

        $rule['email'] = $info['email'];
        $rule['name'] = $info['name'];
        $rule['topic'] = $info['topic'];
        $rule['content'] = $info['content']; 
        $rule['system_order'] = $info['system_order'];
        $rule['create_time'] = time();
        $rule['problem_id'] = \Common::generateOrder();
        $rule['is_deleted'] = IS_NOT_DELETED;
       
        if($info['file_status'] == 0) {
            $data = $contact->add($rule);
            if($data) {
                $this->ajaxReturn(\StatusCode::code('数据添加成功'));
            } else {
                $this->error($contact->getError());
            }
        }
        if($info['file_status'] == 1) {
               
            $file_name = $info['file_name'];
            $file_address = $info['file_address'];
           
            $map['attach_id'] = \Common::generateId();
            $map['create_time'] = time();
            $map['problem_id'] = $rule['problem_id'];
            $map['file_name'] = $file_name;
            $map['file_address'] = $file_address;
            $map['is_deleted'] = IS_NOT_DELETED;
            $result_file = $attach->add($map);
            $data = $contact->add($rule);
            if(!isset($result_file) && !isset($data)) {
                $this->error();
            } else {
                $this->ajaxReturn(\StatusCode::code('数据文件添加成功'));
            } 
        
        }
    }

    /**
     * 上传文件
     * 
     */
    public function getUpload() {

        $upload = new \Think\Upload();
        $upload->maxSize   =     3145728;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        // 设置附件上传类型
        $upload->autoSub   =     false;
        $upload->subName   =     '';
        $upload->rootPath  =     './Uploads/'; 
        $upload->savePath  =     'action/commonQuestions/';

        $row = $upload->upload();
        
        if(!$row) {
            $this->error($upload->getError());
        } else {
            foreach ($row as $data) { 
                $file_name = $data['savename'];
                $file_address = HOST_PATH.'/Uploads/'.$data['savepath'].$file_name;   
            }
        }
        $result = \StatusCode::code(0);
        $map['file_name'] = $file_name;
        $map['file_address'] = $file_address;
        $result['data'] = $map;
        $this->ajaxReturn($result);

    }
}
