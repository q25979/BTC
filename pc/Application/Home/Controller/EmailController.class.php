<?php
namespace Home\Controller;

/**
 * 作者：671
 * 时间：2018年4月16日16:51:07
 * 功能：Email
 */
class EmailController extends LoginController {
    /**
     * token成功后保存数据库(step1)
     *
     * method: POST
     * url: /Home/Email/step_1
     * @param email
     * @param password
     * @param nonce_str
     * @param sign
     */
    public function step_1() {
        $User = M('User');
        $data = I('post.');
        $ip   = \Common::getIP();

        // 判断账号是否存在
        $map['email'] = $data['email'];
        $count = $User->where($map)->count();
        $count > 0 ? $this->ajaxReturn(\StatusCode::code(1001)) : '';

        $data['user_id']     = \Common::generateId();
        $data['create_time'] = time();
        $data['user_name']   = $data['email'];
        $data['register_ip'] = $ip;
        $data['login_ip']    = $ip;

        // 1.注册插入数据库：user
        $User->startTrans();
        $info = $User->add($data);
        if ($info < 1) $this->ajaxReturn(\StatusCode::code(4001));

        // 2.插入数据库：user_account
        $UserAccount = M('UserAccount');
        $uaData = array(
            'account_id'    => \Common::generateId(),
            'user_id'       => $data['user_id'],
            'create_time'   => $data['create_time']
        );
        $uaInfo = $UserAccount->add($uaData);
        if ($uaInfo < 1) {
            $User->rollback();

            $result = \StatusCode::code(4001);
            $result['errmsg'] = '插入user_account失败';
            $this->ajaxReturn($result);
        }

        // 3.插入数据库：user_set
        $UserSet = M('UserSet');
        $usData = array(
            'seting_id'     => \Common::generateId(),
            'user_id'       => $data['user_id'],
            'create_time'   => $data['create_time']
        );
        $usInfo = $UserSet->add($usData);
        if ($usInfo < 1) {
            $User->rollback();
            $UserAccount->rollback();

            $result = \StatusCode::code(4001);
            $result['errmsg'] = '插入user_set失败';
            $this->ajaxReturn($result);
        }

        // 4.插入数据库：user_wallet_address
        $UserWalletAddress = M('UserWalletAddress');
        $uwaData = array(
            'user_wallet_address_id'    => \Common::generateId(),
            'user_id'                   => $data['user_id'],
            'wallet_address_id'         => WALLET_TYPE_ETH_ID,
            'create_time'               => $data['create_time']
        );
        $uwaInfo = $UserWalletAddress->add($uwaData);
        if ($uwaInfo < 1) {
            $User->rollback();
            $UserAccount->rollback();
            $UserSet->rollback();

            $result = \StatusCode::code(4001);
            $result['errmsg'] = '插入user_wallet_address失败';
            $this->ajaxReturn($result);
        }

        // 事物正确，全部提交
        $User->commit();
        $UserAccount->commit();
        $UserSet->commit();
        $UserWalletAddress->commit();
        $this->_login($data);
    }

    /**
     * 手机注册成功后进入步骤2
     *
     * method: POST
     * url: /Home/Email/step_2
     * @param tel
     * @param nonce_str
     * @param sign
     */
    public function step_2() {
        $User = M('User');
        $data = I('post.');

        $map['email']  = $data['email'];
        $update['tel'] = $data['tel'];
        $update['update_time'] = time();
        $update['maincoin_id'] = $this->maincoinId();

        $info = $User->where($map)->save($update);
        $info > 0 ? $this->ajaxReturn(\StatusCode::code(0)) : $this->ajaxReturn(\StatusCode::code(4000));
    }

    /**
     * 注册成功后登陆
     *
     * @param $data 账号和密码
     */
    private function _login($data) {
        $cookie['email']    = base64_encode($data['email']);
        $cookie['password'] = base64_encode($data['password']);
        cookie('identification', $cookie);

        $this->ajaxReturn(\StatusCode::code(0));
    }

    /**
     * 获取数据库唯一的maincoin_id
     */
    public function maincoinId() {
        $User = M('User');

        $id = \Common::nonceStr(8);
        $map['maincoin_id'] = $id;
        $count = $User->where($map)->count();
        if ($count > 0) {
            // 如果存在就在进行一次
            $this->maincoinId();
        }

        return $id;
    }

    /**
     * 获取邮箱之后的注册
     */
    public function index() {
        $data  = I('get.');
        $Token = M('Token');
        $User  = M('User');

        // 判断是否token是否正确
        $tMap['token'] = md5($data['token']);
        $tCount = $Token->where($tMap)->count();
        // token认证失败,退出
        if ($tCount < 1) header('Location: '. HOST_PATH .'/Home/Login/index/token_err/true');

        // 判断账号是否注册过
        $uMap['email'] = base64_decode(base64_decode($data['token']));
        $uCount = $User->where($uMap)->count();
        if ($uCount < 1) {
            // 数据库没有邮箱账号，进入注册页面
            $this->register($uMap['email']);
            return true;
        }

        // 数据库已经存在，进入改成页面
        $this->forget($uMap['email']);

    }

    /**
     * 邮箱接收,需要的参数需要跨域请求
     */
    public function receive() {
        $HomeInfo = M('HomeInfo');

        $info = $HomeInfo
            ->field('name, company_email, company_tel, logo_url')
            ->where('id='. HOME_INFO_ID)
            ->find();

        $result = $info;
        return $result;
    }

    /**
     * 注册页面
     *
     * @param string $email
     */
    public function register($email) {
        $this->assign('email', $email);
        $this->display('register');
    }

    /**
     * 忘记密码
     *
     * @param string $email
     */
    public function forget($email) {
        $this->assign('email', $email);
        $this->display('forget');
    }

    /**
     * 修改密码
     *
     * method: POST
     * url: /Home/Email/changePassword
     * @param email
     * @param password
     * @param nonce_str
     * @param sign
     */
    public function changePassword() {
        $data = I('post.');

        $md5String = $data['email'] . $data['password'] . $data['nonce_str'];
        if (!\Common::verifyMd5($data['sign'], $md5String)) {
            $this->ajaxReturn(\StatusCode::code(-100));
        }
        $User = M('User');
        $map['email'] = $data['email'];
        $info = $User->where($map)->save($data);

        $info > 0
            ? $this->ajaxReturn(\StatusCode::code(0))
            : $this->ajaxReturn(\StatusCode::code(4000));
    }

    /**
     * 发送邮件
     */
    public function send() {
        $this->display();
    }

    /**
     * 账号锁定
     */
    public function lockout() {
    	$this->display();
    }
}
