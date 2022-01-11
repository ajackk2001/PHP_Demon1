<?php

include 'block/head.php';
include 'block/header.php';
$text = new text();
$info = $text->getInfo(1);

?>
	
	<!-- breadcrumbs-area-start -->
	<div class="breadcrumbs-area mb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumbs-menu">
						<ul>
							<li><a href="index.php">首頁</a></li>
							<li><a href="#" class="active">會員隱私條款</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- breadcrumbs-area-end -->
	<!-- blog-main-area-start -->
	<div class="blog-main-area mb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-12 order-lg-2 order-1">
					<div class="blog-main-wrapper">
						<div class="single-blog-content">
							<div class="single-blog-title">
								<h3>會員隱私條款</h3>
							</div>
							<div class="blog-single-content">
							<?=$info['content']?>
							</div>
						</div>
						
					
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- blog-main-area-end -->
	<?php

include 'block/footer.php';
?>