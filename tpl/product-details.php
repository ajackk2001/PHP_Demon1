<?php

include 'block/head.php';
include 'block/header.php';
$product      = new product();
$product_info = $product->getInfo($_GET['id']);

if (!$product_info || $product_info['is_show'] != 1) {
    echo jsCtrl::Location('index.php');
    exit;
}
$artist      = new artist();
$artist_info = $artist->getInfo($product_info['artist_id']);
if (!$artist_info || $artist_info['is_show'] != 1) {
    echo jsCtrl::Location('index.php');
    exit;
}
$product_group      = new product_group();
$product_group_info = $product_group->getInfo($product_info['category_id']);

$product_pic = new product_pic();
$product_pic->setKw(['product_id' => $product_info['id'], 'is_show' => 1]);
$product_pic_list = $product_pic->getList();

$product_other = $product->other_list($artist_info['id'], $product_info['id']);
?>
		<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="index.php">首頁</a></li>
								<li><a href="index.php?action=artist_detail&id=<?=$artist_info['id']?>"><?=$artist_info['name']?></a></li>
								<li><a href="index.php?action=product&artist_id=<?=$artist_info['id']?>">周邊商品</a></li>
								<li><a href="index.php?action=product&artist_id=<?=$artist_info['id']?>&group_id=<?=$product_group_info['id']?>"><?=$product_group_info['title']?></a></li>
								<li><a href="#" class="active"><?=$product_info['title']?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- product-main-area-start -->
		<div class="product-main-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-12 order-lg-1 order-1">
						<!-- product-main-area-start -->
						<div class="product-main-area">
							<div class="row">
								<div class="col-lg-5 col-md-6 col-12">
									<div class="flexslider">
										<ul class="slides">
										<?php
										 echo '	<li data-thumb="' . $product_info['pic'] . '">
												<img src="' . $product_info['pic'] . '" alt="' . $product_info['title'] . '" />
											  </li>';
                                            foreach ($product_pic_list as $val) {
                                                echo '	<li data-thumb="' . $val['pic'] . '">
												<img src="' . $val['pic'] . '" alt="' . $product_info['title'] . '" />
											  </li>';
                                            }
                                        ?>
										
										</ul>
									</div>
								</div>
								<div class="col-lg-7 col-md-6 col-12">
									<div class="product-info-main">
										<div class="page-title">
											<h1><?=$product_info['title']?></h1>
										</div>
										<div class="product-info-stock-sku">
											<span>銷售中</span>
											<div class="product-attribute">
												<span>編號</span>
												<span class="value"><?=$product_info['product_code']?></span>
											</div>
										</div>
										
										<div class="product-info-price">
											<div class="price-final">
												<span>定價：$<?=number_format($product_info['price'])?></span>
												<!-- <span class="old-price">$40.00</span> -->
											</div>
										</div>
										<div class="product-add-form">
											<form action="index.php?action=addCar" method="post" id="form">
												
												<div class="quality-button">
													<input type="hidden" name="p_id" value="<?=$product_info['id']?>">
													<input class="qty" type="number" name="num" value="1" min="1" max="10">
												</div>
												<a href="#" onclick="toForm();">加入購物車</a>
											</form>
										</div>
										<div class="product-social-links">
											<!-- <div class="product-addto-links">
												<a href="#"><i class="fa fa-heart"></i></a>
												<a href="#"><i class="fa fa-pie-chart"></i></a>
												<a href="#"><i class="fa fa-envelope-o"></i></a>
											</div> -->
											<div class="product-addto-links-text">
												<p><?=$product_info['description']?></p>
											</div>
										</div>
									</div>
								</div>
							</div>	
						</div>
						<!-- product-main-area-end -->
						<!-- product-info-area-start -->
						<div class="product-info-area mt-80">
							<!-- Nav tabs -->
							<ul class="nav">
								<li><a class="active" href="#Details" data-toggle="tab">商品內容</a></li>
								
							</ul>
							<div class="tab-content">
                                <div class="tab-pane fade show active" id="Details">
                                    <div class="valu">
									<?=$product_info['content']?>
                                    </div>
                                </div>
                               
                            </div>	
						</div>
						<!-- product-info-area-end -->
						<!-- new-book-area-start -->
						<div class="new-book-area mt-60">
							<div class="section-title text-center mb-30">
								<h3>其他商品</h3>
							</div>
							<div class="tab-active-2 owl-carousel">
							<?php
                            if (count($product_other) > 3) {
                                foreach ($product_other as $val) {
                                    ?>
								<!-- single-product-start -->
								<div class="product-wrapper">
									<div class="product-img">
										<a href="index.php?action=product-details&id=<?=$val['id']?>">
											<img src="<?=$val['pic']?>" alt="<?=$val['title']?>" class="primary" />
										</a>
									</div>
									<div class="product-details text-center">
										<h4><a href="index.php?action=product-details&id=<?=$val['id']?>"><?=$val['title']?></a></h4>
										<div class="product-price">
											<ul>
												<li> <span>定價：</span>$<?=number_format($val['price'])?></li>
											</ul>
										</div>
									</div>
									<div class="product-link">
										<div class="product-button">
											<a href="index.php?action=product-details&id=<?=$val['id']?>" title="加入購物車"><i class="fa fa-shopping-cart"></i>加入購物車</a>
										</div>
										<div class="add-to-link">
                                            <ul>
                                                <li><a href="index.php?action=product-details&id=<?=$val['id']?>" title="Details"><i class="fa fa-external-link"></i></a></li>
                                            </ul>
                                        </div>
									</div>	
								</div>
								<!-- single-product-end -->
							<?php
                                }
                            }
                                ?>	
							
							</div>
						</div>
						<!-- new-book-area-start -->
					</div>
				
				</div>
			</div>
		</div>
		<script>
			function toForm(){
				$('#form').submit();
			}
		</script>
		<!-- product-main-area-end -->
		<?php

include 'block/footer.php';
?>