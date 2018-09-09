<?php
namespace Home\Controller;

/**
 * 作者：新疆哥
 * 时间：2018年4月16日16:51:07
 * 功能：浮动框
 */
class PopupWindowController extends VerifyController {
    /**
     * 获取公告数据
     * URL: /Home/PopupWindow/getBulletin
     * meodth GET
	 * 参数 无
     */
    public function getBulletin() {

    	$getData=I('post.');

        $Information=M('Bulletin as b');
        $I18nId = M('I18n');

        $map['b.is_deleted'] = IS_NOT_DELETED;
        $map['b.status'] = BULLETIN_ISSUE_STATUS_OFF;
        
        $data=$Information->where($map)->order('create_time desc')->field('b.bulletin_id,b.create_time,b.bulletin_title_i18n')->select();

        foreach ($data as $k => $v) {
            $data[$k]['title'] = $this->lang == "zh-tw"
            ? $I18nId->getFieldByI18nId($v['bulletin_title_i18n'], 'tw_content')
            : $I18nId->getFieldByI18nId($v['bulletin_title_i18n'], 'en_content');
        }

        $data=$this->setStatus($data);

        $result = \StatusCode::code(0);
        $result['data'] = $data;

        $this->ajaxReturn($result);       
    }
    /**
     * 判断公告是否悬浮
     * URL: /Home/PopupWindow/isColse
     * meodth GET
     * 参数 无 
     */
    public function isBuClose() {
        $home = M('HomeInfo');
        $data = $home
            ->field('bulletin_status')
            ->select();
        if ($data[0]['bulletin_status'] == BULLETIN_STATUS_OFF) {//关闭就返回false
            $result = false;
            $this->ajaxReturn($result); 
        }
        $result = true;
        $this->ajaxReturn($result); 
    }

    /**
     * 根据ID查看公告详细
     * URL: /Home/PopupWindow/getBulletinContent
     */
    public function getBulletinContent() {
        $getData=I('get.');

        $Bulletin=M('Bulletin as b');
        $I18nId = M('I18n');

        $map['b.is_deleted'] = IS_NOT_DELETED;
        $map['b.bulletin_id'] = $getData['bulletin_id'];

        $data=$Bulletin->where($map)->select();

        foreach ($data as $k => $v) {
            $data[$k]['title'] = $this->lang == "zh-tw"
            ? $I18nId->getFieldByI18nId($v['bulletin_title_i18n'], 'tw_content')
            : $I18nId->getFieldByI18nId($v['bulletin_title_i18n'], 'en_content');

            $data[$k]['content'] = $this->lang == "zh-tw"
            ? $I18nId->getFieldByI18nId($v['bulletin_content_i18n'], 'tw_content')
            : $I18nId->getFieldByI18nId($v['bulletin_content_i18n'], 'en_content');
        }

        $data=$this->setStatus($data);

        $result = \StatusCode::code(0);
        $result['data'] = $data;

        $this->ajaxReturn($result);
    }

    /**
     * 公告模板 
     */
    public function bulletin() {
    	$this->display();
    }

    /**
     * 获取客服信息
     * URL: /Home/PopupWindow/getCallCenter
     * meodth GET
     * 参数 无 
     */
    public function getCallCenter() {


        $getData =I('get.');
    	$service = M('Service');

    	$data = $service->field('name')->select();

        foreach ($data as $row) {
        }
        $arr = array();
        $arr = explode(",",$row['name']);
        $this->ajaxReturn($arr);

    }
    /**
     * 判断是否悬浮
     * URL: /Home/PopupWindow/isColse
     * meodth GET
     * 参数 无 
     */
    public function isSvClose() {
        $home = M('HomeInfo');
        $data = $home
            ->field('service_status')
            ->select();
        if ($data[0]['service_status'] == SERVICE_STATUS_OFF) {//关闭就返回false
            $result = false;
            $this->ajaxReturn($result); 
        }
        $result = true;
        $this->ajaxReturn($result); 
    }
    /**
     * 客服中心
     */
    public function callCenter() {
        $this->display();
    }
    /**
     * 设置状态
     * @param $data     数据库获取的数据
     * @return json     更改之后的数据
     */
    private function setStatus($data) {

        foreach ($data as $k => $v) {
            // 转换时间
            $data[$k]['create_time'] = date('Y-m-d', $v['create_time']);
        }

        return $data;
    }
    

}
