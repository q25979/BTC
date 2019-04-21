<?php
namespace Admin\Controller;

/**
 * 作者：亮
 * 时间：2018年4月16日20:43:42
 * 功能：用户管理
 */
class UserController extends VerifyController {

    public function UserList() {
        $this->display();
    }
    public function SendList() {
        $this->display();
    }
    /**
     * 获得用户信息
     * 方式：GET
     * URL：/Admin/getUserInfo
     * 参数：有
     * @param page  分页
     * @param limit 条数
     */
    public function getUserInfo(){
        $getData=I('get.');
        $User=M('user');
        $map['is_deleted'] = IS_NOT_DELETED;
        $info = $User->where($map)->page($getData['page'],$getData['limit'])->order('create_time desc')->select();
        $result = \StatusCode::code(0);
        $result['count'] = $User->count();
        $info = $this->setStatus($info);
        $result['data'] = $info;
        $this->ajaxReturn($result);
    }

    /**
     * 获得单个用户个人信息
     * 方式：POST
     * URL：/Admin/UserInfo
     * 参数：有
     * @param user_id
     */
    public function UserInfo(){
        $getData=I('post.');
        $User=M('User');
        $map['user_id'] = $getData['user_id'];
        $info = $User->where($map)->field('user_name,password,email,tel,certificate_type,certificate_num')->select();
        $result = \StatusCode::code(0);
        $result['data'] = $info;
        $this->ajaxReturn($result);

    }

     /**
    * 用户信息修改
    * 方式：POST
    * URL：/Admin/saveUser
    * 参数：有
    * @param user_id  用户ID
    */
    public function saveUser(){
        $User=M('User');

        $getData=I('post.');
        $map['user_id'] = $getData['user_id'];
        $data =$User->where($map)->save($getData);

        if($data < 1){
            $result = \StatusCode::code(1004);
            $result['msg'] = '修改失败';
            $this->ajaxReturn($result);
        }
        
        $result = \StatusCode::code(0);
        $result['msg'] = '修改成功';

        $this->ajaxReturn($result);
    }

    /**
    * 搜索用户（模糊）
    * 方式：POST
    * URL：/Admin/getUser
    * 参数：有
    * @param user_name  用户名
    * @param page       分页
    * @param limit      条数
    */
    public function getUser(){
        $User=M('user');

        $getData=I('get.');

        $map['is_deleted'] = IS_NOT_DELETED;

        $map['user_name']=array('like', '%'. $getData['user_name'] .'%');

        $info = $User->where($map)->page($getData['page'],$getData['limit'])->select();

        $info = $this->setStatus($info);

        $result = \StatusCode::code(0);

        $result['count'] = $User->where($map)->count();

        $result['data'] = $info;
      
        return $result;
    }

     /**
     * 恢复用户（只有停用和锁定的用户才能恢复）
     * 方式：POST
     * URL：/Admin/recoverUser
     * 参数 有
     * @param user_id 需要恢复的用户ID
     * @param status     状态
     * @param nonce_str  随机数
     * @param sign       签名md5
     */
     public function recoverUser(){
        $User=M('user');

        $getData=I('post.');

        //md5验证
        $md5Str = $getData['nonce_str'] . $getData['status'] . $getData['user_id'];
        if (!\Common::verifyMd5($getData['sign'], $md5Str)) {
            $result = \StatusCode::code(-100);
            $this->ajaxReturn($result);
        }

        if($getData['status']== USER_STATUS_LOCK){
            $row['user_id']=$getData['user_id'];
            $map['update_time'] = time();
            $map['status']=USER_STATUS_ENABLE;
            $data = $User->where($row)->save($map);
            $result = \StatusCode::code(0);
        } else {
            $result = \StatusCode::code(0);
            $result['msg'] = "当前状态正常";
        } 
        $this->setStatus($data);

        $result['data'] = $data;

        $this->ajaxReturn($result);
    }
     /**
     * 停用用户
     * 方式：POST
     * URL：/Admin/disableUser
     * 参数 有
     * @param user_id 封停的用户ID
     * @param status     状态
     * @param nonce_str  随机数
     * @param sign       签名md5
     */
     public function disableUser(){
            $User=M('User');

            $getData=I('post.');

            //md5验证
            $md5Str = $getData['nonce_str'] . $getData['status'] . $getData['user_id'];
            if (!\Common::verifyMd5($getData['sign'], $md5Str)) {
                $result = \StatusCode::code(-100);
                $this->ajaxReturn($result);
            }

            $map['user_id'] = $getData['user_id'];

            $getData['status'] = USER_STATUS_LOCK; //-1为锁定状态;

            $getData['update_time'] = time();//更新时间

            $data = $User->where($map)->save($getData);

            if($data < 1) {
            $result = \StatusCode::code(4001);
            $result['msg'] = "内容更新失败";

            }else{
                $result = \StatusCode::code(0);
                $result['msg'] = "内容更新成功";
            }
          
            $this->ajaxReturn($result);
        }
     
    /**
     * 获得所有发送信息
     * 方式：GET
     * URL：/Admin/getSendListUser
     * 参数：有
     * @param page  分页
     * @param limit 条数
     */
    public function getSendList(){
        $getData=I('$get.');

        $Information=M('Information as a');

         $join = (
            array("left join btc_i18n as b on b.i18n_id = a.title_i18n_id and b.is_deleted = '0'
                   left join btc_i18n as c on c.i18n_id = a.content_i18n_id and c.is_deleted = '0'
                   left join btc_user as u on u.maincoin_id = a.maincoin_id and u.is_deleted = '0'")
        );

        $map['a.is_deleted'] = IS_NOT_DELETED;

        $data=$Information->join($join)->where($map)->order('create_time desc')->field('a.*,b.en_content as en_content2,b.tw_content as tw_content2,c.en_content,c.tw_content,u.user_name')->select();

        $data=$this->setStatus($data);

        $result = \StatusCode::code(0);
        $result['count']=$Information->where($map)->count();
        $result['data'] = $data;

        $this->ajaxReturn($result);
    }

    /**
     * 删除
     *
     * 方式：post
     * url： /Admin/deleted
     * @param  information_id
     */
    public function deleted() {
        $data = I('post.');
        $Information = M('Information');

        $info = $Information->where($data)->delete();

        $info > 0
            ? $this->ajaxReturn(\StatusCode::code(0))
            : $this->ajaxReturn(\StatusCode::code(-1));        
    }

    /**
    * 搜索私信信息（模糊）
    * 方式：get
    * URL：/Admin/userSendSearch
    * 参数：有
    * @param user_name  用户名
    * @param page       分页
    * @param limit      条数
    */
    public function userSendSearch(){
        $getData=I('get.');

        $Information=M('Information as a');

        $join = (
            array("left join btc_i18n as b on b.i18n_id = a.title_i18n_id and b.is_deleted = '0'
                   left join btc_i18n as c on c.i18n_id = a.content_i18n_id and c.is_deleted = '0'
                   left join btc_user as u on u.maincoin_id = a.maincoin_id and u.is_deleted = '0'")
        );

        $map['u.user_name']=array('like', '%'. $getData['user_name'] .'%');
        $map['a.is_deleted'] = IS_NOT_DELETED;

        $data=$Information->where($map)->join($join)->field('a.*,b.en_content as en_content2,b.tw_content as tw_content2,c.en_content,c.tw_content,u.user_name')->select();

        $data=$this->setStatus($data);

        $result = \StatusCode::code(0);

        $result['count']=$Information->where($map)->join($join)->count();
        $result['data'] = $data;

        $this->ajaxReturn($result);
    }

    /**
     * 修改密码
     * @date    2019年4月11日
     * @author  671
     */
    public function updatepass() {
        $data = I('post.');
        $user = M('User');
        $map['user_id'] = $data['user_id'];
        $update['password'] = md5(VERIFY_STR . $data['password']);
        $info = $user->where($map)->save($update);
        $result = $info > 0
            ? ['msg' => '更新成功', 'code' => 0]
            : ['msg' => '更新失败', 'code' => -1];
        $this->ajaxReturn($result);
    }

    /**
     * 添加发送信息
     * 方式：POST
     * URL：/Admin/SendInformation
     * 参数：有
     * @param maincoin_id   发送对象的ID
     * @param left_title    繁体标题
     * @param right_title   英文标题
     * @param left_content  繁体内容
     * @param right_content 英文内容
     */
    public function SendInformation(){
        $getData = I('post.');

        $Information =M('Information');
        $i18n =M('I18n');

        $i18n->startTrans();    // 启动事物
   
        $getData['information_id'] = \Common::generateId();//随机生成32位ID
        $getData['create_time'] =time();

        
        //准备插入国际化表的数据
        $title_i18n_id = \Common::generateId();//随机生成32位ID
        $content_i18n_id = \Common::generateId();//随机生成32位ID

        $i18nList[] = array('i18n_id'=>$content_i18n_id,'en_content'=>$getData['right_content'],
        'tw_content'=>$getData['left_content'],'create_time'=>time());
        $i18nList[] = array('i18n_id'=>$title_i18n_id,'en_content'=>$getData['right_title'],
        'tw_content'=>$getData['left_title'],'create_time'=>time());

        //批量插入国际化表
        $i = $i18n->addAll($i18nList);

        if (!$i) {
            $i18n->rollback();  // 事物回滚
            $i18n->commit();    // 事物提交
            $result = \StatusCode::code(4001);
            $this->ajaxReturn($result);
        }

        //发送信息增加
        $getData['information_id'] = \Common::generateId();//随机生成32位ID
        $getData['title_i18n_id']=$title_i18n_id;
        $getData['content_i18n_id']=$content_i18n_id;
        $getData['create_time'] =time();
        $Information->create();

        $data = $Information->add($getData);

       if(!$data){
            $i18n->rollback();  // 事物回滚
            $i18n->commit();    // 事物提交
            $result = \StatusCode::code(4001);
            $this->ajaxReturn($result);
        }
        $i18n->commit();    // 事物提交
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
            $data[$k]['birthdate']   = date('Y-m-d', $v['birthdate']);

            // 判断证件类型
            if ($v['certificate_type'] == CERTIFICATE_RPT) {
                $data[$k]['certificate_name'] = '身份证';
            } else if ($v['certificate_type'] == CERTIFICATE_RPC) {
                $data[$k]['certificate_name'] = '护照';
            } else if ($v['certificate_type'] == CERTIFICATE_PASSPORT) {
                $data[$k]['certificate_name'] = '其他';
            }

            if ($v['status'] == -1) {
                $data[$k]['status_name'] = '已封号';
            } else{
                $data[$k]['status_name'] = '正常使用';
            }
        }

        return $data;
    }

}

