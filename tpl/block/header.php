<?php
$faq_group = new faq_group();
$faq_group->setKw(['is_show' => 1]);
$faq_group_list = $faq_group->getList();

$artist      = new artist();
$where_array = ['is_show' => 1];
$artist->setKw($where_array);
$artist->pageReNum = 20;
$artist_list       = $artist->getList();

// print_R($_SESSION);
$product = new product();
$cars    = array();
foreach ($_SESSION['Car'] as $key => $val) {
    $p_info = $product->getInfo($key);
    if (isset($p_info['id']) && $p_info['is_show'] == 1) {
        $cars[$key]['product'] = $p_info;
        $cars[$key]['num']     = $val;
    } else {
        unset($_SESSION['Car']['key']);
    }
}

?>

<body class="product-details">
	<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

	<!-- Add your site or application content here -->
	<!-- header-area-start -->
	<header>
		<!-- header-top-area-start -->
		<div class="header-top-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-12">

					</div>
					<div class="col-lg-6 col-md-6 col-12">
						<div class="account-area text-right">
							<ul>
								<?php
                                    if (isset($_SESSION['MEMBER_USER']['id'])) {
                                        ?>
								<li><a href="index.php?action=my-account">會員專區</a></li>
								<li><a href="index.php?action=logout">登出</a></li>
								<?php
                                    }
                                    if (!isset($_SESSION['MEMBER_USER']['id'])) {
                                        ?>
								<li><a href="index.php?action=login">會員登入</a></li>
								<li><a href="index.php?action=register">註冊</a></li>
								<?php
                                    }
                                    ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- header-top-area-end -->
		<!-- header-mid-area-start -->
		<div class="header-mid-area ptb-40">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-5 col-12">
						<div class="header-search">

						</div>
					</div>
					<div class="col-lg-6 col-md-4 col-12">
						<div class="logo-area text-center logo-xs-mrg">
							<a href="index.php"><img src="img/logo.png" alt="logo" /></a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-12">
						<div class="my-cart">
							<ul>
								<li><a href="#"><i class="fa fa-shopping-cart"></i>購物車</a>
									<span><?=count($cars)?></span>
									<div class="mini-cart-sub">
										<div class="cart-product">
											<?php
                                                $total = '';
                                                foreach ($cars as $car) {
                                                    $total += $car['num'] * $car['product']['price']; ?>
											<div class="single-cart">
												<div class="cart-img">
													<a
														href="index.php?action=product-details&id=<?=$car['product']['id']?>"><img
															src="<?=$car['product']['pic']?>"
															alt="<?=$car['product']['title']?>" /></a>
												</div>
												<div class="cart-info">
													<h5><a
															href="index.php?action=product-details&id=<?=$car['product']['id']?>"><?=$car['product']['title']?></a>
													</h5>
													<p> <?=$car['num']?>
														x <?=number_format($car['product']['price'])?>
													</p>
												</div>
												<div class="cart-icon">
													<!-- <a href="index.php?action=delCar&id=<?=$car['product']['id']?>"><i
														class="fa fa-remove"></i></a> -->
												</div>
											</div>
											<?php
                                                }
                                                ?>


										</div>
										<div class="cart-totals">
											<h5>總金額 <span><?=number_format($total)?></span>
											</h5>
										</div>
										<div class="cart-bottom">
											<a class="view-cart" href="index.php?action=cart">查看購物車</a>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- header-mid-area-end -->
		<!-- main-menu-area-start -->
		<div class="main-menu-area d-md-none d-none d-lg-block sticky-header-1" id="header-sticky">
			<div class="container">
				<div class="row">
					<div class="col-lg-12" style="text-align:center;">
						<div class="menu-area">
							<nav>
								<ul>
									<li class="active"><a href="index.php">首頁<i class="fa fa-angle-down"></i></a>

									</li>
									<li><a href="index.php?action=artist">明星商城<i class="fa fa-angle-down"></i></a>
										<div class="sub-menu sub-menu-2">
											<ul>
												<?php
                                                foreach ($artist_list as $val) {
                                                    echo '<li><a href="index.php?action=artist_detail&id=' . $val['id'] . '">' . $val['name'] . '</a></li>';
                                                }
                                                ?>

											</ul>
										</div>
									</li>
									<li><a href="#">常見問題<i class="fa fa-angle-down"></i></a>
										<div class="sub-menu sub-menu-2">
											<ul>
												<?php
                                                foreach ($faq_group_list as $val) {
                                                    echo '<li><a href="index.php?action=faq&group_id=' . $val['id'] . '">' . $val['title'] . '</a></li>';
                                                }
                                                ?>
											</ul>
										</div>
									</li>

									<li><a href="index.php?action=contact">廠商合作<i class="fa fa-angle-down"></i></a>
									</li>
									<li><a href="index.php?action=contact">廠商合作<i class="fa fa-angle-down"></i></a>
									</li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		</div>
		<!-- main-menu-area-end -->
		<!-- mobile-menu-area-start -->
		<div class="mobile-menu-area d-lg-none d-block fix">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="mobile-menu">
							<nav id="mobile-menu-active">
								<ul id="nav">
									<li><a href="index.php">首頁</a></li>
									<li><a href="index.php?action=artist">明星商城</a>
										<ul>
											<?php
                                                foreach ($artist_list as $val) {
                                                    echo '<li><a href="index.php?action=artist_detail&id=' . $val['id'] . '">' . $val['name'] . '</a></li>';
                                                }
                                                ?>

										</ul>
									</li>
									<li><a href="#">常見問題</a>
										<ul>
											<?php
                                                foreach ($faq_group_list as $val) {
                                                    echo '<li><a href="index.php?action=faq&group_id=' . $val['id'] . '">' . $val['title'] . '</a></li>';
                                                }
                                                ?>
										</ul>
									</li>
									<li><a href="index.php?action=contact">廠商合作</a></li>

								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- mobile-menu-area-end -->
	</header>
	<!-- header-area-end -->