<?php

include 'block/head.php';
include 'block/header.php';
if (!isset($_SESSION['MEMBER_USER']['id'])) {
    echo jsCtrl::Location('index.php');
    exit;
}
$order = new order();
$list  = $order->getUserOrder($_SESSION['MEMBER_USER']['id'], 1);
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
                                            <div class="tab-pane fade show active" id="orders" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h5>訂單資料</h5>
                                                    <div class="myaccount-table table-responsive text-center">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>訂單序號</th>
                                                                    <th>日期</th>
                                                                    <th>訂單狀態</th>
                                                                    <th>金額</th>
                                                                    <th>操作</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                foreach ($list as $key => $val) {
                                                                    echo '
                                                                    <tr>
                                                                        <td>' . $val['order_number'] . '</td>
                                                                        <td>' . $val['insert_time'] . '</td>
                                                                        <td>' . $pay_status[$val['pay_status']] . '</td>
                                                                        <td>$' . number_format($val['total']) . '</td>
                                                                        <td><a href="index.php?action=order_detail&id=' . $val['order_number'] . '" class="btn btn-sqr">查看</a>
                                                                        </td>
                                                                    </tr>
                                                                    ';
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Single Tab Content End -->
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