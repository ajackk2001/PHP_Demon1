<?php

include 'block/head.php';
include 'block/header.php';
if (!isset($_SESSION['MEMBER_USER']['id'])) {
    echo jsCtrl::Alert_Location('請先登入會員', 'index.php?action=login');
    exit;
}
$order = new order();
$info  = $order->getOrderNumber($_GET['id']);

if ($info['user_id'] != $_SESSION['MEMBER_USER']['id']) {
    echo jsCtrl::Alert_Location('系統錯誤', 'index.php');
    exit;
}

$order_product = new order_product();
$order_product->setKw(['order_id' => $id]);
$order_product->pageReNum = 2000;

$order_product_list = $order_product->getList();
?>
		<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="index.php">首頁</a></li>
								<li><a href="#" class="active">訂單資料</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- entry-header-area-start -->
		<div class="entry-header-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="entry-header-title">
							<h2>訂單資料</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- entry-header-area-end -->
	
		<!-- checkout-area-start -->
		<div class="checkout-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                <div class="checkbox-form">	
                                    <div class="row">
                                        <div class="col-lg-12 col-md-6 col-12 ">
                                            <h4><label>訂單狀態</label></h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-6 col-12">
                                            <?php
                                            if ($info['pay_status'] == 1) {
                                                ?>
                                                 <form method="post" action="index.php?action=go_ecpay">
                                                <input type="hidden" value="<?=$info['id']?>" name="o_id">
                                                <button class="btn btn-sqr">未付款 (點擊前往付款）</button>
                                            </form>
                                            <?php
                                            } else {
                                                echo '<button class="btn btn-sqr">' . $pay_status[$info['pay_status']] . '</button>';
                                            }
                                            ?>
                                           
                                        </div>
                                    </div>
                                    <br>
                                    <?php
                                    if ($info['shipping_number'] != '') {
                                        ?>
                                  
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12 ">
                                            <h4><label>物流資料</label></h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-6 col-12">
                                           <label>物流單號：</label>	
                                           <br>
                                           <button class="btn btn-sqr">寄送中 (查詢物流狀態）</button>
                                        </div>
                                    </div>
                                    <br>
                                    <?php
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12 ">
                                            <h4><label>訂單內容</label></h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                   
                                        <div class="col-lg-6 col-md-6 col-12 ">
                                            <div class="checkout-form-list">
                                                <label>收件人</label>										
                                                <input type="text" placeholder="收件人" value="<?=$info['name']?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="checkout-form-list">
                                                <label>地址 </label>
                                                <input type="text" placeholder="地址" value="<?=$info['address']?>" disabled>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="checkout-form-list">
                                                <label>郵政區號</label>										
                                                <input type="text" placeholder="郵政區號" value="<?=$info['zipcode']?>" disabled>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="checkout-form-list">
                                                <label>電話  </label>										
                                                <input type="text" placeholder="電話" value="<?=$info['tel']?>" disabled>
                                            </div>
                                        </div>
                                       				
                                    </div>
									<div class="different-address">
                                        <div class="order-notes">
                                            <div class="checkout-form-list">
                                                <label>訂單備註</label>
                                                <textarea placeholder="" rows="10" cols="30" id="checkout-mess" disabled><?=$info['remark']?></textarea>
                                            </div>									
                                        </div>
                                    </div>		
                                    											
                                </div>
                            </div>
                                <div class="col-lg-12 col-md-12 col-12">
                                <div class="your-order">
                                    <h3>訂單詳情</h3>
                                    <div class="your-order-table table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="product-name">產品</th>
                                                    <th class="product-total">金額</th>
                                                </tr>							
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($order_product_list as $order_p) {
                                                // $data_json = urldecode($order_p['product_detail']);
                                                $product = json_decode($order_p['product_detail'], true); ?>
                                                <tr class="cart_item">
                                                    <td class="product-name">
													<?=urldecode($product['title'])?> <strong class="product-quantity"> × <?=$order_p['num']['title']?></strong>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="amount"><?=number_format($order_p['price'] * $order_p['num'])?></span>
                                                    </td>
                                                </tr>
                                                <?php
                                            }?>
                                            </tbody>
                                            <tfoot>
                                                <tr class="cart-subtotal">
                                                    <th>小計</th>
                                                    <td><span class="amount"><?=number_format($info['total'] - $info['shipping'])?></span></td>
                                                </tr>
                                                <tr class="shipping">
                                                    <th>運費</th>
													<td><span class="amount"><?=($info['shipping'] == 0 ? '免運' : number_format($info['shipping']))?></span></td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>總計</th>
                                                    <td><strong><span class="amount"><?=number_format($info['total'])?></span></strong>
                                                    </td>
                                                </tr>								
                                            </tfoot>
                                        </table>
                                    </div>
                                  
                                </div>
                            </div>
                            </div>
                        
					</div>
				</div>
			</div>
		</div>
		<!-- checkout-area-end -->
		<?php

include 'block/footer.php';
?>