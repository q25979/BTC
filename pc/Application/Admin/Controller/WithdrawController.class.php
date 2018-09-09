<?php
namespace Admin\Controller;

// +---------------------------------------------------
// | 作者：671
// +---------------------------------------------------
// | 时间：2018年5月6日16:33:50
// +---------------------------------------------------
// | 功能：提现管理
// +---------------------------------------------------

class WithdrawController extends VerifyController {
    public function index(){
        $this->display();
    }

    /**
     * 获取数据
     *
     * method: get
     * url：/Admin/Withdraw/get
     * @param page
     * @param limmit
     */
    public function get() {
        $data = I('get.');

        $map['uo.is_deleted'] = IS_NOT_DELETED;
        $this->ajaxReturn($this->_data($map, $data));
    }

    /**
     * 删除（逻辑删除）
     * 方式：POST
     * URL：/Admin/Withdraw/deleted
     * 参数：有
     * @param up_order_id
     * @param nonce_str   随机数
     * @param sign        签名
     */
    public function deleted() {
        $table = M('UpOrder');
        $data = I('post.');

        //md5验证
        $md5Str = $data['nonce_str'].$data['up_order_id'];
        if (!\Common::verifyMd5($data['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $result['data'] = $data;
            $this->ajaxReturn($result);
        }

        //校验
        if (empty($data['up_order_id'])) {
            $result = \StatusCode::code(4003);
            $result['msg'] = "删除失败，请传入商品ID";
            $this->ajaxReturn($result);
        }

        //准备更新数据和条件
        $map['up_order_id'] = array('in', $data['up_order_id']);
        $map['is_deleted'] = IS_NOT_DELETED;
        $param['is_deleted'] = IS_DELETED;
        $param['delete_time'] = time();
        $result = $table-> where($map)->save($param);

        if ($result < 1) {//删除失败
            $result = \StatusCode::code(4003);
            $this->ajaxReturn($result);
        }

        $result = \StatusCode::code(0);
        $result['msg'] = "删除成功";
        $this->ajaxReturn($result);
    }

    /**
     * 搜索
     *
     * 方式：GET
     * URL：/Admin/Withdraw/search
     * 参数：有
     * @param name      人名(模糊)
     * @param page      页
     * @param limit     条数
     */
    public function search() {
        $data = I('get.');

        $map['uo.is_deleted'] = IS_NOT_DELETED;
        $data['name'] == 'all'
            ? ''
            : $map['uo.status'] = $data['name'];
        $this->ajaxReturn($this->_data($map, $data));
    }

    /**
     * 通过审核
     *
     * method: post
     * url: /Admin/Withdraw/pass
     * @param up_order_id
     * @param nonce_str
     * @param sign
     */
    public function pass() {
        $data = I('post.');

        $sign = $data['nonce_str'] . $data['up_order_id'];
        if (!\Common::verifyMd5($data['sign'], $sign))
            $this->ajaxReturn(\StatusCode::code(-100));

        $map['up_order_id'] = $data['up_order_id'];
        $update['status']   = 1;
        $update['update_time'] = time();

        $info = M('UpOrder')->where($map)->save($update);
        $info <= 0
            ? $this->ajaxReturn(\StatusCode::code(4000))
            : $this->ajaxReturn(\StatusCode::code(0));
    }

    /**
     * 不通过审核
     *
     * method: post
     * url: /Admin/Withdraw/notPass
     * @param up_order_id
     * @param user_id
     * @param price         // 提现的金额
     * @param refusal_cause // 拒绝原因
     * @param nonce_str
     * @param sign
     */
    public function notPass() {
        $data = I('post.');
        $UpOrder     = M('UpOrder');
        $UserAccount = M('UserAccount');

        $sign = $data['nonce_str'] . $data['price'] . $data['up_order_id'];
        if (!\Common::verifyMd5($data['sign'], $sign))
            $this->ajaxReturn(\StatusCode::code(-100));

        $map['up_order_id'] = $data['up_order_id'];
        $update['status']   = -1;
        $update['refusal_cause'] = $data['refusal_cause'];
        $update['update_time']   = time();

        $UpOrder->startTrans();
        $info = $UpOrder->where($map)->save($update);
        $info <= 0 ? $this->ajaxReturn(\StatusCode::code(4000)) : '';

        // 获取可提现余额
        $uaMap['user_id'] = $data['user_id'];
        $uaInfo = $UserAccount->where($uaMap)->setInc('extract_balance', (int)$data['price']);
        if ($uaInfo <= 0) {
            $UpOrder->rollback();
            $this->ajaxReturn(\StatusCode::code(4000));
        }

        $UpOrder->commit();
        $UserAccount->commit();
        $this->ajaxReturn(\StatusCode::code(0));
    }

    /**
     * 数据库数据
     *
     * @param array $map  所需数据条件
     * @param array $data 分页所需的数据
     */
    private function _data($map, $data) {
        $UpOrder = M('UpOrder as uo');

        $list = $UpOrder
            ->where($map)
            ->join('left join btc_user u on u.user_id = uo.user_id
                    left join btc_user_account ua on ua.user_id = uo.user_id
                    left join btc_bank bb1 on bb1.bank_id = ua.bank_name
                    left join btc_bank bb2 on bb2.bank_id = ua.bank_branch')
            ->field('
                uo.user_id,
                uo.up_price,
                uo.status,
                uo.refusal_cause,
                uo.create_time,
                uo.update_time,
                uo.up_order_id,
                u.maincoin_id,
                u.user_name,
                u.tel,
                u.email,
                bb1.bank_name as bank_name,
                ua.bank_num,
                ua.bank_account,
                bb2.bank_name as bank_branch
            ')
            ->page($data['page'], $data['limit'])
            ->order('uo.create_time desc')
            ->select();

        $list = $this->setInfo($list);
        $result = \StatusCode::code(0);
        $result['count'] = $UpOrder->where($map)->count();
        $result['data']  = $list;

        return $result;
    }

    /**
     * 设置需要改变的信息
     *
     * @param  array $data
     * @return array 修改好之后的数据
     */
    private function setInfo($data) {
        foreach ($data as $k => $v) {
            if ($v['status'] == WITHDRAW_STATUS_FIAL)
                $data[$k]['status_name'] = '拒绝提现';

            if ($v['status'] == WITHDRAW_STATUS_ING)
                $data[$k]['status_name'] = '审核中';

            if ($v['status'] == WITHDRAW_STATUS_SUCCESS)
                $data[$k]['status_name'] = '提现成功';

            $data[$k]['create_time'] = date('Y-m-d H:i', $v['create_time']);

            // 审核时间
            empty($v['update_time'])
                ? $data[$k]['update_time_name'] = '未审核'
                : $data[$k]['update_time_name'] = date('Y-m-d H:i', $v['update_time']);

            // 提现金额
            $data[$k]['up_price_name'] = 'NT$:'.(int)$v['up_price'];

        }

        return $data;
    }
}