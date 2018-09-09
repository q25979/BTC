<?php
namespace Demo\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use Think\Controller;

class LangController extends Controller {
    // 添加常见问题
    public function index() {
        if (IS_AJAX) {
            $d = I('get.');

            $time = time();
            $dc['i18n_id'] = \Common::sGenerateId();
            $dc['create_time'] = $time;
            $dc['TW_content'] = $d['TW_content'];
            $dc['EN_content'] = $d['EN_content'];

            $i18n = M('I18n');
            $i18n->startTrans();    // 启动事物
            $result['content'] = $i18n->add($dc);

            $dt['i18n_id'] = \Common::sGenerateId();
            $dt['create_time'] = $time;
            $dt['TW_content'] = $d['TW_title'];
            $dt['EN_content'] = $d['EN_content'];

            $result['title'] = $i18n->add($dt);


            $dp['common_problem_id'] = \Common::generateId();
            $dp['title_i18n_id'] = $dt['i18n_id'];
            $dp['content_i18n_id'] = $dc['i18n_id'];

            $commonProblem = M('CommonProblem');
            $result['problem_id'] = $commonProblem->add($dp);

            if (!$result['problem_id'] || !$result['content'] || !$result['title']) {
                $i18n->rollback();  // 事物回滚
            }

            $i18n->commit();    // 事物提交

            $this->ajaxReturn($result);
        }

        $this->assign('type', $this->type());
        $this->display();
    }

    public function stringId() {
        var_dump(\Common::sGenerateId());
    }

    private function type() {
        $d = array(
            array( 'type' => 1 ),
            array( 'type' => 2 ),
            array( 'type' => 3 ),
            array( 'type' => 4 ),
            array( 'type' => 5 ),
            array( 'type' => 6 ),
        );

        return $this->typeChange($d);
    }

    private function typeChange($data) {
        foreach ($data as $k => $v) {
            if ($v['type'] == PROBLEM_TYPE_SEND_REC) {
                $data[$k]['type_name'] = '发送与接收';

            } else if ($v['type'] == PROBLEM_TYPE_BUY_SELL) {
                $data[$k]['type_name'] = '购买与接收';

            } else if ($v['type'] == PROBLEM_TYPE_IS_MERCHANT) {
                $data[$k]['type_name'] = '成为特约商家';

            } else if ($v['type'] == PROBLEM_TYPE_ABOUT) {
                $data[$k]['type_name'] = '关于';

            } else if ($v['type'] == PROBLEM_TYPE_SECURITY) {
                $data[$k]['type_name'] = '账户安全与实名审核';

            } else {
                $data[$k]['type_name'] = '反诈骗及处理流程';
            }
        }

        return $data;
    }
}
