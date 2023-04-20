<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta name="force-rendering" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
    <meta name="applicable-device" content="pc,mobile">
    <title>{pboot:pagetitle}</title>
    <meta name="keywords" content="{pboot:sitekeywords}" />
    <meta name="description" content="{pboot:sitedescription}" />
    <link rel="stylesheet" href="{pboot:sitetplpath}/skin/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{pboot:sitetplpath}/skin/css/style.css" type="text/css">
    <!--[if lt IE 9]><div class="fuck-ie"><p class="tips">*您的IE浏览器版本过低，为获得更好的体验请使用Chrome、Firefox或其他现代浏览器!</p></div><![endif]-->
    <script src="{pboot:sitetplpath}/skin/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="{pboot:sitetplpath}/skin/js/zblogphp.js" type="text/javascript"></script>
</head>

<body>
    <header class="header">
    <div class="h-fix">
        <div class="container">
            <h1 class="logo"> <a href="{pboot:sitepath}/" title="{pboot:pagetitle}"> <img id="light-logo" src="{pboot:sitelogo}" alt="{pboot:pagetitle}" title="{pboot:pagetitle}" /> <img id="dark-logo" src="{label:logo2}" alt="{pboot:pagetitle}" title="{pboot:pagetitle}" /> </a> </h1>
            <div id="m-btn" class="m-btn"><i class="fa fa-bars"></i></div>
            <div class="search"> <i class="s-btn off fa fa-search"></i>
                <div class="s-form"> <i class="arrow fa fa-caret-up"></i>
                    <form action="{pboot:scaction}" method="get" class="sform">
                        <input class="sinput" name="keyword" type="text" placeholder="请输入搜索词">
                        <button><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="darkmode"> <a href="javascript:switchNightMode()" target="_self" class=""><i class="fa fa-moon-o"></i></a> </div>
            <nav class="nav-bar" id="nav-box" data-type="index" data-infoid="">
                <ul class="nav">
                    <li {pboot:if(0=='{sort:scode}' )}class="active" {/pboot:if}> <a href="{pboot:sitepath}/">首页</a></li>
                    {pboot:nav num=8 parent=0}
                    <li {pboot:if('[nav:scode]'=='{sort:tcode}' )}class="active" {/pboot:if}> <a href="[nav:link]">[nav:name]</a>
                        {pboot:if([nav:soncount]>0)}
                        <ul class="sub-menu">
                            {pboot:2nav num=10 parent=[nav:scode]}
                            <li id="navbar-category-8" class="li-cate-8"><a href="[2nav:link]">[2nav:name]</a></li>
                            {/pboot:2nav}
                        </ul>
                        {/pboot:if}
                    </li>
                    {/pboot:nav}
                </ul>
            </nav>
            <div class="submit fr"> {pboot:sort scode=20}<a href="[sort:link]" target="_blank" class="a transition"><i class="fa fa-heart"></i>[sort:name]</a>{/pboot:sort} </div>
        </div>
    </div>
</header>
    <div id="mask"></div>
    <p class="index-breadcrumb"></p>
    <div id="banner-bear" class="preserve3d csstransforms3d">
        <p class="typing web-font transition">免费收录站长们的网站</p>
        <div class="primary-menus">
            <ul class="selects">
                <li>常用</li>
                <li class="current" data-target="search_1"><span>百度</span></li>
                <li data-target="search_2"><span>Bing</span></li>
                <li data-target="search_3"><span>360</span></li>
                <li data-target="search_4"><span>搜狗</span></li>
                <li data-target="search_5"><span>天猫</span></li>
                <li data-target="search_6"><span>淘宝</span></li>
                <li data-target="search_7"><span>知乎</span></li>
                <li data-target="search_8"><span>站内</span></li>
            </ul>
            <div class="cont">
                <div class="left-cont">
                    <form class="search" id="search_1" action="https://www.baidu.com/s?wd=" method="get" target="_blank">
                        <input type="text" name="wd" class="s" placeholder="请输入关键词">
                        <button type="submit" name="" class="btn">百度搜索</button>
                    </form>
                    <form class="search hidden" id="search_2" action="https://cn.bing.com/search?q=" method="get" target="_blank">
                        <input type="text" name="q" class="s" placeholder="请输入关键词">
                        <button type="submit" name="" class="btn">Bing搜索</button>
                    </form>
                    <form class="search hidden" id="search_3" action="https://www.so.com/s?q=" method="get" target="_blank">
                        <input type="text" name="q" class="s" placeholder="请输入关键词">
                        <button type="submit" name="" class="btn">360搜索</button>
                    </form>
                    <form class="search hidden" id="search_4" action="https://www.sogou.com/web?query=" method="get" target="_blank">
                        <input type="text" name="query" class="s" placeholder="请输入关键词">
                        <button type="submit" name="" class="btn">搜狗搜索</button>
                    </form>
                    <form class="search hidden" id="search_5" action="https://list.tmall.com/search_product.htm?q=" method="get" target="_blank">
                        <input type="text" name="q" class="s" placeholder="请输入关键词">
                        <button type="submit" name="" class="btn">天猫搜索</button>
                    </form>
                    <form class="search hidden" id="search_6" action="https://s.taobao.com/search?q=" method="get" target="_blank">
                        <input type="text" name="q" class="s" placeholder="请输入关键词">
                        <button type="submit" name="" class="btn">淘宝搜索</button>
                    </form>
                    <form class="search hidden" id="search_7" action="https://www.zhihu.com/search?q=" method="get" target="_blank">
                        <input type="text" name="q" class="s" placeholder="请输入关键词">
                        <button type="submit" name="" class="btn">知乎搜索</button>
                    </form>
                    <form class="search hidden" id="search_8" name="formsearch" action="{pboot:scaction}" method="get">
                        <input type="text" name="keyword" class="s" placeholder="请输入关键词">
                        <button type="submit" name="" class="btn">站内搜索</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="submit fr"> {pboot:sort scode=20}<a href="[sort:link]" target="_blank" class="a transition"><i class="fa fa-heart"></i>投稿</a>{/pboot:sort} </div>
        <div class="banner-wrap scenes-ready">
            <div id="stage">
                <div class="space"></div>
                <div class="mountains">
                    <div class="mountain mountain-1"></div>
                    <div class="mountain mountain-2"></div>
                    <div class="mountain mountain-3"></div>
                </div>
                <div class="bear"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <!-- 广告位AD1  -->
        <!-- 收录统计  -->
        <div class="row row-position">
            <div class="col-md-12">
                {pboot:sort scode=19}
                <div class="part" id="cate19" data-title="[sort:name]">
                    <p class="tt sticky"> <strong>[sort:name]</strong> <a title="更多[sort:name]" href="[sort:link]">更多+</a> </p>
                    <div class="items">
                        <div class="row">
                            {pboot:list scode=[sort:scode] num=4 order=sorting}
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <div class="item art-item transition"> <a class="art-a" href="[list:link]" title="[list:title]" target="_blank"> <img class="img-cover" src="[list:ico]" alt="[list:title]" title="[list:title]"> </a>
                                    <h3 class="art-title"><a class="" href="[list:link]" title="[list:title]" target="_blank">[list:title]</a></h3>
                                    <p>[list:description]...</p>
                                </div>
                            </div>
                            {/pboot:list}
                        </div>
                    </div>
                </div>
                {/pboot:sort}
                {pboot:nav num=6 parent=0}
                <div class="part" id="cate2" data-title="[nav:name]">
                    <p class="tt sticky"> <strong>[nav:name]</strong> <a title="更多[nav:name]" href="[nav:link]">更多+</a> </p>
                    <div class="items">
                        <div class="row">
                            {pboot:list scode=[nav:scode] num=12 order=sorting}
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <div class="item"> <a class="link" target="_blank" href="http://[list:ext_wangzhi]" rel="nofollow"><i class="autoleft fa fa-angle-right" title="直达网站"></i></a> <a class="a" href="[list:link]" title="[list:title]" target="_blank"> <img src="[list:ico]" alt="[list:title]" title="[list:title]">
                                        <h3>[list:title]</h3>
                                        <p>[list:description]...</p>
                                    </a> </div>
                            </div>
                            {/pboot:list}
                        </div>
                    </div>
                </div>
                {/pboot:nav}
            </div>
        </div>
        <div class="f-link part">
            <p class="tt"><strong>友情链接</strong></p>
            <ul id="flink" class="container">
                {pboot:link gid=1 num=100}<li><a href="[link:link]" title="[link:name]" target="_blank">[link:name]</a></li>{/pboot:link}
            </ul>
        </div>
    </div>
    <div class="footer-copyright ">
    <div class="container">
        <p> 本站收录的网站若侵害到您的利益，请联系我们删除处理！| 联系QQ：{pboot:companyqq} 请注明来意！</br>
            {pboot:sitecopyright} <a target="_blank" rel="nofollow" href="https://beian.miit.gov.cn">{pboot:siteicp}</a> <a href="{pboot:sitetplpath}/sitemap.xml" target="_blank">XML地图</a> {pboot:sitestatistical}
        </p>
        <img id="light-flogo" class="flogo" src="{pboot:sitelogo}" alt="{pboot:pagetitle}" title="{pboot:pagetitle}" /> <img id="dark-flogo" class="flogo" src="{label:logo2}" alt="{pboot:pagetitle}" title="{pboot:pagetitle}" />
    </div>
</div>
<!--提交和回顶-->
{pboot:sort scode=20}<a id="quick_submit" class="fa fa-pencil" rel="nofollow" href="[sort:link]"></a>{/pboot:sort}
<div id="backtop" class="fa fa-angle-up"></div>
<script src="{pboot:sitetplpath}/skin/js/jquery.cookie.min.js" type="text/javascript"></script>
<script src="{pboot:sitetplpath}/skin/js/main.js" type="text/javascript"></script>
    <!--初始化Swiper-->
    <script src="{pboot:sitetplpath}/skin/js/swiper.js" type="text/javascript"></script>
    <script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        centeredSlides: true,
        autoplay: 3500,
        slidesPerView: 1,
        paginationClickable: true,
        autoplayDisableOnInteraction: false,
        spaceBetween: 0,
        loop: true
    });
    </script>
    <script>
    /* tooltip.js初始化 */
    $('.autoleft').tooltip({
        align: 'autoLeft',
        fade: {
            duration: 200,
            opacity: 0.8
        }
    });
    </script>
    <script>
    /* jQuery.positionSticky.js初始化 */
    jQuery('.sticky').positionSticky({ offsetTop: 78 });
    </script>
    <!--[if lt IE 9]><script src="{pboot:sitetplpath}/skin/js/html5-css3.js"></script><![endif]-->
</body>

</html><?php return array (
  0 => 'D:/phpstudy_pro/WWW/mb.mk.me/20003/template/default/html/head.html',
  1 => 'D:/phpstudy_pro/WWW/mb.mk.me/20003/template/default/html/foot.html',
); ?>