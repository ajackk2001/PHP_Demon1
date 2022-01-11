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
                <div class="row filter" >
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label">標題：</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="keywords" id="example-text-input" value="<?=$get['keywords']?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">是否上架：</label>
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
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label">分類：</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="category_id">
                                    <option value="">請選擇</option>
                                    <?php
                                    $category      = $webdb->getList("select * from _web_product_group order by sort,id");
                                    $category_list = array_column($category, 'title', 'id');
                                    foreach ($category as $value) {
                                        echo '<option value="' . $value['id'] . ' ' . ($_GET['category_id'] == $value['id'] ? 'selected' : '') . '">' . $value['title'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label">藝人：</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="artist_id">
                                    <option value="">請選擇</option>
                                    <?php
                                    $category    = $webdb->getList("select * from _web_artist order by sort,id");
                                    $artist_list = array_column($category, 'name', 'id');
                                    foreach ($category as $value) {
                                        echo '<option value="' . $value['id'] . ' ' . ($_GET['artist_id'] == $value['id'] ? 'selected' : '') . '">' . $value['name'] . '</option>';
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
                <hr>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>商品標題</th>
                        <th>商品分類</th>
                        <th>商品藝人</th>
                        <th>商品序號</th>
                        <th>商品金額</th>
                        <th>排序</th>
                        <th>是否上架</th>
                        <th>操作 </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $val) {?>
                    <tr>
                        <td><?php echo $val['title'];?></td>
                        <td><?php echo $category_list[$val['category_id']];?></td>
                        <td><?php echo $artist_list[$val['artist_id']];?></td>
                        <td><?php echo $val['product_code'];?></td>
                        <td><?php echo $val['price'];?></td>
                      
                        <td><input postType="<?php echo $_GET['cn']?>" postId="<?php echo $val['id']?>" name="sort" type="text" style="width:35px" value="<?php echo $val['sort']?>" onKeyPress="Check_num();" onBlur="Cls_event();"></td>
                        <td>
                            <input type="checkbox" value="1" name="is_show" product_id="<?php echo $val['id'];?>" 
                            <?=($val['is_show'] == 1 ? "checked" : "") ?>>
                        </td>
                    
                        <td class="E_bd">
                        <a href="index.php?type=<?php echo $_GET['type']?>&do=info&cn=<?php echo $className?>&id=<?php echo $val['id'] . ($_GET['ntype'] ? '&ntype=' . $_GET['ntype'] : '')?>">編輯</a>
                        | 
                        <a href="javascript:;" onclick="delFun('<?php echo $className?>','<?php echo $val['id']?>')">刪除</a> 
                        
                        <a href="index.php?type=web&do=list&cn=product_pic&product_id=<?=$val['id']?>">前往相簿</a>
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

