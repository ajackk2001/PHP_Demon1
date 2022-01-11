<?php

$member_class = new member();
$member       = $member_class->getInfo($info['user_id']);

$order_product = new order_product();
$product_list  = $order_product->orderProductList($info['id']);

?>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">會員ID</label>
    <div class="col-sm-10">
    <?=$info['user_id']?> - <a href="index.php?type=web&do=info&cn=member&id=<?=$info['user_id']?>"><?=$member['name']?></a>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">訂單號碼</label>
    <div class="col-sm-10">
    <?=$info['order_number']?>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">綠界訂單號碼</label>
    <div class="col-sm-10">
    <?=$info['log_order_number']?>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">物流配送號</label>
    <div class="col-sm-10">
    <input class="form-control" name="shipping_number" value="<?=$info['shipping_number']?>">
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">付款方式</label>
    <div class="col-sm-10">
    <?=$pay_type[$info['pay_type']]?>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">付款金額</label>
    <div class="col-sm-10">
    <?=$info['total']?>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">付款狀態</label>
    <div class="col-sm-10">
    <?=$pay_status[$info['pay_status']]?>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">姓名</label>
    <div class="col-sm-10">
        <input class="form-control" name="name" value="<?=$info['name']?>">
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">電話</label>
    <div class="col-sm-10">
    <input class="form-control" name="tel" value="<?=$info['tel']?>">
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">地址</label>
    <div class="col-sm-10">
    <input class="form-control" name="address" value="<?=$info['address']?>">
  </div>
</div>
<!-- <div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">郵遞區號</label>
    <div class="col-sm-10">
    <input class="form-control" name="zipcode" value="<?=$info['zipcode']?>">
  </div>
</div> -->

<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">備註</label>
    <div class="col-sm-10">
        <textarea class="form-control" name="remark"><?=$info['remark']?></textarea>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">金流支付細節</label>
    <div class="col-sm-10">
        <textarea class="form-control" name="pay_detail" disabled> <?=$info['pay_detail']?></textarea>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">新增時間</label>
    <div class="col-sm-10">
    <?=$info['insert_time']?>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">最後更新時間</label>
    <div class="col-sm-10">
    <?=$info['update_time']?>
  </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">

                <h4 class="mt-0 header-title">訂購商品</h4>
              
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                        <tr>
                          <th>商品</th>
                          <th>商品編號</th>
                          <th>價格</th>
                          <th>數量</th>
                          <th>小計</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($product_list as $product) {
                            $product_detail = json_decode($product['product_detail'], true);

                            echo '<tr>
                                      <td>' . urldecode($product_detail['title']) . '</td>
                                      <td>' . $product['product_code'] . '</td>
                                      <td>' . number_format($product['price']) . '</td>
                                      <td>' . $product['num'] . '</td>
                                      <td>' . number_format($product['price'] * $product['num']) . '</td>
                                  </tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div>