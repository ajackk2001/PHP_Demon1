<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="button-items">
                            <a href="index.php?type=<?php echo $_GET['type']?>&do=info&cn=<?php echo $className . ($_GET['ntype'] ? '&ntype=' . $_GET['ntype'] : '');?>" class="btn btn-primary btn-lg waves-effect waves-light">新增資料</a>
                        </div>
                    </div>
                </div>
                <BR>
                <div class="row filter" >
                </div>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>標題</th>
                        <th>排序</th>
                        <th>是否上架</th>
                        <th>首頁顯示</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $val) {?>
                    <tr>
                        <td><?php echo $val['title'];?></td>
                        <td><input postType="<?php echo $_GET['cn']?>" postId="<?php echo $val['id']?>" name="sort" type="text" style="width:35px" value="<?php echo $val['sort']?>" onKeyPress="Check_num();" onBlur="Cls_event();"></td>
                        <td>
                            <input type="checkbox" value="1" name="is_show" product_id="<?php echo $val['id'];?>" 
                            <?=($val['is_show'] == 1 ? "checked" : "") ?>>
                        </td>
                        <td class="N_title"><input type="checkbox" value="1" name="is_top" product_id="<?php echo $val['id'];?>" <?php if ($val['is_top'] == 1) {
    echo "checked";
}?>></td>
                        <td class="E_bd">
                       
						<a href="index.php?type=<?php echo $_GET['type']?>&do=info&cn=<?php echo $className?>&id=<?php echo $val['id'] . ($_GET['ntype'] ? '&ntype=' . $_GET['ntype'] : '')?>">編輯</a>
                        
                        </td>

                    </tr>
                    <?php
                    }
                    ?>
                    
                    
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

