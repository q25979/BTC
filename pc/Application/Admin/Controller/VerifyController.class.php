<?php
namespace Admin\Controller;

use Think\Controller;

// +---------------------------------------------------
// | 作者：庄
// +---------------------------------------------------
// | 时间：2018年4月20日
// +---------------------------------------------------
// | 功能：验证后台账号
// +---------------------------------------------------

class VerifyController extends Controller {
    public $admin;
    public $adminId;

    // 继承构造函数
    public function __construct() {

        parent::__construct();
        $this->verifyAccount();
    }

    public function verifyAccount() {

        // 判断缓存是否存在
        if (cookie('admin_account')) {
            // 表示缓存存在,验证账号密码是否正确
            $data = cookie('admin_account');

            if ($this->isPass($data)) {
                // 表示账号密码正确
                $this->admin = "yes";
            }

            return true;

        } else {
            // 表示缓存不存在
            header('Location:'. HOST_PATH .'/Admin/Login');
        }
    }

    /**
     * @param $data session账号密码的数据
     * @return bool 返回true表示账号密码正确
     */
    private function isPass($data) {
        $admin = M('Admin');

        // 查询账号是否正确
        $map['user_name'] = $data['user_name'];
        $map['pass_word'] = $data['pass_word'];

        $info = $admin->where($map)->count();

        if ($info == 0) {
            // 表示账号或者密码错误
            $this->error("账号或密码错误，请认真检查后登录!", ADMIN_PATH, 3);
        }

        $this->adminId = $admin->getFieldByUserName($data['user_name'], 'admin_id');

        return true;
    }
}