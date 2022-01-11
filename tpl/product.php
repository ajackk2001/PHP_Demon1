<?php

include 'block/head.php';
include 'block/header.php';

$product_group = new product_group();
$product_group->setKw(['is_show' => 1]);
$product_group_list = $product_group->getList();

$category_list = array_column($product_group_list, 'title', 'id');

$artist      = new artist();
$artist_info = $artist->getInfo($_GET['artist_id']);
if (!$artist_info || $artist_info['is_show'] != 1) {
    echo jsCtrl::Location('index.php');
    exit;
}
$url = 'index.php?action=product&artist_id=' . $artist_info['id'];

$where_array = ['is_show' => 1, 'artist_id' => $artist_info['id']];

$group_title = '全部商品';
$breadcrumbs = '<li><a href="#" class="active">周邊商品</a></li>';

if (isset($_GET['group_id']) && isset($category_list[$_GET['group_id']])) {
    $breadcrumbs = '
	<li><a href="index.php?action=product&artist_id=' . $artist_info['id'] . '">周邊商品</a></li>
	<li><a href="#" class="active">' . $category_list[$_GET['group_id']] . '</a></li>';
    $group_title                = $category_list[$_GET['group_id']];
    $where_array['category_id'] = $_GET['group_id'];
    $url .= '&group_id=' . $_GET['group_id'];
}

$product = new product();
$product->setKw($where_array);
$product_list = $product->getPageData($_GET['p']);
// var_dump($product);

?>
	<!-- breadcrumbs-area-start -->
	<div class="breadcrumbs-area mb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumbs-menu">
						<ul>
							<li><a href="index.php">首頁</a></li>
							<li><a href="index.php?action=artist&id=<?=$artist_info['name']?>"><?=$artist_info['name']?></a></li>
							<?=$breadcrumbs?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- breadcrumbs-area-end -->
	<!-- shop-main-area-start -->
	<div class="shop-main-area mb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-12 col-12 order-lg-1 order-2 mt-sm-50 mt-xs-40">
					<div class="shop-left">
						<div class="section-title-5 mb-30">
							<h2>周邊商品</h2>
						</div>
						<div class="left-title mb-20">
							<h4>分類</h4>
						</div>
						<div class="left-menu mb-30">
							<ul>
							<?php
                            foreach ($product_group_list as $val) {
                                echo '<li><a href="index.php?action=product&artist_id=' . $artist_info['id'] . '&group_id=' . $val['id'] . '">' . $val['title'] . '<span></span></a></li>';
                            }
                            ?>
							
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-12 col-12 order-lg-2 order-1">
					<div class="category-image mb-30">
						<a href="#"><img src="<?=$artist_info['product_banner']?>" alt="banner" /></a>
					</div>
					<div class="section-title-5 mb-30">
						<h2><?=$group_title?></h2>
					</div>
					
					<!-- tab-area-start -->
					<div class="tab-content">
						<div class="tab-pane fade show active" id="th">
							<div class="row">
								<?php
                                foreach ($product_list as $val) {
                                    ?>
								<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
									<!-- single-product-start -->
									<div class="product-wrapper mb-40">
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
								</div>
								<?php
                                }
                                ?>
								
							</div>
						</div>
						
					</div>
					<!-- tab-area-end -->
					<!-- pagination-area-start -->
					<div class="pagination-area mt-50">
						<!-- <div class="list-page-2">
							<p>Items 1-9 of 11</p>
						</div> -->
						<div class="page-number">
							<ul>
							<?php
                                for ($i = 1; $i <= $product->pageCount;$i++) {
                                    echo '<li><a href="' . $url . '&p=' . $i . '" ' . ($product->p == $i ? 'class="active"' : '') . '>' . $i . '</a></li>';
                                }
                            ?>
						
								<li><a href="<?=$url . '&p=' . ($prodcut->p + 1)?>" class="angle"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div>
					</div>
					<!-- pagination-area-end -->
				</div>
			</div>
		</div>
	</div>
	<!-- shop-main-area-end -->
	<?php

include 'block/footer.php';
?>