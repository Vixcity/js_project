<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="renderer"  content="webkit">
  <title><?php echo CMSNAME;?>管理中心-V<?php echo APP_VERSION;?>-<?php echo RELEASE_TIME;?></title>
  <link rel="shortcut icon" href="<?php echo SITE_DIR;?>/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="<?php echo APP_THEME_DIR;?>/layui/css/layui.css?v=v2.5.4">
  <link rel="stylesheet" href="<?php echo APP_THEME_DIR;?>/font-awesome/css/font-awesome.min.css?v=v4.7.0" type="text/css">
  <link rel="stylesheet" href="<?php echo APP_THEME_DIR;?>/css/comm.css?v=v3.0.6">
  <link href="<?php echo APP_THEME_DIR;?>/css/jquery.treetable.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="<?php echo APP_THEME_DIR;?>/js/jquery-1.12.4.min.js"></script>
  <script type="text/javascript" src="<?php echo APP_THEME_DIR;?>/js/jquery.treetable.js"></script>
</head>

<body class="layui-layout-body">

<!--定义部分地址方便JS调用-->
<div style="display: none">
	<span id="controller" data-controller="<?php echo C;?>"></span>
	<span id="url" data-url="<?php echo URL;?>"></span>
	<span id="preurl" data-preurl="<?php echo url('/admin',false);?>"></span>
	<span id="sitedir" data-sitedir="<?php echo SITE_DIR;?>"></span>
	<span id="mcode" data-mcode="<?php echo get('mcode');?>"></span>
</div>

<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">
    <a href="<?php echo \core\basic\Url::get('/admin/Index/home');?>">
    <img src="<?php echo APP_THEME_DIR;?>/images/logo.png" height="30">
	    <?php echo CMSNAME;?> 
	   	<?php if (LICENSE==3) {?>
	   		<span class="layui-badge">SVIP</span>
	   	<?php } else { ?>
	   		<span class="layui-badge layui-bg-gray">V<?php echo APP_VERSION;?></span>	
	   	<?php } ?>
    </a>
    </div>
    
    <ul class="menu">
    	<li class="menu-ico" title="显示或隐藏侧边栏"><i class="fa fa-bars" aria-hidden="true"></i></li>
	</ul>
	<?php if (!$this->getVar('one_area')) {?>
	<form method="post" action="<?php echo \core\basic\Url::get('/admin/Index/area');?>" class="area-select">
		<input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
		<div class="layui-col-xs8">
		   <select name="acode">
		       <?php echo $this->getVar('area_html');?>
		   </select>
		</div>
		<div class="layui-col-xs4">
		 	<button type="submit" class="layui-btn layui-btn-sm">切换</button>
		</div>
   	</form>
 	<?php } ?>

    <ul class="layui-nav layui-layout-right">
    
       <li class="layui-nav-item layui-hide-xs">
      	 <a href="<?php echo SITE_DIR;?>/" target="_blank"><i class="fa fa-home" aria-hidden="true"></i> 网站主页</a>
       </li>

       <li class="layui-nav-item layui-hide-xs">
       		<a href="<?php echo \core\basic\Url::get('/admin/Index/clearCache');?>" class="ajaxlink"><i class="fa fa-trash-o" aria-hidden="true"></i> 清理缓存</a>
       </li>
       
       <li class="layui-nav-item layui-hide-xs">
	        <a href="javascript:;">
	          <i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo session('realname');?>
	        </a>
	        <dl class="layui-nav-child">
	          <dd><a href="<?php echo \core\basic\Url::get('/admin/Index/ucenter');?>"><i class="fa fa-address-card-o" aria-hidden="true"></i> 密码修改</a></dd>
	          <dd><a href="<?php echo \core\basic\Url::get('/admin/Index/loginOut');?>"><i class="fa fa-sign-out" aria-hidden="true"></i> 退出登录</a></dd>
	          <?php if (session('ucode')==10001) {?>
	          	<dd><a href="<?php echo \core\basic\Url::get('/admin/Upgrade/index');?>"><i class="fa fa-cloud-upload" aria-hidden="true"></i> 在线更新</a></dd>
	          	<dd><a href="<?php echo \core\basic\Url::get('/admin/Index/clearSession');?>" class="ajaxlink"><i class="fa fa-trash-o" aria-hidden="true"></i> 清理会话</a></dd>
	          <?php } ?>
	        </dl>
      </li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree" id="nav" lay-shrink="all">
	   <?php $num = 0;foreach ($this->getVar('menu_tree') as $key => $value) { $num++;?>
        <li class="layui-nav-item nav-item <?php if ($this->getVar('primary_menu_url')==$value->url) {?>layui-nav-itemed<?php } ?>">
          <a class="" href="javascript:;"><i class="fa <?php echo $value->ico; ?>" aria-hidden="true"></i><?php echo $value->name; ?></a>
          <dl class="layui-nav-child">
			<?php if ($value->mcode=='M130') {?>
				 <?php $num3 = 0;foreach ($this->getVar('menu_models') as $key3 => $value3) { $num3++;?>
				 	<?php if ($value3->type==1) {?>
						<dd><a href="<?php echo \core\basic\Url::get('/admin/Single/index/mcode/'.$value3->mcode.'');?>"><i class="fa fa-file-text-o" aria-hidden="true"></i><?php echo $value3->name; ?>内容</a></dd>
					<?php } ?>
					<?php if ($value3->type==2) {?>
						<dd><a href="<?php echo \core\basic\Url::get('/admin/Content/index/mcode/'.$value3->mcode.'');?>"><i class="fa fa-file-text-o" aria-hidden="true"></i><?php echo $value3->name; ?>内容</a></dd>
					<?php } ?>
				 <?php } ?>
			<?php } else { ?>
				<?php $num2 = 0;foreach ($value->son as $key2 => $value2) { $num2++;?>
					<?php if (!isset($value2->status)|| $value2->status==1) {?>
	            		<dd><a href="<?php echo \core\basic\Url::get(''.$value2->url.'');?>"><i class="fa <?php echo $value2->ico; ?>" aria-hidden="true"></i><?php echo $value2->name; ?></a></dd>
	            	<?php } ?>
				<?php } ?>
				
				<?php if ($value->mcode=='M101' && session('ucode')==10001) {?>
					<dd><a href="<?php echo \core\basic\Url::get('/admin/Upgrade/index');?>"><i class="fa fa-cloud-upload" aria-hidden="true"></i>在线更新</a></dd>
				<?php } ?>
		    <?php } ?>
          </dl>
        </li>
		<?php } ?>
		
		<li style="height:1px;background:#666" class="layui-hide-sm"></li>
		
		<li class="layui-nav-item layui-hide-sm">
		 <a href="<?php echo SITE_DIR;?>/" target="_blank"><i class="fa fa-home" aria-hidden="true"></i> 网站主页</a>
		</li>
		
		<li class="layui-nav-item layui-hide-sm">
          <a href="<?php echo \core\basic\Url::get('/admin/Index/ucenter');?>"><i class="fa fa-address-card-o" aria-hidden="true"></i> 资料修改</a>
        </li>
        
        <li class="layui-nav-item layui-hide-sm">
         <a href="<?php echo \core\basic\Url::get('/admin/Index/clearCache');?>"><i class="fa fa-trash-o" aria-hidden="true"></i> 清理缓存</a>
        </li>
        
        <li class="layui-nav-item layui-hide-sm">
         <a href="<?php echo \core\basic\Url::get('/admin/Index/loginOut');?>"><i class="fa fa-sign-out" aria-hidden="true"></i> 退出登录</a>
        </li>

      </ul>
    </div>
  </div>

<div class="layui-body">
	<div class="layui-tab layui-tab-brief" lay-filter="tab">
	  <ul class="layui-tab-title">
	    <li class="layui-this" lay-id="t1">基本配置</li>
	    <li  lay-id="t2">邮件通知</li>
	    <li  lay-id="t3">百度接口</li>
	    <li  lay-id="t4">WebAPI</li>
	    <li  lay-id="t5">图片水印</li>
	    <li  lay-id="t6">安全配置</li>
	    <li  lay-id="t7">URL规则</li>
	    <li  lay-id="t8">标题样式</li>
	    <li  lay-id="t9">会员配置</li>
	  </ul>
		  <div class="layui-tab-content">
		  	   <div class="layui-tab-item layui-show">
		  	   	   <form action="<?php echo \core\basic\Url::get('/admin/Config/index');?>" method="post" class="layui-form">
			  	   	   <input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
			  	   	   
			  	   	    <div class="layui-form-item">
		                     <label class="layui-form-label">网站状态</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="close_site" value="1" <?php if ($this->vars['configs']['close_site']['value']==1) {?> checked="checked" <?php } ?> title="关闭">
								<input type="radio" name="close_site" value="0" <?php if ($this->vars['configs']['close_site']['value']==0) {?> checked="checked" <?php } ?> title="开启">
		                     </div>
		                </div>
		                
			  	   	     <div class="layui-form-item">
		                     <label class="layui-form-label">关站提示</label>
		                     <div class="layui-input-inline">
		                     	<textarea name="close_site_note" placeholder="" class="layui-textarea"><?php echo @$this->vars['configs']['close_site_note']['value'];?></textarea>
		                     </div> 
		                </div>
		                
		  	   		 	<div class="layui-form-item">
		                     <label class="layui-form-label">独立手机版</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="open_wap" value="1" <?php if ($this->vars['configs']['open_wap']['value']==1) {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="open_wap" value="0" <?php if ($this->vars['configs']['open_wap']['value']==0) {?> checked="checked" <?php } ?> title="禁用">
								<span class="layui-icon layui-icon-about tips" data-content="使用响应式模板的用户请不要开启！"></span>
		                     </div>
		                </div>
		                
		                 <div class="layui-form-item">
		                     <label class="layui-form-label">手机版域名绑定</label>
		                     <div class="layui-input-inline">
		                     	<input type="text" name="wap_domain"  value="<?php echo @$this->vars['configs']['wap_domain']['value'];?>" placeholder="如：m.xxx.com"  class="layui-input">
		                     </div>
		                </div>

		                <div class="layui-form-item">
		                     <label class="layui-form-label">动态缓存</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="tpl_html_cache" value="1" <?php if ($this->vars['configs']['tpl_html_cache']['value']==1) {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="tpl_html_cache" value="0" <?php if ($this->vars['configs']['tpl_html_cache']['value']==0) {?> checked="checked" <?php } ?> title="禁用">
		                     	<span class="layui-icon layui-icon-about tips" data-content="本功能效果接近生成静态，开启后将提高前端访问速度及并发能力！"></span>
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">缓存有效期(秒)</label>
		                     <div class="layui-input-inline">
		                     	<input type="text" name="tpl_html_cache_time"  value="<?php echo @$this->vars['configs']['tpl_html_cache_time']['value'];?>" placeholder="请输入缓存有效期（秒）"  class="layui-input">
		                     </div>
		                     <div class="layui-form-mid layui-word-aux">秒</div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">Gzip页面压缩</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="gzip" value="1" <?php if ($this->vars['configs']['gzip']['value']==1) {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="gzip" value="0" <?php if ($this->vars['configs']['gzip']['value']==0) {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">会话文件路径</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="session_in_sitepath" value="1" <?php if ($this->vars['configs']['session_in_sitepath']['value']==1) {?> checked="checked" <?php } ?> title="站内">
								<input type="radio" name="session_in_sitepath" value="0" <?php if ($this->vars['configs']['session_in_sitepath']['value']==0) {?> checked="checked" <?php } ?> title="系统">
								<span class="layui-icon layui-icon-about tips" data-content="站内则使用站点下runtime路径，系统则使用操作系统的缓存路径！"></span>
		                     </div>
		                </div>
		                
		               <div class="layui-form-item">
		                     <label class="layui-form-label">跨语言自动切换</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="lgautosw" value="1" <?php if ($this->vars['configs']['lgautosw']['value']=='1'||$this->vars['configs']['lgautosw']['value']=='') {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="lgautosw" value="0" <?php if ($this->vars['configs']['lgautosw']['value']=='0') {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">记录蜘蛛访问</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="spiderlog" value="1" <?php if ($this->vars['configs']['spiderlog']['value']=='1'||$this->vars['configs']['spiderlog']['value']=='') {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="spiderlog" value="0" <?php if ($this->vars['configs']['spiderlog']['value']=='0') {?> checked="checked" <?php } ?> title="禁用">
		                     	<span class="layui-icon layui-icon-about tips" data-content="开启后自动在系统日志进行记录！"></span>
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">自动转HTTPS</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="to_https" value="1" <?php if ($this->vars['configs']['to_https']['value']==1) {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="to_https" value="0" <?php if ($this->vars['configs']['to_https']['value']==0) {?> checked="checked" <?php } ?> title="禁用">
		                     	<span class="layui-icon layui-icon-about tips" data-content="访问非HTPPS地址时自动跳转！"></span>
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">自动转主域名</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="to_main_domain" value="1" <?php if ($this->vars['configs']['to_main_domain']['value']==1) {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="to_main_domain" value="0" <?php if ($this->vars['configs']['to_main_domain']['value']==0) {?> checked="checked" <?php } ?> title="禁用">
		                     	<span class="layui-icon layui-icon-about tips" data-content="访问非主域名地址时自动跳转！"></span>
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">网站主域名</label>
		                     <div class="layui-input-inline">
		                     	<input type="text" name="main_domain"  value="<?php echo @$this->vars['configs']['main_domain']['value'];?>" placeholder="如：www.xxx.com"  class="layui-input">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">分页数字条数量</label>
		                     <div class="layui-input-inline">
		                     	<input type="text" name="pagenum"  value="<?php echo @$this->vars['configs']['pagenum']['value'];?>" placeholder="请输入前端分页数字条显示数量"  class="layui-input">
		                     </div>
		                     <div class="layui-form-mid layui-word-aux">条</div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">内链替换次数</label>
		                     <div class="layui-input-inline">
		                     	<input type="text" name="content_tags_replace_num"  value="<?php echo @$this->vars['configs']['content_tags_replace_num']['value'];?>" placeholder="请输入文章内链替换次数，默认3次"  class="layui-input">
		                     </div>
		                     <div class="layui-form-mid layui-word-aux">次</div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">敏感词过滤</label>
		                     <div class="layui-input-inline">
		                     	<textarea name="content_keyword_replace" placeholder="请输入需要过滤的关键词，多个之间逗号隔开" class="layui-textarea"><?php echo @$this->vars['configs']['content_keyword_replace']['value'];?></textarea>
		                     	<div class="layui-form-mid layui-word-aux">注：多个敏感词之间用逗号隔开！</div>
		                     </div>
		                     
		                </div>
		                
		                <?php if (LICENSE<2) {?>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">系统授权码</label>
		                     <div class="layui-input-inline">
		                     	<input type="text" name="sn"  value="<?php echo @$this->vars['configs']['sn']['value'];?>" placeholder="请输入授权码，多个授权码用逗号隔开"  class="layui-input">
		                     </div>
		                </div>
		                
		                 <div class="layui-form-item">
		                     <label class="layui-form-label">授权码手机</label>
		                     <div class="layui-input-inline">
		                     	<input type="text" name="sn_user"  value="<?php echo @$this->vars['configs']['sn_user']['value'];?>" placeholder="请购买了万能授权码的用户填写"  class="layui-input">
		                     </div>
		                </div>
		                
		                <?php } ?>
		                
		                <div class="layui-form-item">
							 <div class="layui-input-block">
							    <button class="layui-btn" lay-submit name="submit" value="basic">立即提交</button>
							    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
							 </div>
						</div>
	              </form>
		  	   </div>
		  	   
		  	   <div class="layui-tab-item">
		  	   	   <form action="<?php echo \core\basic\Url::get('/admin/Config/index');?>" method="post" class="layui-form">
			  	   	    <input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
		                
		                <div class="layui-form-item">
			                   <label class="layui-form-label">服务器状态 </label>
			                   <div class="layui-input-block" style="line-height:36px;">
									stream_socket_client函数<i class="layui-icon layui-icon-ok-circle" style="color: <?php  echo function_exists('stream_socket_client')?'#5FB878':'#f2f2f2';?>"></i>&nbsp;&nbsp;&nbsp; 
									fsockopen函数 <i class="layui-icon layui-icon-ok-circle" style="color: <?php  echo function_exists('fsockopen')?'#5FB878':'#f2f2f2';?>"></i>
									<span class="layui-icon layui-icon-about tips" data-content="至少需要支持其中一个函数才能正常使用！"></span>
			                   </div>
			             </div>
			             
			 	   		<div class="layui-form-item">
			                    <label class="layui-form-label">SMTP服务器</label>
			                   <div class="layui-input-inline">
			                   	<input type="text" name="smtp_server" value="<?php echo @$this->vars['configs']['smtp_server']['value'];?>" placeholder="请输入SMTP服务器" class="layui-input">
			                   </div>
			             </div>
				  	   
			
			  	   		<div class="layui-form-item">
			                    <label class="layui-form-label">SMTP端口</label>
			                   <div class="layui-input-inline">
			                   	<input type="text" name="smtp_port" value="<?php echo @$this->vars['configs']['smtp_port']['value'];?>" placeholder="请输入SMTP端口,一般SSL为465，普通为25" class="layui-input">
			                   </div>
			             </div>
				  	   
				  	    <div class="layui-form-item">
			                <label class="layui-form-label">是否为SSL</label>
			                <div class="layui-input-block">
			                   	<input type="radio" name="smtp_ssl" value="1" <?php if ($this->vars['configs']['smtp_ssl']['value']==1) {?> checked="checked" <?php } ?> title="是">
								<input type="radio" name="smtp_ssl" value="0" <?php if ($this->vars['configs']['smtp_ssl']['value']==0) {?> checked="checked" <?php } ?> title="否">
			           		</div>
			           </div>
			           
			   			<div class="layui-form-item">
			                  <label class="layui-form-label">邮箱账号</label>
			                 <div class="layui-input-inline">
			                 	<input type="text" name="smtp_username"  value="<?php echo @$this->vars['configs']['smtp_username']['value'];?>" placeholder="请输入邮箱账号" class="layui-input">
			                 </div>
			            </div>
			   
			   			<div class="layui-form-item">
			                  <label class="layui-form-label">邮箱密码</label>
			                 <div class="layui-input-inline">
			                 	<input type="password" name="smtp_password" value="<?php echo @$this->vars['configs']['smtp_password']['value'];?>" placeholder="请输入邮箱密码或邮箱授权码" class="layui-input">
			                 </div>
			            </div>
			            
						<div class="layui-form-item">
			                  <label class="layui-form-label">测试账号</label>
			                 <div class="layui-input-inline">
			                 	<input type="text" name="smtp_username_test" id="smtp_username_test" value="<?php echo @$this->vars['configs']['smtp_username_test']['value'];?>" placeholder="请输入用于接受测试邮件的账号" class="layui-input">
			                 </div>
			            </div>
		            
		                <div class="layui-form-item">
		                     <label class="layui-form-label">留言发送邮件</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="message_send_mail" value="1" <?php if ($this->vars['configs']['message_send_mail']['value']==1) {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="message_send_mail" value="0" <?php if ($this->vars['configs']['message_send_mail']['value']==0) {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">表单发送邮件</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="form_send_mail" value="1" <?php if ($this->vars['configs']['form_send_mail']['value']==1) {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="form_send_mail" value="0" <?php if ($this->vars['configs']['form_send_mail']['value']==0) {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">评论发送邮件</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="comment_send_mail" value="1" <?php if ($this->vars['configs']['comment_send_mail']['value']==1) {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="comment_send_mail" value="0" <?php if ($this->vars['configs']['comment_send_mail']['value']==0) {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">信息接收邮箱</label>
		                     <div class="layui-input-inline">
		                     	<input type="text" name="message_send_to"  value="<?php echo @$this->vars['configs']['message_send_to']['value'];?>" placeholder="请输入信息接收邮箱"  class="layui-input">
		                     </div>
		                </div>
		                
						 <div class="layui-form-item">
							 <div class="layui-input-block">
							    <button class="layui-btn" lay-submit name="submit" value="email">立即提交</button>
							    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
							    <a href="<?php echo \core\basic\Url::get('/admin/Config/index/action/sendemail');?>" onclick="return sendtest(this,'#smtp_username_test')" class="layui-btn layui-btn-primary">发送测试邮件</a>
							 </div>
						</div>
						<script>
					    	function sendtest(obj,to){
					    		$(obj).attr('href',$(obj).attr('href')+'&to='+$(to).val()); 
					    		return true;
					    	}
					    </script>
	              </form>
		  	   </div>
		  	   
		  	   <div class="layui-tab-item">
		  	   	   <form action="<?php echo \core\basic\Url::get('/admin/Config/index');?>" method="post" class="layui-form">
			  	   	    <input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">普通收录token</label>
		                     <div class="layui-input-inline">
		                     	<input type="text" name="baidu_zz_token"  value="<?php echo @$this->vars['configs']['baidu_zz_token']['value'];?>" placeholder="请输入普通收录token"  class="layui-input">
		                     </div>
		                     <span class="layui-icon layui-icon-about tips" data-content="请到百度站长中心获取！"></span>
		                </div>

		               <div class="layui-form-item">
		                     <label class="layui-form-label">快速收录token</label>
		                     <div class="layui-input-inline">
		                     	<input type="text" name="baidu_ks_token"  value="<?php echo @$this->vars['configs']['baidu_ks_token']['value'];?>" placeholder="请输入快速收录token"  class="layui-input">
		                     </div>
		                     <span class="layui-icon layui-icon-about tips" data-content="请到百度站长中心获取！"></span>
		               </div>
		               
		           
		                <div class="layui-form-item">
							 <div class="layui-input-block">
							    <button class="layui-btn" lay-submit name="submit" value="baidu">立即提交</button>
							    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
							 </div>
						</div>
	              </form>
		  	   </div>
		  	   
		  	   <div class="layui-tab-item">
		  	   	  <form action="<?php echo \core\basic\Url::get('/admin/Config/index');?>" method="post" class="layui-form">
		  	   	  	<input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
		  	   		<div class="layui-form-item">
	                     <label class="layui-form-label">API状态</label>
	                     <div class="layui-input-block">
	                     	<input type="radio" name="api_open" value="1" <?php if (@$this->vars['configs']['api_open']['value']==1) {?> checked="checked" <?php } ?> title="启用">
							<input type="radio" name="api_open" value="0" <?php if (@$this->vars['configs']['api_open']['value']==0) {?> checked="checked" <?php } ?> title="禁用">
	                     </div>
	                </div>
	                
	                <div class="layui-form-item">
	                     <label class="layui-form-label">API强制认证</label>
	                     <div class="layui-input-block">
	                     	<input type="radio" name="api_auth" value="1" <?php if (@$this->vars['configs']['api_auth']['value']==1) {?> checked="checked" <?php } ?> title="启用">
							<input type="radio" name="api_auth" value="0" <?php if (@$this->vars['configs']['api_auth']['value']==0) {?> checked="checked" <?php } ?> title="禁用">
	                     </div>
	                </div>
	                
	                <div class="layui-form-item">
	                      <label class="layui-form-label">API认证用户</label>
	                     <div class="layui-input-inline">
	                     	<input type="text" name="api_appid" value="<?php echo @$this->vars['configs']['api_appid']['value'];?>" placeholder="请输入API认证用户名" class="layui-input">
	                     </div>
	                </div>
	                
	                 <div class="layui-form-item">
	                      <label class="layui-form-label">API认证密钥</label>
	                     <div class="layui-input-inline">
	                     	<input type="password" name="api_secret" value="<?php echo @$this->vars['configs']['api_secret']['value'];?>" placeholder="请输入API认证密钥"  class="layui-input">
	                     </div>
	                </div>
	                
	                <div class="layui-form-item">
						 <div class="layui-input-block">
						    <button class="layui-btn" lay-submit name="submit" value="api">立即提交</button>
						    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
						 </div>
					</div>
				 </form>
		  	   </div> 
		  	   
		  	    <div class="layui-tab-item">
		  	   	  <form action="<?php echo \core\basic\Url::get('/admin/Config/index');?>" method="post" class="layui-form">
		  	   	  	<input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
		  	   		<div class="layui-form-item">
	                     <label class="layui-form-label">状态</label>
	                     <div class="layui-input-block">
	                     	<input type="radio" name="watermark_open" value="1" <?php if (@$this->vars['configs']['watermark_open']['value']==1) {?> checked="checked" <?php } ?> title="启用">
							<input type="radio" name="watermark_open" value="0" <?php if (@$this->vars['configs']['watermark_open']['value']==0) {?> checked="checked" <?php } ?> title="禁用">
	                     </div>
	                </div>
	                
	                <div class="layui-form-item">
	                      <label class="layui-form-label">水印文字</label>
	                     <div class="layui-input-inline">
	                     	<input type="text" name="watermark_text" value="<?php echo @$this->vars['configs']['watermark_text']['value'];?>" placeholder="请输入水印文字，如：XXXCMS" class="layui-input">
	                     </div>
	                </div>
					
					<div class="layui-form-item">
	                     <label class="layui-form-label">文字字体</label>
	                     <div class="layui-input-inline">
	                     	<input type="text" name="watermark_text_font" id="watermark_text_font" value="<?php echo @$this->vars['configs']['watermark_text_font']['value'];?>" placeholder="请上传水印文字字体"  class="layui-input">
	                     </div>
	                     <button type="button" class="layui-btn file" data-des="watermark_text_font">
						 	 <i class="layui-icon">&#xe67c;</i>上传字体
						 </button>
	                </div>
	                
	                <div class="layui-form-item">
	                      <label class="layui-form-label">文字大小</label>
	                     <div class="layui-input-inline">
	                     	<input type="text" name="watermark_text_size" value="<?php echo @$this->vars['configs']['watermark_text_size']['value'];?>" placeholder="请输入水印文字大小，如：20" class="layui-input">
	                     </div>
	                </div>
	                
	                <div class="layui-form-item">
	                      <label class="layui-form-label">文字颜色</label>
	                     <div class="layui-input-inline">
	                     	<input type="text" name="watermark_text_color" value="<?php echo @$this->vars['configs']['watermark_text_color']['value'];?>" placeholder="请输入水印文字颜色，如：100,100,100" class="layui-input">
	                     </div>
	                </div>
	                
	                <div class="layui-form-item">
	                     <label class="layui-form-label">水印图片</label>
	                     <div class="layui-input-inline">
	                     	<input type="text" name="watermark_pic" id="watermark_pic" value="<?php echo @$this->vars['configs']['watermark_pic']['value'];?>" placeholder="请上传水印图片，优先文字水印"  class="layui-input">
	                     </div>
	                     <button type="button" class="layui-btn upload" data-des="watermark_pic">
						 	 <i class="layui-icon">&#xe67c;</i>上传图片
						 </button>
						 <div id="watermark_pic_box" class="pic"><dl><dt><?php if (@$this->vars['configs']['watermark_pic']['value']) {?><img src="<?php echo SITE_DIR;?><?php echo @$this->vars['configs']['watermark_pic']['value'];?>" data-url="<?php echo @$this->vars['configs']['watermark_pic']['value'];?>"></dt><dd>删除</dd></dl><?php } ?></div>
	                </div>
	                
	                <div class="layui-form-item">
	                     <label class="layui-form-label">水印位置</label>
	                     <div class="layui-input-block">
	                     	<input type="radio" name="watermark_position" value="1" <?php if (@$this->vars['configs']['watermark_position']['value']==1) {?> checked="checked" <?php } ?> title="左上">
	                     	<input type="radio" name="watermark_position" value="2" <?php if (@$this->vars['configs']['watermark_position']['value']==2) {?> checked="checked" <?php } ?> title="右上">
							<input type="radio" name="watermark_position" value="3" <?php if (@$this->vars['configs']['watermark_position']['value']==3) {?> checked="checked" <?php } ?> title="左下">
	                     	<input type="radio" name="watermark_position" value="4" <?php if (@$this->vars['configs']['watermark_position']['value']==4) {?> checked="checked" <?php } ?> title="右下">
	                     	<input type="radio" name="watermark_position" value="5" <?php if (@$this->vars['configs']['watermark_position']['value']==5) {?> checked="checked" <?php } ?> title="中间">
	                     </div>
	                </div>

	                <div class="layui-form-item">
						 <div class="layui-input-block">
						    <button class="layui-btn" lay-submit name="submit" value="watermark">立即提交</button>
						    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
						 </div>
					</div>
				 </form>
		  	   </div> 
		  	   
		  	    <div class="layui-tab-item">
		  	   	   <form action="<?php echo \core\basic\Url::get('/admin/Config/index');?>" method="post" class="layui-form">
			  	   	   <input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 

		                <div class="layui-form-item">
		                     <label class="layui-form-label">留言功能</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="message_status" value="1" <?php if ($this->vars['configs']['message_status']['value']=='1'||$this->vars['configs']['message_status']['value']=='') {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="message_status" value="0" <?php if ($this->vars['configs']['message_status']['value']=='0') {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">留言验证码</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="message_check_code" value="1" <?php if ($this->vars['configs']['message_check_code']['value']=='1'||$this->vars['configs']['message_check_code']['value']=='') {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="message_check_code" value="0" <?php if ($this->vars['configs']['message_check_code']['value']=='0') {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">留言审核</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="message_verify" value="1" <?php if ($this->vars['configs']['message_verify']['value']=='1'||$this->vars['configs']['message_verify']['value']=='') {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="message_verify" value="0" <?php if ($this->vars['configs']['message_verify']['value']=='0') {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">留言需登录</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="message_rqlogin" value="1" <?php if ($this->vars['configs']['message_rqlogin']['value']==1) {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="message_rqlogin" value="0" <?php if ($this->vars['configs']['message_rqlogin']['value']==0) {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">表单功能</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="form_status" value="1" <?php if ($this->vars['configs']['form_status']['value']=='1'||$this->vars['configs']['form_status']['value']=='') {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="form_status" value="0" <?php if ($this->vars['configs']['form_status']['value']=='0') {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">表单验证码</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="form_check_code" value="1" <?php if ($this->vars['configs']['form_check_code']['value']=='1'||$this->vars['configs']['form_check_code']['value']=='') {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="form_check_code" value="0" <?php if ($this->vars['configs']['form_check_code']['value']=='0') {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>

			            <div class="layui-form-item">
		                   <label class="layui-form-label">模板子目录</label>
		                   <div class="layui-input-inline">
		                  		<input type="text" name="tpl_html_dir" value="<?php echo @$this->vars['configs']['tpl_html_dir']['value'];?>" placeholder="首次请手动移动模板文件到填写的目录！" class="layui-input">
		                   </div>
		                   <span class="layui-icon layui-icon-about tips" data-content="一定程度上防盗，如填 html，则默认模板情况下路径为 default/html 目录！"></span>
			            </div>
			            
			           <div class="layui-form-item">
		                     <label class="layui-form-label">IP黑名单</label>
		                     <div class="layui-input-inline">
		                     	<textarea name="ip_deny" placeholder="请输入需要禁止访问的IP，多个之间逗号隔开，IP地址支持使用/掩码位数模式，如：192.168.1.0/24, 192.168.2.100" class="layui-textarea"><?php echo @$this->vars['configs']['ip_deny']['value'];?></textarea>
		                     </div> 
		                     <span class="layui-icon layui-icon-about tips" data-content="请输入需要禁止访问的IP，多个之间逗号隔开，IP地址支持使用/掩码位数模式，如：192.168.1.0/24, 192.168.2.100"></span>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">IP白名单</label>
		                     <div class="layui-input-inline">
		                     	<textarea name="ip_allow" placeholder="请输入需要允许访问的IP，多个之间逗号隔开，IP地址支持使用/掩码位数模式，如：192.168.1.0/24, 192.168.2.100" class="layui-textarea"><?php echo @$this->vars['configs']['ip_allow']['value'];?></textarea>
		                     </div> 
		                      <span class="layui-icon layui-icon-about tips" data-content="请输入需要允许访问的IP，多个之间逗号隔开，IP地址支持使用/掩码位数模式，如：192.168.1.0/24,192.168.2.100"></span>
		                </div>
		                
		                <hr>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">后台验证码</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="admin_check_code" value="1" <?php if ($this->vars['configs']['admin_check_code']['value']=='1'||$this->vars['configs']['admin_check_code']['value']=='') {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="admin_check_code" value="0" <?php if ($this->vars['configs']['admin_check_code']['value']=='0') {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">后台登录阀值</label>
		                     <div class="layui-input-inline">
								<input type="text" name="lock_count" value="<?php echo @$this->vars['configs']['lock_count']['value'];?>" placeholder="请输入后台登录失败几次后锁定IP，默认5次" class="layui-input">
		                     </div>
		                     <div class="layui-form-mid layui-word-aux">次</div>
		                </div>
		                
		                <div class="layui-form-item">
		                   <label class="layui-form-label">失败锁定时间</label>
		                   <div class="layui-input-inline">
		                  		<input type="text" name="lock_time" value="<?php echo @$this->vars['configs']['lock_time']['value'];?>" placeholder="请输入后台登录异常锁定时间，默认为900秒" class="layui-input">
		                   </div>
		                   <div class="layui-form-mid layui-word-aux">秒</div>
			            </div>
		                
		                <div class="layui-form-item">
							 <div class="layui-input-block">
							    <button class="layui-btn" lay-submit name="submit" value="security">立即提交</button>
							    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
							 </div>
						</div>
	              </form>
		  	   </div>
		  	   
		  	   <div class="layui-tab-item">
		  	   	   <form action="<?php echo \core\basic\Url::get('/admin/Config/index');?>" method="post" class="layui-form">
			  	   	   <input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">地址模式</label>
		                     <div class="layui-input-block">
		                     	<P>
		                     		<input type="radio" name="url_rule_type" value="1" <?php if ($this->vars['configs']['url_rule_type']['value']==1) {?> checked="checked" <?php } ?> title="普通模式，类似：/index.php/product/1.html">
		                     		<span class="layui-icon layui-icon-about tips" data-content="基本模式需要服务器支持pathinfo,特别是nginx下pathinfo要手动配置！"></span>
		                     	</P>
		                     	<P>
		                     		<input type="radio" name="url_rule_type" value="2" <?php if ($this->vars['configs']['url_rule_type']['value']==2) {?> checked="checked" <?php } ?> title="伪静态模式，类似：/product/1.html">
		                     		<span class="layui-icon layui-icon-about tips" data-content="伪静态时需要服务器环境的支持，并需要添加伪静态规则！"></span>
								</P>
		                     	<P>
									<input type="radio" name="url_rule_type" value="3" <?php if ($this->vars['configs']['url_rule_type']['value']==3||!$this->vars['configs']['url_rule_type']['value']) {?> checked="checked" <?php } ?> title="兼容模式，类似：/?product/1.html">
								</P>
		                     </div>
		                </div>
		                
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">文章路径</label>
		                     <div class="layui-input-block">
		                     	<P>
		                     		<input type="radio" name="url_rule_content_path" value="0" <?php if (!$this->vars['configs']['url_rule_content_path']['value']) {?> checked="checked" <?php } ?> title="带栏目路径，类似：/product/1.html">
								</P>
		                     	<P>
									<input type="radio" name="url_rule_content_path" value="1" <?php if ($this->vars['configs']['url_rule_content_path']['value']==1) {?> checked="checked" <?php } ?> title="不带栏目路径，类似：/1.html">
								</P>
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
							 <div class="layui-input-block">
							    <button class="layui-btn" lay-submit name="submit" value="urlrule">立即提交</button>
							    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
							 </div>
						</div>
	              </form>
		  	   </div>
		  	   
		  	   <div class="layui-tab-item">
		  	   	   <form action="<?php echo \core\basic\Url::get('/admin/Config/index');?>" method="post" class="layui-form">
			  	   	   <input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 

	                  <div class="layui-form-item">
		                   <label class="layui-form-label">常用组合标签： </label>
		                   <div class="layui-input-block" style="line-height:36px;">
								<p>全局标签：{pboot:sitetitle}站点标题、{pboot:sitesubtitle}站点副标题</p>
								<p>列表或内容页：{sort:name}栏目名称、{sort:title}栏目标题</p>
								<p>内容页：{content:title}内容标题</p>
								<p>搜索结果页：{pboot:keyword}搜索关键字</p>
								<p>个人中心：{user:nickname}会员昵称</p>
								<p>例如定义内容页样式：{content:title}-{sort:name}-{pboot:sitetitle}-{pboot:sitesubtitle}</p>
								<p>以下配置参数不设置时将使用系统默认规则。</p>
		                   </div>
		              </div>
		             
		               <div class="layui-form-item">
		                   <label class="layui-form-label">首页</label>
		                   <div class="layui-input-block">
		                  		<input type="text" name="index_title" value="<?php echo @$this->vars['configs']['index_title']['value'];?>" class="layui-input">
		                   </div>
			           </div>
			           
			           <div class="layui-form-item">
		                   <label class="layui-form-label">专题页</label>
		                   <div class="layui-input-block">
		                  		<input type="text" name="about_title" value="<?php echo @$this->vars['configs']['about_title']['value'];?>" class="layui-input">
		                   </div>
			           </div>
			           
			           <div class="layui-form-item">
		                   <label class="layui-form-label">列表页</label>
		                   <div class="layui-input-block">
		                  		<input type="text" name="list_title" value="<?php echo @$this->vars['configs']['list_title']['value'];?>" class="layui-input">
		                   </div>
			           </div>
			           
			           <div class="layui-form-item">
		                   <label class="layui-form-label">内容页</label>
		                   <div class="layui-input-block">
		                  		<input type="text" name="content_title" value="<?php echo @$this->vars['configs']['content_title']['value'];?>" class="layui-input">
		                   </div>
			           </div>
			           
			           <div class="layui-form-item">
		                   <label class="layui-form-label">搜索结果页</label>
		                   <div class="layui-input-block">
		                  		<input type="text" name="search_title" value="<?php echo @$this->vars['configs']['search_title']['value'];?>" class="layui-input">
		                   </div>
			           </div>
			           
			           <div class="layui-form-item">
		                   <label class="layui-form-label">会员注册页</label>
		                   <div class="layui-input-block">
		                  		<input type="text" name="register_title" value="<?php echo @$this->vars['configs']['register_title']['value'];?>" class="layui-input">
		                   </div>
			           </div>
			           
			           <div class="layui-form-item">
		                   <label class="layui-form-label">会员登录页</label>
		                   <div class="layui-input-block">
		                  		<input type="text" name="login_title" value="<?php echo @$this->vars['configs']['login_title']['value'];?>" class="layui-input">
		                   </div>
			           </div>
			           
			           <div class="layui-form-item">
		                   <label class="layui-form-label">个人中心页</label>
		                   <div class="layui-input-block">
		                  		<input type="text" name="ucenter_title" value="<?php echo @$this->vars['configs']['ucenter_title']['value'];?>" class="layui-input">
		                   </div>
			           </div>
			           
			           <div class="layui-form-item">
		                   <label class="layui-form-label">资料修改页</label>
		                   <div class="layui-input-block">
		                  		<input type="text" name="umodify_title" value="<?php echo @$this->vars['configs']['umodify_title']['value'];?>" class="layui-input">
		                   </div>
			           </div>
			           
			           <div class="layui-form-item">
		                   <label class="layui-form-label">其它页</label>
		                   <div class="layui-input-block">
		                  		<input type="text" name="other_title" value="<?php echo @$this->vars['configs']['other_title']['value'];?>" class="layui-input">
		                   </div>
			           </div>
		                
		                <div class="layui-form-item">
							 <div class="layui-input-block">
							    <button class="layui-btn" lay-submit name="submit" value="pagetitle">立即提交</button>
							    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
							 </div>
						</div>
	              </form>
		  	   </div>
		  	   
		  	    <div class="layui-tab-item">
		  	   	   <form action="<?php echo \core\basic\Url::get('/admin/Config/index');?>" method="post" class="layui-form">
			  	   	   <input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
						
						<div class="layui-form-item">
		                     <label class="layui-form-label">会员注册</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="register_status" value="1" <?php if ($this->vars['configs']['register_status']['value']=='1'||$this->vars['configs']['register_status']['value']=='') {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="register_status" value="0" <?php if ($this->vars['configs']['register_status']['value']=='0') {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">会员注册类型</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="register_type" value="1" <?php if ($this->vars['configs']['register_type']['value']=='1'||$this->vars['configs']['register_type']['value']=='') {?> checked="checked" <?php } ?> title="用户名">
								<input type="radio" name="register_type" value="2" <?php if ($this->vars['configs']['register_type']['value']=='2') {?> checked="checked" <?php } ?> title="邮箱账号">
								<input type="radio" name="register_type" value="3" <?php if ($this->vars['configs']['register_type']['value']=='3') {?> checked="checked" <?php } ?> title="手机号码">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">会员注册验证码</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="register_check_code" value="0" <?php if ($this->vars['configs']['register_check_code']['value']=='0') {?> checked="checked" <?php } ?> title="禁用">
		                     	<input type="radio" name="register_check_code" value="1" <?php if ($this->vars['configs']['register_check_code']['value']=='1'||$this->vars['configs']['register_check_code']['value']=='') {?> checked="checked" <?php } ?> title="普通验证码">
								<input type="radio" name="register_check_code" value="2" <?php if ($this->vars['configs']['register_check_code']['value']=='2') {?> checked="checked" <?php } ?> title="邮箱验证码">
								<!-- <input type="radio" name="register_check_code" value="3" <?php if ($this->vars['configs']['register_check_code']['value']=='3') {?> checked="checked" <?php } ?> title="短信验证码"> -->
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">会员注册审核</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="register_verify" value="1" <?php if ($this->vars['configs']['register_verify']['value']==1) {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="register_verify" value="0" <?php if ($this->vars['configs']['register_verify']['value']==0) {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
	                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">会员登录</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="login_status" value="1" <?php if ($this->vars['configs']['login_status']['value']=='1'||$this->vars['configs']['login_status']['value']=='') {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="login_status" value="0" <?php if ($this->vars['configs']['login_status']['value']=='0') {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">会员登录验证码</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="login_check_code" value="1" <?php if ($this->vars['configs']['login_check_code']['value']=='1'||$this->vars['configs']['login_check_code']['value']=='') {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="login_check_code" value="0" <?php if ($this->vars['configs']['login_check_code']['value']=='0') {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">不等待跳登录</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="login_no_wait" value="1" <?php if ($this->vars['configs']['login_no_wait']['value']==1) {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="login_no_wait" value="0" <?php if ($this->vars['configs']['login_no_wait']['value']==0) {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">评论功能</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="comment_status" value="1" <?php if ($this->vars['configs']['comment_status']['value']=='1'||$this->vars['configs']['comment_status']['value']=='') {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="comment_status" value="0" <?php if ($this->vars['configs']['comment_status']['value']=='0') {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">匿名评论</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="comment_anonymous" value="1" <?php if ($this->vars['configs']['comment_anonymous']['value']==1) {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="comment_anonymous" value="0" <?php if ($this->vars['configs']['comment_anonymous']['value']==0) {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">评论验证码</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="comment_check_code" value="1" <?php if ($this->vars['configs']['comment_check_code']['value']=='1'||$this->vars['configs']['comment_check_code']['value']=='') {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="comment_check_code" value="0" <?php if ($this->vars['configs']['comment_check_code']['value']=='0') {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>

		                <div class="layui-form-item">
		                     <label class="layui-form-label">评论审核</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="comment_verify" value="1" <?php if ($this->vars['configs']['comment_verify']['value']=='1'||$this->vars['configs']['comment_verify']['value']=='') {?> checked="checked" <?php } ?> title="启用">
								<input type="radio" name="comment_verify" value="0" <?php if ($this->vars['configs']['comment_verify']['value']=='0') {?> checked="checked" <?php } ?> title="禁用">
		                     </div>
		                </div>

			            <div class="layui-form-item">
		                     <label class="layui-form-label">会员注册积分</label>
		                     <div class="layui-input-inline">
		                     	<input type="text" name="register_score"  value="<?php echo @$this->vars['configs']['register_score']['value'];?>" placeholder="请输入会员注册初始积分"  class="layui-input">
		                     </div>
		                </div>
		                
		                 <div class="layui-form-item">
		                     <label class="layui-form-label">会员登录积分</label>
		                     <div class="layui-input-inline">
		                     	<input type="text" name="login_score"  value="<?php echo @$this->vars['configs']['login_score']['value'];?>" placeholder="请输入会员每次登录积分"  class="layui-input">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">会员默认等级</label>
		                     <div class="layui-input-inline">
		                     	<select name="register_gcode">
		                     		<option value="">请选择</option>
			                        <?php $num = 0;foreach ($this->getVar('groups') as $key => $value) { $num++;?>
			                            <option value="<?php echo $value->gcode; ?>" <?php if ($this->vars['configs']['register_gcode']['value']==$value->gcode) {?>selected<?php } ?>><?php echo $value->gname; ?></option>
			                        <?php } ?>
			                    </select>
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                   <label class="layui-form-label">允许上传格式</label>
		                   <div class="layui-input-inline">
		                  		<input type="text" name="home_upload_ext" value="<?php echo @$this->vars['configs']['home_upload_ext']['value'];?>" placeholder="以英文逗号隔开！" class="layui-input">
		                   </div>
		                   <span class="layui-icon layui-icon-about tips" data-content="以英文逗号隔开，默认：jpg, jpeg, png, gif, xls, xlsx, doc, docx, ppt, pptx, rar, zip, pdf, txt！"></span>
			            </div>
		                
		                <div class="layui-form-item">
							 <div class="layui-input-block">
							    <button class="layui-btn" lay-submit name="submit" value="member">立即提交</button>
							    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
							 </div>
						</div>
	              </form>
		  	   </div>
		  	   
		  </div>
	 </div>
</div>
  
</div>

<script type="text/javascript" src="<?php echo APP_THEME_DIR;?>/layui/layui.all.js?v=v2.5.4"></script>
<script type="text/javascript" src="<?php echo APP_THEME_DIR;?>/js/comm.js?v=v3.1.1"></script>
<script type="text/javascript" src="<?php echo APP_THEME_DIR;?>/js/mylayui.js?v=v3.1.0"></script>


<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
<!--[if lt IE 9]>
  <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</body>
</html>

<?php return array (
  0 => 'D:/phpstudy_pro/WWW/mb.mk.me/20003/apps/admin/view/default/common/head.html',
  1 => 'D:/phpstudy_pro/WWW/mb.mk.me/20003/apps/admin/view/default/common/foot.html',
); ?>