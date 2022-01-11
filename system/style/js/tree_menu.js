function myFunOfMouseOver(iId)
{
	var iIdNow="ID"+iId+"a";
	var nodeObject=document.getElementById(iIdNow);
	if(nodeObject) 
	{
		var infoNow=nodeObject.getAttribute("myDemo");
		var infodisplay=document.getElementById("infodisplay"); 
		infodisplay.innerHTML="<font color='#999999'>"+infoNow+"<font>";   
	}
	return false;
}
function expandRoot(sImagePathPrefix,rootID)
{
	var roootElement=document.getElementById(rootID);
	if(roootElement) 
	{
		if(roootElement.className=="Outline")
		{
			var targetId=roootElement.id+"d";
			var targetElement=document.getElementById(targetId);
			if(targetElement.style.display=="none")
			{
				targetElement.style.display="";
				roootElement.src=sImagePathPrefix+"style/tree/ofolder.png";
			}
			else
			{
				targetElement.style.display="none";
				roootElement.src=sImagePathPrefix+"style/tree/folder.png";
			}
		}
	}
}

function OnClickOutline(imgRootPath,iId)
{
	var targetId,srcElement,targetElement;
	srcElement=document.getElementById("ID"+iId);
	if(srcElement.className=="Outline"){
		targetId=srcElement.id+"d";
		targetElement=document.getElementById(targetId);
		if(targetElement.style.display=="none"){
			targetElement.style.display="";
			srcElement.src=imgRootPath+"style/tree/ofolder.png";
		}else{
			targetElement.style.display="none";
			srcElement.src=imgRootPath+"style/tree/folder.png";
		}
	}
}
function tree_menu_setNow(url,id){
	var a_url=$('.'+id).find('a[href="'+url+'"]');
	var obj=$('.'+id);
	$('#side-menu li').removeClass('active');
	$('#side-menu a').removeClass('active');
	obj.addClass('active');
	a_url.addClass('active');
	obj.parents('li').addClass('active');
	// console.log(obj.parents('li'));
	var submenu = obj.parents('.submenu');
	submenu.addClass('in');
	submenu.attr('aria-expanded',"true");
}

function delete_menu(id){
	if(confirm('確定要刪除嗎?')){
		$.ajax({
		   type: "POST",
		   url: "delete.php",
		   data: "id="+id,
		   success: function(msg){
			window.location.href=window.location.href;
		   }
		}); 
	}
}