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
    <style type="text/css">
    .page-tips {
        padding: 10px;
        line-height: 2em;
        padding-left: 20px;
        background: rgb(255, 255, 249) none repeat scroll 0% 0%;
        border-radius: 6px;
        box-sizing: border-box;
        border: 1px solid rgb(249, 231, 224);
    }
    .art-main>p {
        display: none;
    }
    .submit-form {
        margin-top: 20px;
    }
    .submit-form .item {
        margin-bottom: 20px;
    }
    .submit-form input.post-btn {
        border: 1px solid #dadfec;
        color: #6b7386;
        background: #f1f5f8;
        text-align: center;
        height: 42px;
        line-height: 42px;
        border-radius: 3px;
        width: 204px;
        display: block;
        margin-top: 5px;
        cursor: pointer
    }
    .submit-form input.post-btn:hover {
        border: 1px solid #6b7386;
        background: #6b7386;
        color: #fff;
    }
    .submit-form input {
        height: 36px;
        line-height: 36px;
        width: 40%;
        border-radius: 3px;
        border: 1px solid #dadada;
        padding-left: 5px;
    }
    .submit-form .intro {
        opacity: .6;
        padding-left: 10px;
    }
    .submit-form textarea {
        width: 100%;
        height: 130px;
        border: 1px solid #d7dae0;
        border-radius: 5px;
    }
    input.z_vcode {
        width: 10% !important;
    }
    #reg_verfiycode {
        border: 1px solid #dadada !important;
        height: 36px !important;
        margin-left: -2px;
        display: inline-block;
        border-radius: 3px;
    }
    @media (max-width:1200px) {
        .submit-form input {
            width: 100%;
        }
        input.z_vcode {
            width: 50% !important;
        }
    }
    @media (max-width:768px) {
        .post-btn {
            width: 100%;
        }
    }
    .submit-form .item .edui-editor {
        z-index: 1 !important;
    }
    </style>
    <link rel="stylesheet" href="{pboot:sitetplpath}/skin/css/style2.css" type="text/css">
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
        <div class="container bread"> <i class="fa fa-home"></i>{pboot:position separator=>>}</div>
    </div>
    <div class="container">
        <div class="page part">
            <h1 class="tt"> <span>申请收录</span> <span class="data fr"> </span> </h1>
            <div class="items">
                <div class="art-main">
                    <p>1<br />
                    </p>
                    <form action="{pboot:msgaction}" method="post">
                        <div class="page-tips">
                            <font color="red">注：违规站点（黄、赌、毒）禁止提交，如有发现永久删除</font></br>
                            <strong>一、自动网址提交</strong></br>
                            本站标题【站长导航】</br>
                            本站链接【{pboot:httpurl}】</br>
                            请将本站添加为您网站的友情链接；</br>
                            从您的网站访问至本站；本站便会自动收录您的网站，并帮您发布一个页面；</br>
                            <strong>二、手动网址提交</strong></br>
                            按照下面表格如实填写网站信息并提交，等待审核完毕，本站将为您创建一个页面并发布你的站点。
                        </div>
                        <div class="submit-form">
                            <p class="item"><span class="title">网站标题</span><br>
                                <input class="z_title" id="" size="100" name="biaoti" type="text" placeholder="必填" required>
                            </p>
                            <p class="item"><span class="title">网站图标(url)</span><br>
                                <input name="tubiao" class="tubiao" id="" size="100" type="text" placeholder="必填" required>
                            </p>
                            <p class="item"><span class="title">网站地址</span><br>
                                <input name="wangzhi" id="" class="z_meta" size="100" type="text" placeholder="必填" required>
                            </p>
                            <p class="item"><span class="title">所属分类</span><br>
                                <select name="fenlei" class="z_cate" onchange="document.formname.fenlei.value=this.value">
                                    <option value="">--请选择分类--</option>
                                    {pboot:nav}
                                    <option value="[nav:name]">[nav:name]</option>
                                    {pboot:2nav parent=[nav:scode]}
                                    <option value="[2nav:name]">—[2nav:name]</option>
                                    {/pboot:2nav}
                                    {/pboot:nav}
                                </select>
                            </p>
                            <p class="item"><span class="title">网站介绍<span class="intro">(必填，请认真填写！)</span></span><br>
                                <textarea id="newstext" name="content" required></textarea>
                            </p>
                            <p class="item">
                                <button class="post-btn" type="submit" id="tj">提交</button>
                            </p>
                        </div>
                    </form>
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