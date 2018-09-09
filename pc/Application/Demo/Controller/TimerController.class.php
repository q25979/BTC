<?php
namespace Demo\Controller;
use Think\Controller;

// 定时器
class TimerController extends Controller {
    public function index(){
//        ignore_user_abort(true);
        set_time_limit(0);
        ob_end_clean();
        ob_start();
        while (1) {
            echo str_repeat(" ", 1024);//写满IE有默认的1k buffer
            ob_flush();//将缓存中的数据压入队列
            flush();
            // echo "now time is " . date('h:i:s') . "<br/>";//打印数据，其实是先将数据存入了缓存中
            $this->test();
            usleep(1000000 * 60); // 1m
        }
    }

    public function test() {
        /*$demo = M('Demo');

        $data['value'] = \Common::nonceStr(8);
        $demo->where('id=1')->save($data);*/
    }
    public function round() {
        $min = 0.04 * 100;
        $max = 0.06 * 100;

        echo rand($min, $max) / 100;
    }


    public function t() {
        //调用方法1
        $daemon=new DaemonCommand(true);
        $daemon->daemonize();
        $daemon->start(2);//开启2个子进程工作
        work();

        $daemon=new DaemonCommand(true);
        $daemon->daemonize();
        $daemon->addJobs(array('function'=>'work','argv'=>'','runtime'=>1000));//function 要运行的函数,argv运行函数的参数，runtime运行的次数
        $daemon->start(2);//开启2个子进程工作

        function work(){
            echo "测试1";
        }
    }
}


