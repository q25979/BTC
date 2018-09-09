<?php
namespace Home\Controller;

/**
 * 作者：亮哥
 * 时间：2018年4月16日16:51:07
 * 功能：消息提示
 */
class MessageTipController extends VerifyController {
    public function index() {
        $this->display();

    }
    /**
     * 用户消息通知
     * URL: /Home/MessageTip/News
     * POST
     * @param user_id  用户ID
     * 
     */

    public function News(){
    	$getData=I('get.');

        $Information=M('Information as a');
        $I18nId = M('I18n');

         $join = (
            array("left join btc_user as u on u.maincoin_id = a.maincoin_id and u.is_deleted = '0'")
        );

        $map['a.is_deleted'] = IS_NOT_DELETED;
        $map['user_id'] = $this->user_id;
        
        $data=$Information->join($join)->where($map)->page($getData['page'],15)->order('create_time desc')->field('a.information_id,u.user_id,a.create_time,a.title_i18n_id')->select();

        foreach ($data as $k => $v) {
            $data[$k]['title'] = $this->lang == "zh-tw" 
            ? $I18nId->getFieldByI18nId($v['title_i18n_id'], 'tw_content') 
            : $I18nId->getFieldByI18nId($v['title_i18n_id'], 'en_content');
        }

        $data=$this->setStatus($data);

        $result = \StatusCode::code(0);
        $result['count'] = $Information->join($join)->where($map)->count();
        $result['data'] = $data;

        $this->ajaxReturn($result);
    }

    /**
     * 通过信息ID查询内容
     * 方式：POST
     * URL:/Home/MessageTip/newsContent
     * @param information_id
     */
    public function newsContent(){
        $getData=I('get.');

        $Information=M('Information as a');
        $I18nId = M('I18n');

        $map['a.is_deleted'] = IS_NOT_DELETED;
        $map['information_id'] = $getData['information_id'];

        $data=$Information->where($map)->order('create_time desc')->select();

        foreach ($data as $k => $v) {
            $data[$k]['title'] = $this->lang == "zh-tw"
            ? $I18nId->getFieldByI18nId($v['title_i18n_id'], 'tw_content')
            : $I18nId->getFieldByI18nId($v['title_i18n_id'], 'en_content');

            $data[$k]['content'] = $this->lang == "zh-tw"
            ? $I18nId->getFieldByI18nId($v['content_i18n_id'], 'tw_content')
            : $I18nId->getFieldByI18nId($v['content_i18n_id'], 'en_content');
        }

        $data=$this->setStatus($data);

        $result = \StatusCode::code(0);
        $result['data'] = $data;

        $this->ajaxReturn($result);
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
