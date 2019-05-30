<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:76:"/Users/luodiao/Sites/admin/public/../application/index/view/index/index.html";i:1557135926;s:66:"/Users/luodiao/Sites/admin/application/index/view/Common/base.html";i:1557136331;s:68:"/Users/luodiao/Sites/admin/application/index/view/Common/header.html";i:1557137283;s:68:"/Users/luodiao/Sites/admin/application/index/view/Common/footer.html";i:1557108301;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head> 
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<meta name="description" content="">
<meta name="keywords" content="" /> 
<meta name="author" content=""> 
<title><?php echo $title; ?></title>
<link href="/assets/css/index/bootstrap.min.css" rel="stylesheet">
<link href="/assets/css/index/prettyPhoto.css" rel="stylesheet"> 
<link href="/assets/css/index/font-awesome.min.css" rel="stylesheet"> 

<link href="/assets/css/index/animate.css" rel="stylesheet"> 
<link href="/assets/css/index/main.css" rel="stylesheet">
<link href="/assets/css/index/responsive.css" rel="stylesheet">




</head>
<body>
<!-- 头部开始 -->
<header id="navigation"> 
	<div class="navbar navbar-inverse navbar-fixed-top" role="banner"> 
		<div class="container"> 
			<div class="navbar-header"> 
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
					<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> 
				</button> 
				<a class="navbar-brand" href="index.html"><h1 style="color:#18a488">Author Luoio</h1></a> 
			</div> 
			<div class="collapse navbar-collapse"> 
				<ul class="nav navbar-nav navbar-right"> 
					<li class="scroll active"><a href="#">首页</a></li> 
					<li class="scroll"><a href="#">会展概况</a></li> 
					<li class="scroll"><a href="#">会展展示</a></li> 
					<li class="scroll"><a href="#">专项活动</a></li> 
					<li class="scroll"><a href="#">论坛概况</a></li> 
					<li class="scroll"><a href="#">展商指引</a></li> 
					<li class="scroll"><a href="#">同期活动</a></li> 
					<li class="scroll"><a href="#">参观指南</a></li> 
					<li class="scroll"><a href="<?php echo url('User/login'); ?>">登录/注册</a></li> 
				</ul> 
			</div> 
		</div> 
	</div><!--/navbar--> 
</header>

<!-- 头部结束 -->

<!--  内容开始 -->

<section id="home">
    <div class="home-pattern"></div>
    <div id="main-carousel" class="carousel slide" data-ride="carousel"> 
        <ol class="carousel-indicators">
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $kkk=>$vo): ?>
                <li data-target="#main-carousel" data-slide-to="<?php echo $kkk; ?>" <?php if($kkk==0): ?> class="active" <?php endif; ?>></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ol><!--/.carousel-indicators--> 
        <div class="carousel-inner">
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $kkk=>$vo): ?>
                <div class="item <?php if($kkk==0): ?>active <?php endif; ?>"> 
                    <img src="<?php echo $vo['image']; ?>" style="width:100%;height:100%">
                    <div class="carousel-caption">
                        <div>
                            <h2 class="heading animated bounceInDown"><?php echo $vo['name']; ?></h2> 
                            <p class="animated bounceInUp"><?php echo $vo['description']; ?></p> <a class="btn btn-default slider-btn animated fadeIn" href="<?php echo $vo['url']; ?>"><?php echo $vo['btnname']; ?></a> 
                        </div>
                    </div> 
                </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div> 
        <a class="carousel-left member-carousel-control hidden-xs" href="#main-carousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
        <a class="carousel-right member-carousel-control hidden-xs" href="#main-carousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
    </div><!--/.carousel-inner-->
</section><!--/#home-->

<section id="about-us">
<div class="container">
    <div class="text-center">
        <div class="col-sm-8 col-sm-offset-2">
            <h2 class="title-one">展会新闻</h2>
            <p>Exhibition information</p>
        </div>
    </div>
    <div class="about-us">
        <div class="row">
            <div class="col-sm-6">
                <h3>展会新闻</h3>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#about" data-toggle="tab"><i class="fa fa-chain-broken"></i> 热点新闻</a></li>
                    <li><a href="#mission" data-toggle="tab"><i class="fa fa-th-large"></i> 最新资讯</a></li>
                    <li><a href="#community" data-toggle="tab"><i class="fa fa-users"></i> 实时新闻</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="about">
                        <div class="media">
                            <img class="pull-left media-object" src="./assets/css/images/about-us/about.jpg" alt="about us"> 
                            <div class="media-body">
                                <h5>深度解析：创交会高度成果转化背后的秘密</h5>
                                <p>中国创新创业成果交易会自2016年落地广州后，坚持以市场为导向，以展示交易为手段，以落地转化与商业达成为目标，在成果转化上实现了非常大的突破，这少不了政府、主办方...</p>
                                <div class="col-sm-offset-3 col-sm-4 ">
                                    <a href="">查看更多</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade" id="mission">
                        <div class="media">
                            <img class="pull-left media-object" src="./assets/css/images/about-us/mission.jpg" alt="Mission"> 
                            <div class="media-body">
                                <h5>深度解析：创交会高度成果转化背后的秘密</h5>
                                <p>中国创新创业成果交易会自2016年落地广州后，坚持以市场为导向，以展示交易为手段，以落地转化与商业达成为目标，在成果转化上实现了非常大的突破，这少不了政府、主办方...</p>
                                <div class="col-sm-offset-3 col-sm-4 ">
                                    <a href="">查看更多</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="community">
                        <div class="media">
                            <img class="pull-left media-object" src="./assets/css/images/about-us/community.jpg" alt="Community"> 
                            <div class="media-body">
                                <h5>深度解析：创交会高度成果转化背后的秘密</h5>
                                <p>中国创新创业成果交易会自2016年落地广州后，坚持以市场为导向，以展示交易为手段，以落地转化与商业达成为目标，在成果转化上实现了非常大的突破，这少不了政府、主办方...</p>
                                <div class="col-sm-offset-3 col-sm-4 ">
                                    <a href="">查看更多</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <h3>平台数据</h3>
                <div class="skill-bar">
                    <div class="skillbar clearfix " data-percent="90%">
                        <div class="skillbar-title">
                            <span>成果</span>
                        </div>
                        <div class="skillbar-bar"></div>
                        <div class="skill-bar-percent">10470</div>
                    </div> <!-- End Skill Bar -->
                    <div class="skillbar clearfix" data-percent="48%">
                        <div class="skillbar-title"><span>成果单位</span></div>
                        <div class="skillbar-bar"></div>
                        <div class="skill-bar-percent">6293</div>
                    </div> <!-- End Skill Bar -->
                    <div class="skillbar clearfix " data-percent="60%">
                        <div class="skillbar-title"><span>专家</span></div>
                        <div class="skillbar-bar"></div>
                        <div class="skill-bar-percent">4152</div>
                    </div> <!-- End Skill Bar -->
                    <div class="skillbar clearfix " data-percent="99%">
                        <div class="skillbar-title"><span>今日预约</span></div>
                        <div class="skillbar-bar"></div>
                        <div class="skill-bar-percent">12470</div>
                    </div> <!-- End Skill Bar -->
                    <div class="skillbar clearfix " data-percent="76%">
                        <div class="skillbar-title"><span>撮合人数</span></div>
                        <div class="skillbar-bar"></div>
                        <div class="skill-bar-percent">2205</div>
                    </div> <!-- End Skill Bar --></div>
                </div>
            </div>
        </div>
    </div>
</section><!--/#about-us-->




<section id="services" class="parallax-section">
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-8 col-sm-offset-2">
                <h2 class="title-one title-ones">活动日程</h2>
                <p>Activity schedule</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="our-service">
                    <div class="services row col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#about1" data-toggle="tab"><i class="fa fa-chain-broken"></i> 2018年6月22日</a></li>
                            <li><a href="#about2" data-toggle="tab"><i class="fa fa-th-large"></i> 2018年6月23日</a></li>
                            <li><a href="#about3" data-toggle="tab"><i class="fa fa-users"></i> 2018年6月24日</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active " id="about1">
                                <table class="table table-bordered active">
                                    <tr>
                                        <th>主体</th>
                                        <th>时间（日期）</th>
                                        <th>地点</th>
                                    </tr>
                                    <tr>
                                        <td>中国创新创业成果交易会启动仪式</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                    <tr>
                                        <td>中国创新创业成果交易会启动仪式</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                    <tr>
                                        <td>中国创新创业成果交易会启动仪式</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                    <tr>
                                        <td>中国创新创业成果交易会启动仪式</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                    <tr>
                                        <td>中国创新创业成果交易会启动仪式</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>

                                    <tr>
                                        <td>中国创新创业成果交易会启动仪式</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                </table>
                                
                            </div>

                            <div class="tab-pane fade" id="about2">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>主体</th>
                                        <th>时间（日期）</th>
                                        <th>地点</th>
                                    </tr>
                                    <tr>
                                        <td>粤港澳大湾区创新人才建设论坛</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                    <tr>
                                        <td>粤港澳大湾区创新人才建设论坛</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                    <tr>
                                        <td>粤港澳大湾区创新人才建设论坛</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                    <tr>
                                        <td>粤港澳大湾区创新人才建设论坛</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                    <tr>
                                        <td>粤港澳大湾区创新人才建设论坛</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>粤港澳大湾区创新人才建设论坛</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="about3">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>主体</th>
                                        <th>时间（日期）</th>
                                        <th>地点</th>
                                    </tr>
                                    <tr>
                                        <td>首届“中国孵化器50强“</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                    <tr>
                                        <td>首届“中国孵化器50强“</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                    <tr>
                                        <td>首届“中国孵化器50强“</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                    <tr>
                                        <td>首届“中国孵化器50强“</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                    <tr>
                                        <td>首届“中国孵化器50强“</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>首届“中国孵化器50强“</td>
                                        <td>上午</td>
                                        <td>5.2馆主论坛区1</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--/#service-->

<section id="our-team">
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-8 col-sm-offset-2">
                <h2 class="title-one">Meet The Team</h2>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
            </div>
        </div>
        <div id="team-carousel" class="carousel slide" data-interval="false">
            <a class="member-left" href="#team-carousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="member-right" href="#team-carousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            <div class="carousel-inner team-members">
                <div class="row item active">
                    <div class="col-sm-6 col-md-3">
                        <div class="single-member">
                            <img src="./assets/css/images/our-team/member1.jpg" alt="team member" />
                            <h4>William Hurt</h4>
                            <h5>Sr. Web Developer</h5>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>
                            <div class="socials">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="single-member">
                            <img src="./assets/css/images/our-team/member2.jpg" alt="team member" />
                            <h4>Alekjandra Jony</h4>
                            <h5>Creative Designer</h5>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>
                            <div class="socials">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="single-member">
                            <img src="./assets/css/images/our-team/member3.jpg" alt="team member" />
                            <h4>Paul Johnson</h4>
                            <h5>Skilled Programmer</h5>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>
                            <div class="socials">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="single-member">
                            <img src="./assets/css/images/our-team/member4.jpg" alt="team member" />
                            <h4>John Richerds</h4>
                            <h5>Marketing Officer</h5>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>
                            <div class="socials">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row item">
                    <div class="col-sm-6 col-md-3">
                        <div class="single-member">
                            <img src="./assets/css/images/our-team/member1.jpg" alt="team member" />
                            <h4>William Hurt</h4>
                            <h5>Sr. Web Developer</h5>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>
                            <div class="socials">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="single-member">
                            <img src="./assets/css/images/our-team/member3.jpg" alt="team member" />
                            <h4>Paul Johnson</h4>
                            <h5>Skilled Programmer</h5>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>
                            <div class="socials">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="single-member">
                            <img src="./assets/css/images/our-team/member2.jpg" alt="team member" />
                            <h4>Alekjandra Jony</h4>
                            <h5>Creative Designer</h5>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>
                            <div class="socials">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="single-member">
                            <img src="./assets/css/images/our-team/member4.jpg" alt="team member" />
                            <h4>John Richerds</h4>
                            <h5>Marketing Officer</h5>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>
                            <div class="socials">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--/#Our-Team-->

<section id="portfolio">
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-8 col-sm-offset-2">
                <h2 class="title-one">Portfolio</h2>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
            </div>
        </div>
        <ul class="portfolio-filter text-center">
            <li><a class="btn btn-default active" href="#" data-filter="*">All</a></li>
            <li><a class="btn btn-default" href="#" data-filter=".html">Html</a></li>
            <li><a class="btn btn-default" href="#" data-filter=".wordpress">Wordpress</a></li>
            <li><a class="btn btn-default" href="#" data-filter=".joomla">Joomla</a></li>
            <li><a class="btn btn-default" href="#" data-filter=".megento">Megento</a></li>
        </ul><!--/#portfolio-filter-->
        <div class="portfolio-items">
            <div class="col-sm-3 col-xs-12 portfolio-item html">
                <div class="view efffect">
                    <div class="portfolio-image">
                        <img src="./assets/css/images/portfolio/1.jpg" alt=""></div> 
                        <div class="mask text-center">
                            <h3>Novel</h3>
                            <h4>Lorem ipsum dolor sit amet consectetur</h4>
                            <a href="#"><i class="fa fa-link"></i></a>
                            <a href="./assets/css/images/portfolio/big-item.jpg" data-gallery="prettyPhoto"><i class="fa fa-search-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12 portfolio-item jooma">
                    <div class="view efffect" >
                        <div class="portfolio-image">
                            <img src="./assets/css/images/portfolio/2.jpg" alt="">
                        </div> 
                        <div class="mask text-center">
                            <h3>Novel</h3>
                            <h4>Lorem ipsum dolor sit amet consectetur</h4>
                            <a href="#"><i class="fa fa-link"></i></a>
                            <a href="./assets/css/images/portfolio/big-item4.jpg" data-gallery="prettyPhoto"><i class="fa fa-search-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12 portfolio-item wordpress">
                    <div class="view efffect">
                        <div class="portfolio-image">
                            <img src="./assets/css/images/portfolio/3.jpg" alt="">
                        </div> 
                        <div class="mask text-center">
                        <h3>Novel</h3>
                        <h4>Lorem ipsum dolor sit amet consectetur</h4>
                        <a href="#"><i class="fa fa-link"></i></a>
                        <a href="./assets/css/images/portfolio/big-item.jpg" data-gallery="prettyPhoto"><i class="fa fa-search-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12 portfolio-item megento">
                <div class="view efffect">
                    <div class="portfolio-image">
                        <img src="./assets/css/images/portfolio/4.jpg" alt="">
                    </div> 
                    <div class="mask text-center">
                        <h3>Novel</h3>
                        <h4>Lorem ipsum dolor sit amet consectetur</h4>
                        <a href="#"><i class="fa fa-link"></i></a>
                        <a href="./assets/css/images/portfolio/big-item.jpg" data-gallery="prettyPhoto"><i class="fa fa-search-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12 portfolio-item html">
                <div class="view efffect">
                    <div class="portfolio-image">
                        <img src="./assets/css/images/portfolio/5.jpg" alt="">
                    </div> <div class="mask text-center">
                    <h3>Novel</h3>
                    <h4>Lorem ipsum dolor sit amet consectetur</h4>
                    <a href="#"><i class="fa fa-link"></i></a>
                    <a href="./assets/css/images/portfolio/big-item.jpg" data-gallery="prettyPhoto"><i class="fa fa-search-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-xs-12 portfolio-item wordpress">
            <div class="view efffect">
                <div class="portfolio-image">
                    <img src="./assets/css/images/portfolio/6.jpg" alt="">
                </div> 
                <div class="mask text-center">
                    <h3>Novel</h3>
                    <h4>Lorem ipsum dolor sit amet consectetur</h4>
                    <a href="#"><i class="fa fa-link"></i></a>
                    <a href="./assets/css/images/portfolio/big-item.jpg" data-gallery="prettyPhoto"><i class="fa fa-search-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-xs-12 portfolio-item html">
            <div class="view efffect">
                <div class="portfolio-image">
                    <img src="./assets/css/images/portfolio/7.jpg" alt="">
                </div> 
                <div class="mask text-center">
                    <h3>Novel</h3>
                    <h4>Lorem ipsum dolor sit amet consectetur</h4>
                    <a href="#"><i class="fa fa-link"></i></a>
                    <a href="./assets/css/images/portfolio/big-item.jpg" data-gallery="prettyPhoto"><i class="fa fa-search-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-xs-12 portfolio-item joomla">
            <div class="view efffect">
                <div class="portfolio-image">
                    <img src="./assets/css/images/portfolio/8.jpg" alt=""></div> 
                    <div class="mask text-center">
                        <h3>Novel</h3>
                        <h4>Lorem ipsum dolor sit amet consectetur</h4>
                        <a href="#"><i class="fa fa-link"></i></a>
                        <a href="./assets/css/images/portfolio/big-item.jpg" data-gallery="prettyPhoto"><i class="fa fa-search-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12 portfolio-item html">
                <div class="view efffect">
                    <div class="portfolio-image">
                        <img src="./assets/css/images/portfolio/9.jpg" alt="">
                    </div> 
                    <div class="mask text-center">
                        <h3>Novel</h3>
                        <h4>Lorem ipsum dolor sit amet consectetur</h4>
                        <a href="#"><i class="fa fa-link"></i></a>
                        <a href="./assets/css/images/portfolio/big-item.jpg" data-gallery="prettyPhoto"><i class="fa fa-search-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12 portfolio-item wordpress">
                <div class="view efffect">
                    <div class="portfolio-image">
                        <img src="./assets/css/images/portfolio/10.jpg" alt=""></div> 
                        <div class="mask text-center">
                            <h3>Novel</h3>
                            <h4>Lorem ipsum dolor sit amet consectetur</h4>
                            <a href="#"><i class="fa fa-link"></i></a>
                            <a href="./assets/css/images/portfolio/big-item.jpg" data-gallery="prettyPhoto"><i class="fa fa-search-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12 portfolio-item joomla">
                    <div class="view efffect">
                        <div class="portfolio-image">
                            <img src="./assets/css/images/portfolio/11.jpg" alt=""></div> 
                            <div class="mask text-center">
                                <h3>Novel</h3>
                                <h4>Lorem ipsum dolor sit amet consectetur</h4>
                                <a href="#"><i class="fa fa-link"></i></a>
                                <a href="./assets/css/images/portfolio/big-item3.jpg" data-gallery="prettyPhoto"><i class="fa fa-search-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12 portfolio-item megento">
                        <div class="view efffect">
                            <div class="portfolio-image">
                                <img src="./assets/css/images/portfolio/12.jpg" alt=""></div> 
                                <div class="mask text-center">
                                    <h3>Novel</h3>
                                    <h4>Lorem ipsum dolor sit amet consectetur</h4>
                                    <a href="#"><i class="fa fa-link"></i></a>
                                    <a href="./assets/css/images/portfolio/big-item4.jpg" data-gallery="prettyPhoto"><i class="fa fa-search-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 

            </section> <!--/#portfolio-->

<section id="clients" class="parallax-section">
    <div class="container">
        <div class="clients-wrapper">
            <div class="row text-center">
                <div class="col-sm-8 col-sm-offset-2">
                    <h2 class="title-one">Clients Say About Us</h2>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>
                </div>
            </div>
            <div id="clients-carousel" class="carousel slide" data-ride="carousel"> <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#clients-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#clients-carousel" data-slide-to="1"></li>
                    <li data-target="#clients-carousel" data-slide-to="2"></li>
                </ol> <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="single-client">
                            <div class="media">
                                <img class="pull-left" src="./assets/css/images/clients/client1.jpg" alt="">
                                <div class="media-body">
                                    <blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p><small>Someone famous in Source Title</small><a href="">www.yourwebsite.com</a></blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="single-client">
                            <div class="media">
                                <img class="pull-left" src="./assets/css/images/clients/client3.jpg" alt="">
                                <div class="media-body">
                                    <blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p><small>Someone famous in Source Title</small><a href="">www.yourwebsite.com</a></blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="single-client">
                            <div class="media">
                                <img class="pull-left" src="./assets/css/images/clients/client2.jpg" alt="">
                                <div class="media-body">
                                    <blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p><small>Someone famous in Source Title</small><a href="">www.yourwebsite.com</a></blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--/#clients-->

<section id="blog"> 
    <div class="container">
        <div class="row text-center clearfix">
            <div class="col-sm-8 col-sm-offset-2">
                <h2 class="title-one">Our Blog</h2>
                <p class="blog-heading">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
            </div>
        </div> 
        <div class="row">
            <div class="col-sm-4">
                <div class="single-blog">
                    <img src="./assets/css/images/blog/1.jpg" alt="" />
                    <h2>Lorem ipsum dolor sit amet</h2>
                    <ul class="post-meta">
                        <li><i class="fa fa-pencil-square-o"></i><strong> Posted By:</strong> John</li>
                        <li><i class="fa fa-clock-o"></i><strong> Posted On:</strong> Apr 15 2014</li>
                    </ul>
                    <div class="blog-content">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    </div>
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#blog-detail">Read More</a>
                </div>
                <div class="modal fade" id="blog-detail" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <img src="./assets/css/images/blog/3.jpg" alt="" />
                                <h2>Lorem ipsum dolor sit amet</h2>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="single-blog">
                    <img src="./assets/css/images/blog/2.jpg" alt="" />
                    <h2>Lorem ipsum dolor sit amet</h2>
                    <ul class="post-meta">
                        <li><i class="fa fa-pencil-square-o"></i><strong> Posted By:</strong> John</li>
                        <li><i class="fa fa-clock-o"></i><strong> Posted On:</strong> Apr 15 2014</li>
                    </ul>
                    <div class="blog-content">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    </div>
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#blog-two">Read More</a>
                </div>
                <div class="modal fade" id="blog-two" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <img src="./assets/css/images/blog/2.jpg" alt="" />
                                <h2>Lorem ipsum dolor sit amet</h2>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="single-blog">
                    <img src="./assets/css/images/blog/3.jpg" alt="" />
                    <h2>Lorem ipsum dolor sit amet</h2>
                    <ul class="post-meta">
                        <li><i class="fa fa-pencil-square-o"></i><strong> Posted By:</strong> John</li>
                        <li><i class="fa fa-clock-o"></i><strong> Posted On:</strong> Apr 15 2014</li>
                    </ul>
                    <div class="blog-content">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    </div>
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#blog-three">Read More</a>
                </div>
                <div class="modal fade" id="blog-three" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <img src="./assets/css/images/blog/3.jpg" alt="" />
                                <h2>Lorem ipsum dolor sit amet</h2>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="single-blog">
                    <img src="./assets/css/images/blog/3.jpg" alt="" />
                    <h2>Lorem ipsum dolor sit amet</h2>
                    <ul class="post-meta">
                        <li><i class="fa fa-pencil-square-o"></i><strong> Posted By:</strong> John</li>
                        <li><i class="fa fa-clock-o"></i><strong> Posted On:</strong> Apr 15 2014</li>
                    </ul>
                    <div class="blog-content">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    </div>
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#blog-four">Read More</a></div>
                    <div class="modal fade" id="blog-four" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <img src="./assets/css/images/blog/3.jpg" alt="" />
                                    <h2>Lorem ipsum dolor sit amet</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="single-blog">
                        <img src="./assets/css/images/blog/2.jpg" alt="" />
                        <h2>Lorem ipsum dolor sit amet</h2>
                        <ul class="post-meta">
                            <li><i class="fa fa-pencil-square-o"></i><strong> Posted By:</strong> John</li>
                            <li><i class="fa fa-clock-o"></i><strong> Posted On:</strong> Apr 15 2014</li>
                        </ul>
                        <div class="blog-content">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                        </div>
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#blog-six">Read More</a>
                    </div>
                    <div class="modal fade" id="blog-six" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <img src="./assets/css/images/blog/2.jpg" alt="" />
                                    <h2>Lorem ipsum dolor sit amet</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="single-blog">
                        <img src="./assets/css/images/blog/1.jpg" alt="" />
                        <h2>Lorem ipsum dolor sit amet</h2>
                        <ul class="post-meta">
                            <li><i class="fa fa-pencil-square-o"></i><strong> Posted By:</strong> John</li>
                            <li><i class="fa fa-clock-o"></i><strong> Posted On:</strong> Apr 15 2014</li>
                        </ul>
                        <div class="blog-content">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                        </div>
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#blog-seven">Read More</a>
                    </div>
                    <div class="modal fade" id="blog-seven" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <img src="./assets/css/images/blog/1.jpg" alt="" />
                                    <h2>Lorem ipsum dolor sit amet</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
    </section> <!--/#blog-->


<div>
    
</div>

<!--  内容结束 -->

<!-- 尾部开始 -->
<footer id="footer"> 
	<div class="container"> 
		<div class="text-center"> 
			<p>Copyright &copy; 2016.Company name All rights reserved.<a target="_blank" href="http://www.freemoban.com/">www.freemoban.com</a></p> 
		</div> 
	</div> 
</footer>

<!-- 尾部结束 -->

<!-- js开始 -->
<script type="text/javascript" src="/assets/js/index/jquery.js"></script> 
<script type="text/javascript" src="/assets/js/index/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/js/index/smoothscroll.js"></script> 
<script type="text/javascript" src="/assets/js/index/jquery.isotope.min.js"></script>
<script type="text/javascript" src="/assets/js/index/jquery.parallax.js"></script> 
<script type="text/javascript" src="/assets/js/index/main.js"></script> 



<!-- js结束 -->
</body>
</html>