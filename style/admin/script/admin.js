$(function(){
	//登录表单居中
	var width = $(window).width();
	var height = $(window).height();
	$(".loginContent").css("height",height+"px");
	$(".loginArea").css({"top":(height-350)/2+"px","left":(width-470)/2+"px"});

	//头部菜单
	$(".nav li").click(function(){
		var index = $(".nav li").index(this);
		$(".nav li").removeClass("current");
		$(this).addClass("current");
		self.parent.contentFrame.location="/admin/"+$(this).attr("com");
		self.parent.sidebarFrame.changeSubMenu(index,$(this).attr("com"));
	});

	//左侧菜单当前状态
	$(".subNode a").click(function(){
		$(".subNode").removeClass("current");
		$(this).parent().addClass("current");
	});

	//默认左侧
	changeSubMenu(0,$(".nav li:eq(0)").attr("com"));

	//登出
	$(".logout").click(function(){
		if (window.confirm("您确定要退出吗？")){
			parent.location.replace('/admin/manage/logout.html');
		}
	});

	//双色Tab
	$(".listTab tr:even").addClass('evenList');

	//停留高亮
	$(".listTab tr").hover(function(){
		$(this).addClass("heightLight");
	},function(){
		$(this).removeClass("heightLight");
	})

	//全选
	$(".checkAll").click(function(){
		if($(this).attr("checked")=="checked"){
			$(":checkbox").attr("checked","checked");
		}else{
			$(":checkbox").removeAttr("checked");
		}
	});

	//全选分配部分全选
	$(".authority dt :checkbox").click(function(){
		if($(this).attr("checked")=="checked"){
			$(this).parents(".authority").find(":checkbox").attr("checked","checked");
		}else{
			$(this).parents(".authority").find(":checkbox").removeAttr("checked");
		}
	});

	$(".authority dd div :checkbox").click(function(){
		if($(this).attr("checked")=="checked"){
			$(this).parent().next().find(":checkbox").attr("checked","checked");
		}else{
			$(this).parent().next().find(":checkbox").removeAttr("checked");
		}
	});
})

//左侧菜单
function changeSubMenu(n,com){
	$(".sidebarMenu .menuGroup").hide();
	$(".sidebarMenu .menuGroup").eq(n).show();
	$(".sidebarMenu .menuGroup a[com='"+com+"']").trigger("click");
}

//修改表单提交
function formSubmit(action,note){
	if(note){
		if(confirm(note)){
			$("#listForm").attr('action',action);
			$("#listForm").submit();
		}
	}else{
		$("#listForm").attr('action',action);
		$("#listForm").submit();
	}
}