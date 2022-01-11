<?php

include 'block/head.php';
include 'block/header.php';

$banner = new banner();
$banner->setKw(['is_show' => 1]);
$banner_list = $banner->getList();

$banner_footer      = new banner_footer();
$banner_footer_info = $banner_footer->getInfo(1);

$artist      = new artist();
$artist_list = $artist->is_index_list();

$faq      = new faq_group();
$faq_list = $faq->is_index_list();
?>
        <!-- slider-area-start -->
        <div class="slider-area">
            <div class="slider-active owl-carousel">
               <?php
               foreach ($banner_list as $val) {
                   ?>
                <div class="single-slider pt-105 pb-225 bg-img" style="background-image:url(<?=$val['pic']?>);" onclick="location.href='<?=$val['url']?>';">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="slider-content-3 slider-animated-1 pl-295">
                                    <!--<a href="<?=$val['url']?>"><h1><?=$val['name']?><BR></h1></a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <?php
               }
               ?>
            </div>
        </div>
        <!-- slider-area-end -->
       
        <!-- product-area-start -->
        <div class="product-area pt-90 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center mb-30">
                            <h2>明星資料</h2>
                           
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <!-- tab-menu-start -->
                        <!-- <div class="tab-menu mb-40 text-center">
                            <ul class="nav justify-content-center">
                                <li><a class="active" href="#Audiobooks" data-toggle="tab">New Arrival </a></li>
                                <li><a href="#books" data-toggle="tab">OnSale</a></li>
                                <li><a href="#bussiness" data-toggle="tab">Featured Products </a></li>
                            </ul>
                        </div> -->
                        <!-- tab-menu-end -->
                    </div>
                </div>
                <!-- tab-area-start -->
                <div class="row">
                <?php
                foreach ($artist_list as $val) {
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
              <?php
              /*
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="Audiobooks">
                        <div class="tab-active owl-carousel">
                        <?php

                            foreach ($artist_list as $val) {
                                ?>
                            <div class="tab-total">
                                <!-- single-product-start -->
                                <div class="product-wrapper mb-40">
                                    <div class="product-img">
                                        <a href="index.php?action=artist_detail&id=<?=$val['id']?>">
                                            <img src="<?=$val['pic']?>" alt="<?=$val['name']?>" class="primary" />
                                        </a>
                                        <div class="quick-view">
                                            <a class="action-view" href="index.php?action=artist_detail&id=<?=$val['id']?>"  title="<?=$val['name']?>">
                                                <i class="fa fa-search-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-details text-center">
                                        <div class="product-rating">
                                        </div>
                                        <h4><a href="index.php?action=artist_detail&id=<?=$val['id']?>"><?=$val['name']?></a></h4>
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
                <?*/?>
            </div>
        </div>
        <!-- product-area-end -->

        <!-- banner-area-start -->
        <div class="banner-area-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-img-2">
                            <a href="<?=$banner_footer_info['url']?>"><img src="<?=$banner_footer_info['pic']?>" alt="banner" /></a>
                            <!-- <div class="banner-text">
                                <h3>G. Meyer Books & Spiritual Traveler Press</h3>
                                <h2>Sale up to 30% off</h2>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner-area-end -->
      
        <!-- recent-post-area-start -->
        <div class="recent-post-area pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title section-title-res pt-95 bt-3 text-center mb-30">
                            <h2>常見相關問題</h2>
                        </div>
                    </div>
                    <div class="post-active owl-carousel text-center">
                        <?php
                        foreach ($faq_list as $val) {
                            ?>
                        <div class="col-lg-12">
                            <div class="single-post">
                                <div class="post-img">
                                    <a href="index.php?action=faq&group_id=<?=$val['id']?>"><img src="<?=$val['pic']?>" alt="<?=$val['title']?>" /></a>
                                </div>
                                <div class="post-content">
                                    <h3><a href="index.php?action=faq&group_id=<?=$val['id']?>"><?=$val['title']?></a></h3>
                                    <p><?=$val['content']?></p>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                        }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- recent-post-area-end -->
      
        <!-- social-group-area-start -->
        <!-- <div class="social-group-area ptb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="section-title-3">
                            <h3>Latest Tweets</h3>
                        </div>
                        <div class="twitter-content">
                            <div class="twitter-icon">
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </div>
                            <div class="twitter-text">
                                <p>
                                    Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum notare quam
                                </p>
                                <a href="#">koparion</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="section-title-3">
                            <h3>Stay Connected</h3>
                        </div>
                        <div class="link-follow">
                            <ul>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fa fa-flickr"></i></a></li>
                                <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- social-group-area-end -->
        <?php

include 'block/footer.php';
?>