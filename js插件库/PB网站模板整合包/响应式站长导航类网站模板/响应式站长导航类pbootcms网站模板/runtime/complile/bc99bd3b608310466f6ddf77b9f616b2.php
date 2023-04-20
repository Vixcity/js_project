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
	<?php if ($this->getVar('list')) {?>
	<div class="layui-tab layui-tab-brief" lay-filter="tab">
	  <ul class="layui-tab-title">
	    <li class="layui-this" lay-id="t1">幻灯片列表</li>
	    <li lay-id="t2">幻灯片新增</li>
	  </ul>
	  <div class="layui-tab-content">
	  	<div class="layui-tab-item layui-show">
	  		<form action="<?php echo \core\basic\Url::get('/admin/Slide/mod');?>" method="post" class="layui-form" onkeydown="if(event.keyCode==13) return false;">
		    <input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
	  		<table class="layui-table">
            	<thead>
                    <tr>
                    	<th>分组(gid)</th>
                        <th>图片</th>
                        <th>链接</th>
                        <th>标题</th>
                        <th>副标题</th>
                        <th>排序</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $num = 0;foreach ($this->getVar('slides') as $key => $value) { $num++;?>
                    <tr>
                    	<td><?php echo $value->gid; ?></td>
                        <td><img src="<?php echo SITE_DIR;?><?php echo $value->pic; ?>" style="height:30px;"></td>
                        <td><?php echo $value->link; ?></td>
                        <td><?php echo $value->title; ?></td>
                        <td><?php echo $value->subtitle; ?></td>
                        <td class="table-input">
                        <input type="hidden" name="listall[]" value="<?php echo $value->id; ?>">
                        <input type="text" lay-ignore class="layui-input" name="sorting[]" value="<?php echo $value->sorting; ?>">
                        </td>
                        <td>
                            <?php echo get_btn_del($value->id);?>
                            <?php echo get_btn_mod($value->id);?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <button type="submit" name="submit" value="sorting" class="layui-btn layui-btn-sm">保存排序</button>
            </form> 
            <div class="page"><?php echo $this->getVar('pagebar');?></div>
	  	</div>
	  	
	  	<div class="layui-tab-item">
	  		<form action="<?php echo \core\basic\Url::get('/admin/Slide/add');?>" method="post" class="layui-form">
	  			<input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
	  			<div class="layui-form-item">
                     <label class="layui-form-label">分组</label>
                     <div class="layui-input-block">
                     	<select name="gid" >	
                     		<?php $num = 0;foreach ($this->getVar('gids') as $key => $value) { $num++;?>
	                			<option value="<?php echo $value; ?>" >分组<?php echo $value; ?></option>
	                		<?php } ?>
	                		<option value="" >自动新增分组</option>
	                	</select>
                     </div>
                </div>
                
                <div class="layui-form-item">
                     <label class="layui-form-label">图片</label>
                     <div class="layui-input-inline">
                     	<input type="text" name="pic" id="pic" required  lay-verify="required" placeholder="请上传图片"  class="layui-input">
                     </div>
                     <button type="button" class="layui-btn upload" data-des="pic">
					 	 <i class="layui-icon">&#xe67c;</i>上传图片
					 </button>
					 <div id="pic_box" class="pic"></div>
                </div>
                
                <div class="layui-form-item">
                     <label class="layui-form-label">链接</label>
                     <div class="layui-input-block">
                     	<input type="text" name="link" placeholder="请输入跳转链接"  class="layui-input">
                     </div>
                </div>
                
                 <div class="layui-form-item">
                     <label class="layui-form-label">标题</label>
                     <div class="layui-input-block">
                     	<input type="text" name="title" placeholder="请输入标题"  class="layui-input">
                     </div>
                </div>
                
                <div class="layui-form-item">
                     <label class="layui-form-label">副标题</label>
                     <div class="layui-input-block">
                     	<input type="text" name="subtitle" placeholder="请输入副标题"  class="layui-input">
                     </div>
                </div>
                
                <div class="layui-form-item">
                     <label class="layui-form-label">排序</label>
                     <div class="layui-input-block">
                     	<input type="text" name="sorting" required lay-verify="required" value="255" placeholder="请输入排序"  class="layui-input">
                     </div>
                </div>
                
                 <div class="layui-form-item">
					 <div class="layui-input-block">
					    <button class="layui-btn" lay-submit>立即提交</button>
					    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
					 </div>
				</div>
	  		</form>
	  	</div>
	  </div>
	</div>
	<?php } ?> 
	
	<?php if ($this->getVar('mod')) {?>
	<div class="layui-tab layui-tab-brief" lay-filter="tab">
	  <ul class="layui-tab-title">
	    <li class="layui-this">幻灯片修改</li>
	  </ul>
	  <div class="layui-tab-content">
	  	<div class="layui-tab-item layui-show">
	  		<form action="<?php echo \core\basic\Url::get('/admin/Slide/mod/id/'.get('id').'');?><?php echo $this->getVar('backurl');?>" method="post" class="layui-form">
	  			<input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
	  			
                <div class="layui-form-item">
                     <label class="layui-form-label">分组</label>
                     <div class="layui-input-block">
                     	<input type="text" name="gid" required  lay-verify="required" value="<?php echo @$this->getVar('slide')->gid;?>" placeholder="请输入分组"  class="layui-input">
                     </div>
                </div>
                
                <div class="layui-form-item">
                     <label class="layui-form-label">图片</label>
                     <div class="layui-input-inline">
                     	<input type="text" name="pic" id="pic" required  lay-verify="required" value="<?php echo @$this->getVar('slide')->pic;?>" placeholder="请上传图片"  class="layui-input">
                     </div>
                     <button type="button" class="layui-btn upload" data-des="pic">
					 	 <i class="layui-icon">&#xe67c;</i>上传图片
					 </button>
					 <div id="pic_box" class="pic"><?php if ($this->getVar('slide')->pic) {?><dl><dt><img src="<?php echo SITE_DIR;?><?php echo @$this->getVar('slide')->pic;?>" data-url="<?php echo @$this->getVar('slide')->pic;?>"></dt><dd>删除</dd></dl><?php } ?></div>
                </div>
                
                <div class="layui-form-item">
                     <label class="layui-form-label">跳转链接</label>
                     <div class="layui-input-block">
                     	<input type="text" name="link" value="<?php echo @$this->getVar('slide')->link;?>"  placeholder="请输入跳转链接"  class="layui-input">
                     </div>
                </div>
                
                <div class="layui-form-item">
                     <label class="layui-form-label">标题</label>
                     <div class="layui-input-block">
                     	<input type="text" name="title" value="<?php echo @$this->getVar('slide')->title;?>" placeholder="请输入标题"  class="layui-input">
                     </div>
                </div>
                
                 <div class="layui-form-item">
                     <label class="layui-form-label">副标题</label>
                     <div class="layui-input-block">
                     	<input type="text" name="subtitle" value="<?php echo @$this->getVar('slide')->subtitle;?>" placeholder="请输入副标题"  class="layui-input">
                     </div>
                </div>
                
                 <div class="layui-form-item">
                     <label class="layui-form-label">排序</label>
                     <div class="layui-input-block">
                     	<input type="text" name="sorting" required lay-verify="required" value="<?php echo @$this->getVar('slide')->sorting;?>" placeholder="请输入排序"  class="layui-input">
                     </div>
                </div>
                
                 <div class="layui-form-item">
					 <div class="layui-input-block">
					    <button class="layui-btn" lay-submit>立即提交</button>
					    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
					    <?php echo get_btn_back();?>
					 </div>
				</div>
	  		</form>
	  	</div>
	  </div>
	</div>
	<?php } ?> 

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