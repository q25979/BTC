<?php
namespace Home\Controller;

/**
 * 作者：新疆哥
 * 时间：2018年4月16日16:51:07
 * 功能：首页
 */
class IndexController extends VerifyController {

    // 渲染
    public function index() {
        // 判断账号有没有绑定手机号
        if (!empty($this->user_id)) {
            $User = M('User');
            $uMap['user_id'] = $this->user_id;
            $info = $User
                ->where($uMap)
                ->field('maincoin_id, email')
                ->find();

            $this->assign('maincoin_id', $info['maincoin_id']);
            $this->assign('email', $info['email']);
        } 
        $this->display();
    }

    /**
     * 账户概况
     * URL：/Home/Index/getAccount
     * method: post 
     */
    public function getAccount() {
        $info = I('post.');
        $account = M('User_account');

        $map['user_id'] = $this->user_id;
        $map['is_deleted'] = IS_NOT_DELETED;
        $map['status'] = USER_STATUS_ENABLE;
        
        $data = $account->where($map)->field('btc_balance,eth_balance,freeze_balance,extract_balance')->find(); 

        $this->ajaxReturn($data);
    }
    
    /**
     * 获取顶部信息
     *
     * method: get
     * url: /Home/Index/getTopInfo
     */
    public function getTopInfo() {
        if (isset($this->user_id)) {
            $uMap['user_id'] = $this->user_id;
            $info = M('User')
                ->where($uMap)
                ->field('user_name, maincoin_id')
                ->find();
            $map['maincoin_id'] = $info['maincoin_id'];

            $result = \StatusCode::code(0);
            $result['data']['username'] = $info['user_name'];
            $result['data']['message']  = M('information')
                ->where($map)
                ->count();

            $this->ajaxReturn($result);

        } else {
            $this->ajaxReturn(\StatusCode::code(-1));
        }
    }
    
    /**
     * 生成提現訂單
     *
     * method: get
     * url: /Home/Index/createUpOrder
     */
    public function createUpOrder() {
        if (isset($this->user_id)) {
            $info = I('post.');
            $upOrder = M('UpOrder');
            $userAccount = M('UserAccount');
            $userAccount->startTrans();    // 启动事物

            //md5验证
            // $md5Str = $info['nonce_str'] . $info['up_price'];
            // if (!\Common::verifyMd5($getData['sign'], $md5Str)) {
            //     $result = \StatusCode::code(-100);
            //     $this->ajaxReturn($result);
            // }
            if ((int)$info['up_price'] < 0) {
                $this->ajaxReturn(\StatusCode::code(-1));
            }

            $map['user_id'] = $this->user_id;
            $data = $userAccount->where($map)->select();
            (int)$param['extract_balance'] = (int)$data[0]['extract_balance'] - (int)$info['up_price'];

            if ($param['extract_balance'] < 0) {//如果为负数则需要刷新后提现（前后端数据不一致）
                $userAccount->rollback();  // 事物回滚
                $userAccount->commit();    // 事物提交
                $result = \StatusCode::code(4000);
                $this->ajaxReturn($result);
            }

            $i = $userAccount->where($map)->save($param);
            if (!$i) {
                $userAccount->rollback();  // 事物回滚
                $userAccount->commit();    // 事物提交
                $result = \StatusCode::code(4000);
                $this->ajaxReturn($result);
            }

            $info['user_id'] = $this->user_id;
            $info['up_order_id'] = \Common::generateId();
            $info['create_time'] = time();

            $i = $upOrder->add($info);
            if ($i) {
                $userAccount->commit();    // 事物提交
                $result = \StatusCode::code(0);
                $this->ajaxReturn($result);
            }else{
                $userAccount->rollback();  // 事物回滚
                $userAccount->commit();    // 事物提交
                $result = \StatusCode::code(4000);
                $this->ajaxReturn($result);
            }

        } else {
            $this->ajaxReturn(\StatusCode::code(-1));
        }
    }
 
}
