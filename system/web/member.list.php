<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
             
                <div class="row filter" >
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label">帳號：</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="keywords" id="example-text-input" value="<?=$get['keywords']?>">
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">是否啟用：</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="is_show">
                                    <option value="">請選擇</option>
                                    <option value="1" <?=($get['is_show'] == 1 ? "selected" : "") ?>>是</option>
                                    <option value="0" <?=($get['is_show'] === '0' ? "selected" : "") ?>>否</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary waves-effect waves-light"  onClick="filter();">搜尋</button>
                        </div>
                    </div>
                </div>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>會員ID</th>
                            <th>姓名</th>
                            <th>帳號</th>
                            <th>是否啟用</th>
                            <th>操作 </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($list as $val) { ?>
                    <tr>
                        <td><?php echo $val['id']; ?></td>
                        <td><?php echo $val['name']; ?></td>
                        <td><?php echo $val['username']; ?></td>
                        <td>
                            <input type="checkbox" value="1" name="is_show" product_id="<?php echo $val['id']; ?>" 
                            <?=($val['is_show'] == 1 ? "checked" : "") ?>>
                        </td>
                        <td class="E_bd">
                        <a href="index.php?type=<?php echo $_GET['type']?>&do=info&cn=<?php echo $className?>&id=<?php echo $val['id'] . ($_GET['ntype'] ? '&ntype=' . $_GET['ntype'] : '')?>">編輯</a>
                        | 
                        <a href="javascript:;" onclick="delFun('<?php echo $className?>','<?php echo $val['id']?>')">刪除</a> 
                        | 
                        <a href="index.php?type=web&do=list&cn=order&user_id=<?=$val['id']?>">訂單資料</a> 
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

