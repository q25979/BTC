<?php
namespace Home\Controller;

/**
 * 作者：新疆哥
 * 时间：2018年4月16日16:51:07
 * 功能：交易明细
 */
class DealDetailsController extends VerifyController {
    /**
     * 交易模板渲染
     */
    public function index() {
        $this->display();

    }

    /**
     * 获取交易数据
     * method: post
     * url: /Home/DealDetails/getDealInfo
     * currency_type 币种类型
     * page 页数 
     */
    public function getDealInfo() {
    	$info = I('post.');

    	$deal = M('Order_info');

    	$map['user_id'] = $this->user_id;
    	$map['is_deleted'] = IS_NOT_DELETED;
        $result = \StatusCode::code(0);
        if($info['currency_type'] == CURRENCY_TYPE_BTC) {
            $map['currency_type'] = CURRENCY_TYPE_BTC;
            $data = $deal
                ->field('order_id,system_order,order_type,create_time,status,number,currency_type')
                ->where($map)
                ->page($info['page'],LIMIT)
                ->order('create_time desc')
                ->select();
            
            $result['count'] = $deal
                ->where($map)
                ->count();
            $data = $this->changeDataBTC($data);
            $result['data'] = $data;
            $this->ajaxReturn($result);
        }
        if($info['currency_type'] == CURRENCY_TYPE_ETN) {
            $map['currency_type'] = CURRENCY_TYPE_ETN;
            $data = $deal
                ->field('order_id,system_order,order_type,create_time,status,number,currency_type')
                ->where($map)
                ->page($info['page'],LIMIT)
                ->order('create_time desc')
                ->select();
            $result['count'] = $deal
                ->where($map)
                ->count();
            $data = $this->changeDataETH($data);
            $result['data'] = $data;
            $this->ajaxReturn($result); 
        }
		
    }

    /**
     * 訂單詳情
     *
     * url: /Home/DealDetails/dealDetails
     * method: post
     * order_id 訂單号
     */
    public function dealDetails() {
        $info = I('get.');
        $order = M('Order_info');
        $map['order_id'] = $info['order_id'];
        $data = $order
            ->where($map)
            ->field('system_order,number,price,status,order_type,unit_price,currency_type,create_time')
            ->select();
        $res = $this->changeTime($data);
        if ($res[0]['status'] == ORDER_STATUS_SUBMIT) {
            $res[0]['status'] = '已提交';
        }else if ($res[0]['status'] == ORDER_STATUS_UNDERWAY) {
            $res[0]['status'] = '已审核';
        }else if ($res[0]['status'] == ORDER_STATUS_FINISH) {
            $res[0]['status'] = '已完成';
        }else if ($res[0]['status'] == ORDER_STATUS_CANCEL) {
            $res[0]['status'] = '已取消';
        }
        
        
        $result = \StatusCode::code(0);
        $result['data'] = $res;
        $this->ajaxReturn($result);
    }
    //修改数据內容
    public function changeTime($data) {
        foreach ($data as $k => $v) {
            $data[$k]['create_time'] = date('Y-m-d H:m:s',$v['create_time']);
        }
        return $data;
    }
    /**
     * 交易完成总数
     * URL：/Home/DealDetails/total
     * method: get
     */
    public function total(){
        $getdata = I('post.');
        $total = M('Order_info');

        $map['user_id'] = $this->user_id;
        $map['currency_type'] = $getdata['currency_type'];

        $info = $total->where($map)->field('number')->select();

        foreach ($info as $k=>$v) {  
          //获取到每次循环的数量
          $subtotal[] += $v['number'];  
                          
        } 
        $numtotal = array_sum($subtotal);  

        $result = \StatusCode::code(0);
        $result['data'] = $numtotal;
        $this->ajaxReturn($result);
    }

    /**
     * 修改時間戳及狀態
     */
    public function changeDataBTC($data) {
        foreach ($data as $k => $v) {
            $data[$k]['create_time'] = date('Y-m-d H:m:s',$v['create_time']);
            $data[$k]['currency_type'] = '比特幣';  
        }
        return $data;
    }
    public function changeDataETH($data) {
        foreach ($data as $k => $v) {
            $data[$k]['create_time'] = date('Y-m-d H:m:s',$v['create_time']);
            $data[$k]['currency_type'] = '以太幣';  
        }
        return $data;
    }  
}
