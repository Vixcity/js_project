<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">
<meta name="force-rendering" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
<meta name="applicable-device" content="pc,mobile">
<title>{pboot:sitetitle}</title>
<meta name="keywords" content="{pboot:sitekeywords}">
<meta name="description" content="{pboot:sitedescription}">
<link href="{pboot:sitedomain}/skin/css/font.css" rel="stylesheet">
<link href="{pboot:sitedomain}/skin/css/style.css" rel="stylesheet">
<link href="{pboot:sitedomain}/skin/css/swiper.min.css" rel="stylesheet">
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
<p class="index-breadcrumb"></p>
<div id="index-content" class="content container"> 
  <!-- 广告位AD1  --> 
  <!-- 首页顶部推荐  -->
  <div id="top_recommend" class="related-item sb br mb"> <span class="tips">推荐</span>
    <ul class="ul clearfix">
      {pboot:list isrecommend=1 scode=5,6 num=10 page=0}
      <li class="item fl"> <a class="thumbnail" href="[list:link]" title="[list:title]"> <img class="img-cover br" src="[list:ico]" alt="[list:title]" title="[list:title]"> </a>
        <h2 class="title ellipsis"><a href="[list:link]" title="[list:title]">[list:title]</a><span class="sub ellipsis">[list:visits]人看过</span></h2>
        <a rel="nofollow" class="download br" href="[list:link]">下载</a> </li>
      {/pboot:list}
    </ul>
  </div>
  <div class="clearfix">
    <div id="index-right" class="index-right hidden-sm-md-lg fr">
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
        <section id="divPrevious" class="widget widget_previous sb br mb">
          <p class="c-title mb10"><span class="name">最近发表</span></p>
          <ul class="widget-content divPrevious">
            {pboot:list order=date scode=2,3,4 num=10}
            <li><a href="[list:link]">[list:title len=14]</a></li>
            {/pboot:list}
          </ul>
        </section>
        <section id="divComments" class="widget widget_comments sb br mb">
          <p class="c-title mb10"><span class="name">最新资讯</span></p>
          <ul class="widget-content divComments">
            {pboot:list order=date scode=2,3,4 num=5}
            <li class="list clearfix"> <span class="avatar fl"><a href="[list:link]"><img src="[list:ico]" alt="[list:title]" title="[list:title]"></a></span>
              <div class="title"> <a class="a ellipsis" href="[list:link]" title="查阅详情">[list:title]</a>
                <div class="info ellipsis"> <span class="time"><i class="iconfont icon-time"></i>[list:date style=m-d]</span> </div>
              </div>
            </li>
            {/pboot:list}
          </ul>
        </section>
      </div>
    </div>
    <div id="index-middle" class="fr mr">
      <div class="swiper-container br">
        <ul class="swiper-wrapper">
          {pboot:slide gid=1 num=8}
          <li class="swiper-slide"> <a class="link" href="[slide:link]" title="[slide:title]">
            <p class="p ellipsis">[slide:subtitle]</p>
            <img src="[slide:src]" alt="[slide:title]" /> </a> </li>
          {/pboot:slide}
        </ul>
        <div class="swiper-pagination"></div>
        <div class="hidden-sm-md-lg swiper-button-next iconfont icon-right"></div>
        <div class="hidden-sm-md-lg swiper-button-prev iconfont icon-left"></div>
      </div>
      <section> 
      {pboot:sort scode=2}
        <div id="middle_2" class="wrap sb br mb clearfix">
          <p class="c-title"> <span>[sort:name]</span> <a class="more" href="[sort:link]" title="更多[sort:name]">更多</a> </p>
          {pboot:list scode=[sort:scode] num=1}
          <article class="item top">
            <h2 class="top-title ellipsis"><a href="[list:link]" title="[list:title]">[list:title]</a></h2>
            <p class="intro multi-ellipsis"> <i class="iconfont icon-yin"></i> [list:description lencn=80] </p>
          </article>
          {/pboot:list}
          {pboot:list scode=[sort:scode] start=2 num=28}
          <article class="item fl">
            <h2 class="title ellipsis"><i class="iconfont icon-dot"></i><a href="[list:link]" title="[list:title]">[list:title]</a></h2>
          </article>
          {/pboot:list} </div>
        {/pboot:sort} </section>
      <section> {pboot:sort scode=6}
        <div id="middle_1" class="wrap sb br mb clearfix">
          <p class="c-title"> <span>[sort:name]</span> <a class="more" href="[sort:link]" title="更多[sort:name]">更多</a> </p>
          {pboot:list scode=[sort:scode] num=15}
          <article class="item fl"> <a class="thumbnail" href="[list:link]" title="[list:title]"> <img class="img-cover br" src="[list:ico]" alt="[list:title]" title="[list:title]"> </a>
            <h2 class="title ellipsis"><a href="[list:link]" title="[list:title]">[list:title]</a><span class="sub ellipsis">[list:visits]次查看</span></h2>
            <a rel="nofollow" class="download br" href="[list:link]">下载</a> </article>
          {/pboot:list} </div>
        {/pboot:sort}
        {pboot:sort scode=5}
        <div id="middle_1" class="wrap sb br mb clearfix">
          <p class="c-title"> <span>[sort:name]</span> <a class="more" href="[sort:link]" title="更多[sort:name]">更多</a> </p>
          {pboot:list scode=[sort:scode] num=15}
          <article class="item fl"> <a class="thumbnail" href="[list:link]" title="[list:title]"> <img class="img-cover br" src="[list:ico]" alt="[list:title]" title="[list:title]"> </a>
            <h2 class="title ellipsis"><a href="[list:link]" title="[list:title]">[list:title]</a><span class="sub ellipsis">[list:visits]次查看</span></h2>
            <a rel="nofollow" class="download br" href="[list:link]">下载</a> </article>
          {/pboot:list} </div>
        {/pboot:sort} </section>
    </div>
    <div id="index-left" class="fr mr">
      <section id="left_1" class="sb br mb">
        <p class="c-title mb10"><span>每日一荐</span></p>
        <div class="br mb">
          <div class="wrap clearfix"> {pboot:list isheadline=1 scode=5,6 num=1}
            <article class="item fl">
              <div class="clearfix"> <a class="thumbnail fl" href="[list:link]" title="[list:title]"> <img class="img img-cover br" src="[list:ico]" alt="[list:title]" title="[list:title]"> </a>
                <div class="fr-wrap">
                  <div class="title-wrap">
                    <h2 class="title ellipsis"> <a href="[list:link]" title="[list:title]">[list:title]</a> </h2>
                    <a class="category transition br" href="[list:sortlink]"> [list:sortname]</a>
                    <div class="div"><a rel="nofollow" class="download brightness transition br" href="[list:link]">下载</a></div>
                  </div>
                </div>
              </div>
              <p class="intro br clearfix multi-ellipsis">[list:description len=32]</p>
            </article>
            {/pboot:list} </div>
        </div>
      </section>
      <section id="left_2" class="sb br mb"> {pboot:sort scode=3}
        <div class="clearfix">
          <div class="br">
            <p class="c-title mb10"> <span>[sort:name]</span> <a class="more" href="[sort:link]" title="更多[sort:name]">更多</a> </p>
            {pboot:list scode=[sort:scode] num=1}
            <article class="item mb10"> <a class="thumbnail" href="[list:link]" title="[list:title]"> <img class="img-cover br" src="[list:ico]" alt="[list:title]" title="[list:title]">
              <div class="absolute">
                <p class="p-title ellipsis">[list:title]</p>
              </div>
              <i class="mask br"></i> </a> </article>
            {/pboot:list}
            <ul class="ul">
              {pboot:list scode=[sort:scode] start=2 num=12}
              <li class="title clearfix"> <a class="a ellipsis fl" href="[list:link]" title="[list:title]"> <i class="iconfont icon-dot"></i>[list:title]</a> </li>
              {/pboot:list}
            </ul>
          </div>
        </div>
        {/pboot:sort} </section>
      <section> {pboot:sort scode=6}
        <div id="left_3" class="wrap sb br mb">
          <p class="c-title"> <span>手游排行</span> </p>
          {pboot:list scode=[sort:scode] num=5}
          <article class="item">
            <div class="clearfix"> <a class="thumbnail fl" href="[list:link]" title="[list:title]"> <img class="img img-cover br" src="[list:ico]" alt="[list:title]" title="[list:title]"> </a>
              <div class="fr-wrap">
                <div class="title-wrap">
                  <h2 class="title ellipsis"> <a href="[list:link]" title="[list:title]">[list:title]</a> </h2>
                  <p class="intro br clearfix ellipsis">[list:description]</p>
                </div>
              </div>
            </div>
          </article>
          {/pboot:list} <a class="more" href="[sort:link]">查看全部></a> </div>
        {/pboot:sort}
        {pboot:sort scode=5}
        <div id="left_3" class="wrap sb br mb">
          <p class="c-title"> <span>软件排行</span> </p>
          {pboot:list scode=[sort:scode] num=5}
          <article class="item">
            <div class="clearfix"> <a class="thumbnail fl" href="[list:link]" title="[list:title]"> <img class="img img-cover br" src="[list:ico]" alt="[list:title]" title="[list:title]"> </a>
              <div class="fr-wrap">
                <div class="title-wrap">
                  <h2 class="title ellipsis"> <a href="[list:link]" title="[list:title]">[list:title]</a> </h2>
                  <p class="intro br clearfix ellipsis">[list:description]</p>
                </div>
              </div>
            </div>
          </article>
          {/pboot:list} <a class="more" href="[sort:link]">查看全部></a> </div>
        {/pboot:sort} </section>
    </div>
  </div>
  {pboot:sort scode=4}
  <div id="full-post" class="sb br mb">
    <p class="c-title mb10"> <span>[sort:name]</span> <a class="more" href="[sort:link]" title="更多[sort:name]">更多</a> </p>
    <div class="clearfix"> {pboot:list scode=[sort:scode] num=8}
      <article class="item fl"> <a class="thumbnail" href="[list:link]" title="[list:title]"> <img class="img-cover br" src="[list:ico]" alt="[list:title]" title="[list:title]">
        <div class="absolute">
          <p class="p-title ellipsis">[list:title]</p>
        </div>
        <i class="mask br"></i> </a> </article>
      {/pboot:list} </div>
  </div>
  {/pboot:sort}
  <div id="shuoming-post" class="sb br mb"> <img src="{pboot:sitelogo}"/>
    <p class="shuoming-title">{label:bottom}</p>
  </div>
  <div class="flink sb br mb">
    <p class="c-title">友情链接</p>
    <ul id="flink" class="f-list clearfix">
      {pboot:link  gid=1 num=50}
      <li><a href="[link:link]" target="_blank">[link:name]</a> </li>
      {/pboot:link}
    </ul>
  </div>
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
<script type="text/javascript">
			$(document).ready(function(e) {
				$(".table_card .tab li").click(function() {
					$(".table_card .tab li").eq($(this).index()).addClass("active").siblings().removeClass("active");
					$(".table_card .tabCon ul").hide().eq($(this).index()).show();
				})
			});
		</script> 
<!--[if lt IE 9]><script src="{pboot:sitedomain}/skin/js/html5shiv.min.js"></script><![endif]-->
</body>
</html>
<?php return array (
  0 => 'D:/wwwroot/www.shangye1.com/template/default/comm/header.html',
  1 => 'D:/wwwroot/www.shangye1.com/template/default/comm/footer.html',
); ?>