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
}