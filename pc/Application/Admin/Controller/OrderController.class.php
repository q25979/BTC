<?php
namespace Admin\Controller;

/**
 * 作者：庄
 * 时间：2018年4月16日20:43:42
 * 功能：交易管理
 */
class OrderController extends VerifyController {
    public function OrderAudit() {
		$this->display();
	}
    public function OrderListAll() {
        $this->display();
    }
    // 订单列表
    public function OrderList() {
        $this->display();
    }
    /**
     * 订单列表
     * 方式：GET
     * URL：/Admin/getOrderListAll
     * 参数：无
     * @param page        分页
     * @param limit       条数
     */
    public function getOrderListAll(){

        $table = M('OrderInfo as oi');
        $data = I('get.');

        if (isset($data['order_type']) && $data['order_type'] != "") {
            $map['oi.order_type'] = $data['order_type'];
        }

        $map['oi.is_deleted'] = IS_NOT_DELETED;
        $join ="btc_user as bu on bu.user_id = oi.user_id and bu.is_deleted =" . IS_NOT_DELETED;
        $count = $table->where($map)->join($join)->count();
        $list = $table->where($map)->join($join)->page($data['page'], $data['limit'])->field("
            oi.*,bu.user_name
            ")->order('oi.create_time desc')->select();

        $list = $this->setStatus($list);
        $result = \StatusCode::code(0);
        $result['count'] = $count;
        $result['data'] = $list;

        $this->ajaxReturn($result);
        
    }
	/**
     * 订单列表
     * 方式：GET
     * URL：/Admin/getOrderList
     * 参数：无
     * @param order_type  订单类型
     * @param page        分页
     * @param limit       条数
     */
	public function getOrderList(){

	    $table = M('OrderInfo as oi');
        $data = I('get.');

        if (isset($data['order_type']) && $data['order_type'] != "") {
            $map['oi.order_type'] = $data['order_type'];
        }

        $map['oi.is_deleted'] = IS_NOT_DELETED;
        $map['oi.status'] = ORDER_STATUS_SUBMIT;
        $join ="btc_user as bu on bu.user_id = oi.user_id and bu.is_deleted =" . IS_NOT_DELETED;
        $count = $table->where($map)->join($join)->count();
        $list = $table->where($map)->join($join)->page($data['page'], $data['limit'])->field("
            oi.*,bu.user_name
            ")->order('oi.create_time desc')->select();

        $list = $this->setStatus($list);
        $result = \StatusCode::code(0);
        $result['count'] = $count;
        $result['data'] = $list;

        $this->ajaxReturn($result);
        
	}
    /**
     * 订单审核列表
     * 方式：GET
     * URL：/Admin/getOrderListAudit
     * 参数：无
     * @param order_type  订单类型
     * @param page        分页
     * @param limit       条数
     */
    public function getOrderListAudit(){

        $table = M('OrderInfo as oi');
        $data = I('get.');

        if (isset($data['order_type']) && $data['order_type'] != "") {
            $map['oi.order_type'] = $data['order_type'];
        }

        $map['oi.is_deleted'] = IS_NOT_DELETED;
        $map['oi.status'] = ORDER_STATUS_UNDERWAY;
        $join ="btc_user as bu on bu.user_id = oi.user_id and bu.is_deleted =" . IS_NOT_DELETED;
        $count = $table->where($map)->join($join)->count();
        $list = $table->where($map)->join($join)->page($data['page'], $data['limit'])->field("
            oi.*,bu.user_name
            ")->order('oi.create_time desc')->select();

        $list = $this->setStatus($list);
        $result = \StatusCode::code(0);
        $result['count'] = $count;
        $result['data'] = $list;

        $this->ajaxReturn($result);
        
    }
	/**
     * 订单审核(不同的按钮有不同的功能前端传状态值区别)
     * 方式：POST
     * URL：/Admin/orderAuditInfo
     * 参数：无
     * @param order_id   订单ID
     * @param status     改变状态
     * @param remark     备注
     * @param nonce_str  随机数
     * @param sign       签名md5
     */
	public function orderAuditInfo(){

        $table = M('OrderInfo');
        $data = I('post.');

        //md5验证
        $md5Str = $data['nonce_str'] . $data['order_id'] . $data['status'];
        if (!\Common::verifyMd5($data['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

        if (!isset($data['order_id'])) {
            $result = \StatusCode::code(4000);
            $this->ajaxReturn($result);
        }

        $map['order_id'] = $data['order_id'];
        $map['is_deleted'] = IS_NOT_DELETED;
        $data['update_time'] = time();
        $i = $table->where($map)->save($data);

        if (!$i) {
            $result = \StatusCode::code(4000);
            $this->ajaxReturn($result);
        }

        $result = \StatusCode::code(0);
        $this->ajaxReturn($result);
		
	}
    /**
     * 订单取消
     * 方式：POST
     * URL：/Admin/orderLose
     * 参数：无
     * @param order_id 订单ID
     * @param status   改变状态
     * @param remark   备注
     * @param nonce_str  随机数
     * @param sign       签名md5
     */
    public function orderLose(){
   
        $table = M('OrderInfo as oi');
        $UserAccount = M('UserAccount');// 操作账户表
        $table->startTrans();    // 启动事物
        $data = I('post.');
        $data['update_time'] = time();

        //md5验证
        $md5Str = $data['nonce_str'] . $data['order_id'] . $data['status'];
        if (!\Common::verifyMd5($data['sign'], $md5Str)) {
            $table->commit();    // 事物提交
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

        if (!isset($data['order_id'])) {
            $table->commit();    // 事物提交
            $result = \StatusCode::code(4000);
            $this->ajaxReturn($result);
        }

        $map['oi.order_id'] = $data['order_id'];
        $map['oi.is_deleted'] = IS_NOT_DELETED;
        $i = $table->where($map)->save($data);

        if (!$i) {
            $table->rollback();  // 事物回滚
            $table->commit();    // 事物提交
            $result = \StatusCode::code(4000);
            $this->ajaxReturn($result);
        }

        $join = "btc_user_account as bua on bua.user_id = oi.user_id";
        $loseList = $table->where($map)->join($join)->field("
            bua.btc_balance,
            bua.eth_balance,
            bua.extract_balance,
            oi.currency_type,
            oi.number,
            oi.order_type,
            oi.user_id,
            oi.payment_type,
            oi.price,
            oi.user_id")->select();

        //如果是买入取消，是用余额付款要返还
        if ($loseList[0]['order_type'] == ORDER_TYPE_BUY) {
            if ($loseList[0]['payment_type'] == PAYMENT_TYPE_BALANCE) {//如果是余额付款
                //操作账户余额
                (integer)$param['extract_balance'] = (integer)$loseList[0]['extract_balance'] + 
                                                     (integer)$loseList[0]['price'];
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
     * 订单完成
     * 方式：POST
     * URL：/Admin/orderSuccess
     * 参数：无
     * @param order_id  订单ID
     * @param status   改变状态
     * @param nonce_str  随机数
     * @param sign       签名md5
     */
    public function orderSuccess(){
   
        $table = M('OrderInfo as oi');
        $table->startTrans();    // 启动事物
        $data = I('post.');
        $data['update_time'] = time();

        //md5验证
        $md5Str = $data['nonce_str'] . $data['order_id'] . $data['status'];
        if (!\Common::verifyMd5($data['sign'], $md5Str)) {
            $table->commit();    // 事物提交
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

        if (!isset($data['order_id'])) {
            $table->commit();    // 事物提交
            $result = \StatusCode::code(4000);
            $this->ajaxReturn($result);
        }

        $map['oi.order_id'] = $data['order_id'];
        $map['oi.is_deleted'] = IS_NOT_DELETED;
        $i = $table->where($map)->save($data);

        if (!$i) {
            $table->rollback();  // 事物回滚
            $table->commit();    // 事物提交
            $result = \StatusCode::code(4000);
            $this->ajaxReturn($result);
        }

        $UserAccount = M('UserAccount');//操作账户表

        $join = "btc_user_account as bua on bua.user_id = oi.user_id";
        $successList = $table->where($map)->join($join)->field("
            bua.btc_balance,
            bua.eth_balance,
            bua.extract_balance,
            oi.currency_type,
            oi.number,
            oi.order_type,
            oi.price,
            oi.user_id")->select();

        //如果是卖出完成,添加到可提现余额中
        if ($successList[0]['order_type'] == ORDER_TYPE_SALE) {
            //操作账户余额
            (integer)$param['extract_balance'] = (integer)$successList[0]['extract_balance'] + 
                                                 (integer)$successList[0]['price'];
            $param['update_time'] = time();
            $userAccountMap['user_id'] = $successList[0]['user_id'];
            $i = $UserAccount->where($userAccountMap)->save($param);

            if (!$i) {
                $table->rollback();  // 事物回滚
                $table->commit();    // 事物提交
                $result = \StatusCode::code(4000);
                $this->ajaxReturn($result);
            }

            $table->commit();    // 事物提交
            $result = \StatusCode::code(0);
            $this->ajaxReturn($result);
        }

        //数据处理
        if ($successList[0]['currency_type'] == CURRENCY_TYPE_BTC) {
            //是比特币
            (double)$param['btc_balance'] = (double)$successList[0]['btc_balance'] + 
                                             (double)$successList[0]['number'];
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
            (double)$param['eth_balance'] = (double)$successList[0]['eth_balance'] + 
                                             (double)$successList[0]['number'];
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

            // 判断状态（订单）
            if ($v['order_type'] == ORDER_TYPE_BUY) {

                $data[$k]['order_type_name'] = '买入';

            } else if($v['order_type'] == ORDER_TYPE_SALE) {

                $data[$k]['order_type_name'] = '卖出';

            }
            // 判断状态（交易币种）
            if ($v['currency_type'] == CURRENCY_TYPE_BTC) {

                $data[$k]['currency_type_name'] = '比特币';

            } else if($v['currency_type'] == CURRENCY_TYPE_ETN) {

                $data[$k]['currency_type_name'] = '以太币';

            }

            // 判断状态（订单状态）
            if ($v['status'] == ORDER_STATUS_SUBMIT) {

                $data[$k]['status_name'] = '已提交';

            } else if($v['status'] == ORDER_STATUS_UNDERWAY) {

                $data[$k]['status_name'] = '进行中';

            } else if($v['status'] == ORDER_STATUS_FINISH) {

                $data[$k]['status_name'] = '已完成';

            } else if($v['status'] == ORDER_STATUS_CANCEL) {

                $data[$k]['status_name'] = '已取消';

            }
        }

        return $data;
    }
}
