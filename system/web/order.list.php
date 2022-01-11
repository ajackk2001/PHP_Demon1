<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
               
                <div class="row filter" >
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label">會員ID：</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="user_id" id="example-text-input" value="<?=$get['user_id']?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">付款狀態：</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="pay_status">
                                    
                                    <option value="">請選擇</option>
                                    <?php
                                    foreach ($pay_status as $key => $val) {
                                        echo '<option value="' . $key . '" ' . ($get['pay_status'] == $key ? 'selected' : '') . '>' . $val . '</option>';
                                    }
                                  ?>
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
                        <th>購買會員ID</th>
                        <th>訂單編號</th>
                        <th>付款方式</th>
                        <th>金額</th>
                        <th>交易狀態</th>
                        <th>建立時間</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $classes = new classes();
                    foreach ($list as $val) {
                        $class = $classes->getInfo($val['class_id']); ?>
                    <tr>
                        <td><?php echo $val['user_id']; ?></td>
                        <td><?php echo $val['order_number']; ?></td>
                        <td><?php echo $pay_type[$val['pay_type']]; ?></td>
                        <td><?php echo $val['total']; ?></td>
                        <td><?php echo $pay_status[$val['pay_status']]; ?></td>
                        <td><?php echo $val['insert_time']; ?></td>
                        <td class="E_bd">
                        <a href="index.php?type=<?php echo $_GET['type']?>&do=info&cn=<?php echo $className?>&id=<?php echo $val['id'] . ($_GET['ntype'] ? '&ntype=' . $_GET['ntype'] : '')?>">查看</a>
                        <!-- <a href="javascript:;" onclick="delFun('<?php echo $className?>','<?php echo $val['id']?>')">刪除</a>  -->
                        
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

