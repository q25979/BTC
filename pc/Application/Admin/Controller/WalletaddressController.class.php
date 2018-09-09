<?php
namespace Admin\Controller;

// +---------------------------------------------------
// | 作者：dong
// +---------------------------------------------------
// | 时间：2018年4月23日19:56:32
// +---------------------------------------------------
// | 功能：钱包地址
// +---------------------------------------------------

class WalletaddressController extends VerifyController {
    public function AddreUpdate() {
        $this->display();
    }

    //查看钱包地址
    public function address(){
        $getdata = I('get.');

        $address = M('WalletAddress as wa');

        $map['is_deleted'] = IS_NOT_DELETED; 
        
        $info = $address->where($map)->select();

        $info = $this->setStatus($info);

        if($info){
            $result = \StatusCode::code(0);
        }else{
            $result = \StatusCode::code(4000);
        }

        $result['count'] = $address->where($map)->count();
        $result['data'] = $info;
        $this->ajaxReturn($result);
    }

    //根据ID查看
    public function addressInfo(){
        $data = I('post.');

        $address = M('WalletAddress as wa');

        $map['is_deleted'] = IS_NOT_DELETED; 
        $map['wallet_address_id'] = $data['id']; 
        
        $info = $address->where($map)->select();

        if($info){
            $result = \StatusCode::code(0);
        }else{
            $result = \StatusCode::code(4000);
        }

        $result['data'] = $info;
        $this->ajaxReturn($result);
    }

    //修改地址
    public function UpdateAddress(){

        $data = I('post.');
        $table = M('WalletAddress');

        //md5验证
        $md5Str = $data['address'] . $data['nonce_str'] . $data['wallet_address_id'];
        if (!\Common::verifyMd5($data['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

        $map['wallet_address_id'] = $data['wallet_address_id'];
        if (!empty($data['address'])) {
            $param['address'] = $data['address'];
        }
        if (!empty($data['address_url'])) {
            $param['address_url'] = $data['address_url'];
        }
        $param['update_time'] = time();
        
        $info = $table->where($map)->save($param);

        if($info){
            $result = \StatusCode::code(0);
        }else{
            $result = \StatusCode::code(4000);
        }

        $this->ajaxReturn($result);

    }

    /**
     * 文件上传
     * @return type
     */
    public function uploadFile(){

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->autoSub   =     false;
        $upload->subName   =     '';
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'static/walletAddress/'; // 设置附件上传根目录


        // 上传文件 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息

            $this->error($upload->getError());

        }else{// 上传成功

            $result = \StatusCode::code(0);
            $img_url=$info['file']['savepath'].$info['file']['savename'];
            $map['img_url']=$img_url;
            $map['img_name']=$info['file']['savename'];
            $result['data'] = $map;
            $this->ajaxReturn($result);

        }
    }

    //状态设置
    private function setStatus($info){

        foreach ($info as $key => $value) {
            
            if (!empty($value['update_time'])) {
                $info[$key]['update_time'] = date('Y-m-d', $value['update_time']);
            }

            if($value['type'] ==BTC){
                $info[$key]['type_name'] = 'BTC';
            }else{
                $info[$key]['type_name'] = 'ETH';
            }
        }
        return $info;
    }

}