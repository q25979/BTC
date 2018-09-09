<?php
namespace Admin\Controller;
use Think\Controller;

// +---------------------------------------------------
// | 作者：dong
// +---------------------------------------------------
// | 时间：2018年5月5日
// +---------------------------------------------------
// | 功能：银行卡添加
// +---------------------------------------------------

class BankController extends VerifyController {
    public function index(){
        $this->display();
    }
    /**
     * 银行列表
     * 方式：GET
     * URL：/Admin/getBank
     * 参数：无
     * @param page        分页
     * @param limit       条数
     */
    public function getBank(){

        $table = M('Bank as bb1');
        $data = I('get.');

        if (isset($data['bank_name'])) {
            $map['bb1.bank_name']=array('like', '%'. $data['bank_name'] .'%');
        }

        $map['bb1.is_deleted'] = IS_NOT_DELETED;
        $join = "left join btc_bank as bb2 on bb1.bank_parent = bb2.bank_id and
        bb2.is_deleted =".IS_NOT_DELETED;
        
        $count = $table->where($map)->count();
        $list = $table->where($map)->page($data['page'], $data['limit'])->join($join)
        		->field('bb1.bank_id,bb1.bank_name,bb1.bank_type,bb1.create_time,bb2.bank_name as bank_parent_name')
        		->order('bb1.create_time desc')->select();

        $list = $this->setStatus($list);
        $result = \StatusCode::code(0);
        $result['count'] = $count;
        $result['data'] = $list;

        $this->ajaxReturn($result);
        
    }

    /**
     * 添加银行
     * 方式：post
     * URL：/Admin/addBank
     * 参数：无
     * @param page        分页
     * @param limit       条数
     */
    public function addBank(){

        $table = M('Bank');
        $data = I('post.');

        if (!isset($data['bank_parent'])) {//如果父节点为空就设置默认为0
            $data['bank_parent'] = '0';
        }
        $data['bank_id'] = \Common::generateId();
        $data['create_time'] = time();

        $i = $table->add($data);
        if (!$i) {
        	$result = \StatusCode::code(4003);
        }else{
        	$result = \StatusCode::code(0);
        }

        $this->ajaxReturn($result);
        
    }

    /**
     * 获取一级银行
     * 方式：GET
     * URL：/Admin/getParentBank
     * 参数：无
     * @param page        分页
     * @param limit       条数
     */
    public function getParentBank(){

        $table = M('Bank');

        $map['is_deleted'] = IS_NOT_DELETED;
        $map['bank_type'] = BANK_TYPE_PARENT;
        
        $list = $table->where($map)->field('bank_id,bank_name')->order('create_time desc')->select();

        $result = \StatusCode::code(0);
        $result['data'] = $list;

        $this->ajaxReturn($result);
        
    }

    /**
     * 删除银行
     * 方式：GET
     * URL：/Admin/delete
     * 参数：无
     * @param page        分页
     * @param limit       条数
     */
    public function delete(){

        $table = M('Bank');
        $data = I('post.');

        //md5验证
        $md5Str = $data['bank_id'] . $data['nonce_str'];
        if (!\Common::verifyMd5($data['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

        if (!isset($data['bank_id'])) {
            $result = \StatusCode::code(-1);
            $result['msg'] = "ID不能为空";
            $this->ajaxReturn($result);
        }

        $data['is_deleted'] = IS_NOT_DELETED;
        $param['is_deleted'] = IS_DELETED;
        
        $i = $table->where($data)->save($param);
        if (!$i) {
            $result = \StatusCode::code(-1);
            $this->ajaxReturn($result);
        }

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
            if ($v['bank_type'] == BANK_TYPE_PARENT) {

                $data[$k]['bank_type_name'] = '主银行';

            } else if($v['bank_type'] == BANK_TYPE_SON) {

                $data[$k]['bank_type_name'] = '子银行';

            }
   		}
   		return $data;
   	}
}