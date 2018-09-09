<?php
namespace Home\Controller;

/**
 * 作者：庄
 * 时间：2018年4月16日16:51:07
 * 功能：常见问题
 */
class QuestionController extends LoginController {
    public function index() {
    	$this->display();
    }

    /**
     * 获取所有常见问题
     */
    public function getCommonProblemAll() {
		$common = M('CommonProblem');
		$I18nId = M('I18n');

		$map['is_deleted'] = IS_NOT_DELETED;

		$info = $common
            ->where($map)
            ->field('
                common_problem_id,
			    title_i18n_id,
			    type
			')
            ->select();
		foreach ($info as $k => $v) {
            $info[$k]['title'] = $this->lang == "zh-tw"
            ? $I18nId->getFieldByI18nId($v['title_i18n_id'], 'tw_content')
            : $I18nId->getFieldByI18nId($v['title_i18n_id'], 'en_content');
		}

		if($info){
			$result = \StatusCode::code(0);
		}else{
			$result = \StatusCode::code(4002);
		}

		$result['data'] = $info;
		$result['lang'] = $this->lang;
		$this->ajaxReturn($result);
    }
    /**
     * 按照类型获取常见问题数据
     */
    public function getFAQ() {
		$common = M('Common_problem');
		$I18nId = M('I18n');
		$data = I('get.');

		$data['is_deleted'] = IS_NOT_DELETED;

		$info = $common->where($data)->field('
			title_i18n_id,content_i18n_id,type,create_time,common_problem_id
			')->select();
		foreach ($info as $k => $v) {
			$info[$k]["content"] = $this->lang == "zh-tw"
            ? $I18nId->getFieldByI18nId($v['content_i18n_id'], 'tw_content')
            : $I18nId->getFieldByI18nId($v['content_i18n_id'], 'en_content');

            $info[$k]['title'] = $this->lang == "zh-tw"
            ? $I18nId->getFieldByI18nId($v['title_i18n_id'], 'tw_content')
            : $I18nId->getFieldByI18nId($v['title_i18n_id'], 'en_content');
		}

		if($info){
			$result = \StatusCode::code(0);
		}else{
			$result = \StatusCode::code(4002);
		}

		$result['data'] = $info;
		$result['lang'] = $this->lang;
		$this->ajaxReturn($result);
    }

    /**
     * 获取问题详情
     *
     * method: get
     * url: /Home/Question/details
     * @param common_problem_id
     */
    public function details() {
        $cp   = M('CommonProblem');
        $I18n = M('I18n');
        $data = I('get.');

        $map['is_deleted']          = IS_NOT_DELETED;
        $map['common_problem_id']   = $data['common_problem_id'];
        $cpInfo = $cp->where($map)
            ->field('title_i18n_id, content_i18n_id')
            ->find();

        $iInfo['title']   = $this->lang == 'zh-tw'
            ? $I18n->getFieldByI18nId($cpInfo['title_i18n_id'], 'tw_content')
            : $I18n->getFieldByI18nId($cpInfo['title_i18n_id'], 'en_content');

        $iInfo['content'] = $this->lang == 'zh-tw'
            ? $I18n->getFieldByI18nId($cpInfo['content_i18n_id'], 'tw_content')
            : $I18n->getFieldByI18nId($cpInfo['content_i18n_id'], 'en_content');

        $result = \StatusCode::code(0);
        $result['data'] = $iInfo;
        $this->ajaxReturn($result);
    }

    /**
     * 常见问题数据获取
     * 方式：POST
     * URL：/Home/Question/getCommonProblemFive
     */
    
     public function getCommonProblemFive() {
		$common = M('CommonProblem');
		$I18nId = M('I18n');

		$map['is_deleted'] = IS_NOT_DELETED;

		$info = $common->where($map)->field('title_i18n_id,type')->order('common_problem_id desc')->limit(6)->select();
		foreach ($info as $k => $v) {
            $info[$k]['title'] = $this->lang == "zh-tw"
            ? $I18nId->getFieldByI18nId($v['title_i18n_id'], 'tw_content')
            : $I18nId->getFieldByI18nId($v['title_i18n_id'], 'en_content');
		}

		if($info){
			$result = \StatusCode::code(0);
		}else{
			$result = \StatusCode::code(4002);
		}

		$result['data'] = $info;
		$result['lang'] = $this->lang;
		$this->ajaxReturn($result);
    }
}
