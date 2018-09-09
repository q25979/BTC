<?php
namespace Home\Controller;

/**
 * 作者：新疆哥
 * 时间：2018年4月16日16:51:07
 * 功能：Send货币
 */
class SendController extends VerifyController {
    
	/**
	 * 发送页面渲染
	 */
    public function index() {
        $this->display(); 
    }

    public function receive() {
        $this->display();
    }

	public function receiveDetail () {
		$this->display();
	}

    /**
     * 获取余额 价格
     * method post
     * URL :/Home/Send/getBalance
     * @param  currency_type 币种
     * @param  nonce_str
     * @param  sign		
     */
    public function getBalance() {
    	$info = I('post.');

    	//md5验证
    	$md5Str = $info['currency_type'].$info['nonce_str'];
    	if(!\Common::verifyMd5($info['sign'], $md5Str)) {
    		$this->ajaxReturn(\StatusCode::code(-100));
    	}

        $res = $this->getFloat();
        
    	$balance = M('User_account');
    	$map['is_deleted'] = IS_NOT_DELETED;
    	$map['status'] = USER_STATUS_ENABLE;
    	$map['user_id'] = $this->user_id;
    	$data = $balance->field('btc_balance,eth_balance')->where($map)->select();
    	foreach ($data as $row) {
            $btc_balance = $row['btc_balance'];
            $eth_balance = $row['eth_balance'];
        }
    	$result = \StatusCode::code(0);
        if($info['currency_type'] == CURRENCY_TYPE_BTC) {
            $result['btc_balance'] = $btc_balance;
            $result['btc_twd'] = $res['btc_twd'];
        }
        if($info['currency_type'] == CURRENCY_TYPE_ETN) {
            $result['eth_balance'] = $eth_balance;
            $result['eth_twd'] = $res['eth_twd'];
        }
    	
    	$this->ajaxReturn($result);
    }
    /**
     * 检验虚拟币余额是否充足
     * url /Home/Send/balanceCheck
     * method: post
     * @param currency_type 币种类型
     * @param number 发送虚拟币数量
     */
    public function balanceCheck() {
        $info = I('post.');

        $balance = M('User_account');
        $map['user_id'] = $this->user_id;
        $map['status'] = ACCOUNT_STATUS_ENABLE;
        $map['is_deleted'] = IS_NOT_DELETED;
        $data = $balance->where($map)->field('btc_balance,eth_balance')->select();
        foreach ($data as $row) {}

        if($info['currency_type'] == CURRENCY_TYPE_BTC) {
            if($row['btc_balance'] < $info['number'] ) {
                $result = \StatusCode::code(1);
                $result['data'] = 'BTC账户余额不足！';
                $this->ajaxReturn($result);
            } else {
                $result = \StatusCode::code(2);
                $result['data'] = 'BTC账户余额充足！';
                $this->ajaxReturn($result);
            }
        }
        
        if($info['currency_type'] == CURRENCY_TYPE_ETN) {
            if($row['eth_balance'] < $info['number'] ) {
                $result = \StatusCode::code(3);
                $result['data'] = 'ETH账户余额不足！';
                $this->ajaxReturn($result);
            } else {
                $result = \StatusCode::code(4);
                $result['data'] = 'ETH账户余额充足！';
                $this->ajaxReturn($result);
            }
        }
    }

   

     /**
     * 上传文件
     * /home/Send/getUpload
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
        $upload->savePath  =     'action/sendImg/';

        $row = $upload->upload();
        
        if(!$row) {
            $this->error($upload->getError());
        } else {
            foreach ($row as $data) { 
                $file_name = $data['savepath'].$data['savename'];
                $file_url = HOST_PATH.'/Uploads/'.$file_name;   
            }
        }

        $result = \StatusCode::code(0);
        $map['file_name'] = $file_name;
        $map['file_url'] = $file_url;
        $result['data'] = $map;
        $this->ajaxReturn($result);

    }

    /**
     * 发送货币
     * method: post
     * URL: /Home/Send/getSendInfo
     * @param currency_type 发送币种类型
     * @param send_address 	发送地址
     * @param maincoin_id   接收方ID
     * @param number 		发送数量
     * @param  url_img    上传的照片
     * @param leave_words	留言
     * @param nonce_str		
     * @param sign
     */
    public function getSendInfo() {
    	$info = I('post.');

    	//md5验证
    	$md5Str = $info['currency_type'].$info['maincoin_id'].$info['number'].$info['nonce_str'].$info['send_address'];
    	if(!\Common::verifyMd5($info['sign'],$md5Str)) {
    		$this->ajaxReturn(\StatusCode::code(-100));
    	}
   
        $res['user_id'] = $this->user_id;
    	   	
    	$res['send_address'] = $info['send_address'];
    	$res['maincoin_id'] = $info['maincoin_id'];
    	$res['number'] = $info['number'];
    	$res['leave_words'] = $info['leave_words'];
    	$res['send_id'] = \Common::generateId();
    	$res['create_time'] = time();
        $res['is_deleted'] = IS_NOT_DELETED;
        $res['status'] = SEND_STATUS_SUBMIT;
        $res['img_url'] = $info['file_url'];

    	$send = M('Send');
    	$account = M('User_account');
    	$map['user_id'] = $this->user_id;
   	    
    	if($info['currency_type'] == CURRENCY_TYPE_BTC) {
            $res['currency_type'] = CURRENCY_TYPE_BTC;
    		$send->add($res);           
    		$row = $account->where($map)->select();
    		
    		foreach ($row as $k => $v) {
    			$balance = $row[$k]['btc_balance']-$info['number'];		
                if ($balance < 0) {
                        $this->ajaxReturn(\StatusCode::code(-1));
                }	
    		} 
    		$rule['btc_balance'] = $balance;
    		$rule['update_time'] = time();
    		$account->where($map)->save($rule); 

            //如果有设置賣出提醒的用户要发送邮件
            $userSet = M('UserSet');
            $user = M('User');

            $param['user_id'] = $this->user_id;
            $setParam = $userSet->where($param)->field("
                email_get
                ")->select();
            if ($setParam[0]['email_get'] == USER_SET_EMAIL_GET_YES) {
                //查询发送邮箱
                $email = $user->getFieldByUserId($this->user_id,'email');

                $userInfo = $user->where($param)->select();
                //发送邮件
                $userInfo[0]['time'] = time();
                $userInfo[0]['time'] = date('Y-m-d', $userInfo[0]['time']);

                $mail = new \SendEmail($email, '發送提示', $this->hintHtml($userInfo[0]));
                $mail->send();
            }

    		$this->ajaxReturn(\StatusCode::code(0));
    	} 
    	if($info['currency_type'] == CURRENCY_TYPE_ETN) {
    		$res['currency_type'] = CURRENCY_TYPE_ETN;
    		$send->add($res);    		
    		$row = $account->where($map)->select();
    		
    		foreach ($row as $k => $v) {
    			$balance = $row[$k]['eth_balance']-$info['number'];	
                if ($balance < 0) {
                        $this->ajaxReturn(\StatusCode::code(-1));
                }   	 	
    		}

    		$rule['eth_balance'] = $balance;
    		$rule['update_time'] = time();
    		$account->where($map)->save($rule);

            //如果有设置賣出提醒的用户要发送邮件
            $userSet = M('UserSet');
            $user = M('User');

            $param['user_id'] = $this->user_id;
            $setParam = $userSet->where($param)->field("
                email_get
                ")->select();
            if ($setParam[0]['email_get'] == USER_SET_EMAIL_GET_YES) {
                //查询发送邮箱
                $email = $user->getFieldByUserId($this->user_id,'email');

                $userInfo = $user->where($param)->select();
                //发送邮件
                $userInfo[0]['time'] = time();
                $userInfo[0]['time'] = date('Y-m-d', $userInfo[0]['time']);

                $mail = new \SendEmail($email, '發送提示', $this->hintHtml($userInfo[0]));
                $mail->send();
            }

    		$this->ajaxReturn(\StatusCode::code(0));

    	}
    } 
    
        /**
     * 货币浮动后价值
     */
    public function getFloat() {
        
        $currency = M('ShowCurrencyValue');

        $data = $currency->select();
        
        foreach ($data as $k => $v) {
                $btc_twd = $data[$k]['btc_value_twd'];
                $eth_twd = $data[$k]['eth_value_twd'];
        }
        $result['btc_twd'] = $btc_twd;
        $result['eth_twd'] = $eth_twd;
        
        return $result;
    }

    /**
     * hintHtml(提示的HTML)
     */
    private function hintHtml($data) {
        $rece = EmailController::receive();

        $html  = '';
        $html .= '<!DOCTYPE html>';
        $html .= '<html lang="en">';
        $html .= '<head>';
        $html .= '<meta charset="UTF-8" />';
        $html .= '<style>'. $this->hintStyle() .'</style>';
        $html .= '</head>';
        $html .= '<body>';
        $html .= '<block name="receive">';
        $html .= '<div class="receive-container">';
        $html .= '<div class="receive-content">';
        $html .= '<div class="receive-content-hd"></div>';
        $html .= '<div class="receive-content-bd">';
        $html .= '<div class="receive-logo">';
        $html .= '<h3 class="receive-logo-title">'. $rece['name'] .'</h3>';
        $html .= '</div>';

        $html .= '<div class="receive-text-content">';
        $html .= '<p>親愛的 '. $data['user_name'] .' :</p>';
        $html .= '<p>您與'. $data['time'] .'，進行了發送交易，若非本人操作請及時聯繫客服。</p>';

        $html .= '<p>若有任何疑問，請寫信至<a href="javascript:">'. $rece['company_email'] .'</a>';
        $html .= '，或撥打客服專線<span class="receive-phone">'. $rece['company_tel'] .'</span></p>';
        $html .= '<p>感謝您選擇 '. $rece['name'] .'</p>';
        $html .= '<p>'. $rece['name'] .' 敬上</p>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="receive-content-fd">';
        $html .= '<p>關於本訊息</p>';
        $html .= '<p>本服務訊息是寄給 '. $rece['name'] .'客戶，以提供您賬戶最新資料。您的個人資料受到 ';
        $html .= $rece['name'].' 技術的保護。</p>';
        $html .= '<ul><li><a href="javascript:;" target="_blank">取消訂閱</a></li>';
        $html .= '<li><a href="javascript:;" target="_blank">使用條款</a></li>';
        $html .= '<li><a href="javascript:;" target="_blank">隱私權政策</a></li>';
        $html .= '<li><a href="javascript:;" target="_blank">常見問題</a></li></ul></div></div></div>';
        $html .= '</block>';
        $html .= '</body>';
        $html .= '</html>';

        return $html;
    }
    /**
     * css（提示的CSS）
     */
    private function hintStyle() {
        $css  = '.receive-container{margin-top: 50px; width: 100%; height: 500px;background-color: #fff;}';
        $css .= '.receive-content{width: 580px;height: 500px;background-color: #fff;margin: 0 auto;}';
        $css .= '.receive-content-hd{width: 580px;height: 10px;background-color: red;}';
        $css .= '.receive-content-bd{width: 580px;height: 370px;background-color: #fff;}';
        $css .= '.receive-logo{width: 580px;height: 140px;display: flex;flex-direction: column;align-items: center;}';
        $css .= '.receive-logo-img{margin-top: 20px;width: 50px;height: 50px;margin-bottom: 15px;}';
        $css .= '.receive-logo-title{color: #DE0000;margin: 0;}';
        $css .= '.receive-text-content{width: 580px;height: 220px;padding: 0 16px}';
        $css .= '.receive-text-content p{margin-bottom: 14px;font-size: 14px;}';
        $css .= '.receive-website{font-size: 14px;width: 380px;display: inline-block;color: #53AFD2;margin-bottom: 14px;text-decoration: underline;}';
        $css .= '.receive-website:hover{color: #EF5356;}';
        $css .= '.receive-email{color: #558DB5;}';
        $css .= '.receive-phone{color: #383838;border-bottom: 1.5px #D9E0DB dashed !important;}';
        $css .= '.receive-content-fd{width: 580px;height: 120px;background-color: #F3F3F3;padding: 10px 12px;}';
        $css .= '.receive-content-fd p{color: #9E9E9E;margin-bottom: 10px;}';
        $css .= '.receive-content-fd ul{list-style: none;}';
        $css .= '.receive-content-fd li{float: left;text-decoration: underline;margin-right: 44px;}';
        $css .= '.receive-content-fd a{color: #949597;font-size: 14px;}';
        $css .= '.receive {width: 100%;margin-top: 3px;box-shadow: 0 -2px 2px #E0E0E0;}';

        return $css;
    }


    	
}


