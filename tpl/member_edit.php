<?php

include 'block/head.php';
include 'block/header.php';
if (!isset($_SESSION['MEMBER_USER']['id'])) {
    echo jsCtrl::Location('index.php');
    exit;
}
$member = new member();
$info   = $member->getInfo($_SESSION['MEMBER_USER']['id']);
if ($_POST) {
    $member->edit($_POST, $_SESSION['MEMBER_USER']['id']);
    echo jsCtrl::Alert_Location('修改會員資料成功', 'index.php?action=member_edit');
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
								<li><a href="#" class="active">會員中心</a></li>
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
							<h2>會員中心</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- entry-header-area-end -->
		<!-- my account wrapper start -->
        <div class="my-account-wrapper mb-70">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- My Account Page Start -->
                            <div class="myaccount-page-wrapper">
                                <!-- My Account Tab Menu Start -->
                                <div class="row">
                                <?php
                                include 'block/member_menu.php';
                                ?>
                                    <!-- My Account Tab Menu End -->

                                    <!-- My Account Tab Content Start -->
                                    <div class="col-lg-9 col-md-8">
                                        <div class="tab-content" id="myaccountContent">
                                            <!-- Single Tab Content Start -->
                                            <div class="tab-pane fade show active" id="account-info" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h5>修改個人資料</h5>
                                                    <div class="account-details-form">
                                                        <form action="#">
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">帳號 </label>
                                                            <input type="email" id="email" placeholder="Email" value="<?=$info['username']?>" disabled/>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="name" class="required">姓名</label>
                                                                    <input type="text" id="name" placeholder="姓名" name="name" value="<?=$info['name']?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="gender" class="required">性別</label>
                                                                    <input type="text" id="gender" placeholder="女" name="gender" value="<?=$info['gender']?>" />
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="tel" class="required">電話</label>
                                                                    <input type="text" id="tel" placeholder="電話" name="tel" value="<?=$info['tel']?>" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="birthday" class="required">生日</label>
                                                                    <input type="date" id="birthday" placeholder="生日" name="birthday" value="<?=$info['birthday']?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="single-input-item">
                                                                    <label for="addresse" class="required">地址</label>
                                                                    <input type="text" id="address" placeholder="地址" value="<?=$info['address']?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            
                                                           
                                                        <fieldset>
                                                            <legend>更改密碼（無填寫則不更改）</legend>
                                                            
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="new-pwd" class="required">新密碼</label>
                                                                        <input type="password" id="new-pwd" placeholder="新密碼" name="password"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="confirm_pwd" class="required">再次輸入新密碼</label>
                                                                        <input type="password" id="confirm_pwd" placeholder="再次輸入新密碼"  name="confirm_pwd"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <div class="single-input-item">
                                                            <button class="btn btn-sqr">修改資料</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> <!-- Single Tab Content End -->
                                        </div>
                                    </div> <!-- My Account Tab Content End -->
                                </div>
                            </div> <!-- My Account Page End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- my account wrapper end -->
		<?php

include 'block/footer.php';
?>