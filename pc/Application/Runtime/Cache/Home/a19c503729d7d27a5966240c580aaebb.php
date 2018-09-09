<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo (L("_LOGIN_TERMS_FOR_USAGE_")); ?></title>
    <script type="text/javascript" src="http://blnance66.com/Public/plug-in/pdf/js/pdfobject.js"></script>

    <script>
    	window.onload = function() {
    		var myPDF = new PDFObject({
    			url: "<?php echo ($url); ?>" 
    		}).embed();
    	}
    </script>
</head>
<body>
	<p>没有Adobe Reader或PDF支持web浏览器。 
		<a href="<?php echo ($url); ?>">点击这里下载PDF</a>
	</p>
</body>
</html>