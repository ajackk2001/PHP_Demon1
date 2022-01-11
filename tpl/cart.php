<?php

include 'block/head.php';
include 'block/header.php';
if (!isset($_SESSION['MEMBER_USER']['id'])) {
    echo jsCtrl::Alert_Location('請先登入會員', 'index.php?action=login');
    exit;
}
$shipping      = new shipping();
$shipping_info = $shipping->getInfo(1);
if ($total >= $shipping_info['pay_total']) {
    $pay_shipping['pay_shipping'] = 0;
}
?>
		<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="index.php">首頁</a></li>
								<li><a href="#" class="active">購物車</a></li>
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
							<h2>購物車</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- entry-header-area-end -->
		<!-- cart-main-area-start -->
		<div class="cart-main-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<form action="#">
							<div class="table-content table-responsive mb-15 border-1">
								<table>
									<thead>
										<tr>
											<th class="product-thumbnail">產品圖</th>
											<th class="product-name">商品</th>
											<th class="product-price">價格</th>
											<th class="product-quantity">數量</th>
											<th class="product-subtotal">金額</th>
											<th class="product-remove">刪除</th>
										</tr>
									</thead>
									<tbody>
										<?php
                                            foreach ($cars as $car) {
                                                ?>
										<tr>
											<td class="product-thumbnail"><a href="index.php?action=product-details&id=<?=$car['product']['id']?>"><img src="<?=$car['product']['pic']?>" alt="<?=$car['product']['title']?>" /></a></td>
											<td class="product-name"><a href="index.php?action=product-details&id=<?=$car['product']['id']?>"><?=$car['product']['title']?></a></td>
											<td class="product-price"><span class="amount"><?=number_format($car['product']['price'])?></span></td>
											<td class="product-quantity"><input type="number" value="<?=$car['num']?>" min="1" max="10" class="editCar" p_id="<?=$car['product']['id']?>"></td>
											<td class="product-subtotal"><?=number_format($car['product']['price'] * $car['num'])?></td>
											<td class="product-remove"><a href="index.php?action=delCar&id=<?=$car['product']['id']?>"><i class="fa fa-times"></i></a></td>
										</tr>
										<?php
                                            }
                                        ?>
									
										
									</tbody>
								</table>
							</div>
						</form>
					</div>
				</div>
				<div class="row">
                    <div class="col-lg-8 col-md-6 col-12">
						<p>單筆消費滿 $<?=number_format($shipping_info['pay_total'])?> ，則享有免運費優惠</p>
						<div class="wc-proceed-to-checkout">
							<a href="index.php?action=checkout">下一步 - 填寫資料</a>
						</div>
                        <!-- <div class="buttons-cart mb-30">
                            <ul>
                                <li><a href="#">Update Cart</a></li>
                                <li><a href="#">Continue Shopping</a></li>
                            </ul>
                        </div>
                        <div class="coupon">
                            <h3>Coupon</h3>
                            <p>Enter your coupon code if you have one.</p>
                            <form action="#">
                                <input type="text" placeholder="Coupon code">
                                <a href="#">Apply Coupon</a>
                            </form>
                        </div> -->
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="cart_totals">
                            <h2></h2>
                            <table>
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>小計</th>
                                        <td>
                                            <span class="amount"><?=number_format($total)?></span>
                                        </td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>運費</th>
                                        <td>
											<strong>
                                                <span class="amount"><?=($total >= $shipping_info['pay_total'] ? '免運' : number_format($pay_shipping['pay_shipping']))?></span>
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>總計</th>
                                        <td>
                                            <strong>
                                                <span class="amount"><?=number_format($total + $pay_shipping['pay_shipping'])?></span>
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
							
                           
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<script>
       $('.editCar').on('change',function(){
           var product_id = $(this).attr('p_id');
           var num = $(this).val();
		   
           $.ajax({
			   type: "POST",
			   url: "index.php?action=editCar",
			   data: {
                "p_id" : product_id,
                "num" : num,
               },
			   success: function(msg){
                    alert(msg);
                    window.location.reload();
               }
			}); 
       })
	   <?php
       /*
       $('.delCar').on('click',function(){
           var product_id = $(this).attr('product_id');

           $.ajax({
               type: "POST",
               url: "index.php?action=delCar",
               data: {
                "p_id" : product_id,
               },
               success: function(msg){
                    alert(msg);
                    window.location.reload();
               }
            });
       })
       $('.sale_type').on('change',function(){

        var value = $(this).attr('value');
           var is_check = $(this).is(':checked');
           if(is_check != true){
                value ='is_no_use'
           }
           var num = $(this).val();
           $.ajax({
               type: "POST",
               url: "index.php?action=saleCar",
               data: {
                "sale_type" : value,
                "num" : num,
                "is_check" : num,
               },
               success: function(msg){
                    alert(msg);
                    window.location.reload();
               }
            });
       })*/
       ?>
    </script>
		<!-- cart-main-area-end -->
		<?php

include 'block/footer.php';
?>