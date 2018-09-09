<?php
namespace Home\Controller;

/**
 * 作者：671
 * 时间：2018年4月30日21:58:03
 * 功能：使用条款
 */
class PDFController extends LoginController {
    public function index() {
    	$d = I('get.');
    	$u = HOST_PATH.'/Uploads/static/file/';

    	if ($d['type'] == 'termsOfUse') $u .= 'Terms-of-Use.pdf';
    	if ($d['type'] == 'privacy')    $u .= 'Privacy-Policy.pdf';

		$this->assign('url', $u);    	
    	$this->display();
    }
}
