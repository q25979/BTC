<?php
return array(
    'SESSION_OPTIONS'       =>  array(
        'name'      => 'admin_account',
        'expire'    => 3600,
        'prefix'    => 'btc',
    ),

    // 开启路由
    'URL_ROUTER_ON'   => true,

    'URL_ROUTE_RULES'=>array(
        // 系统配置
        'getLogo' => array('System/Logo', array('method' => 'get')),                  // 获得logo管理数据
        'updataLogo' => array('System/updataLogo', array('method' => 'post')),        // 修改logo管理数据
        'getEmail' => array('System/Email', array('method' => 'get')),                // 获取邮箱信息
        'setEmail' => array('System/setEmail', array('method' => 'post')),            // 修改邮箱信息
        'getCurrency' => array('System/Coin', array('method' => 'get')),              // 获取货币浮动信息
        'setCurrency' => array('System/setCoin', array('method' => 'post')),          // 修改货币浮动信息
        'getCommonProblem' => array('System/Problem', array('method' => 'get')),      // 获得常见问题列表
        'addProblem' => array('System/addProblem', array('method' => 'post')),        // 添加常见问题
        'updataProblem' => array('System/updataProblem', array('method' => 'post')),  // 修改常见问题
        'deleteProblem' => array('System/deleteProblem', array('method' => 'post')),  // 删除常见问题
        'getContact' => array('System/ContactList', array('method' => 'get')),        // 联系我们
        'lookContact' => array('System/Contact', array('method' => 'post')),          // 查看联系我们问题详细
        'getNotice' => array('System/Notice', array('method' => 'get')),              // 获取公告管理
        'updataNotice' => array('System/updataNotice', array('method' => 'post')),    // 发布公告
        'deleteNotice' => array('System/deleteNotice', array('method' => 'post')),    // 删除公告
        'addNotice' => array('System/addNotice', array('method' => 'post')),          // 添加公告

        // 用户管理
        'getUserInfo' => array('User/getUserInfo', array('method' => 'get')),         // 获得用户信息
        'UserInfo' => array('User/UserInfo', array('method' => 'post')),         // 获得用户信息
        'saveUser' => array('User/saveUser', array('method' => 'post')),         // 用户信息修改
        'getUser' => array('User/getUser', array('method' => 'post')),                // 搜索用户（模糊）
        'lockUser' => array('User/lockUser', array('method' => 'post')),              // 锁定用户
        'recoverUser' => array('User/recoverUser', array('method' => 'post')),        // 恢复用户
        'disableUser' => array('User/disableUser', array('method' => 'post')),        // 停用用户
        'getSendListUser' => array('User/getSendList', array('method' => 'get')),           // 获得所有发送信息
        'SendInformation' => array('User/SendInformation', array('method' => 'post')),  //添加发送信息
        'userSendSearch' => array('User/userSendSearch', array('method' => 'get')),  //添加发送信息

        // 账户管理
        'getAccountList' => array('Account/getAccountList', array('method' => 'get')),  // 获取账户列表
        'AccountInfo' => array('Account/AccountInfo', array('method' => 'post')),  // 获取个人账户信息
        'saveAccount' => array('Account/saveAccount', array('method' => 'post')),  // 修改个人账户信息
        'getAccount' => array('Account/getAccount', array('method' => 'post')),         // 按照用户名搜索账户
        'recoverAccount' => array('Account/recoverAccount', array('method' => 'post')), // 恢复账户
        'disableAccount' => array('Account/disableAccount', array('method' => 'post')), // 冻结账户

        // 认证管理
        'getAttestList' => array('Attest/getAttestList', array('method' => 'get')),    // 获取认证列表
        'getAttest' => array('Attest/getAttest', array('method' => 'get')),           // 按照审核状态查询
        'getExamine' => array('Attest/getExamine', array('method' => 'get')),           // 审核表状态搜索
        'getAttestInfo' => array('Attest/getAttestInfo', array('method' => 'post')),   // 查看认证信息
        'auditYes' => array('Attest/auditYes', array('method' => 'post')),             // 审核通过
        'auditNo' => array('Attest/auditNo', array('method' => 'post')),               // 审核不通过
        'examineList' => array('Attest/examineList', array('method' => 'get')),        // 认证审核

        // 订单管理
        'getOrderListAll' => array('Order/getOrderListAll', array('method' => 'get')),         // 获取所有订单信息
        'getOrderList' => array('Order/getOrderList', array('method' => 'get')),               // 获取待提交订单
        'getOrderListAudit' => array('Order/getOrderListAudit', array('method' => 'get')),     // 订单审核信息
        'orderAuditInfo' => array('Order/orderAuditInfo', array('method' => 'post')),          // 订单审核
        'orderLose' => array('Order/orderLose', array('method' => 'post')),                    // 发送失败
        'orderSuccess' => array('Order/orderSuccess', array('method' => 'post')),              // 发送成功

        // 发送管理
        'getSendListAll' => array('Send/getSendListAll', array('method' => 'get')),         // 获取所有发送信息
        'getSendList' => array('Send/getSendList', array('method' => 'get')),               // 获取待提交发送信息
        'getSendAuditList' => array('Send/getSendAuditList', array('method' => 'get')),     // 获取审核信息
        'sendAuditInfo' => array('Send/sendAuditInfo', array('method' => 'post')),          // 发送审核
        'sendLose' => array('Send/sendLose', array('method' => 'post')),                    // 发送失败
        'sendSuccess' => array('Send/sendSuccess', array('method' => 'post')),              // 发送成功

        // 客服管理
        'serviceInfo' => array('Service/serviceInfo', array('method' => 'get')),            // 客服信息
        'setService' => array('Service/setService', array('method' => 'post')),             // 客服修改
    ), 
);