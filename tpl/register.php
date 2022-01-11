<?php

include 'block/head.php';
include 'block/header.php';
if ($_POST) {
    // if ($_POST['rememberme'] != 1) {
    //     echo jsCtrl::Alert_Location('請確認會員隱私條款是否同意', 'index.php?action=register');
    //     exit;
    // }
    if ($_POST['password'] != $_POST['password2']) {
        echo jsCtrl::Alert_Location('密碼不同請重新輸入', 'index.php?action=register');
        exit;
    }
    $member = new member();
    $check  = $member->checkUser($_POST);
    if ($check['status']) {
        echo jsCtrl::Alert_Location('帳號已經使用請重新輸入', 'index.php?action=register');
        exit;
    }
    $id = $member->add($_POST);
    if ($id) {
        echo jsCtrl::Alert_Location('註冊成功，請登入', 'index.php?action=login');
        exit;
    }
    echo jsCtrl::Alert_Location('系統發生錯誤請重新嘗試', 'index.php?action=register');
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
							<li><a href="#" class="active">註冊</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- breadcrumbs-area-end -->
	<!-- user-login-area-start -->
	<div class="user-login-area mb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="login-title text-center mb-30">
						<h2>註冊</h2>
						<p>請填寫以下註冊欄位</p>
					</div>
				</div>
				<div class="offset-lg-2 col-lg-8 col-md-12 col-12">
						<form class="" action="" method="post" id="form">
							<div class="login-form">
								<div class="single-login">
									<label>Email(登入帳號）<span>*</span></label>
									<input type="email" name="username" required/>
								</div>
								<div class="single-login">
									<label>姓名<span>*</span></label>
									<input type="text" placeholder="" name="name" required/>
								</div>
								<div class="single-login">
									<label>性別<span>*</span></label>
									<select name="gender" required>
										<option value="男">男</option>
										<option value="女">女</option>
									</select>
								</div>
								<div class="single-login">
									<label>生日<span>*</span></label>
									<input type="date" placeholder="" name="birthday" required/>
								</div>
								<div class="single-login">
									<label>電話<span>*</span></label>
									<input type="tel" placeholder="" name="tel" required/>
								</div>
								<div class="single-login">
									<label>地址<span>*</span></label>
									<input type="text" placeholder="" name="address" required/>
								</div>
								<div class="single-login">
									<label>密碼<span>*</span></label>
									<input type="password" placeholder="" name="password" required/>
								</div>
								<div class="single-login">
									<label>再次輸入密碼<span>*</span></label>
									<input type="password" placeholder="" name="password2" required/>
								</div>
								
								<input id="rememberme" type="checkbox" name="rememberme" value="1" required>
								<label class="inline">我同意<a href="index.php?action=member_text">會員隱私條款</a></label>
							
								<div class="single-login">
									<button type="sumbit" >註冊</button>
								</div>
								
								
							</div>
						</form>
					</div>
				
			</div>
		</div>
	</div>
	<!-- user-login-area-end -->
	<?php

include 'block/footer.php';
?>