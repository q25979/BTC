<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 作者：671
 * 时间：2018年9月29日10:23:37
 * 描述：博彩功能
 */
class BocaiController extends VerifyController 
{
	// 博彩首页
	public function index()
	{
		$this->display();
	}

	// 獲取餘額
	public function getbalance()
	{
		$result = M('UserAccount')->getFieldByUserId($this->user_id, 'extract_balance');
		$this->ajaxReturn($result);
	}

	// 买
	public function deal()
	{
		$type = I('get.type');
		$title = $type == 1 ? "買漲" : "買跌";

		$this->assign([
			'title'	=> $title
		]);
		$this->display();
	}
}