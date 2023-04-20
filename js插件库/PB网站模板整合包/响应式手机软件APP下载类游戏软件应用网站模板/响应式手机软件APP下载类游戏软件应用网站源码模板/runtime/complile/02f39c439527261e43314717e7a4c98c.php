
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">
<meta name="force-rendering" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
<meta name="applicable-device" content="pc,mobile">
<title>{sort:title}</title>
<meta name="keywords" content="{sort:keywords}">
<meta name="description" content="{sort:description}">
<link href="{pboot:sitedomain}/skin/css/font.css" rel="stylesheet">
<link href="{pboot:sitedomain}/skin/css/style.css" rel="stylesheet">
<link href="{pboot:sitedomain}/skin/css/swiper.min.css" rel="stylesheet">
<link href="{pboot:sitedomain}/skin/css/lightgallery.min.css" rel="stylesheet">
<script src="{pboot:sitedomain}/skin/js/jquery.min.js"></script>
<script src="{pboot:sitedomain}/skin/js/zblogphp.js" type="text/javascript"></script>
</head>
<body>
<header id="header" class="header header-fixed sb">
  <div class="h-wrap container clearfix">
    <div class="logo-area fl"> <a href="{pboot:sitedomain}/" title="{pboot:sitetitle}"> <img class="img" src="{pboot:sitelogo}" alt="{pboot:sitetitle}" title="{pboot:sitetitle}"/> </a> </div>
    <div class="m-nav-btn"><i class="iconfont icon-menu"></i></div>
    <nav class="responsive-nav">
      <div class="pc-nav m-nav fl" data-type="article"  data-infoid="9">
		  <ul class="nav-ul">
		    <li><a class="{pboot:if(0=='{sort:scode}')}active{/pboot:if}" href="{pboot:sitedomain}/">首页</a></li>
		    {pboot:nav num=10 parent=0}
		    <li><a {pboot:if('[nav:scode]'=='{sort:tcode}')} class="active"{/pboot:if} href="[nav:link]">[nav:name]</a></li>
		    {/pboot:nav}
		  </ul>
      </div>
    </nav>
    <span id="search-button" class="search-button hidden fr"><i class="iconfont icon-search"></i></span>
    <div id="search-area" class="container br">
      <form  class="searchform clearfix" action="{pboot:scaction}" method="get">
        <input class="s-input br fl" type="text" name="keyword" placeholder="请输入关键词...">
        <button class="s-button fr br iconfont icon-search" type="submit" id="submit"></button>
      </form>
    </div>
  </div>
</header>
<nav class="breadcrumb container ellipsis"> {pboot:position}</nav>
<div id="content" class="content container clearfix">
  <div id="mainbox" class="article-box fl mb">
    <article class="art-main sb br">
      <div class="art-head mb">
        <h1 class="art-title">{content:title}</h1>
        <div class="head-info">
			<span class="author"><i class="iconfont icon-user"></i>{content:author}</span>
			<time class="time" datetime="{content:date}" title="{content:date}"> <i class="iconfont icon-time"></i>{content:date}</time>
			<span class="view hidden-sm-md-lg"><i class="iconfont icon-view"></i>{content:visits}</span></div>
      </div>
      <!-- 广告位AD2  -->
      <div class="art-content" id="maximg">
		  {content:content}
      </div>
    </article>
  </div>
  <aside id="sidebar" class="hidden-sm-md-lg fr">
  <div class="theiaStickySidebar">
    <section id="top10" class="widget widget_top10 sb br mb">
      <ul class="widget-content top10">
        <div class="table_card">
          <ul class="tab">
            <li class="active">热门应用</li>
            <li>热门游戏</li>
          </ul>
          <div class="tabCon">
            <ul class="list on">
              {pboot:list order=visits scode=5 num=8}
              <li class="item">
                <div class="clearfix"> <span class="fl iconfont icon-top10 list list-[list:i]"><small>[list:i]</small></span> <a class="thumbnail fl" href="[list:link]" title="[list:title]"> <img class="img img-cover br" src="[list:ico]" alt="[list:title]" title="[list:title]"> </a>
                  <div class="fr-wrap">
                    <div class="title-wrap">
                      <h2 class="title ellipsis"> <a href="[list:link]" title="[list:title]">[list:title]</a> </h2>
                      <p class="intro br clearfix ellipsis"> [list:visits]人看过 </p>
                    </div>
                  </div>
                </div>
              </li>
              {/pboot:list}
            </ul>
            <ul class="list">
              {pboot:list order=visits scode=6 num=8}
              <li class="item">
                <div class="clearfix"> <span class="fl iconfont icon-top10 list list-[list:i]"><small>[list:i]</small></span> <a class="thumbnail fl" href="[list:link]" title="[list:title]"> <img class="img img-cover br" src="[list:ico]" alt="[list:title]" title="[list:title]"> </a>
                  <div class="fr-wrap">
                    <div class="title-wrap">
                      <h2 class="title ellipsis"> <a href="[list:link]" title="[list:title]">[list:title]</a> </h2>
                      <p class="intro br clearfix ellipsis"> [list:visits]人看过 </p>
                    </div>
                  </div>
                </div>
              </li>
              {/pboot:list}
            </ul>
          </div>
        </div>
      </ul>
    </section>
    <section id="divTags" class="widget widget_tags sb br mb">
      <p class="c-title mb10"><span class="name">标签列表</span></p>
      <ul class="widget-content divTags">
        {pboot:tags num=30}
        <li><a target="_blank" href="[tags:link]" title="[tags:text]">[tags:text]</a></li>
        {/pboot:tags}
      </ul>
    </section>
  </div>
</aside>

</div>
<footer class="footer">
  <div class="main container">
    <div class="f-about"> {pboot:sitecopyright}  {pboot:sitestatistical} <a href="https://beian.miit.gov.cn" rel="nofollow" target="_blank">{pboot:siteicp}</a> <a href="{pboot:sitedomain}/sitemap.xml">XML地图</a> <a href="https://www.pb2345.com/" target="_blank">PBOOTCMS网站模板</a> </div>
  </div>
  <div id="toolbar" class="toolbar ">
    <div id="totop" class="btn hidden br transition"><i class="iconfont icon-totop"></i></div>
  </div>
</footer>


<div id="mask-hidden" class="mask-hidden transition"></div>
<script src="{pboot:sitedomain}/skin/js/common.js"></script> 
<script src="{pboot:sitedomain}/skin/js/headroom.min.js"></script> 
<script src="{pboot:sitedomain}/skin/js/swiper.min.js"></script> 
<script type="text/javascript">
	$(document).ready(function(e) {
		$(".table_card .tab li").click(function() {
			$(".table_card .tab li").eq($(this).index()).addClass("active").siblings().removeClass("active");
			$(".table_card .tabCon ul").hide().eq($(this).index()).show();
		})
	});
</script> 
<script>
    var swiper2 = new Swiper('.swiper-container', {
    pagination: '.swiper-pagination',
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev', 
    slidesPerView: 3,
    paginationClickable: true,
    spaceBetween: 20
});
</script> 
<script src="{pboot:sitedomain}/skin/js/lightgallery.min.js"></script> 
<script src="{pboot:sitedomain}/skin/js/lg-thumbnail.min.js"></script> 
<script src="{pboot:sitedomain}/skin/js/lg-zoom.min.js"></script> 
<script>
    lightGallery(document.getElementById('lightgallery'));
</script> 
<script>
    $("#wrong-btn").click(function () {
        $("html, body").animate({scrollTop: $($(this).attr("href")).offset().top -20+ "px"}, 500);
        return false;
    });
</script> 
<!--[if lt IE 9]><script src="{pboot:sitedomain}/skin/js/html5shiv.min.js"></script><![endif]-->
</body>
</html><?php return array (
  0 => 'D:/wwwroot/www.shangye1.com/template/default/comm/header.html',
  1 => 'D:/wwwroot/www.shangye1.com/template/default/comm/position.html',
  2 => 'D:/wwwroot/www.shangye1.com/template/default/comm/sidebar_list.html',
  3 => 'D:/wwwroot/www.shangye1.com/template/default/comm/footer.html',
); ?>