<?php

$product = new product();
$info    = $product->getInfo($_GET['product_id']);

?>
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
							<form method="post" enctype="multipart/form-data" action="index.php?type=web&do=info&cn=product&id=<?=$_GET['product_id']?>">
								<div class="row">
									<div class="col-md-12">
										
											<a href="index.php?type=<?php echo $_GET['type']?>&do=info&cn=product&id=<?=$info['id']?>" class="btn btn-primary btn-lg waves-effect waves-light">回到修改</a>
										
									</div>
									<div class="col-md-4">
										<div class="form-group row">
											<label class="col-sm-6 col-form-label">圖片上傳：</label>
											<div class="col-sm-6">
											<input type="hidden" name="product_id" value="<?=$_GET['product_id']?>">
											<input type="hidden" name="back_page" value="<?=$_SERVER['REQUEST_URI']?>">
											<input type="file" name="picfile_list[]" multiple="multiple" class="form-control">
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
												<button type="submit" class="btn btn-primary waves-effect waves-light" >上傳</button>
										</div>
									</div>
								</div>
							</form>
                <div class="row filter" >
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">是否上架：</label>
                            <div class="col-sm-6">
														<input type="hidden" name="product_id" value="<?=$_GET['news_id']?>">
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
                        <th>圖片</th>
                        <th>排序</th>
                        <th>是否上架</th>
                        <th>操作 </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $val) {?>
                    <tr>
                        <td><img src="<?php echo ROOT_URL . $val['pic'];?>" width="100px"></td>
                        <td><input postType="<?php echo $_GET['cn']?>" postId="<?php echo $val['id']?>" name="sort" type="text" style="width:35px" value="<?php echo $val['sort']?>" onKeyPress="Check_num();" onBlur="Cls_event();"></td>
                        <td>
                            <input type="checkbox" value="1" name="is_show" product_id="<?php echo $val['id'];?>" 
                            <?=($val['is_show'] == 1 ? "checked" : "") ?>>
                        </td>
                        <td class="E_bd">
                        <a href="javascript:;" onclick="delFun('<?php echo $className?>','<?php echo $val['id']?>')">刪除</a>
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

