<?php
namespace Home\Controller; 

/**
 * 作者：@新疆哥
 * 时间：2018年4月16日16:51:07
 * 功能：购买货币
 */
class BuyController extends VerifyController {
    /**
     * 购买模板渲染 
     */
    public function index() {
		$this->display();
	}
	/**
	 * 验证购买权限
	 * Url: /Home/Buy/check
	 */
	public function check() {

		$user = M('User_attach');
		$map['user_id'] = $this->user_id;
		$map['is_deleted'] = IS_NOT_DELETED;
		$data = $user->where($map)->count();
		
		if($data == 3) {
			$this->ajaxReturn(\StatusCode::code('拥有购买权限！'));
		} else {
			$this->ajaxReturn(\StatusCode::code('没有购买权限！'));
		}
	} 
	/**
	 * 获取账户余额、现金余额
	 * method: post 
	 * URL：/Home/Buy/getBalance
	 * @param currency_type	币种 
	 */
	public function getBalance() {
		$info = I('post.'); 
		
 		$balance = M('User_account');  
		$map['is_deleted'] = IS_NOT_DELETED;
		$map['user_id'] = $this->user_id;
		$map['status'] = USER_STATUS_ENABLE;

		if($info['currency_type'] == CURRENCY_TYPE_BTC) {
			$res = $balance->where($map)->field('btc_balance,extract_balance')->select();
			foreach ($res as $data) {}
			$da[0]['btc_balance'] = $data['btc_balance'];
			$da[1]['extract_balance'] = $data['extract_balance'];
		}
		if($info['currency_type'] == CURRENCY_TYPE_ETN) {
			$res = $balance->where($map)->field('eth_balance,extract_balance')->select();
			foreach ($res as $data) {}
			$da[0]['eth_balance'] = $data['eth_balance'];
			$da[1]['extract_balance'] = $data['extract_balance'];
		}		
		$result = \StatusCode::code(0);
		$result['data'] = $da; 
		$this->ajaxReturn($result);
	}
	/**
	 *获取单价
	 *url: /Home/Buy/getPrice
	 *method: post
	 */
	public function getPrice() {
		$info = I('post.');
		$currency = M('Home_info');
		$row = $currency->field('buy_float')->select();
		foreach ($row as $float) {
            $buy_float = $float['buy_float'];
        	}
        $twd = $this->getTwd();
        $hkd = $this->getHkd();
        $usd = $this->getUsd();   

    	$data['btc_twd'] = $twd['btc_twd'] + $twd['btc_twd'] * $buy_float;
        $data['btc_hkd'] = $hkd['btc_hkd'] + $hkd['btc_hkd'] * $buy_float;
        $data['btc_usd'] = $usd['btc_usd'] + $usd['btc_usd'] * $buy_float;

    	$data['eth_twd'] = $twd['eth_twd'] + $twd['eth_twd'] * $buy_float;
        $data['eth_hkd'] = $hkd['eth_hkd'] + $hkd['eth_hkd'] * $buy_float;
        $data['eth_usd'] = $usd['eth_usd'] + $usd['eth_usd'] * $buy_float;
        $result = \StatusCode::code(0);
        $result['data'] = $data;
        $this->ajaxReturn($result);
	}
	/**
	 *购买虚拟币
	 *URL： /Home/Buy/buyCoin
	 *method: post 
	 *@param number 		购买数量
	 *@param price 			购买总价
	 *@param money_currrency_type 货币类型1-新台币2-港币3-美元 
	 *@param payment_type	支付方式 1-银行转账2-萊爾富便利商店
	 *@param unit_price 	购买单价
	 *@param currency_type 	币种 1-BTC 2-ETC
	 *@param nonce_str	 	
	 *@param sign			
	 */
	public function buyCoin() {
		$info = I('post.'); 
		
		//MD5
		$md5Str = $info['currency_type'].$info['money_currency_type'].$info['nonce_str'].$info['number'].$info['payment_type'].$info['price'].$info['unit_price'];

		if(!\Common::verifyMd5($info['sign'],$md5Str)) {
			$this->ajaxReturn(\StatusCode::code(-100));
		}
		
		$order = M('Order_info');
		$User_account = M('User_account');

		$map['user_id'] = $this->user_id;
		$data = $User_account->where($map)->field('extract_balance')->find();

		$row['order_id'] = \Common::generateId();
		$row['user_id'] = $this->user_id;
		$row['system_order'] = \Common::generateOrder();
		$row['number'] = $info['number'];
		$row['price'] = $info['price'];
		$row['money_currency_type'] = $info['money_currency_type']; 
		$row['status'] = ORDER_STATUS_SUBMIT;
		$row['order_type'] = ORDER_TYPE_BUY;
		$row['payment_type'] = $info['payment_type']; 
		$row['unit_price'] = $info['unit_price'];
		$row['create_time'] = time();
		$row['currency_type'] = $info['currency_type'];

		if($info['currency_type'] == CURRENCY_TYPE_BTC) {	
			//订单成功后扣除现金余额
			if ($info['payment_type'] == PAYMENT_TYPE_BALANCE) {
				$rule['extract_balance'] = $data['extract_balance'] - $info['price'];
				if ($rule['extract_balance'] < 0) {
					$this->ajaxReturn(\StatusCode::code(-1));
				}

				$User_account->where($map)->save($rule);
			}		

			$result = $order->add($row);
			if($result) {
				//如果有设置购买提醒的用户要发送邮件
		        $userSet = M('UserSet');
		        $user = M('User');

		        $param['user_id'] = $this->user_id;
		        $setParam = $userSet
			        ->where($param)
			        ->field('email_buy')
			        ->select();
		        if ($setParam[0]['email_buy'] == USER_SET_EMAIL_BUY_YES) {
		            //查询发送邮箱
		            $email = $user->getFieldByUserId($this->user_id,'email');

		            $userInfo = $user->where($param)->select();
		            //发送邮件
		            $userInfo[0]['time'] = time();
		            $userInfo[0]['time'] = date('Y-m-d', $userInfo[0]['time']);

		            $mail = new \SendEmail($email, '購買提示', $this->hintHtml($userInfo[0]));
            		$mail->send();
		        }

				$this->ajaxReturn(\StatusCode::code(0));	
			} else {
				$this->ajaxReturn(\StatusCode::code(-1));
			}			
		}

		if($info['currency_type'] == CURRENCY_TYPE_ETN) {
			if ($info['payment_type'] == PAYMENT_TYPE_BALANCE) {
				//订单成功后扣除现金余额
				$rule['extract_balance'] = $data['extract_balance'] - $info['price'];
				
				if ($rule['extract_balance'] < 0) {
					$this->ajaxReturn(\StatusCode::code(-1));
				}
				$User_account->where($map)->save($rule);
			}

			$result = $order->add($row);
			if($result) {
				//如果有设置购买提醒的用户要发送邮件
		        $userSet = M('UserSet');
		        $user = M('User');

		        $param['user_id'] = $this->user_id;
		        $setParam = $userSet->where($param)->field("
		            email_buy
		            ")->select();
		        if ($setParam[0]['email_buy'] == USER_SET_EMAIL_BUY_YES) {
		            //查询发送邮箱
		            $email = $user->getFieldByUserId($this->user_id,'email');
		            $userInfo = $user->where($param)->select();
		            //发送邮件
		            $userInfo[0]['time'] = time();
		            $userInfo[0]['time'] = date('Y-m-d', $userInfo[0]['time']);
		            $mail = new \SendEmail($email, '購買提示', $this->hintHtml($userInfo[0]));
            		$mail->send();
		        }
				$this->ajaxReturn(\StatusCode::code(0));	
			} else {
				$this->ajaxReturn(\StatusCode::code(-1));
			}
		} 

	}

	/**
     * 货币浮动后价值 台币
     */
    public function getTwd() {
        
        $currency = M('ShowCurrencyValue');
        $data = $currency->select();
        
        foreach ($data as $k => $v) {
                $btc_twd = $data[$k]['btc_value_twd'];
                $eth_twd = $data[$k]['eth_value_twd'];
        }
        $result['btc_twd'] = (int)$btc_twd;
        $result['eth_twd'] = (int)$eth_twd;
        
      	return $result;
    }

    /**
     * 货币浮动后价值 港币
     */
    public function getHkd() {
        
        $currency = M('ShowCurrencyValue');
        $data = $currency->select();
        
        foreach ($data as $k => $v) {
                $btc_hkd = $data[$k]['btc_value_hkd'];
                $eth_hkd = $data[$k]['eth_value_hkd'];
        }
        $result['btc_hkd'] = (int)$btc_hkd;
        $result['eth_hkd'] = (int)$eth_hkd;
        
      	return $result;
    }

    /**
     * 货币浮动后价值 美元
     */
    public function getUsd() {
        
        $currency = M('ShowCurrencyValue');
        $data = $currency->select();
        
        foreach ($data as $k => $v) {
                $btc_usd = $data[$k]['btc_value_usd'];
                $eth_usd = $data[$k]['eth_value_usd'];
        }
        $result['btc_usd'] = (int)$btc_usd;
        $result['eth_usd'] = (int)$eth_usd;
        
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
        $html .= '<p>您與'. $data['time'] .'，進行了購買交易，若非本人操作請及時聯繫客服。</p>';

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
