<?php
namespace Home\Controller;

/**
 * 作者：671
 * 时间：2018年4月16日16:51:07
 * 功能：钱包地址
 */
class WalletAddrController extends VerifyController {
    public function index() {
        $this->ajaxReturn($this->get());
        $this->display();
    }

    /**
     * 获取钱包地址
     *
     * @return array
     */
    public function get() {

        $getdata = I('get.');
        $UserWalletAddr = M('UserWalletAddress as uwa');

        $map['user_id'] = $this->user_id;

        $list = $UserWalletAddr
            ->join('btc_wallet_address wa on uwa.wallet_address_id = wa.wallet_address_id')
            ->field('uwa.label, wa.address, wa.address_url, wa.type, uwa.user_wallet_address_id, uwa.create_time')
            ->where($map)
            ->order('uwa.create_time desc')
            ->select();
        $list = $this->typeClassify($list);

        $this->ajaxReturn($list);
    }

    /**
     * 添加钱包地址
     * method GET
     * URL:/Home/WalletAddr/addNew
     */
    public function addNew() {
        $UserWalletAddr = M('UserWalletAddress');
        $WalletAddr = M('WalletAddress');

        $map['type'] = CURRENCY_TYPE_BTC;
        $map['is_deleted'] = IS_NOT_DELETED;

        $WalletAddrList = $WalletAddr
            ->field('wallet_address_id')
            ->where($map)
            ->select();

        $UserWalletMap['user_id'] = $this->user_id;
        // 查看我的钱包地址是否存在当前数据id没有就更新
        foreach ($WalletAddrList as $k => $v) {
            $UserWalletMap['wallet_address_id'] = $v['wallet_address_id'];

            $count = $UserWalletAddr->where($UserWalletMap)->count();
            // 如果没有存在就添加
            if ((int)$count == 0) {
                $d['wallet_address_id'] = $UserWalletMap['wallet_address_id'];
                $d['user_id'] = $this->user_id;
                $d['create_time'] = time();
                $d['user_wallet_address_id'] = \Common::generateId();

                $addInfo = $UserWalletAddr->add($d);
                $addInfo ? $this->ajaxReturn(\StatusCode::code(0)) : $this->ajaxReturn(\StatusCode::code(-1));
            }
        }

        // 已经达到最大地址数量，就更新时间
        $map['user_id'] = $this->user_id;
        $UpdateMap['create_time'] = $UserWalletAddr->where($map)->min('create_time');
        $UpdateMap['user_id'] = $this->user_id;
        $updateD['create_time'] = time();

        $UserWalletAddressId = $UserWalletAddr->field('user_wallet_address_id')->where($UpdateMap)->find();
        $updateInfo = $UserWalletAddr->where($UserWalletAddressId)->save($updateD);
        $updateInfo ? $this->ajaxReturn(\StatusCode::code(0)) : $this->ajaxReturn(\StatusCode::code(-1));
    }

    /**
     * 根据ID查找
     *
     * @return array
     */
    public function getById() {

        $getdata = I('get.');
        $UserWalletAddr = M('UserWalletAddress as uwa');

        $map['uwa.user_wallet_address_id'] = $getdata['user_wallet_address_id'];
        $list = $UserWalletAddr
            ->join('btc_wallet_address wa on uwa.wallet_address_id = wa.wallet_address_id')
            ->field('uwa.label, wa.address, wa.address_url, uwa.user_wallet_address_id, uwa.create_time')
            ->where($map)
            ->order('uwa.create_time desc')
            ->select();

        foreach ($list as $k => $v) {
            $list[$k]['create_time'] = date('Y-m-d', $v['create_time']);
        }
        $result = \StatusCode::code(0);
        $result['data'] = $list;
        $this->ajaxReturn($result);
    }
    /**
     * 更新数据post
     *
     * @return array
     */
    public function updata() {

        $getdata = I('post.');
        $UserWalletAddr = M('UserWalletAddress');

        $map['user_wallet_address_id'] = $getdata['user_wallet_address_id'];
        $param['label'] = $getdata['label'];

        $i = $UserWalletAddr->where($map)->save($param);

        if (!$i) {
            $result = \StatusCode::code(4002);
            $this->ajaxReturn($result);
        }
        
        $result = \StatusCode::code(0);
        $this->ajaxReturn($result);
    }


    /**
     * 类型分类
     *
     * @param array     $data
     * @return array    $newData
     */
    public function typeClassify($data) {
        $newData = array(
            'btc'   => array(),
            'eth'   => array(),
        );
        $b = 0;
        $e = 0;

        foreach ($data as $k => $v) {
            if (!empty($v['create_time'])) {
                // 转换时间
                $v['create_time'] = date('Y-m-d', $v['create_time']);
            }
            if ($v['type'] == CURRENCY_TYPE_BTC) {
                $newData['btc'][$b++] = $v;

            } else {
                $newData['eth'][$e++] = $v;
            }
        }

        return $newData;
    }
}
