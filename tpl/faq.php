<?php

include 'block/head.php';
include 'block/header.php';
$faq_group_info = array_column($faq_group_list, 'title', 'id');

$group = $faq_group->getInfo($_GET['group_id']);
if (!$group) {
    echo jsCtrl::Location('index.php');
    exit;
}

$faq = new faq();

$where_array = ['is_show' => 1, 'category_id' => $group['id']];
if (isset($_GET['keywords'])) {
    $where_array['keywords'] = $_GET['keywords'];
}
$faq->setKw($where_array);
$faq->pageReNum = 100;

$faq_list = $faq->getList();

?>
		<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="index.php">首頁</a></li>
								<li><a href="#">常見問題</a></li>
								<li><a href="#" class="active"><?=$group['title']?></a></li>
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
					<div class="col-lg-3 col-md-12 col-12 order-lg-1 order-2 mt-sm-50">
						<div class="single-blog mb-50">
							<div class="blog-left-title">
								<h3>搜尋</h3>
							</div>
							<div class="side-form">
								<form action="index.php" method="get" id="select">
								<input type="hidden" name="action" value="faq">
								<input type="hidden" name="group_id" value="<?=$group['id']?>">

									<input type="text" placeholder="搜尋相關問題" name="keywords" value="<?=$_GET['keywords']?>"/>
									<a href="#" onclick="toForm();"><i class="fa fa-search"  onclick="toForm();"></i></a>
								</form>
							</div>
						</div>
						<div class="single-blog mb-50">
							<div class="blog-left-title">
								<h3>分類</h3>
							</div>
							<div class="blog-side-menu">
								<ul>
								<?php
                                foreach ($faq_group_list as $val) {
                                    echo '<li><a href="index.php?action=faq&group_id=' . $val['id'] . '">' . $val['title'] . '</a></li>';
                                }
                                ?>
								
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-12 col-12 order-lg-2 order-1">
						<div class="blog-main-wrapper">
							<div class="single-blog-post">
								<?php
                                foreach ($faq_list as $val) {
                                    ?>
								<div class="single-blog-content">
									<div class="single-blog-title">
										<h3><a href="#"><?=$val['title']?></a></h3>
									</div>
									<div class="blog-single-content">
										<p><?=$val['content']?></p>
									</div>
								</div>
								<hr>
								<?php
                                }
                                ?>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			function toForm(){
				$('#select').submit();
			}
		</script>
		<!-- blog-main-area-end -->
		<?php

include 'block/footer.php';
?>