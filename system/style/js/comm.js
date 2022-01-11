function trim(str) {//trim()
res="";
for(var i=0; i< str.length; i++) {
if (str.charAt(i) != " " && str.charAt(i) != "　") {
res +=str.charAt(i);
}
}
return res;
}
function btnTrimLeft(x) {//去除左邊的空白
while(x.substring(0,1)==" ") {
x = x.substring(1,x.length);
}
return x;
}
function btnTrimRight(x) {//去除右邊的空白
while(x.substring(x.length-1,x.length)==" ") {
x = x.substring(0,x.length-1);
}
return x;
}
function btnTrimAll(x) {//去除二邊的空白
x = btnTrimLeft(x);
x = btnTrimRight(x);
return x;
}

//提交表單
function subForm(fid){
	$('#'+fid).submit();
}
//把表單變成可以提交用的params,不支持文件
function formToParam(form){
	var params={};
	$('#'+form+' input').each(function (){
		if($(this).attr('name')){
			params[$(this).attr('name')]=$(this).val();
		}
	});
	$('#'+form+' select').each(function (){
		if($(this).attr('name')){
			params[$(this).attr('name')]=$(this).val();
		}
	});
	$('#'+form+' textarea').each(function (){
		if($(this).attr('name')){
			params[$(this).attr('name')]=$(this).val();
		}
	});
	$('#'+form+' button').each(function (){
		if($(this).attr('name')){
			params[$(this).attr('name')]=$(this).val();
		}
	});
	return params;
}
/*
 * 根據值獲得select的Text
 */
function selectText(obj){
	var val=obj.val();
	var str='';
	obj.find('option').each(function (){
		if($(this).attr('value')==val) str=$(this).html();
	})
	return str;
}
/*
 * 設定修改表單的數據
 */
function editFunEmpty(obj){
	var fieldName='';
	$(':input').each(function (){
		fieldName=$(this).attr('name');
		if(fieldName && obj[fieldName] && !$(this).val()){
			switch($(this).attr('type')){
				case 'checkbox'	:
								if(obj[fieldName]>0)
									$(this).attr('checked','checked');
								break;
				case 'file'		:
								break;
				case 'radio':
								$("input[name="+fieldName+"][value="+obj[fieldName]+"]").attr("checked",true);
								// $("input[@name="+fieldName+"][@value="+obj[fieldName]+"]").attr("checked",true);
								break;
				default			:
								$(this).val(obj[fieldName]);
			}
		}
	})
}
function editFun(obj){
	var fieldName='';
	$(':input').each(function (){
		fieldName=$(this).attr('name');
		if(fieldName && obj[fieldName]){
			switch($(this).attr('type')){
				case 'checkbox'	:
								if(obj[fieldName]>0)
									$(this).attr('checked','checked');
								break;
				case 'file'		:
								break;
				case 'radio':
								$("input[name="+fieldName+"][value="+obj[fieldName]+"]").attr("checked",true);
								// $("input[@name="+fieldName+"][@value="+obj[fieldName]+"]").attr("checked",true);
								break;
				default			:
								$(this).val(obj[fieldName]);
			}
		}
	})
}
/*
 * 跳轉到某個頁面
 */
function go(url){
	window.location.href=url;
}

//check num
function checkNum(a) {
if (a.length>0) {
  var tmp=0;
  for (i=0;i<a.length;i++) {
    c=a.charAt(i);
    if ("0123456789".indexOf(c,0) < 0 ) {
      tmp+=1;
      return false;
    }
  }
  if (a=="0") {
    a="1";
    return true;
  }
  else return true;
}
else return false;
}
function isnum(num){
	//res=/^\d+$/;
	res=/^(\d+)-(\d+)$/;
	var re = new RegExp(res);
	return !(num.match(re) == null); 
}
//check email
function isEmail(str){ 
	res = /^[0-9a-zA-Z_\-\.]+@[0-9a-zA-Z_\-]+(\.[0-9a-zA-Z_\-]+)*$/; 
	var re = new RegExp(res); 
	return !(str.match(re) == null); 
}
/////////////////////////////////////////輸入數孛//////////////////////////
var bName = navigator.appName;
nc = (bName == "Netscape") ? true : false;
ie = (bName == "Microsoft Internet Explorer") ? true : false;
function Check_num() {
	if(nc) document.onkeypress = keyDown;
	else if ((event.keyCode < 48 || event.keyCode > 57) && event.keyCode != 13 && event.keyCode != 46) event.returnValue = false;
}
function keyDown(e){
	var nkey=e.which;
	if (nkey >= 48 && nkey <= 57 || nkey==46 || nkey==13 || nkey==8 || nkey==0) return true;
	else return false;
}
function Cls_event(){
	document.onkeypress = "";
}
/////////////////////////////////////////輸入數孛//////////////////////////

function basename(path) {
    return path.replace(/\\/g,'/').replace( /.*\//, '' );
}
function nl2br(str, is_xhtml) {   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}
function CheckFileType(obj,type) {
  var re = type=="Word"?/\.(doc|docx)$/i:/\.(pdf)$/i;  //允許的副檔名
  if(obj.val() == "" || obj.val() == " " || typeof(obj.val())=='undefined') {
    return true;
  }
  else {
	if (!re.test(obj.val())) {
	alert("File type allows only "+type+" !!!");
	obj.focus();
	obj.select();
	return false;
	}
  }
}

function Fill0(p,q) {//前面補0,p欄位,q位數
  var GotID,tot,TempKey;
  p.value=btnTrimAll(p.value);
  //TempKey=btnTrimAll(p.value);
  if (p.value.length>0) {
    tot=p.value.length;
    GotID=p.value;
    if(tot*1<q*1) {
      for(i = tot; i <q*1; i++){
        GotID="0"+GotID;
      }
    }
    p.value=GotID;
  }
}
function Fill0New(p,q,r) {//前面補0,p欄位,q位數,r是否補0
  if (r.checked) {
    var GotID,tot;
    tot=p.value.length;
    GotID=p.value;
    if(tot*1<q*1) {
      for(i = tot; i <q*1; i++){
        GotID="0"+GotID;
      }
    }
    p.value=GotID;
  }
  else {
    if (p.value=="00000") {
      p.value="";
    }
  }
}
function Turn_UDID(this_cols) {
  var tmp_cols1,tmp_cols2;
  tmp_cols1="";
  tmp_cols2="";
  this_cols.value=btnTrimAll(this_cols.value.toUpperCase());
  if (this_cols.value!="") {
    tmp_cols1=this_cols.value.charAt(0);
    tmp_cols2=this_cols.value.substring(1,this_cols.value.length);
    if (tmp_cols1!="N" && tmp_cols1!="S") { 
      tmp_cols1="S"
      tmp_cols2=this_cols.value;
    }
    //if (tmp_cols1=="N" || tmp_cols1=="S") {
      if (tmp_cols2.length<4) {
        for (var i = 0; i < 4-(tmp_cols2.length); i++) {
          tmp_cols1=tmp_cols1+"0";
        }
      }
      this_cols.value=tmp_cols1+tmp_cols2;
      return true;
    //}
    //else {
    //  alert("會員編號第一碼請輸入N或S");
    //  this_cols.focus();
    //  return false;
    //}
  }
  else {
    return true;
  }
}