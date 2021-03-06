<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>分类列表</title>
<link href="/MyJDShop/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
<script src="/MyJDShop/Public/Admin/js/jquery.js"></script>
<style>
.tr_color{
	background-color: #9F88FF
}
.button{
	width:100px;
	height:20px;
	background:#E8F2FC;
	font-size:10px;
}
.bg{
	background:#EAF1D7;
}
</style>
<script>
$(function(){
	$(':button').prop('disabled',$("[name='id[]']:checked").size()==0);//按钮初始化为不可用
	//控制全选和取消全选
	$('#control').click(function(){
		//先获取control的checkbox的属性true / false,让checked[]的属性和control相同
		$("[name='id[]']").prop('checked',$(this).prop('checked'));
		$(':button').prop('disabled',$("[name='id[]']:checked").size()==0);
	})
	//单击列表的复选框
	$("[name='id[]']").click(function(){
		var chenkedNUm = $("[name='id[]']:checked").size();//获取被选中的数量
		var b = $("[name='id[]']").size();
		$('#control').prop("checked",chenkedNUm==b);
		$(':button').prop('disabled',$("[name='id[]']:checked").size()==0);
	})
	//控制背景颜色
	$("tr:not(:first):not(:last)").hover(function(){
		$(this).addClass("bg");
	},function(){
		$(this).removeClass('bg');
	});
	//提交事件
	$("[type='button']:eq(0)").click(function(){
		$('form').attr('action','huishouBrand').submit();
	})
	$("[type='button']:eq(2)").click(function(){
		$('form').attr('action','deleteBrand').submit();	
	})
	$("[type='button']:eq(1)").click(function(){
		$('form').attr('action','showBrand').submit();	
	})
})
</script>
</head>
<body>
<div class="div_head">
    <span>
        <span style="float: left;">当前位置是：品牌中心-》品牌管理</span>
        <span style="float: right; margin-right: 8px; font-weight: bold;">
            <a style="text-decoration: none;" href="/MyJDShop/index.php/Admin/Brand/addBrand">【添加品牌】</a>
        </span>
    </span>
</div>
	<div class="div_search">
	    <span>
	        <form action="" method="get">
	            分类<select name="search_type" style="width: 100px;">
	            	<option selected="selected" value=''>请选择</option>	            	
	                <?php echo ($option); ?>
	            </select>
	            <input type="text" name="search_name" style="width: 100px;"/>
	            <input value="查询" type="submit" />
	            <a style="text-decoration: none;" href="/MyJDShop/index.php/Admin/Brand/listBrand">【返回列表】</a>
	        </form>
	    </span>
	</div>
<form method="post">
	<div style="font-size: 13px; margin: 10px 5px;">
	    <table class="table_a" border="1" width="100%">
	        <tbody><tr style="font-weight: bold;">
	                <td><input type="checkbox" id="control"/></td>
	                <td>品牌名称</td>  
	                <td>所属分类</td>
	                <td>状态</td>  
	                <td>商标</td>        
	                <td align="center">操作</td>
	            </tr>
	            <?php if(is_array($brandArr)): foreach($brandArr as $key=>$v): ?><tr>
	            	<td><input type="checkbox" name="id[]" value="<?php echo ($v["brandid"]); ?>"/></td>
	                <td><?php echo ($v["brandname"]); ?></td>  
	                <td><?php echo ($v["typename"]); ?></td>
	                <?php if($v["isdel"]): ?><td><img src="/MyJDShop/Public/Admin/images/show.png"/></td>
	                <?php else: ?>
	                	<td><img src="/MyJDShop/Public/Admin/images/hidden.png"></td><?php endif; ?>  
	                 <td><img src="/MyJDShop/Public/upload/<?php echo ($v["imagename"]); ?>" width="25px"></td>     
	                <td align="center"><a href="/MyJDShop/index.php/Admin/Brand/updateBrand/brandid/<?php echo ($v["brandid"]); ?>">修改</a></td>
	            </tr><?php endforeach; endif; ?>
	            <tr>
	                <td colspan="6" style="text-align: left;">
	                	<input type="button" value="回收" class="button">&nbsp;
						<input type="button" value="显示" class="button">&nbsp;
						<input type="button" value="彻底删除！" class="button" style="color: #f00">
	                </td>
	            </tr>
	        </tbody>
	    </table>
	</div>
</form>
</body>
</html>