            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <!-- <li class="menu-title">網站功能管理</li> -->
                            <!-- <li>
                                <a href="index.php" class="waves-effect">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span> 主選單 </span>
                                </a>
                            </li> -->
<?php
 $menu          = resetArray(0, getMenuData($_SESSION["ADMIN_ID"]));
 $menu_ary      = array();
 $menu_ary_down = array();
 $className     = $_GET['cn'];
 foreach ($menu as $key => $val) {
     $setcookie = $id . '_menu_name';
     if ($val['hide_sub'] == 0 && $val['parent_id'] == 0) {
         $menu_ary[$val['parent_id']][$val['id']]['li'] = ' <li class="bar_' . $val['id'] . '"><a href="' . $val['link'] . '" class="waves-effect"  id="bar_' . $val['id'] . '"><i class="mdi mdi-view-dashboard"></i><span> ' . $val['name'] . '  </span></a></li>';
     } else {
         if ($val['hide_sub'] == 1 && $val['parent_id'] == 0) {
             $menu_ary[$val['parent_id']][$val['id']]['li'] = '
             
                <a href="javascript:void(0);" class="waves-effect bar_' . $val['id'] . '">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span> 
                        ' . $val['name'] . ' 
                        <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> 
                    </span>
                </a>
             ';
         } else {
             $menu_ary_down[$val['parent_id']] .= '<li class="bar_' . $val['id'] . '" ><a href="' . $val['link'] . '"  id="bar_' . $val['id'] . '" onclick="SetCookie(' . $setcookie . ')">' . $val['name'] . ' </a></li>';
         }
     }
 }

 foreach ($menu_ary as $menu_key => $menu_val) {
     foreach ($menu_val as $key => $val) {
         if ($menu_ary_down[$key] != '') {
             echo '<li>' . $val['li'] . '<ul class="submenu">' . $menu_ary_down[$key] . '</ul></li>';
         } else {
             echo $val['li'];
         }
     }
 }

?>

                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

<script>
$('#side-menu a').click(function (){		
    if($(this).attr('href')!='javascript:void(0);') {			
        SetCookie('admin_tree_menu',$(this).attr('href'));			
        SetCookie('admin_menu_name',$(this).text());	
        SetCookie('admin_menu_id',$(this).attr('id'));
    }
});	
$(document).ready(function(){
    tree_menu_setNow(GetCookie('admin_tree_menu'),GetCookie('admin_menu_id'));
})
   

</script>
