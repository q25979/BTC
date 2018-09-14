<?php
namespace Admin\Controller;

/**
 * 作者：庄
 * 时间：2018年4月16日20:43:42
 * 功能：发送管理
 */
class SendController extends VerifyController {
    public function SendAudit() {
        $this->display();
    }
    public function SendList() {
        $this->display();
    }
    public function SendListAll() {
        $this->display();
    }
	  /**
     * 发送信息所有列表
     * 方式：GET
     * URL：/Admin/getSendListAll
     * 参数：有
     * @param currency_type  币种类型
     * @param page           分页
     * @param limit          条数
     */
	  public function getSendListAll(){
        $table = M('Send as s');
        $data = I('get.');

        if (isset($data['currency_type']) && $data['currency_type'] != "") {
            $map['s.currency_type'] = $data['currency_type'];
        }

        $map['s.is_deleted'] = IS_NOT_DELETED;
        $join ="btc_user as bu on bu.user_id = s.user_id and bu.is_deleted =" . IS_NOT_DELETED;
        $count = $table->where($map)->join($join)->count();
        $list = $table->where($map)->join($join)->page($data['page'], $data['limit'])->field("
            s.*,bu.user_name
            ")->order('s.create_time desc')->select();

        $list = $this->setStatus($list);
        $result = \StatusCode::code(0);
        $result['count'] = $count;
        $result['data'] = $list;

        $this->ajaxReturn($result);

	}
    /**
     * 发送待提交列表
     * 方式：GET
     * URL：/Admin/getSendList
     * 参数：有
     * @param currency_type  币种类型
     * @param page           分页
     * @param limit          条数
    */
    public function getSendList(){

        $table = M('Send as s');
        $data = I('get.');

        if (isset($data['currency_type']) && $data['currency_type'] != "") {
            $map['s.currency_type'] = $data['currency_type'];
        }

        $map['s.is_deleted'] = IS_NOT_DELETED;
        $map['s.status'] = SEND_STATUS_SUBMIT;
        $join ="btc_user as bu on bu.user_id = s.user_id and bu.is_deleted =" . IS_NOT_DELETED;
        $count = $table->where($map)->join($join)->count();
        $list = $table->where($map)->join($join)->page($data['page'], $data['limit'])->field("
            s.*,bu.user_name
            ")->order('s.create_time desc')->select();

        $list = $this->setStatus($list);
        $result = \StatusCode::code(0);
        $result['count'] = $count;
        $result['data'] = $list;

        $this->ajaxReturn($result);

    }
    /**
     * 发送进行中列表
     * 方式：GET
     * URL：/Admin/getSendAuditList
     * 参数：有
     * @param currency_type  币种类型
     * @param page           分页
     * @param limit          条数
     */
    public function getSendAuditList(){
          
        $table = M('Send as s');
        $data = I('get.');

        if (isset($data['currency_type']) && $data['currency_type'] != "") {
            $map['s.currency_type'] = $data['currency_type'];
        }

        $map['s.is_deleted'] = IS_NOT_DELETED;
        $map['s.status'] = SEND_STATUS_UNDERWAY;
        $join ="btc_user as bu on bu.user_id = s.user_id and bu.is_deleted =" . IS_NOT_DELETED;
        $count = $table->where($map)->join($join)->count();
        $list = $table->where($map)->join($join)->page($data['page'], $data['limit'])->field("
            s.*,bu.user_name
            ")->order('s.create_time desc')->select();

        $list = $this->setStatus($list);
        $result = \StatusCode::code(0);
        $result['count'] = $count;
        $result['data'] = $list;

        $this->ajaxReturn($result);

    }
    /**
     * 发送审核(不同的按钮有不同的功能前端传状态值区别)
     * 方式：POST
     * URL：/Admin/sendAuditInfo
     * 参数：无
     * @param send_id  发送ID
     * @param status   改变状态
     * @param remark   备注
     * @param nonce_str  随机数
     * @param sign       签名md5
     */
    public function sendAuditInfo(){

        $table = M('Send as s');
        $data = I('post.');
        $data['update_time'] = time(); 

        //md5验证
        $md5Str = $data['nonce_str'] . $data['send_id'] . $data['status'];
        if (!\Common::verifyMd5($data['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

        if (!isset($data['send_id'])) {
            $result = \StatusCode::code(4000);
            $this->ajaxReturn($result);
        }

        $map['s.send_id'] = $data['send_id'];
        $map['s.is_deleted'] = IS_NOT_DELETED;
        $join = "right join btc_user as bu on bu.maincoin_id = s.maincoin_id
        right join btc_user_account as bua on bu.user_id = bua.user_id";
        $successList = $table->where($map)->join($join)->field("
            bua.btc_balance,
            bua.eth_balance,
            s.currency_type,
            s.number,
            bu.user_id")->select();

        if (empty($successList)) {
            $result = \StatusCode::code(4000);
            $this->ajaxReturn($result);
        }

        $i = $table->where($map)->save($data);

        if ($i < 1) {
            $result = \StatusCode::code(4000);
            $this->ajaxReturn($result);
        }

        $result = \StatusCode::code(0);
        $this->ajaxReturn($result);
    
    }     
    /**
     * 发送失败
     * 方式：POST
     * URL：/Admin/sendLose
     * 参数：无
     * @param send_id  发送ID
     * @param status   改变状态
     * @param remark   备注
     * @param nonce_str  随机数
     * @param sign       签名md5
     */
    public function sendLose(){
   
        $table = M('Send as s');
        $UserAccount = M('UserAccount');//操作账户表
        $table->startTrans();    // 启动事物
        $data = I('post.');
        $data['update_time'] = time(); 

        //md5验证
        $md5Str = $data['nonce_str'] . $data['send_id'] . $data['status'];
        if (!\Common::verifyMd5($data['sign'], $md5Str)) {
            $table->commit();    // 事物提交
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

        if (!isset($data['send_id'])) {
            $table->commit();    // 事物提交
            $result = \StatusCode::code(4000);
            $this->ajaxReturn($result);
        }

        $map['s.send_id'] = $data['send_id'];
        $map['s.is_deleted'] = IS_NOT_DELETED;
        $i = $table->where($map)->save($data);

        if (!$i) {
            $table->rollback();  // 事物回滚
            $table->commit();    // 事物提交
            $result = \StatusCode::code(4000);
            $this->ajaxReturn($result);
        }

        $join = "btc_user_account as bua on bua.user_id = s.user_id";
        $loseList = $table->where($map)->join($join)->field("
            bua.btc_balance,
            bua.eth_balance,
            s.currency_type,
            s.number,
            s.user_id")->select();

        //数据处理
        if ($loseList[0]['currency_type'] == CURRENCY_TYPE_BTC) {
            //是比特币
            (double)$param['btc_balance'] = (double)$loseList[0]['btc_balance'] + (double)$loseList[0]['number'];
            $param['update_time'] = time();
            $userAccountMap['user_id'] = $loseList[0]['user_id'];
            $i = $UserAccount->where($userAccountMap)->save($param);
            if (!$i) {
                $table->rollback();  // 事物回滚
                $table->commit();    // 事物提交
                $result = \StatusCode::code(4000);
                $this->ajaxReturn($result);
            }
        }else{
            //是以太币
            (double)$param['eth_balance'] = (double)$loseList[0]['eth_balance'] + (double)$loseList[0]['number'];
            $param['update_time'] = time();
            $userAccountMap['user_id'] = $loseList[0]['user_id'];
            $i = $UserAccount->where($userAccountMap)->save($param);
            if (!$i) {
                $table->rollback();  // 事物回滚
                $table->commit();    // 事物提交
                $result = \StatusCode::code(4000);
                $this->ajaxReturn($result);
              }
        }
        $table->commit();    // 事物提交
        $result = \StatusCode::code(0);
        $this->ajaxReturn($result);
    
    }   
    /**
     * 发送完成
     * 方式：POST
     * URL：/Admin/sendSuccess
     * 参数：无
     * @param send_id  发送ID
     * @param status   改变状态
     * @param nonce_str  随机数
     * @param sign       签名md5
     */
    public function sendSuccess(){
   
        $table = M('Send as s');
        $UserAccount = M('UserAccount');//操作账户表
        $table->startTrans();    // 启动事物
        $data = I('post.');
        $data['update_time'] = time(); 

        //md5验证
        $md5Str = $data['nonce_str'] . $data['send_id'] . $data['status'];
        if (!\Common::verifyMd5($data['sign'], $md5Str)) {
            $table->commit();    // 事物提交
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

        if (!isset($data['send_id'])) {
            $table->commit();    // 事物提交
            $result = \StatusCode::code(4000);
            $this->ajaxReturn($result);
        }

        $map['s.send_id'] = $data['send_id'];
        $map['s.is_deleted'] = IS_NOT_DELETED;
        $i = $table->where($map)->save($data);

        if (!$i) {
            $table->rollback();  // 事物回滚
            $table->commit();    // 事物提交
            $result = \StatusCode::code(4000);
            $this->ajaxReturn($result);
        }

        $join = "left join btc_user as bu on bu.maincoin_id = s.maincoin_id
        left join btc_user_account as bua on bu.user_id = bua.user_id";
        $successList = $table->where($map)->join($join)->field("
            bua.btc_balance,
            bua.eth_balance,
            s.currency_type,
            s.number,
            bu.user_id")->select();

        // //数据处理
        if ($successList[0]['currency_type'] == CURRENCY_TYPE_BTC) {
            //是比特币
            (double)$param['btc_balance'] = (double)$successList[0]['btc_balance'] + (double)$successList[0]['number'];
            $param['update_time'] = time();
            $userAccountMap['user_id'] = $successList[0]['user_id'];
            $i = $UserAccount->where($userAccountMap)->save($param);
            if (!$i) {
                $table->rollback();  // 事物回滚
                $table->commit();    // 事物提交
                $result = \StatusCode::code(4000);
                $this->ajaxReturn($result);
            }
        }else{
            //是以太币
            (double)$param['eth_balance'] = (double)$successList[0]['eth_balance'] + (double)$successList[0]['number'];
            $param['update_time'] = time();
            $userAccountMap['user_id'] = $successList[0]['user_id'];
            $i = $UserAccount->where($userAccountMap)->save($param);
            if (!$i) {
                $table->rollback();  // 事物回滚
                $table->commit();    // 事物提交
                $result = \StatusCode::code(4000);
                $this->ajaxReturn($result);
            }
        }

        $table->commit();    // 事物提交
        $result = \StatusCode::code(0);
        $result['data'] = $successList;
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

            // 判断状态（交易币种）
            if ($v['currency_type'] == CURRENCY_TYPE_BTC) {

                $data[$k]['currency_type_name'] = '比特币';

            } else if($v['currency_type'] == CURRENCY_TYPE_ETN) {

                $data[$k]['currency_type_name'] = '莱特币';

            }

            // 判断状态（交易状态）
            if ($v['status'] == SEND_STATUS_SUBMIT) {

                $data[$k]['status_name'] = '已提交';

            } else if($v['status'] == SEND_STATUS_LOSE) {

                $data[$k]['status_name'] = '失败';

            } else if($v['status'] == SEND_STATUS_UNDERWAY) {

                $data[$k]['status_name'] = '进行中';

            } else if($v['status'] == SEND_STATUS_SUCCESS) {

                $data[$k]['status_name'] = '已完成';

            }
      }

        return $data;
    }
}
