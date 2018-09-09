<?php
namespace Admin\Controller;

/**
 * 作者：亮哥
 * 时间：2018年4月21日15:47:42
 * 功能：客服
 */
class ServiceController extends VerifyController {
    public function Service() {
		$this->display();
	}
    /**
     * 客服信息
     * 方式：GET
     * URL：/Admin/serviceInfo
     * 参数：无
     */
	public function serviceInfo(){ 
        $getData=I('get');

        $Service=M('Service');
        $HomeInfo = M('HomeInfo');

        $data = $Service->select();
        $home = $HomeInfo->select();
        $data['service_status'] = $home[0]['service_status'];

        $result = \StatusCode::code(0);

        $result['data'] = $data;
          
        $this->ajaxReturn($result);
	}

    /**
    * 客服浮动(操作bulletin表)
    * 方式：POST
    * URL：/Admin/noticeSwicth
    * 参数：有
    * @param  float_status
    */
    public function serviceSwicth(){
        
        $homeInfo = M('HomeInfo');
        $data = I('post.');

        $info = $homeInfo->where('id ='.HOME_INFO_ID)->save($data);
        if(!$info){
            $result = \StatusCode::code(4002);
            $this->ajaxReturn($result);
        }

        $result = \StatusCode::code(0);
        $this->ajaxReturn($result);
    }

    /**
     * 客服设置(修改ID为常量类里的功用ID)
     * 方式：POST
     * URL：/Admin/setService
     * 参数：无
     * @param name     名称
     * @param tel      电话
     * @param wechat   微信
     * @param qq       QQ
     */
    public function setService(){
        $getData=I('post.');

        $Service=M('Service');

        $map['service_id'] = HOME_INFO_ID;

        $data = $Service->where($map)->save($getData);

        $result = \StatusCode::code(0);

        $result['data'] = $data;
          
        $this->ajaxReturn($result);
    }

    
}
