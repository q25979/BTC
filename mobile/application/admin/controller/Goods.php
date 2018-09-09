<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Goods extends Base
{

	/**
	 * 产品列表
	 * @author lukui  2017-02-15
	 * @return [type] [description]
	 */
	public function prolist()
	{
		if($this->otype != 3){
			echo '死你全家!';exit;
		}
		$proinfo = Db::name('productinfo')->alias('pi')->field('pi.*,pc.pcname')
                    ->join('__PRODUCTCLASS__ pc','pc.pcid = pi.cid')
                    ->where('pi.isdelete',0)->order('pi.proorder asc')->select();

        $this->assign('proinfo',$proinfo);
		return $this->fetch();
	}

	/**
	 * 添加产品
	 * @author lukui  2017-02-15
	 * @return [type] [description]
	 */
	public function proadd()
	{
		//echo '死你全家!';exit;
		
		if($this->otype != 3){
			echo '死你全家!';exit;
		}
		if(input('post.')){
			$data = input('post.');

            //修改开市时间
            $opentime_arr = $data['opentime'];
            $opentime_str = '';
            foreach ($opentime_arr as $k => $v) {
                $opentime_str .= trim($v).'-';
            }
            $opentime['opentime'] = $opentime_str;
            $_otime = db('opentime')->where('pid',$data['pid'])->find();
            if($_otime){
                db('opentime')->where('pid',$data['pid'])->update($opentime);
            }else{
                $opentime['pid'] = $data['pid'];
                db('opentime')->insert($opentime);
            }

            unset($data['opentime']);

            
			if(!$data['ptitle'] || !$data['cid'] ){
				return WPreturn('参数错误',-1);
			}
			$data['time'] = time();
			$data['isdelete'] = 0;

			if(isset($data['pid']) && !empty($data['pid']) && $data['pid'] != 0){ //编辑
				$editid = Db::name('productinfo')->update($data);
                if($editid){

                    
                    return WPreturn('修改成功',1);
                }else{
                    return WPreturn('修改失败',-1);
                }
			}else{  //新添加
				$addid = Db::name('productinfo')->insertGetId($data);
                if($addid){
                    $p_data['pid'] = $addid;
                    Db::name('productdata')->insert($p_data);
                    return WPreturn('添加成功',1);
                }else{
                    return WPreturn('添加失败',-1);
                }
			}

		}else{
			if(input('param.pid')){  //编辑产品

                $pid = input('param.pid');
                $productinfo = Db::name('productinfo')->where('pid',$pid)->find();
                $this->assign($productinfo);

                $opentime = db('opentime')->where('pid',$pid)->find();
                if($opentime){
                    $otime_arr = explode('-',$opentime["opentime"]);
                }else{
                    $otime_arr = array('','','','','','','');
                }
                
                $this->assign('opentime',$otime_arr);
            }
			//分类
			$proclass = Db::name('productclass')->where('isdelete',0)->order('pcid desc')->select();

            $this->assign('proclass',$proclass);
			return $this->fetch();
		}
		
	}

	/**
	 * 产品开、休市
	 * @author lukui  2017-02-15
	 * @return [type] [description]
	 */
	public function proisopen()
	{
		if($this->otype != 3){
			echo '死你全家!';exit;
		}
		if (input('post.')) {
			$data = input('post.');
			$editid = Db::name('productinfo')->update($data);
            if($editid){
                return WPreturn('修改成功',1);
            }else{
                return WPreturn('修改失败',-1);
            }
		}else{
			return WPreturn('参数错误',-1);
		}
	}

	/**
	 * 删除产品
	 * @author lukui  2017-02-15
	 * @return [type] [description]
	 */
	public function delpro()
	{
		if($this->otype != 3){
			echo '死你全家!';exit;
		}
		$id = input('get.id',0);
    	if(!$id){
    		return WPreturn('参数错误',-1);
    	}

    	$delpro = Db::name('productinfo')->where('pid', $id)->update(['isdelete' => 1]);
    	if($delpro){
            $p_data['isdelete'] = 1;
            Db::name('productdata')->where('pid', $id)->update($p_data);
    		return WPreturn('删除成功',1);
    	}else{
    		return WPreturn('删除失败',-1);
    	}
	}

    /**
     * 还原产品
     * @author lukui  2017-02-15
     * @return [type] [description]
     */
    public function hypro()
    {
		if($this->otype != 3){
			echo '死你全家!';exit;
		}
        $id = input('get.id',0);
        if(!$id){
            return WPreturn('参数错误',-1);
        }

        $delpro = Db::name('productinfo')->where('pid', $id)->update(['isdelete' => 0]);
        if($delpro){
            $p_data['isdelete'] = 0;
            Db::name('productdata')->where('pid', $id)->update($p_data);
            return WPreturn('还原成功',1);
        }else{
            return WPreturn('还原失败',-1);
        }
    }




	/**
	 * 产品分类
	 * @author lukui  2017-02-15
	 * @return [type] [description]
	 */
	public function proclass()
	{
		if($this->otype != 3){
			echo '死你全家!';exit;
		}
		$productclass = Db::name('productclass')->where('isdelete',0)->order('pcid desc')->select();
    	$this->assign('productclass',$productclass);
		return $this->fetch();
	}

	/**
	 * 编辑、添加产品分类
	 * @author lukui  2017-02-15
	 * @return [type] [description]
	 */
	public function editclass()
	{
		
		echo '死你全家!';exit;
		if($this->otype != 3){
			echo '死你全家!';exit;
		}
		$data['pcid'] = input('post.pcid',0);
        $data['pcname'] = input('post.pcname',0);
        $data['isdelete'] = 0;
        if(!$data['pcname']){
            return WPreturn('参数错误',-1);
        }

        if($data['pcid']){ //有id 编辑信息
            $editnews = Db::name('productclass')->where('pcid', $data['pcid'])->update(array('pcname' => $data['pcname']));
            if($editnews){
                return WPreturn('修改成功',1);
            }else{
                return WPreturn('修改失败',-1);
            }
        }else{ //没di 增加一条
            $addid = Db::name('productclass')->insert($data);
            if($addid){
                return WPreturn('添加成功',1);
            }else{
                return WPreturn('添加失败',-1);
            }
        }
	}

	/**
     * 删除分类
     * @author lukui  2017-02-15
     * @return [type] [description]
     */
    public function deleteclass()
    {
		
		if($this->otype != 3){
			echo '死你全家!';exit;
		}
    	$id = input('get.id',0);
    	if(!$id){
    		return WPreturn('参数错误',-1);
    	}

    	$delpro = Db::name('productclass')->where('pcid', $id)->update(['isdelete' => 1]);
    	if($delpro){
    		return WPreturn('删除成功',1);
    	}else{
    		return WPreturn('删除失败',-1);
    	}
    	
    }

    /**
     * 风控管理
     * @author lukui  2017-02-15
     * @return [type] [description]
     */
    public function risk()
    {
    	if($this->otype != 3){
			echo '死你全家!';exit;
		}
		
    	$risk = Db::name('risk')->find();
    	$this->assign($risk);
    	return $this->fetch();
    }

    /**
     * 代理管理的风控管理
     *
     * url: /admin/goods/riskagency
     */
    public function riskagency()
    {
        $userlist = Db::name('userinfo')
            ->field('uid')
            ->where('oid', $this->uid)
            ->select();

        $riskdata = Db::name('risk')->find();

        $riskwinarr  = explode('|', $riskdata['to_win']);   // 盈利
        $risklossarr = explode('|', $riskdata['to_loss']);  // 亏损

        // 风控初始化
        $risk = $riskdata;
        $risk['to_win']  = '';
        $risk['to_loss'] = '';
        foreach ($userlist as $k => $v) {
            // 盈利
            for ($i=0; $i<count($riskwinarr); $i++) {
                // 如果存在就添加进去
                if ($v['uid'] == $riskwinarr[$i]) {
                    $risk['to_win'] .= empty($risk['to_win']) ? '' : '|';
                    $risk['to_win'] .= $riskwinarr[$i];
                }
            }

            // 亏损
            for ($i=0; $i<count($risklossarr); $i++) {
                // 如果存在就添加进去
                if ($v['uid'] == $risklossarr[$i]) {
                    $risk['to_loss'] .= empty($risk['to_loss']) ? '' : '|';
                    $risk['to_loss'] .= $risklossarr[$i];
                }
            }
        }
        
        $this->assign($risk);
        return $this->fetch();
    }

    /**
     * 代理风控添加
     *
     * url:/admin/goods/addriskagency
     */
    public function addriskagency()
    {
        // 输入的数据
        $post = input('post.');

        if (!$post) $this->error('禁止访问');

        // 过滤掉不是自己的客户
        // 代理客户的数据
        $userdata = Db::name('userinfo')
            ->field('uid')
            ->where('oid', $this->uid)
            ->select();

        // 把数组对象下标uid转为0,1,2...
        $index = 0;
        foreach ($userdata as $key => $value) {
            $userdata[$index++] = $value['uid'];
        }

        // 总的数据，包含亏/赢
        $riskdata = Db::name('risk')->find();
        $riskdataloss = explode('|', $riskdata['to_loss']);
        $riskdatawin  = explode('|', $riskdata['to_win']);

        // 输入的数据
        $postloss = explode('|', $post['to_loss']);
        $postwin  = explode('|', $post['to_win']);

        // 过滤掉不是自己的客户
        // 亏
        $dloss = array_unique(array_intersect($postloss, $userdata));
        // 赢
        $dwin  = array_unique(array_intersect($postwin, $userdata));

        $riskdata['to_loss'] = implode('|', $dloss);
        $riskdata['to_win']  = implode('|', $dwin);

        if (empty($post['id'])) {
            unset($post['id']);
            $ids = db('risk')->insert($riskdata);

        } else {
            $ids = db('risk')->update($riskdata);
        }

        if($ids){
            return WPreturn('操作成功',1);

        } else{
            return WPreturn('操作失败，或修改的不是自己的客户',-1);
        }
    }


    public function addrisk()
    {
        if($this->otype != 3){
			echo '死你全家!';exit;
		}
		
        $post = input('post.');
        
        
        if (!$post) {
            $this->error('禁止访问');
        }

        if(empty($post['id'])){
            unset($post['id']);
            $ids = db('risk')->insert($post);
        }else{
            $ids = db('risk')->update($post);
        }

        if($ids){
            return WPreturn('操作成功',1);
        }else{
            return WPreturn('操作失败',-1);
        }

    }


    /**
     * 排序
     * @author lukui  2017-08-27
     * @return [type] [description]
     */
    public function proorder()
    {
        if($this->otype != 3){
			echo '死你全家!';exit;
		}
		
        $post = input('post.');
        if(!isset($post["proorder"])){
            $this->error('参数错误！');
        }
        $proorder = $post["proorder"];
        $productinfo = db('productinfo');
        foreach ($proorder as $k => $v) {
            $_dara['pid'] = $k;
            $_dara['proorder'] = (int)trim($v);
            $productinfo->update($_dara);
            
        }

        $this->success('操作成功！');
        
    }

    public function huishou()
    {
        if($this->otype != 3){
			echo '死你全家!';exit;
		}
		

        $proinfo = Db::name('productinfo')->alias('pi')->field('pi.*,pc.pcname')
                    ->join('__PRODUCTCLASS__ pc','pc.pcid = pi.cid')
                    ->where('pi.isdelete',1)->order('pi.pid asc')->select();

        $this->assign('proinfo',$proinfo);
        return $this->fetch();
    }





}
