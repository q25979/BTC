<?php
namespace Admin\Controller;

/**
 * 作者：亮哥
 * 时间：2018年4月16日20:43:42
 * 功能：账户管理
 */
class AccountController extends VerifyController {
    public function AccountList() {
		$this->display();
	}
    public function AccountUpdata() {
        $this->display();
    }

	/**
     * 获得账户列表（需要显示用户名）
     * 方式：GET
     * URL：
     * 参数：无/Admin/getAccountList
     * @param page  分页
     * @param 
     * 
     */
	public function getAccountList(){
        $getData=I('get.');

		$Account=M('User_account as a');
  
        $join = 'left join btc_user as b on b.user_id=a.user_id
                 left join btc_bank as bb1 on bb1.bank_id = a.bank_name
                 left join btc_bank as bb2 on bb2.bank_id = a.bank_branch';

        $map['a.is_deleted'] = IS_NOT_DELETED;

        $info = $Account->join($join)->where($map)->field('
            a.*,b.user_name,bb1.bank_name as bank_name,bb2.bank_name as bank_branch
            ')->page($getData['page'],$getData['limit'])->order('create_time desc')->select();
         
        $data = $this->setStatus($info);

        $result = \StatusCode::code(0);

        $result['count'] = $Account->where($map)->count();

        $result['data'] = $data;
          
        $this->ajaxReturn($result);

	}

    /**
     * 获得单个用户账户信息
     * 方式：POST
     * URL：/Admin/AccountInfo
     * 参数：有
     * @param user_id
     */
    public function getAccountById(){

        $getData=I('get.');

        $Account=M('User_account');

        $map['account_id'] = $getData['account_id'];
        $map['is_deleted'] = IS_NOT_DELETED;

        $info =$Account->where($map)->select();

        $result = \StatusCode::code(0);

        $result['data'] = $info;
          
        $this->ajaxReturn($result);

    }

    /**
     * 根据用户名搜索账户（模糊）
     * 方式：GET
     * URL：/Admin/getAccount
     * 参数：有
     * @param user_name  用户名
     */
    public function getAccount(){
        $getData=I('GET.');

        $Account=M('user_account as a');

        $join = 'left join btc_user as b on b.user_id=a.user_id
                 left join btc_bank as bb1 on bb1.bank_id = a.bank_name
                 left join btc_bank as bb2 on bb2.bank_id = a.bank_branch';

        $map['a.is_deleted'] = IS_NOT_DELETED;
        $map['b.user_name']=array('like', '%'. $getData['user_name'] .'%');

        $info = $Account->where($map)->join($join)->page($getData['page'],$getData['limit'])->field('a.*,b.user_name,bb1.bank_name as bank_name,bb2.bank_name as bank_branch')->select();

        $data = $this->setStatus($info);

        $result = \StatusCode::code(0);

        $result['count'] =$Account->join($join)->where($map)->count();
        $result['data'] = $data;
          
        $this->ajaxReturn($result);
    }

    /**
     * 冻结恢复账户
     * 方式：POST
     * URL：/Admin/updataFreeze
     * 参数 有
     * @param account_id 封停的用户ID
     * @param type       类型1是恢复，2是冻结
     * @param money      额度
     * @param nonce_str  随机数
     * @param sign       签名md5
     */
     public function updataFreeze(){

            $Account=M('User_account');

            $getData=I('post.');

            //md5验证
            $md5Str = $getData['account_id'] . $getData['nonce_str'];
            if (!\Common::verifyMd5($getData['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
            }

            $map['account_id'] = $getData['account_id'];
            $selectOne = $Account->where($map)->select();

            if ($getData['type'] == 1) {//为1就是恢复(先减去冻结金额，然后在可提现余额中加上)
                (int)$param['freeze_balance'] = (int)$selectOne[0]['freeze_balance'] - (int)$getData['money'];
                (int)$param['extract_balance'] = (int)$selectOne[0]['extract_balance'] + (int)$getData['money'];
            }else if ($getData['type'] == 2) {//2是冻结
                (int)$param['freeze_balance'] = (int)$selectOne[0]['freeze_balance'] + (int)$getData['money'];
                (int)$param['extract_balance'] = (int)$selectOne[0]['extract_balance'] - (int)$getData['money'];
            }
            if ($param['freeze_balance'] < 0 || $param['extract_balance'] < 0) {
                $result = \StatusCode::code(4001);
                $this->ajaxReturn($result);
            }

            $param['update_time'] = time();//更新时间

            $i = $Account->where($map)->save($param);

            if(!$i) {
            $result = \StatusCode::code(4001);
            }else{
                $result = \StatusCode::code(0);
            }

            $this->ajaxReturn($result);

        }


    /**
    * 用户信息修改
    * 方式：POST
    * URL：/Admin/updataAccount
    * 参数：有
    * @param user_id  用户ID
    */
    public function updataAccount(){
        $Account=M('User_account');

        $getData=I('post.');

        //md5验证
        $md5Str = $getData['btc_balance'] . $getData['eth_balance'] . $getData['extract_balance'] .
                  $getData['freeze_balance'] . $getData['nonce_str'];

        if (!\Common::verifyMd5($getData['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

        $map['account_id'] = $getData['account_id'];
        
        $data =$Account->where($map)->save($getData);

        if(!$data){
            $result = \StatusCode::code(4003);
            $this->ajaxReturn($result);
        }
        
        $result = \StatusCode::code(0);

        $this->ajaxReturn($result);
    }



    private function setStatus($info) {

        foreach ($info as $k => $v) {

            if(empty($v['status'])) {
                $info[$k]['status_name'] = '正常使用';
            } else{
                $info[$k]['status_name'] = '冻结状态';
            }
        }

        return $info;
    }

}
