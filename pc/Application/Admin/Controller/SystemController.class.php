<?php
namespace Admin\Controller; 

use Think\Controller;
use Common\Controller\AlismsController;
/**
 * 作者：dong
 * 时间：2018年4月16日20:43:42
 * 功能：系统管理
 */
class SystemController extends VerifyController {
	public function index() {
		$this->display();
	}
	public function noticeAdd() {
		$this->display();
	}
	public function biscProblemAdd() {
		$this->display();
	}
	public function messageVerify() {
		$this->display();
	}

    /**
     * 获取汇率
     */
    public function getExchange() {
        $exchange = M('Exchange');
        $result = $exchange->find();

        $this->ajaxReturn([
            'code' => 0,
            'msg' => 'success',
            'data' => $result
        ]);
    }

    /**
     * 设置汇率
     */
    public function updateExchange() {
        $exchange = M('Exchange');
        $post = I('post.');

        $map['id'] = $post['id'];
        $find = $exchange->where($map)->find();
        if (!isset($find)) {
            // 添加
           $info = $exchange->data($post)->add();
        } else {
            // 修改
            $info = $exchange->where($map)->save($post);
        }

        $result['code'] = $info > 0 ? 0 : -1;
        $this->ajaxReturn($result);
    }

    /**
     * 刷新缓存
     */
    public function refresh() {
        $name = I('get.name');

        S($name, null);
        $this->ajaxReturn([
            'code' => 0,
            'msg' => '刷新成功'
        ]);
    }

	/**
	 * 短信开关
	 * method: post
	 * url: /Admin/System/setSwitch
	 * status 开关状态 0开启 1关闭
	 */
	public function setSwitch() {
		$info = I('post.');

		$msg = M('Message');
		$rule['status'] = $info['status'];
		$rule['update_time'] = time();
		$map['msg_id'] = '10000000000000000000000000000001';

		$data = $msg->where($map)->save($rule);
		if(!$data) {
			$this->ajaxReturn(\StatusCode::code(-1));
		} else {
			$this->ajaxReturn(\StatusCode::code(0));
		}
	}
	/**
	 * 信息获取
	 * method：get
	 * url: /Admin/System/getInfo
	 */
	public function getInfo() {
		$msg = M('Message');
		$data = $msg->select();
		foreach ($data as $row) {}
		$result = \StatusCode::code(0);
		$result['data'] = $row;
		$this->ajaxReturn($result);
	}
	/**
	 * AccessKeyID修改
	 * method: post
	 * url: /Admin/System/updateAppid
	 */
	public function updateAppid() {
		$info = I('post.');

		$msg = M('Message');
		$rule['appid'] = $info['appid'];
		$map['msg_id'] = '10000000000000000000000000000001';
		$rule['update_time'] = time();
		$data = $msg->where($map)->save($rule);
		if(!$data) {
			$this->ajaxReturn('失败');
		} else {
			$this->ajaxReturn('成功');
		}
	}

	/**
	 * AccessKeySecret修改
	 * method: post
	 * url: /Admin/System/updateAppkey
	 */
	public function updateAppkey() {
		$info = I('post.');

		$msg = M('Message');
		$rule['appkey'] = $info['appkey'];
		$map['msg_id'] = '10000000000000000000000000000001';
		$rule['update_time'] = time();
		$data = $msg->where($map)->save($rule);
		if(!$data) {
			$this->ajaxReturn('失败');
		} else {
			$this->ajaxReturn('成功');
		}
	}

	/**
	 * 短信签名修改
	 * method: post
	 * url: /Admin/System/updateSign
	 */
	public function updateSign() {
		$info = I('post.');

		$msg = M('Message');
		$rule['sign'] = $info['sign'];
		$map['msg_id'] = '10000000000000000000000000000001';
		$rule['update_time'] = time();
		$data = $msg->where($map)->save($rule);
		if(!$data) {
			$this->ajaxReturn('失败');
		} else {
			$this->ajaxReturn('成功');
		}
	}

	/**
	 * 短信模板修改
	 * method: post
	 * url: /Admin/System/updateTemplate
	 */
	public function updateTemplate() {
		$info = I('post.');

		$msg = M('Message');
		$rule['template_id'] = $info['template_id'];
		$map['msg_id'] = '10000000000000000000000000000001';
		$rule['update_time'] = time();
		$data = $msg->where($map)->save($rule);
		if(!$data) {
			$this->ajaxReturn('失败');
		} else {
			$this->ajaxReturn('成功');
		}
	}
	
    /**
     * 浮动开关
     *
     * method: post
     * url: /Admin/System/floatSwitch
     * @param float_status 开关：0-关闭 1-开启
     */
    public function floatSwitch() {
        $data = I('post.');
        $HomeInfo = M('HomeInfo');

        $map['home_info_id'] = HOME_INFO_ID;
        $info = $HomeInfo->where($map)->save($data);

        $info == 0
            ? $this->ajaxReturn(\StatusCode::code(4000))
            : $this->ajaxReturn(\StatusCode::code(0));
    }

	/**
	* 获得logo管理数据(操作home_info表)
	* 方式：GET
	* URL：/Admin/getLogo
	* 参数：无
	*/
	public function Logo(){
		$getdata = I('get.');

		$logo = M('Home_info');
		$map['id'] = HOME_INFO_ID;

		$info = $logo->where($map)->select();

		$info = $this->setStatus($info);

		$result = \StatusCode::code(0);
		$result['count'] = $logo->where($map)->count();
		$result['data'] = $info;
		$this->ajaxReturn($result);
	}


	/**
	* 修改logo管理数据(操作home_info表）
	* 方式：POST
	* URL：/Admin/updataLogo
	* 参数 有
	* @param LOGO       背景图片的url
	* @param BACK       图标的url
	* @param name   图标旁边的文字
	*/
	public function updataLogo(){
		$getdata = I('post.');
		$logo = M('HomeInfo');

		$map['id'] = HOME_INFO_ID;
		$info = $logo->where($map)->save($getdata);

		if($info){
			$result = \StatusCode::code(0);
		}else{
			$result = \StatusCode::code(4000);
		}

		$this->ajaxReturn($result);
	}


    /**
	* 获取邮箱信息(操作Home_info表)
	* 方式：get
	* URL：/Admin/getEmail
	* 参数：无
	*/
	public function Email(){
		$getdata = I('get.');

		$email = M('Home_info');

		$map['id'] = HOME_INFO_ID;
		$info = $email->where($map)->field('email_type,email_account,email_password')->select();

		foreach ($info as $k => $v) {
			$info[$k]['email_password'] = base64_decode($v['email_password']);
			if ($v['email_type'] == EMAIL_TYPE_QQ) {
				$info[$k]['email_name'] = 'QQ邮箱';
			}else if ($v['email_type'] == EMAIL_TYPE_163) {
				$info[$k]['email_name'] = '163邮箱';
			}else if ($v['email_type'] == EMAIL_TYPE_YAHOO) {
				$info[$k]['email_name'] = '雅虎邮箱';
			} 
		}

		
		$result = \StatusCode::code(0);
		
		$result['data'] = $info;
		$this->ajaxReturn($result);
	}


	/**
	* 修改邮箱信息(操作Home_info表)
	* 方式：POST
	* URL：/Admin/setEmail
	* 参数：有
	* @param admin_id      管理员的ID
	* @param emai_type     邮箱类型葱
	* @param emai_account  邮箱账号
	* @param emai_password 邮箱密码
	*/
	public function setEmail(){
		$getdata = I('post.');

		//md5验证
        $md5Str = $getdata['email_account'] . $getdata['email_password'] . $getdata['email_type'] . $getdata['nonce_str'];
        if (!\Common::verifyMd5($getdata['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

		$getdata['id'] = HOME_INFO_ID;
		$setemail = M('HomeInfo');
		$map['id'] = $getdata['id'];

		//base64加密
		$getdata['email_password'] = base64_encode($getdata['email_password']);

		$info = $setemail->where($map)->save($getdata);

		if($info){
			$result = \StatusCode::code(0);
		}else{
			$result = \StatusCode::code(4000);
		}

		$this->ajaxReturn($result);
	}

	//修改邮箱密码
	public function passupdate(){
	    $getdata = I('post.');

	    $getdata['id'] = HOME_INFO_ID;

	    //md5验证
        $md5Str = $getdata['newpass'] . $getdata['nonce_str'] . $getdata['oldpass'] ;
        if (!\Common::verifyMd5($getdata['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

	    $setemail = M('Home_info');
	    $map['id'] = $getdata['id'];
	    $email_password = base64_decode($setemail->where($map)->getField('email_password'));
	    
	    if($getdata['oldpass'] == $email_password){
		   
		   $data['email_password'] = base64_encode($getdata['newpass']);

		   $info = $setemail->where($map)->save($data);
	    }

	   if($info){
		  $result = \StatusCode::code(0);
	   }else{
		  $result = \StatusCode::code(4000);
	   }
	   $this->ajaxReturn($result);
    }

	/**
	* 获取货币信息(操作show_currency_value表)
	* 方式：GET
	* URL：/Admin/getCurrency
	* 参数：无
	*/
	public function Coin(){
		$getdata = I('get.');

		$currency = M('CurrencyValue');
		$ShowCurrencyValue = M('ShowCurrencyValue');

		$data = $currency->select();
		$info = $ShowCurrencyValue->select();

		$result = \StatusCode::code(0);
		$result['info'] = $info;
		$result['data'] = $data;
		$result['switch'] = M('HomeInfo')->getFieldById(HOME_INFO_ID, 'float_status');
		$this->ajaxReturn($result);
	}

	/**
	* 修改基础货币信息(操作currency_value表)
	* 方式：POST
	* URL：/Admin/setCurrency
	* 参数：有
	* @param BTC_value_TWD    比特币对新台币的单价
	* @param BTC_value_HKD    比特币对港币的单价
	* @param BTC_value_USD    比特币对美元的单价
	* @param ETH_value_TWD    以太币对新台币的单价
	* @param ETH_value_HKD    以太币对港币的单价
	* @param ETH_value_USD    以太币对美元的单价
	*/
    public function setInfoCoin(){
		$getdata = I('post.');

		$map['id'] = HOME_INFO_ID;

		//md5验证
		$md5Str = $getdata['btc_value_hkd'] . $getdata['btc_value_twd'] . $getdata['btc_value_usd'] .
			      $getdata['eth_value_hkd'] . $getdata['eth_value_twd'] . $getdata['eth_value_usd'] . $getdata['nonce_str'];

        if (!\Common::verifyMd5($getdata['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

		$setcoin = M('CurrencyValue');

		$info = $setcoin->where($map)->save($getdata);

		if($info){
		   $result = \StatusCode::code(0);
		}else{
		   $result = \StatusCode::code(4000);
		}

		$this->ajaxReturn($result);
	}
	/**
	* 修改显示货币信息(操作show_currency_value表)
	* 方式：POST
	* URL：/Admin/setCurrency
	* 参数：有
	* @param BTC_value_TWD    比特币对新台币的单价
	* @param BTC_value_HKD    比特币对港币的单价
	* @param BTC_value_USD    比特币对美元的单价
	* @param ETH_value_TWD    以太币对新台币的单价
	* @param ETH_value_HKD    以太币对港币的单价
	* @param ETH_value_USD    以太币对美元的单价
	*/
    public function setCoin(){
		$getdata = I('post.');

		$map['id'] = HOME_INFO_ID;

		//md5验证
		$md5Str = $getdata['btc_value_hkd'] . $getdata['btc_value_twd'] . $getdata['btc_value_usd'] .
			      $getdata['eth_value_hkd'] . $getdata['eth_value_twd'] . $getdata['eth_value_usd'] . $getdata['nonce_str'];

        if (!\Common::verifyMd5($getdata['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

		$show = M('ShowCurrencyValue');

		$info = $show->where($map)->save($getdata);

		if($info){
		   $result = \StatusCode::code(0);
		}else{
		   $result = \StatusCode::code(4000);
		}

		$this->ajaxReturn($result);
	}
	/**
	* 修改货币浮动信息(操作currency_value表)
	* 方式：POST
	* URL：/Admin/setCurrency
	* 参数：有
	* @param etc_float_max    以太币最大浮动值
	* @param btc_float_max    比特币最大浮动值
	* @param etc_float_min    以太币最小浮动值
	* @param btc_float_min    比特币最小浮动值
	*/
    public function setFloat(){
		$getdata = I('post.');

		$map['id'] = HOME_INFO_ID;

		//md5验证
		$md5Str = $getdata['btc_float_max'] . $getdata['btc_float_min'] . 
				  $getdata['etc_float_max'] . $getdata['btc_float_min'] . $getdata['nonce_str'];

        if (!\Common::verifyMd5($getdata['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

		$currency = M('CurrencyValue');

		$info = $currency->where($map)->save($getdata);

		if($info){
		   $result = \StatusCode::code(0);
		}else{
		   $result = \StatusCode::code(4000);
		}

		$this->ajaxReturn($result);
	}


	/**
	* 获得常见问题列表(操作common_problem表)
	* 方式：GET
	* URL：/Admin/getCommonProblem
	* 参数：有
	* @param page  分页
	* @param limit 条数
	*/
	public function Problem(){
		$getdata = I('get.');

		$common = M('Common_problem as a');

		$map['a.is_deleted'] = IS_NOT_DELETED;
		$join = "left join btc_i18n as bi on bi.i18n_id = a.title_i18n_id and bi.is_deleted = '0'
		left join btc_i18n as bi2 on bi2.i18n_id = a.content_i18n_id and bi2.is_deleted = '0'";

		$info = $common->join($join)->where($map)->page($getdata['page'],$getdata['limit'])->field('
			a.*,bi.en_content,bi.tw_content,bi2.en_content as en_content2,bi2.tw_content as tw_content2
			')->order('a.create_time desc')->select();

		$data = $this->setStatus($info);    

		$result = \StatusCode::code(0);
		$result['count'] = $common->where($map)->count();
		$result['data'] = $data;
		$this->ajaxReturn($result);
	}


    //搜索
    public function searchProblem(){
        $getdata = I('get.');

        $common = M('Common_problem as a');

        $map['a.is_deleted'] = IS_NOT_DELETED;

        $map['type'] = $getdata['type'];

        $join = "left join btc_i18n as bi on bi.i18n_id = a.title_i18n_id and bi.is_deleted = '0'
        left join btc_i18n as bi2 on bi2.i18n_id = a.content_i18n_id and bi2.is_deleted = '0'";

        if(!$map['type'] = $getdata['type']){
        	$info = $common
		        	->join($join)
		        	->page($getdata['page'],$getdata['limit'])
		        	->field('a.*,bi.en_content,bi.tw_content,bi2.en_content as en_content2,bi2.tw_content as tw_content2')
		            ->select();
        }else{

        	$info = $common
		        	->join($join)
		        	->where($map)
		        	->page($getdata['page'],$getdata['limit'])
		        	->field('a.*,bi.en_content,bi.tw_content,bi2.en_content as en_content2,bi2.tw_content as tw_content2')
		        	->select();
        }

        $data = $this->setStatus($info);    
       	$result = \StatusCode::code(0);
        $result['count'] = $common->where($map)->count();
        $result['data'] = $data;
        $this->ajaxReturn($result);
    }

	/**
	* 添加常见问题
	* 方式：POST
	* URL：/Admin/addProblem
	* 参数：有
	* @param problem_type     问题类型
	* @param left_content     繁体内容
	* @param right_content    英文内容
	* @param left_title       繁体题目
	* @param right_title      英文题目
	*/
	public function addProblem(){
		
		$problem = M('CommonProblem');
		$i18n = M('I18n');
		$i18n->startTrans();    // 启动事物
		$data = I('post.');

		//准备插入国际化表的数据
		$title_i18n_id = \Common::generateId();//随机生成32位ID
		$content_i18n_id = \Common::generateId();//随机生成32位ID

		$i18nList[] = array(
		    'i18n_id'=>$title_i18n_id,
            'en_content'=>$data['right_title'],
		    'tw_content'=>$data['left_title'],
            'create_time'=>time()
        );
		$i18nList[] = array(
		    'i18n_id'=>$content_i18n_id,
            'en_content'=>$data['html2'],
		    'tw_content'=>$data['html1'],
            'create_time'=>time()
        );

		//批量插入国际化表
		$i = $i18n->addAll($i18nList);

		if (!$i) {
		    $i18n->rollback();  // 事物回滚
		    $i18n->commit();    // 事物提交
		    $result = \StatusCode::code(4001);
		    $this->ajaxReturn($result);
		}

		//添加常见问题表
		$CommonProblem['common_problem_id'] = \Common::generateId();//随机生成32位ID
		$CommonProblem['title_i18n_id'] = $title_i18n_id;
		$CommonProblem['content_i18n_id'] = $content_i18n_id;
		$CommonProblem['type'] = $data['problem_type'];
		$CommonProblem['create_time'] = time();

		$info = $problem->add($CommonProblem);
		if(!$info){
			$i18n->rollback();  // 事物回滚
			$i18n->commit();    // 事物提交
		    $result = \StatusCode::code(4001);
		    $this->ajaxReturn($result);
		}
		$i18n->commit();    // 事物提交
		$result = \StatusCode::code(0);
		$this->ajaxReturn($result);
	}



	/**
	* 删除常见问题
	* 方式：POST
	* URL：/Admin/deleteProblem
	* 参数：有
	* @param common_problem_id
	*/
	public function deleteProblem(){
		$getdata = I('post.');

		//md5验证
        $md5Str = $getdata['common_problem_id'] . $getdata['nonce_str'];
        if (!\Common::verifyMd5($getdata['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

		//校验ID是否存在
		if (empty($getdata['common_problem_id'])) {
			$result = \StatusCode::code(4003);
			$this->ajaxReturn($result);
		}

		$deleted = M('Common_problem');

		$map['common_problem_id'] = $getdata['common_problem_id'];
	
		$info = $deleted->where($map)->delete();

		if($info){
			$result = \StatusCode::code(0);
		}else{
			$result = \StatusCode::code(4003);
		}

		$this->ajaxReturn($result);
	}


	/**
	* 用户问题
	* 方式：GET
	* URL：/Admin/getContact(操作problem表)
	* 参数：有
	* @param page  分页
	* @param limit 条数
	*/
	public function ContactList(){
		$getdata = I('get.');

		$contact = M('Problem as bp');
			
		$map['bp.is_deleted'] = IS_NOT_DELETED;
		$info = $contact
				->where($map)
				->page($getdata['page'],$getdata['limit'])
				->select();

		$info = $this->setStatus($info);

		$result = \StatusCode::code(0);
		$result['count'] = $contact->where($map)->count();
		$result['data'] = $info;
		$this->ajaxReturn($result);
	}

	/**
	* 查看联系我们问题详细
	* 方式：POST
	* URL：/Admin/lookContact(操作problem表)
	* 参数：有
	* @param problem_id 问题ID
	*/
	public function Contact(){
		$getdata = I('post.');

		//校验ID是否存在
		if (empty($getdata['problem_id'])) {
			$result = \StatusCode::code(4002);
			$this->ajaxReturn($result);
		}

		$problem = M('Problem as bp');

		$map['bp.problem_id'] = $getdata['problem_id'];
			
		$map['bp.is_deleted'] = IS_NOT_DELETED;
		$info = $problem->where($map)->select();
		$info = $this->setStatus($info);

		if($info){
			$result = \StatusCode::code(0);
		}else{
			$result = \StatusCode::code(4002);
		}

		$result['data'] = $info;
		$this->ajaxReturn($result);
	}

     /**
     * 删除用户问题
     * 方式：POST
     * URL：/Admin/deleteProblem
     * 参数：有
     * @param problem_id(批量删除)
     */
     public function deleteUserProblem(){
      	$getdata = I('post.');

         //md5验证
        $md5Str = $getdata['problem_id'] . $getdata['nonce_str'];
        if (!\Common::verifyMd5($getdata['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

	      //校验ID是否存在
	      if (empty($getdata['problem_id'])) {
	           $result = \StatusCode::code(4003);
	           $this->ajaxReturn($result);
	      }

	      $deleted = M('Problem');

	      $deletedattach = M('Problem_attach');

	      $map['problem_id'] = $getdata['problem_id'];
	 
	      $infoProblem = $deleted->where($map)->delete();
	      $infoAttach = $deletedattach->where($map)->delete();

	      if($infoProblem && $infoAttach){
	           $result = \StatusCode::code(0);
	      }else{
	           $result = \StatusCode::code(4003);
	      }

	      $this->ajaxReturn($result);
     }

     //搜索
     public function UserProblemSearch() {
          $getdata = I('get.');

          $search = M('Problem as bp');

          $where['user_name'] = array('like', '%'. $getdata['user_name'] .'%');

          $join = 'left join btc_problem_attach as bpa ON bp.problem_id=bpa.problem_id left join btc_user as c ON bp.user_id = c.user_id';

          $info = $search
                    ->join($join)
                    ->where($where)
                    ->field('bp.*,bpa.file_address,c.user_name,MainCoin_id')
                    ->page($getdata['page'],$getdata['limit'])
                    ->select();

          $info = $this->setStatus($info);

          $result = \StatusCode::code(0);
          $result['count'] = $search->where($where)->count();
          $result['data'] = $info;

          $this->ajaxReturn($result);
     }


	/**
	* 获取公告管理(操作bulletin表)
	* 方式：GET
	* URL：/Admin/getNotice
	* 参数：有
	* @param page  分页
	* @param limit 条数
	*/
	public function Notice(){
		$getdata = I('get.');
		$notice = M('Bulletin as b');
		$HomeInfo = M('HomeInfo');

		$map['b.is_deleted'] = IS_NOT_DELETED;
		$join = "left join btc_i18n as bi on bi.i18n_id = b.bulletin_title_i18n and bi.is_deleted = '0'
		left join btc_i18n as bi2 on bi2.i18n_id = b.bulletin_content_i18n and bi2.is_deleted = '0'";

		$info = $notice->where($map)->join($join)->field("
			b.*,bi.en_content,bi.tw_content,bi2.en_content as en_content2,bi2.tw_content as tw_content2
			")->page($getdata['page'],$getdata['limit'])->select();
		$home = $HomeInfo->select();

		$info = $this->setStatus($info);

	
		$result = \StatusCode::code(0);
		$result['count'] = $notice->where($map)->count();
		$result['data'] = $info;
		$result['home'] = $home[0]['bulletin_status'];
		$this->ajaxReturn($result);
	}

	/**
	* 发布公告(操作bulletin表)
	* 方式：POST
	* URL：/Admin/updataNotice
	* 参数：有
	* @param bulletin_id 公告ID
	*/
	public function updataNotice(){
		$getdata = I('post.');

		//md5验证
        $md5Str = $getdata['bulletin_id'] . $getdata['nonce_str'];
        if (!\Common::verifyMd5($getdata['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

		//校验ID是否存在
		if (empty($getdata['bulletin_id'])) {
			$result = \StatusCode::code(4002);
			$this->ajaxReturn($result);
		}

		$notice = M('Bulletin');

		$map['is_deleted'] = IS_NOT_DELETED;
		$map['bulletin_id'] = $getdata['bulletin_id'];
		$map['status'] = IS_NOT_BULLETIN;

		$data['status'] = IS_BULLETIN;
		$data['bulletin_issue_time'] = time();

		$info = $notice->where($map)->save($data);

		if($info){
			$result = \StatusCode::code(0);
		}else{
			$result = \StatusCode::code(4002);
		}

		$this->ajaxReturn($result);
	}


	/**
	* 删除公告(操作bulletin表)
	* 方式：POST
	* URL：/Admin/deleteNotice
	* 参数：有
	* @param bulletin_id 公告ID（批量删除）
	*/
	public function deleteNotice(){
		$getdata = I('post.');

		//md5验证
        $md5Str = $getdata['bulletin_id'] . $getdata['nonce_str'];
        if (!\Common::verifyMd5($getdata['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

		//校验ID是否存在
		if (empty($getdata['bulletin_id'])) {
			$result = \StatusCode::code(4003);
			$this->ajaxReturn($result);
		}	
		$deleted = M('Bulletin');

		$map['is_deleted'] = IS_NOT_DELETED;
		$map['bulletin_id'] = $getdata['bulletin_id'];

		$param['is_deleted'] = IS_DELETED;
		$param['delete_time'] = time();
	
		$info = $deleted->where($map)->save($param);

		if($info){
			$result = \StatusCode::code(0);
		}else{
			$result = \StatusCode::code(4003);
		}

		$this->ajaxReturn($result);
	}

	
	/**
	* 添加公告(操作bulletin表)
	* 方式：POST
	* URL：/Admin/addNotice
	* 参数：有
	* @param left_title    繁体标题
	* @param right_title   英文标题
	* @param left_content  繁体内容
	* @param right_content 英文标题
	*/
	public function addNotice(){
		
		$notice = M('Bulletin');
		$i18n = M('I18n');
		$i18n->startTrans();    // 启动事物
		$data = I('post.');

		//准备插入国际化表的数据
		$title_i18n_id = \Common::generateId();//随机生成32位ID
		$content_i18n_id = \Common::generateId();//随机生成32位ID

		$i18nList[] = array('i18n_id'=>$title_i18n_id,'en_content'=>$data['right_title'],
		'tw_content'=>$data['left_title'],'create_time'=>time());
		$i18nList[] = array('i18n_id'=>$content_i18n_id,'en_content'=>$data['html2'],
		'tw_content'=>$data['html1'],'create_time'=>time());

		//批量插入国际化表
		$i = $i18n->addAll($i18nList);

		if (!$i) {
		    $i18n->rollback();  // 事物回滚
		    $i18n->commit();    // 事物提交
		    $result = \StatusCode::code(4001);
		    $this->ajaxReturn($result);
		}

		//添加公告表
		$noticeInfo['bulletin_id'] = \Common::generateId();//随机生成32位ID
		$noticeInfo['bulletin_title_i18n'] = $title_i18n_id;
		$noticeInfo['bulletin_content_i18n'] = $content_i18n_id;
		$noticeInfo['create_time'] = time();

		$info = $notice->add($noticeInfo);
		if(!$info){
			$i18n->rollback();  // 事物回滚
			$i18n->commit();    // 事物提交
		    $result = \StatusCode::code(4001);
		    $this->ajaxReturn($result);
		}
		$i18n->commit();    // 事物提交
		$result = \StatusCode::code(0);
		$this->ajaxReturn($result);
	}

	/**
	* 公告浮动(操作bulletin表)
	* 方式：POST
	* URL：/Admin/noticeSwicth
	* 参数：有
	* @param  float_status
	*/
	public function noticeSwicth(){
		
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
	 * 文件上传
	 * @return type
	 */
	public function uploadFile(){

		$data = I('post.'); 

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->autoSub   = 	 false;
        $upload->subName   =     '';
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录

        if ($data['type'] == '1') {//基础信息上传
			$upload->savePath  =     'action/basics/'; // 设置附件上传根目录
		}else{
			$upload->savePath  =     'action/'; // 设置附件上传根目录
		}

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


    //公司信息管理
    public function companylist(){
        $getdata = I('get.');

        $company = M('Home_info as bhi');

        $map['id'] = HOME_INFO_ID;

        $join = 'btc_i18n as bi ON bhi.i18n_id = bi.i18n_id';

        $info = $company
                ->where($map)
                ->join($join)
                ->field('bhi.company_tel,company_email,bi.en_content,tw_content')
                ->select();

        $result = \StatusCode::code(0);
        $result['data'] = $info;
        $this->ajaxReturn($result);
    }

    //公司信息修改
    public function updatecompany(){

        $i18n = M('I18n');
        $i18n->startTrans();    // 启动事物

        $getdata = I('post.');

        //md5验证
        $md5Str = $getdata['company_email'] . $getdata['company_tel'] . $getdata['nonce_str'];
        if (!\Common::verifyMd5($getdata['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

        $i18n_id = \Common::generateId();//随机生成32位ID
        $i18nList= array(
            'i18n_id'=>$i18n_id,
            'en_content'=>$getdata['en_content'],
            'tw_content'=>$getdata['tw_content'],
            'create_time'=>time(),
        );

        //插入国际化表
        $i = $i18n->add($i18nList);

        if (!$i) {
            $i18n->rollback();  // 事物回滚
            $i18n->commit();    // 事物提交
            $result = \StatusCode::code(4001);
            $this->ajaxReturn($result);
        }

        //修改信息
        $update = M('Home_info');

        $map['id'] = HOME_INFO_ID;
        $data = array('i18n_id'=>$i18n_id,'company_tel'=>$getdata['company_tel'],'company_email'=>$getdata['company_email'],'update_time'=>time());

        $info = $update->where($map)->save($data);

        if(!$info){
            $i18n->rollback();  // 事物回滚
            $i18n->commit();    // 事物提交
            $result = \StatusCode::code(4000);
            $this->ajaxReturn($result);
        }
        $i18n->commit();    // 事物提交
        $result = \StatusCode::code(0);
        $this->ajaxReturn($result);
    }

     /**
     * 设置状态
     * @param $data     数据库获取的数据
     * @return json     更改之后的数据
     */
    private function setStatus($info) {

        foreach ($info as $k => $v) {
          // 转换时间
        $info[$k]['create_time'] = date('Y-m-d', $v['create_time']);

      	if (!empty($v['bulletin_issue_time'])) {
    		$info[$k]['bulletin_issue_time'] = date('Y-m-d', $v['bulletin_issue_time']);
        }
        
          
          // 判断状态（邮箱）
        if ($v['email_type'] == EMAIL_TYPE_QQ) {

			$info[$k]['email_name'] = 'QQ邮箱';
		}
		else if ($v['email_type'] == EMAIL_TYPE_163) {

			$info[$k]['email_name'] = '163邮箱';
		}
		else if($v['email_type'] == EMAIL_TYPE_YAHOO){

			$info[$k]['email_name'] = '雅虎邮箱';
		}
		
		// 判断状态（发布）
		if (isset($v['status'])) {

		  	if($v['status'] == IS_NOT_BULLETIN){

			$info[$k]['status_name'] = '未发布';

		  } 
		else if($v['status'] == IS_BULLETIN) {

			$info[$k]['status_name'] = '发布';

		  }
		}
		  
		// 判断状态（常见问题）
		if ($v['type'] == PROBLEM_TYPE_SEND_REC) {

			$info[$k]['type_name'] = '发送与接收';

		}
		else if ($v['type'] == PROBLEM_TYPE_BUY_SELL) {

			$info[$k]['type_name'] = '购买与出售';

		}
		else if ($v['type'] == PROBLEM_TYPE_IS_MERCHANT) {

			$info[$k]['type_name'] = '成为特约商家';

		}
		else if ($v['type'] == PROBLEM_TYPE_ABOUT) {

			$info[$k]['type_name'] = '关于';

		}
		else if ($v['type'] == PROBLEM_TYPE_SECURITY) {

			$info[$k]['type_name'] = '账户安全与实名审核';

		}
		else if ($v['type'] == PROBLEM_TYPE_NOT_CHEAT) {

			$info[$k]['type_name'] = '反诈骗及处理流程';

		} 
		
	   }

	    return $info;
    }
}
