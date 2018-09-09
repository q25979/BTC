<!DOCTYPE html>
<html>
    <body>
        <div class="x-body">
            <blockquote class="layui-elem-quote">欢迎使用 后台管理系统</blockquote>
            <fieldset class="layui-elem-field">
              <legend>信息统计</legend>
              <div class="layui-field-box">
                <table class="layui-table">
                <thead>
                    <tr>
                        <th colspan="2" scope="col">服务器信息</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th width="30%">服务器计算机名</th>
                        <td><span id="lbServerName"><?php echo php_uname('n') ?></span></td>
                    </tr>
                    <tr>
                        <td>服务器IP地址</td>
                        <td><?php echo GetHostByName($_SERVER['SERVER_NAME']) ?></td>
                    </tr>
                    <tr>
                        <td>服务器域名</td>
                        <td><?php echo $_SERVER["HTTP_HOST"] ?></td>
                    </tr>
                    <tr>
                        <td>服务器Web端口 </td>
                        <td><?php echo $_SERVER['SERVER_PORT'] ?></td>
                    </tr>
                    <tr>
                        <td>服务器PHP版本 </td>
                        <td><?php echo PHP_VERSION ?></td>
                    </tr>
                    <tr>
                        <td>服务器运行php环境</td>
                        <td><?php echo php_sapi_name() ?></td>
                    </tr>
                    <tr>
                        <td>本文件所在文件夹 </td>
                        <td><?php echo __FILE__ ?></td>
                    </tr>
                    <tr>
                        <td>服务器操作系统 </td>
                        <td><?php echo php_uname('v')?></td>
                    </tr>
                    <tr>
                        <td>服务器系统目录 </td>
                        <td><?php echo  $_SERVER['SystemRoot'] ?></td>
                    </tr>
                    <tr>
                        <td>服务器脚本超时时间 </td>
                        <td>30000秒</td>
                    </tr>
                    <tr>
                        <td>服务器的语言种类 </td>
                        <td><?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?></td>
                    </tr>
                    <tr>
                        <td>服务器当前时间 </td>
                        <td><?php echo @date('Y-m-d H:i:s') ?></td>
                    </tr>
                    <tr>
                        <td>服务器上次启动到现在已运行 </td>
                        <td>
                            <?php
                                $time = explode(",", exec('uptime'));
                                echo $time[0];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Zend版本 </td>
                        <td><?php echo Zend_Version() ?></td>
                    </tr>
                    <tr>
                        <td>服务器解译引擎</td>
                        <td><?php echo $_SERVER['SERVER_SOFTWARE'] ?></td>
                    </tr>
                </tbody>
            </table>
              </div>
            </fieldset>
        </div>
    </body>
</html>