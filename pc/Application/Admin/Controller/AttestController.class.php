<?php
namespace Admin\Controller;

/**
 * 作者：亮哥
 * 时间：2018年4月16日20:43:42
 * 功能：认证
 */
class AttestController extends VerifyController {
    public function AttestList() {
		$this->display();
	}
    public function Examine() {
        $this->display();
    }
    /**
     * 认证列表
     * 方式：GET
     * URL：/Admin/getAttestList
     * 参数：无
     * @param page  分页
     * @param limit 条数
     * @param user_nam 用户名
     */
	public function getAttestList(){
        $getData=I('get');
	    $Attest=M('authentication as a');

        $join = 'btc_user as b on b.user_id=a.user_id';

        $map['a.is_deleted'] = IS_NOT_DELETED;

        $info = $Attest->where($map)->page($getData['page'],$getData['limit'])->order('create_time desc')->join($join)->field('a.*,b.maincoin_id,b.user_name')->select();

        $info = $this->setStatus($info);

        $result = \StatusCode::code(0);

        $result['count'] = $Attest->where($map)->join($join)->count();
        $result['data'] = $info;
          
        $this->ajaxReturn($result);


	}

    /**
     * 认证待审核列表
     * 方式：GET
     * URL：/Admin/examineList
     * 参数：无
     * @param page  分页
     * @param limit 条数
     * @param user_nam 用户名
     */
    public function examineList(){
        $getData=I('get');

        $Attest=M('authentication as a');

        $join = 'btc_user as b on b.user_id=a.user_id';

        $map['a.is_deleted'] = IS_NOT_DELETED;

        $map['a.status']=ATTEST_STATUS_AUTID;

        $info = $Attest->where($map)->page($getData['page'],$getData['limit'])->join($join)->field('a.*,b.user_name,b.maincoin_id')->order('create_time desc')->select();
        
        $info = $this->setStatus($info);

        $result = \StatusCode::code(0);

        $result['count'] = $Attest->where($map)->count();
        $result['data'] = $info;
          
        $this->ajaxReturn($result);


    }
	/**
     * 认证列表按照用户名搜索
     * 方式：get
     * URL：/Admin/getAttest
     * 参数：有
     * @param user_name 用户名
     * @param page    分页
     * @param limit   条数
     */
    public function getAttest(){
        $getData=I('get.');

        $Attest=M('authentication as a');

        $join = 'btc_user as b on b.user_id=a.user_id';

        $map['user_name']=array('like', '%'. $getData['user_name'] .'%');

        $map['a.is_deleted'] = IS_NOT_DELETED;

        $info = $Attest->where($map)->page($getData['page'],$getData['limit'])->order('create_time desc')->join($join)->field('a.*,b.maincoin_id,b.user_name')->select();

        $info = $this->setStatus($info);

        $result = \StatusCode::code(0);

        $result['count'] = $Attest->where($map)->join($join)->count();

        $result['data'] = $info;
      
        $this->ajaxReturn($result);
    }

    /**
     * 待审核列表按照用户名搜索
     * 方式：get
     * URL：/Admin/getExamine
     * 参数：有
     * @param user_name 用户名
     * @param page    分页
     * @param limit   条数
     */
    public function getExamine(){
        $getData=I('get.');

        $Attest=M('authentication as a');

        $join = 'btc_user as b on b.user_id=a.user_id';

        $map['a.is_deleted'] = IS_NOT_DELETED;

        $map['a.status']=ATTEST_STATUS_AUTID;

        $map['user_name']=array('like', '%'. $getData['user_name'] .'%');

        $info = $Attest->where($map)->page($getData['page'],$getData['limit'])->join($join)->field('a.*,b.user_name,b.maincoin_id')->order('create_time desc')->select();
        
        $info = $this->setStatus($info);

        $result = \StatusCode::code(0);

        $result['count'] = $Attest->where($map)->count();
        $result['data'] = $info;
          
        $this->ajaxReturn($result);
    }
	
	/**
     * 查看认证信息（要以轮播图的方式展示出三张图片）
     * 方式：POST
     * URL：/Admin/getAttestInfo
     * 参数 有
     * @param authentication_id 认证ID
     */
	public function getAttestInfo(){
		$getData=I('post.');

        $Attest=M('authentication');

        $map['authentication_id'] = $getData['authentication_id'];

        $info = $Attest->where($map)->field('f_status_url,r_status_url,hand_status_url')->find();

        $result = \StatusCode::code(0);

        $result['data'] = $info;

        $this->ajaxReturn($result);

	}
    
	/**
     * 审核通过（通过以后要将三张图片的URL添加到对应的用户附件表中，文件名为url的备注名）
     * 方式：POST
     * URL：/Admin/auditYes
     * 参数 有
     * @param authentication_id 认证ID
     * @param f_status_url      正面身份证图片的url
     * @param r_status_url      身份证反面的url
     * @param hand_status_url   手持身份证的URL
     * @param nonce_str  随机数
     * @param status     状态
     * @param sign       签名md5
     */
	public function auditYes(){
		$getData=I('post.');

        $Attest=M('Authentication');
        $table = M('UserAttach');

        //md5验证
        $md5Str = $getData['authentication_id'] .$getData['nonce_str'] .$getData['status'];
        if (!\Common::verifyMd5($getData['sign'], $md5Str)) {
        $result = \StatusCode::code(-100);
        $this->ajaxReturn($result);
        }
        
        $map['authentication_id'] = $getData['authentication_id'];
        
        $getData['update_time'] = time();
        $getData['status'] = ATTEST_STATUS_ADOPT;
        
        $info1=$Attest->where($map)->save($getData);

        $list = $Attest->where($map)->select();

        $dataList[] = array('user_id'=>$list[0]['user_id'],'file_address'=>$list[0]['hand_status_url'],
        'attach_id'=>\Common::generateId(),'create_time'=>time(),'file_type'=>'1');
        $dataList[] = array('user_id'=>$list[0]['user_id'],'file_address'=>$list[0]['f_status_url'],
        'attach_id'=>\Common::generateId(),'create_time'=>time(),'file_type'=>'2');
        $dataList[] = array('user_id'=>$list[0]['user_id'],'file_address'=>$list[0]['r_status_url'],
        'attach_id'=>\Common::generateId(),'create_time'=>time(),'file_type'=>'3');
        //批量插入
        $i = $table->addAll($dataList);//添加数据
        if ($i < 1) {//添加失败
            $result = \StatusCode::code(4001);
            $this->ajaxReturn($result);
        }
        $result = \StatusCode::code(0);
        $result['msg'] = "添加成功";

        $this->ajaxReturn($result);


	}

   
	/**
     * 审核不通过
     * 方式：POST
     * URL：/Admin/auditNo
     * 参数 有
     * @param authentication_id 认证ID
     * @param status     状态
     * @param nonce_str  随机数
     * @param sign       签名md5
     */
	public function auditNo(){
        $getData=I('post.');

        $Attest=M('authentication');

        //md5验证
        $md5Str = $getData['authentication_id'] .$getData['nonce_str'] .$getData['status'];
        if (!\Common::verifyMd5($getData['sign'], $md5Str)) {
        $result = \StatusCode::code(-100);
        $this->ajaxReturn($result);
        }

        $map['authentication_id'] = $getData['authentication_id'];

        $getData['status'] = ATTEST_STATUS_NOTADOPT;
        
        $getData['update_time'] = time();
        
        $data=$Attest->where($map)->save($getData);

        if($data < 1) {
             $result = \StatusCode::code(4001);
             $result['msg'] = "内容更新失败";

        }else{
                $result = \StatusCode::code(0);
                $result['msg'] = "内容更新成功";
             }
        $this->ajaxReturn($result);

    }

     private function setStatus($data) {

        foreach ($data as $k => $v) {           
            // 判断证件类型
            if ($v['status'] == ATTEST_STATUS_ADOPT) {
                $data[$k]['status_name'] = '认证成功';
            } else if ($v['status'] == ATTEST_STATUS_AUTID) {
                $data[$k]['status_name'] = '待审核';
            } else if ($v['status'] == ATTEST_STATUS_NOTADOPT) {
                $data[$k]['status_name'] = '认证失败';
            } 
              
        }
              return $data;
    }

    
}
