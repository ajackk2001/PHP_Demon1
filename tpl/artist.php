<?php

include 'block/head.php';
include 'block/header.php';
$artist      = new artist();
$where_array = ['is_show' => 1];
$artist->setKw($where_array);
$artist->pageReNum = 100;

$list = $artist->getList();
?>
		<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="index.php">首頁</a></li>
								<li><a href="#" class="active">藝人專區</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- about-main-area-end -->
	
		<!-- team-area-start -->
		<div class="team-area pt-70 pb-40">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="team-title text-center mb-50">
							<h2>藝人專區</h2>
						</div>
					</div>
                    <?php
                    foreach ($list as $val) {
                        ?>
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
						<div class="single-team mb-30">
							<div class="team-img-area">
								<div class="team-img">
									<a href="index.php?action=artist_detail&id=<?=$val['id']?>"><img src="<?=$val['pic']?>" alt="<?=$val['name']?>" /></a>
								</div>
								
							</div>
							<div class="team-content text-center">
								<h3><?=$val['name']?></h3>
								<span><?=$val['e_name']?></span>
							</div>
						</div>
					</div>
				<?php
                    }
                ?>
				</div>
			</div>
		</div>
		<!-- team-area-end -->
		
		<?php

include 'block/footer.php';
?>