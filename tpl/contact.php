<?php

include 'block/head.php';
include 'block/header.php';
if ($_POST) {
    $contact = new contact();
    $id      = $contact->add($_POST);
    if ($id) {
        echo jsCtrl::Alert_Location('已收到您的資料，請等待客服與您聯繫', 'index.php?action=contact');
        exit;
    }
    echo jsCtrl::Alert_Location('填寫失敗，請重新嘗試一次', 'index.php?action=contact');
    exit;
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
								<li><a href="#" class="active">聯絡我們</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		
		<!-- contact-area-start -->
		<div class="contact-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-12">
						<div class="contact-info">
							<h3>聯絡我們資訊</h3>
							<ul>
								<li>
									<i class="fa fa-map-marker"></i>
									<span>地址: </span>
									<?=$contact_config['address']?>. 							
								</li>
								<li>
									<i class="fa fa-envelope"></i>
									<span>客服電話: </span>
									<?=$contact_config['tel']?>
								</li>
								<li>
									<i class="fa fa-mobile"></i>
									<span>Email: </span>
									<a href="#"><?=$contact_config['email']?></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-12">
						<div class="contact-form">
							<h3><i class="fa fa-envelope-o"></i>詢問內容</h3>
                            <form id="contact-form" action="" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="single-form-3">
                                            <input name="name" type="text" placeholder="姓名" required>
                                        </div>
                                    </div>
									<div class="col-lg-6">
                                        <div class="single-form-3">
                                            <input name="phone" type="text" placeholder="電話" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single-form-3">
                                            <input name="email" type="email" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single-form-3">
                                            <input name="subject" type="text" placeholder="主旨" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                         <div class="single-form-3">
                                            <textarea name="content" placeholder="內容" required></textarea>
                                            <button class="submit" type="submit">發送訊息</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <p class="form-messege"></p>
						</div>	
					</div>
				</div>
			</div>
		</div>
		<!-- contact-area-end -->
		<?php

include 'block/footer.php';
?>