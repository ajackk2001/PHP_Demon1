<?php

include 'block/head.php';
include 'block/header.php';
$artist = new artist();
$info   = $artist->getInfo($_GET['id']);
if (!$info || $info['is_show'] != 1) {
    echo jsCtrl::Location('index.php');
    exit;
}
?>
     
		<!-- header-area-end -->
		<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="index.php">首頁</a></li>
								<li><a href="#">藝人專區</a></li>
                                <li><a href="#" class="active"><?=$info['name']?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- about-main-area-start -->
		<div class="about-main-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-12">
                        <div class="single-team mb-30">
							<div class="team-img-area">
								<div class="team-img">
									<a href="#"><img src="<?=$info['pic']?>" alt="<?=$info['name']?>" /></a>
								</div>
								<!-- <div class="team-link">
									<ul>
										<li><a href="#"><i class="fa fa-facebook"></i></a></li>
										<li><a href="#"><i class="fa fa-twitter"></i></a></li>
										<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
									</ul>
								</div> -->
							</div>
							<div class="team-content text-center">
								<h3><?=$info['name']?></h3>
								<span><?=$info['e_name']?></span>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-12">
						<div class="about-content">
                            <BR>
							<h3>關於<span><?=$info['name']?></span></h3>
							<p><?=$info['description']?></p>
							<ul>
								<li><a href="#"><i class="fa fa-check"></i>身材體重:<?=$info['size']?></a></li>
								<li><a href="#"><i class="fa fa-check"></i>所屬經紀公司:<?=$info['company']?></a></li>
								<?php
                                if ($info['instagram'] != '') {
                                    echo '<li><a href="' . $info['instagram'] . '" target="_blank"><i class="fa fa-check"></i>Instagram:前往</a></li>';
                                }
                                if ($info['facebook'] != '') {
                                    echo '<li><a href="' . $info['facebook'] . '" target="_blank"><i class="fa fa-check"></i>FackBook:前往</a></li>';
                                }
                                if ($info['youtube'] != '') {
                                    echo '<li><a href="' . $info['youtube'] . '" target="_blank"><i class="fa fa-check"></i>Youtube:前往</a></li>';
                                }
                                if ($info['web'] != '') {
                                    echo '<li><a href="' . $info['web'] . '" target="_blank"><i class="fa fa-check"></i>個人網站:前往</a></li>';
                                }
                                ?>
								
							</ul>
						</div>
						<div class="wc-proceed-to-checkout">
							<a href="index.php?action=product&artist_id=<?=$info['id']?>">前往購買周邊商品</a>
						</div>
						
						
						
					</div>
				</div>
			</div>
		</div>
		<!-- about-main-area-end -->
	
	
		<!-- skill-area-start -->
		<div class="skill-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-6 col-12">
					<div class="skill-content">
							<h3>藝人其他相關資訊</h3>
							<p><?=$info['content']?></p>
							<!-- <a href="index.php?action=product&artist_id=<?=$info['id']?>">前往購買周邊商品<i class="fa fa-long-arrow-right"></i></a> -->
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<!-- skill-area-end -->
		<?php

include 'block/footer.php';
?>
     