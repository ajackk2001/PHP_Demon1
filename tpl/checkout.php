<?php

include 'block/head.php';
include 'block/header.php';
if (count($_SESSION['car']) > 0) {
    $shipping      = new shipping();
    $shipping_info = $shipping->getInfo(1);
    if ($total >= $shipping_info['pay_total']) {
        $pay_shipping['pay_shipping'] = 0;
    }
} else {
    if (!isset($_SESSION['MEMBER_USER']['id'])) {
        echo jsCtrl::Alert_Location('請選購商品至購物車', 'index.php');
        exit;
    }
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
								<li><a href="index.php?action=cart">購物車</a></li>
								<li><a href="#" class="active">填寫資料</a></li>
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
							<h2>填寫資料</h2>
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
					    <form action="index.php?action=sumbitCar" method="post" >
							<input value="wishlist" name="action" type="hidden">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                <div class="checkbox-form">	
									<div class="different-address">
										<div class="ship-different-title">
											<h3>
												<label>是否使用帳號資料?</label>
												<input type="checkbox" id="same_user">
											</h3>
										</div>
									</div>
                                    <div class="row">
                                       
                                        <div class="col-lg-6 col-md-6 col-12 ">
                                            <div class="checkout-form-list">
                                                <label>收件人<span class="required">*</span></label>										
                                                <input type="text" placeholder="收件人" name="name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="checkout-form-list">
                                                <label>電話  <span class="required">*</span></label>										
                                                <input type="text" placeholder="電話" name="tel">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="checkout-form-list">
                                                <label>地址 <span class="required">*</span></label>
                                                <input type="text" placeholder="地址" name="address">
                                            </div>
                                        </div>
                                       
                                        <!-- <div class="col-lg-6 col-md-6 col-12">
                                            <div class="checkout-form-list">
                                                <label>郵政區號<span class="required">*</span></label>										
                                                <input type="text" placeholder="郵政區號" name="zipcode">
                                            </div>
                                        </div> -->
                                       
                                      
                                       				
                                    </div>
									<div class="different-address">
                                        <div class="order-notes">
                                            <div class="checkout-form-list">
                                                <label>訂單備註</label>
                                                <textarea placeholder="訂單備註" rows="10" cols="30" name="remark"></textarea>
                                            </div>									
                                        </div>
                                    </div>		
                                    <div class="different-address">
                                        <div class="order-notes">
                                            <div class="checkout-form-list">
											<h3>購買條款</h3>
											<label><a href="#">前往查看購買相關條款</a>，請確實確認購買條款之內容皆認同</label>
                                            </div>									
                                        </div>
										<div class="ship-different-title">
											<h3>
												<label>是否同意購買條款?</label>
												<input type="checkbox" id="ship-box" name="check_shop">
												
											</h3>
										</div>
                                    </div>													
                                </div>
                            </div>
                                <div class="col-lg-12 col-md-12 col-12">
                                <div class="your-order">
                                    <h3>確認您的訂單資料</h3>
                                    <div class="your-order-table table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="product-name">產品</th>
                                                    <th class="product-total">金額</th>
                                                </tr>							
                                            </thead>
                                            <tbody><?php
                                            foreach ($cars as $car) {
                                                ?>
                                                <tr class="cart_item">
                                                    <td class="product-name">
													<?=$car['product']['title']?> <strong class="product-quantity"> × <?=$car['num']['title']?></strong>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="amount"><?=number_format($car['product']['price'] * $car['num'])?></span>
                                                    </td>
                                                </tr>
                                                <?php
                                            }?>
                                               
                                            </tbody>
                                            <tfoot>
                                                <tr class="cart-subtotal">
                                                    <th>小計</th>
                                                    <td><span class="amount"><?=number_format($total)?></span></td>
                                                </tr>
                                                <tr class="shipping">
                                                    <th>運費</th>
													<td><span class="amount"><?=($total >= $shipping_info['pay_total'] ? '免運' : number_format($pay_shipping['pay_shipping']))?></span></td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>總計</th>
                                                    <td><strong><span class="amount"><?=number_format($total + $pay_shipping['pay_shipping'])?></span></strong>
                                                    </td>
                                                </tr>								
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="payment-method">
                                        
                                        <div class="order-button-payment">
                                            <input type="submit" value="確認送出訂單">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </form>
					</div>
				</div>
			</div>
		</div>
        <script>
$(function(){
    $('#same_user').on('click',function(){
        if($(this).prop("checked", true)) {
            $('input[name=name]').val('<?=$_SESSION['MEMBER_USER']['name']?>');
            $('input[name=address]').val('<?=$_SESSION['MEMBER_USER']['address']?>');
            // $('input[name=zipcode]').val();
            $('input[name=tel]').val('<?=$_SESSION['MEMBER_USER']['tel']?>');

        }else{
            $('input[name=name]').val('');
            $('input[name=address]').val('');
            $('input[name=zipcode]').val('');
            $('input[name=tel]').val('');
        }
    })
})

        </script>
		<!-- checkout-area-end -->
		<?php

include 'block/footer.php';
?>