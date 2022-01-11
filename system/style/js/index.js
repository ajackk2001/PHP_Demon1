/*
 * 提交简单参数
 */
function postCmd(obj,fun){
	if(obj.val()){
		var url='command.php?action='+obj.attr('action')+'&type='+obj.attr('post')+'&id='+obj.attr('id');
		var paramstr=obj.attr('params');
		if(!paramstr) paramstr='';
		eval('params={'+paramstr+'}');
		params[obj.attr('name')]=obj.val();
		if(fun){
			$.post(url,params,function (data){
				eval(fun+'("'+data+'")');
			});
		}else{
			$.post(url,params);
		}
	}
}
function delFun(tab,id,fun){
	if(confirm('您確定要刪除這個資料嗎?')){
		$.get('command.php?action=del&type='+tab+'&id='+id,function (data){
			eval('var json='+data);
			if(json.msg) alert('msg');
			if(fun){
				eval(fun+'("'+data+'")');
			}else{
				window.location.href=window.location.href;
			}
		});
	}
}
/////////////////////////////////////////首页菜单部分开始//////////////////////////
/*
 * 给首页菜单部分的所有LI加上占位图,由于JQuery是一次性读取所有的LI,因此只能使用递归调用的方式,否则二级LI无法生效
 */
function setImg(obj){
	obj.find('> ul > li').each(function (){
		setImg($(this));
	})
	obj.html('<img class="s" src="style/css/s.gif" />'+obj.html());
}
/*
 * 设置所有的LI点击事件以及相应的Class
 */
function setMenu() {
	$('#CNLTreeMenu1 ul').each(function (){
		$(this).hide();
	});
	setImg($('#CNLTreeMenu1'));
	$('#CNLTreeMenu1 li').each(function (){
		if($(this).attr('class')!='Child'){
			$(this).attr('class','Closed');
			$(this).find('img:first').click(openLi);
			$(this).find('a:first').click(openLi);
		}
	})
	$('#CNLTreeMenu1').find('ul:first').show();
}
/*
 * 打开或关闭某个LI
 */
var openLi=function (){
	if($(this).parent().attr('class')=='Closed'){
		$(this).parent().attr('class','Opened');
		$(this).parent().find('ul:first').show();
	}else{
		$(this).parent().attr('class','Closed');
		$(this).parent().find('ul:first').hide();
	}
}
/*
 * 设置当前页面所对应的LI,并打开所有父级LI
 */
/*
function setNow(url){
	var obj=$('#CNLTreeMenu1').find('a[href='+url+']');
	if(obj.html()){
		obj.parent().attr('class',obj.parent().attr('class')+' dq');
		while(obj.parent().attr('id')!='CNLTreeMenu1'){
			obj=obj.parent();
			if(obj.attr('class')=='Closed'){
				obj.attr('class','Opened');
				obj.find('ul:first').show();
			}
		}
	}
}
*/
/////////////////////////////////////////首页菜单部分结束//////////////////////////
