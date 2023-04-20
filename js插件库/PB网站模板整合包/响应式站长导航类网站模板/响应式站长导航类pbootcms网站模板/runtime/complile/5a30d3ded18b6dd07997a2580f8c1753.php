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
    <meta name="keywords" content="{pboot:pagekeywords}">
    <meta name="description" content="{pboot:pagedescription}">
    <link rel="stylesheet" href="{pboot:sitetplpath}/skin/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{pboot:sitetplpath}/skin/css/style.css?ver=3.72" type="text/css">
    <!--[if lt IE 9]><div class="fuck-ie"><p class="tips">*您的IE浏览器版本过低，为获得更好的体验请使用Chrome、Firefox或其他现代浏览器!</p></div><![endif]-->
    <script src="{pboot:sitetplpath}/skin/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="{pboot:sitetplpath}/skin/js/zblogphp.js" type="text/javascript"></script>
    <style type="text/css"></style>
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
    <div class="breadnav">
        <div class="container bread"> <i class="fa fa-home"></i>{pboot:position separator=>>} </div>
    </div>
    <div class="container">
        <div class="part">
            <div class="bar clearfix">
                <h1 class="tt">{content:title}</h1>
                <div class="r-intro fr"> <span class="data fr"> <small class="info"><i class="fa fa-clock-o"></i>{content:date}</small> <small class="info"><i class="fa fa-eye"></i>{content:visits}</small> </span> </div>
            </div>
            <div class="items">
                <div class="art-main"> {content:content}
                    <div class="art-copyright br mb">
                        <div>本文地址：<a href="{pboot:pageurl}" title="{content:title}" target="_blank">{pboot:pageurl}</a></div>
                        <div><span class="copyright">版权声明：</span>除非特别标注，否则均为本站原创文章，转载时请以链接形式注明文章出处。</div>
                    </div>
                    <p class="art-tag">相关标签： <span class="padding"> {pboot:tags id=[list:id] scode={sort:tcode}}<a class="transition tags" href="[tags:link]" title="[tags:text]">[tags:text]</a> {/pboot:tags} </span> </p>
                </div>
            </div>
        </div>
        <!-- 广告位AD3  -->
        <div class="part related">
            <p class="tt"><span>相关推荐</span></p>
            <div class="items">
                <div class="row">
                    {pboot:list scode={sort:scode} num=4}
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="item art-item transition"> <a class="art-a" href="[list:link]" title="[list:title]" target="_blank"> <img class="img-cover" src="[list:ico]" alt="[list:title]" title="[list:title]"> </a>
                            <h3><a class="" href="[list:link]" title="[list:title]" target="_blank">[list:title]</a></h3>
                            <p>[list:description]...</p>
                        </div>
                    </div>
                    {/pboot:list}
                </div>
            </div>
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
    <!--[if lt IE 9]><script src="{pboot:sitetplpath}/skin/js/html5-css3.js"></script><![endif]-->
</body>

</html><?php return array (
  0 => 'D:/phpstudy_pro/WWW/mb.mk.me/20003/template/default/html/head.html',
  1 => 'D:/phpstudy_pro/WWW/mb.mk.me/20003/template/default/html/foot.html',
); ?>