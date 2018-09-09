加密方式(后台加密已封装到Common->Common.class.php)

### md5签名说明
`__VERIFY_STR__ 表示自定义固定的串`

`nonce_str 表示自己随机生成的随机串`

`如需加密的接口请按以下方式进行签名`


- 接口签名说明 md5签名示例 <br />
	
	`如需要的加密参数：有id，nonce_str，end_time` <br />
	
	`第一步：stringA = end_time + id + nonce_str;` <br />
	
	`第二步：stringB = __VERIFY_STR__ + stringA;` <br />
	
	`第三步：MD5(stringB) = ea6ae3a18bb74aa33a782612c13329a2` <br />


<div style="color: red; font-size: 14px;">

==================================================================
    <p>注：</p>
    <p>1.stringA的字符串顺序按照acsll码表的顺序 </p>
    <p>2."\_\_VERIFY_STR\_\_"是项目自定义的32位随机字符串</p>
    <p>3."nonce_str"是16位或32位的随机数</p>
==================================================================

</div>

