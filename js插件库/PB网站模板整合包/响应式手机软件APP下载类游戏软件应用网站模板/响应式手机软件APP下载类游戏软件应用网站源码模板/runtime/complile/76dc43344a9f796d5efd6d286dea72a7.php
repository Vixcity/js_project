<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="renderer"  content="webkit">
  <title>后台管理中心-V<?php echo APP_VERSION;?>-<?php echo RELEASE_TIME;?></title>
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
	    后台管理
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
       		<a href="<?php echo \core\basic\Url::get('/admin/Index/clearCache');?>"><i class="fa fa-trash-o" aria-hidden="true"></i> 清理缓存</a>
       </li>
       
       <li class="layui-nav-item layui-hide-xs">
	        <a href="javascript:;">
	          <i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo session('realname');?>
	        </a>
	        <dl class="layui-nav-child">
	          <dd><a href="<?php echo \core\basic\Url::get('/admin/Index/ucenter');?>"><i class="fa fa-address-card-o" aria-hidden="true"></i> 密码修改</a></dd>
	          <dd><a href="<?php echo \core\basic\Url::get('/admin/Index/loginOut');?>"><i class="fa fa-sign-out" aria-hidden="true"></i> 退出登录</a></dd>
	          <dd><a href="<?php echo \core\basic\Url::get('/admin/Upgrade/index');?>"><i class="fa fa-cloud-upload" aria-hidden="true"></i> 在线更新</a></dd>
	          <dd><a href="<?php echo \core\basic\Url::get('/admin/Index/clearSession');?>"><i class="fa fa-trash-o" aria-hidden="true"></i> 清理会话</a></dd>
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
	    <li class="layui-this" lay-id="t1">栏目列表</li>
	    <li lay-id="t2">栏目新增</li>
	    <li lay-id="t3">批量新增</li>
	  </ul>
	  <div class="layui-tab-content">
	  	   <div class="layui-tab-item layui-show">
	  	   		 <form action="<?php echo \core\basic\Url::get('/admin/ContentSort/mod');?>" method="post" id="sortForm" name="sortForm">
	  	   		 <input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
	  	   		 <table class="layui-table" id="sortTable">
	  	   		 	  <thead>
		                    <tr>
		                        <th><input type="checkbox" lay-ignore id="checkall" title="全选"></th>
		                        <th>栏目名称</th>
		                        <th>编码</th>
		                        <th>URL名称</th>
		                        <th>模型</th>
		                        <th>列表页模板</th>
		                        <th>详情页模板</th>
		                        <th>排序</th>
		                        <th>状态</th>
		                        <th>操作</th>
		                    </tr>
		                </thead>
		                <tbody>
		                <?php $num = 0;foreach ($this->getVar('sorts') as $key => $value) { $num++;?>
		                	
		                    <tr data-tt-id='<?php echo $value->scode; ?>' data-tt-parent-id="<?php echo $value->pcode; ?>">
		                    	<td>
		                    		<input type="checkbox" class="checkitem" lay-ignore name="list[]" value="<?php echo $value->scode; ?>">
		                    		<input type="hidden" name="listall[]" value="<?php echo $value->id; ?>">
		                    	</td>
		                        <td>
		                            <?php if ($value->son) {?>
		                               <i class="fa fa-folder-o" aria-hidden="true"></i>
		                            <?php } else { ?>
		                               <i class="fa fa-folder-open-o" aria-hidden="true"></i>
		                            <?php } ?>
		                            <?php echo $value->name; ?>
		                           
		                            
		                            <?php if ($value->outlink) {?>
		                            	<a href="<?php echo $value->outlink; ?>" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a>
		                            <?php } else { ?>
		                            	<?php if ($value->type==1) {?>
		                            	 <a href="<?php echo \core\basic\Url::get('/admin/Single/index/mcode');?>/<?php echo $value->mcode; ?>&scode=<?php echo $value->scode; ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i> </a>
		                            	<?php } else { ?>
		                            	 <a href="<?php echo \core\basic\Url::get('/admin/Content/index/mcode');?>/<?php echo $value->mcode; ?>&scode=<?php echo $value->scode; ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i> </a>
		                            	 <?php } ?>
		                            <?php } ?>
		                        </td>
		                        <td><?php echo $value->scode; ?></td>
		                        <td><?php echo $value->filename; ?></td>
		                        <td>
		                        <?php $num = 0;foreach ($this->getVar('allmodels') as $key2 => $value2) { $num++;?>	
		                        	<?php if ($value2->mcode==$value->mcode) {?>
										<?php echo $value2->name; ?>
									<?php } ?>                        	
				                <?php } ?>
								</td>
		                        <td><?php echo $value->listtpl; ?></td>
		                        <td><?php echo $value->contenttpl; ?></td>
		                        <td class="table-input"><input type="text" name="sorting[]" value="<?php echo $value->sorting; ?>" class="layui-input"></td>
		                       	<td>
		                            <?php if ($value->status) {?>
		                            <a href="<?php echo \core\basic\Url::get('/admin/'.C.'/mod/scode/'.$value->scode.'/field/status/value/0');?>" class="switch"><i class='fa fa-toggle-on' title="点击禁用"></i></a>
		                            <?php } else { ?>
		                            <a href="<?php echo \core\basic\Url::get('/admin/'.C.'/mod/scode/'.$value->scode.'/field/status/value/1');?>" class="switch"><i class='fa fa-toggle-off' title="点击启用"></i></a>
		                            <?php } ?>
		                        </td>
		                        <td>
		                        	<?php if (!$value->outlink) {?>
		                        		<?php  
			                        		$Parser=new app\home\controller\ParserController();
			                        		$link=$Parser->parserLink($value->type,$value->urlname,'list',$value->scode,$value->filename,'','');
			                        	?>
			                        	<a href="<?php  echo $link?>" class="layui-btn layui-btn-xs layui-btn-primary"  target="_blank">查看</a>
		                        	<?php } ?>
		                
		                            <?php echo get_btn_del($value->scode,'scode');?>
		                            <?php echo get_btn_mod($value->scode,'scode');?>
		                        </td>
		                    </tr>
		                <?php } ?>
		                </tbody>
	  	   		 </table>
	  	   		 <button type="submit" name="submit" value="sorting" class="layui-btn">保存排序</button>
	  	   		 <button type="submit" name="submit" onclick="return setDelAction();" class="layui-btn">批量删除</button>
	  	   		 <script>
		     		function setDelAction(){
		     			document.sortForm.action = "<?php echo \core\basic\Url::get('/admin/ContentSort/del');?>"; 
		     			return confirm("您确定要删除选中的栏目么？");
		     		}
		     		
		     		$("#sortTable").treetable({ expandable: true,column: 1,indent:20,stringCollapse:'收缩',stringExpand:'展开' });
		     	</script>
	  	   		</form>
	  	    </div>
	  	    
	  	     <div class="layui-tab-item">
	  	     	<form action="<?php echo \core\basic\Url::get('/admin/ContentSort/add');?>" method="post" class="layui-form" lay-filter="sort">
		  	     	<input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
		  	     	<div class="layui-tab">
					  <ul class="layui-tab-title">
					    <li class="layui-this">基本选项</li>
					    <li>高级选项</li>
					  </ul>
					  <div class="layui-tab-content">
					    <div class="layui-tab-item layui-show">
					    	<div class="layui-form-item">
			                     <label class="layui-form-label">父栏目</label>
			                     <div class="layui-input-block">
			                     	<select name="pcode">
				                        <option value="0" >顶级栏目</option>
				                        <?php echo $this->getVar('sort_select');?>
				                    </select>
			                     </div>
			                </div>
			                
			                <div class="layui-form-item">
			                     <label class="layui-form-label">栏目名称 <span class="layui-text-red">*</span></label>
			                     <div class="layui-input-block">
			                     	<input type="text" name="name" required lay-verify="required" placeholder="请输入栏目名称" class="layui-input">
			                     </div>
			                </div>
			                
			                <div class="layui-form-item">
			                     <label class="layui-form-label">URL名称 </label>
			                     <div class="layui-input-block">
			                     	<input type="text" name="filename"  placeholder="请输入URL名称，如:test，test/a/b/c" class="layui-input">
			                     </div>
			                </div>
			                
			                <div class="layui-form-item">
			                     <label class="layui-form-label">内容模型 <span class="layui-text-red">*</span></label>
			                     <div class="layui-input-block">
			                     	<select name="mcode" lay-filter="model" lay-verify="required" >
				                     	<option value="">请选择内容模型</option>
				                        <?php $num = 0;foreach ($this->getVar('models') as $key => $value) { $num++;?>	                        	
				                        	<option value="<?php echo $value->mcode; ?>" data-type="<?php echo $value->type; ?>"  data-listtpl="<?php echo $value->listtpl; ?>" data-contenttpl="<?php echo $value->contenttpl; ?>" ><?php echo $value->name; ?></option>
				                        <?php } ?>
				                    </select>
			                     </div>
			                </div>
			                
			                 <input type="hidden" value="1" name="type" id="type">
			                 
			                 <div class="layui-form-item">
			                     <label class="layui-form-label">列表页模板</label>
			                     <div class="layui-input-block">
				                     <select name="listtpl" id="listtpl">
				                     	<option value="">无</option>
				                     	<?php $num = 0;foreach ($this->getVar('tpls') as $key => $value) { $num++;?>
				                        	<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
				                        <?php } ?>
				                     </select>
			                     </div>
			                </div>
			                
			                 <div class="layui-form-item">
			                     <label class="layui-form-label">详情页模板</label>
			                     <div class="layui-input-block">
				                     <select name="contenttpl" id="contenttpl" >
				                     	<option value="">无</option>
				                     	<?php $num = 0;foreach ($this->getVar('tpls') as $key => $value) { $num++;?>
				                        	<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
				                        <?php } ?>
				                     </select>
			                     </div>
			                </div>
			                
			                <div class="layui-form-item">
			                     <label class="layui-form-label">状态</label>
			                     <div class="layui-input-block">
			                     	<input type="radio" name="status" value="1" title="显示" checked>
									<input type="radio" name="status" value="0" title="隐藏">
			                     </div>
			                </div>  
			                
			               <div class="layui-form-item">
			                     <label class="layui-form-label">浏览权限</label>
			                     <div class="layui-input-block">
									<select name="gid">
										<option value="">不限制</option>
				                        <?php $num = 0;foreach ($this->getVar('groups') as $key => $value) { $num++;?>
				                            <option value="<?php echo $value->id; ?>"><?php echo $value->gname; ?></option>
				                        <?php } ?>
				                    </select>
			                     </div>
			                </div>  
			                
			                <div class="layui-form-item">
			                     <label class="layui-form-label">权限类型</label>
			                     <div class="layui-input-block">
			                     	<select name="gtype" id="gtype" >
			                     		<option value="1">小于</option>
			                     		<option value="2">小于等于</option>
			                     		<option value="3">等于</option>
			                     		<option value="4" selected>大于等于</option>
			                     		<option value="5">大于</option>
									</select>
			                     </div>
			                </div>   
			                    
					    </div>
					    <div class="layui-tab-item">
					    	<div class="layui-form-item">
			                     <label class="layui-form-label">栏目副名称</label>
			                     <div class="layui-input-block">
			                     	<input type="text" name="subname" placeholder="请输入栏目副名称" class="layui-input">
			                     </div>
			                </div>
			                
			                <div class="layui-form-item">
			                     <label class="layui-form-label">栏目描述1</label>
			                     <div class="layui-input-block">
			                     	<input type="text" name="def1"  placeholder="请输入栏目描述1内容"  class="layui-input">
			                     </div>
			                </div>
			                
			                <div class="layui-form-item">
			                     <label class="layui-form-label">栏目描述2</label>
			                     <div class="layui-input-block">
			                     	<input type="text" name="def2" placeholder="请输入栏目描述2内容"  class="layui-input">
			                     </div>
			                </div>
			                
			                <div class="layui-form-item">
			                     <label class="layui-form-label">栏目描述3</label>
			                     <div class="layui-input-block">
			                     	<input type="text" name="def3" placeholder="请输入栏目描述3内容"  class="layui-input">
			                     </div>
			                </div>
			                
			                <div class="layui-form-item">
			                     <label class="layui-form-label">跳转链接</label>
			                     <div class="layui-input-block">
			                     	<input type="text" name="outlink" placeholder="请输入跳转链接" class="layui-input">
			                     </div>
			                </div>
			                
			                <div class="layui-form-item">
			                     <label class="layui-form-label">权限不足提示</label>
			                     <div class="layui-input-block">
			                     	<input type="text" name="gnote"  placeholder="请输入权限不足时提示文本"  class="layui-input">
			                     </div>
			                </div>
			                
			                 <div class="layui-form-item">
			                     <label class="layui-form-label">栏目缩略图</label>
			                     <div class="layui-input-inline">
			                     	<input type="text" name="ico" id="ico" placeholder="请上传栏目缩略图"  class="layui-input">
			                     </div>
			                     <button type="button" class="layui-btn upload" data-des="ico">
								 	 <i class="layui-icon">&#xe67c;</i>上传图片
								 </button>
								 <div id="ico_box" class="pic"></div>
			                </div>
			                
			                <div class="layui-form-item">
			                     <label class="layui-form-label">栏目大图</label>
			                     <div class="layui-input-inline">
			                     	<input type="text" name="pic" id="pic" placeholder="请上传栏目大图"  class="layui-input">
			                     </div>
			                     <button type="button" class="layui-btn upload" data-des="pic">
								 	 <i class="layui-icon">&#xe67c;</i>上传图片
								 </button>
								 <div id="pic_box" class="pic"></div>
			                </div>
			                
			                <div class="layui-form-item">
			                     <label class="layui-form-label">SEO标题</label>
			                     <div class="layui-input-block">
			                     	<input type="text" name="title" placeholder="请输入栏目SEO标题，需前端调用" class="layui-input">
			                     </div>
			                </div>
			                
			                <div class="layui-form-item">
			                     <label class="layui-form-label">SEO关键字</label>
			                     <div class="layui-input-block">
			                     	<input type="text" name="keywords" placeholder="请输入栏目SEO关键字，需前端调用" class="layui-input">
			                     </div>
			                </div>
			                
			                <div class="layui-form-item">
			                     <label class="layui-form-label">SEO描述</label>
			                     <div class="layui-input-block">
			                     	<textarea name="description" placeholder="请输入栏目SEO描述，需前端调用" class="layui-textarea"></textarea>
			                     </div>
			                </div>
					    </div>
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
	  	     
	  	     <!-- 批量新增 -->
	  	     <div class="layui-tab-item">
	  	     	<form action="<?php echo \core\basic\Url::get('/admin/ContentSort/add');?>" method="post" class="layui-form" lay-filter="sort">
		  	     		<input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
		  	     		<div class="layui-form-item">
		                     <label class="layui-form-label">父栏目</label>
		                     <div class="layui-input-block">
		                     	<select name="pcode">
			                        <option value="0" >顶级栏目</option>
			                        <?php echo $this->getVar('sort_select');?>
			                    </select>
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">栏目名称</label>
		                     <div class="layui-input-block">
		                     	<input type="text" name="multiplename" required lay-verify="required" placeholder="请输入栏目名称，多个栏目用逗号隔开" class="layui-input">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">内容模型</label>
		                     <div class="layui-input-block">
		                     	<select name="mcode" lay-filter="model" lay-verify="required" >
			                     	<option value="">请选择内容模型</option>
			                        <?php $num = 0;foreach ($this->getVar('models') as $key => $value) { $num++;?>	                        	
			                        	<option value="<?php echo $value->mcode; ?>" data-type="<?php echo $value->type; ?>"  data-listtpl="<?php echo $value->listtpl; ?>" data-contenttpl="<?php echo $value->contenttpl; ?>" ><?php echo $value->name; ?></option>
			                        <?php } ?>
			                    </select>
		                     </div>
		                </div>
		                
		                 <input type="hidden" value="1" name="type" id="type">
		                 
		                 <div class="layui-form-item">
		                     <label class="layui-form-label">列表页模板</label>
		                     <div class="layui-input-block">
			                     <select name="listtpl" id="listtpl">
			                     	<option value="">无</option>
			                     	<?php $num = 0;foreach ($this->getVar('tpls') as $key => $value) { $num++;?>
			                        	<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
			                        <?php } ?>
			                     </select>
		                     </div>
		                </div>
		                
		                 <div class="layui-form-item">
		                     <label class="layui-form-label">详情页模板</label>
		                     <div class="layui-input-block">
			                     <select name="contenttpl" id="contenttpl" >
			                     	<option value="">无</option>
			                     	<?php $num = 0;foreach ($this->getVar('tpls') as $key => $value) { $num++;?>
			                        	<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
			                        <?php } ?>
			                     </select>
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">状态</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="status" value="1" title="显示" checked>
								<input type="radio" name="status" value="0" title="隐藏">
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
	    <li class="layui-this">栏目修改</li>
	  </ul>
	  <div class="layui-tab-content">
	  	<div class="layui-tab-item layui-show">
	  		<form action="<?php echo \core\basic\Url::get('/admin/ContentSort/mod/scode/'.get('scode').'');?><?php echo $this->getVar('backurl');?>" method="post" class="layui-form" lay-filter="sort">
	  	     	<input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
	  	     	<div class="layui-tab">
				  <ul class="layui-tab-title">
				    <li class="layui-this">基本选项</li>
				    <li>高级选项</li>
				  </ul>
				  <div class="layui-tab-content">
				    <div class="layui-tab-item layui-show">
				    	<div class="layui-form-item">
		                     <label class="layui-form-label">父栏目</label>
		                     <div class="layui-input-block">
		                     	<select name="pcode" id="pcode">
			                        <option value="0" >顶级栏目</option>
			                        <?php echo $this->getVar('sort_select');?>
			                    </select>
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">栏目名称  <span class="layui-text-red">*</span></label>
		                     <div class="layui-input-block">
		                     	<input type="text" name="name" required lay-verify="required" value="<?php echo @$this->getVar('sort')->name;?>" placeholder="请输入栏目名称" class="layui-input">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">URL名称 </label>
		                     <div class="layui-input-block">
		                     	<input type="text" name="filename" value="<?php echo @$this->getVar('sort')->filename;?>"  placeholder="请输入URL名称，如:test，test/a/b/c" class="layui-input">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">内容模型  <span class="layui-text-red">*</span></label>
		                     <div class="layui-input-block">
		                     	<select name="mcode" lay-filter="model" lay-verify="required" >
			                     	<option value="">请选择内容模型</option>
			                        <?php $num = 0;foreach ($this->getVar('models') as $key => $value) { $num++;?>	                        	
			                        	<option value="<?php echo $value->mcode; ?>"  <?php if ($value->mcode==$this->getVar('sort')->mcode) {?>selected<?php } ?>  data-type="<?php echo $value->type; ?>"  data-listtpl="<?php echo $value->listtpl; ?>" data-contenttpl="<?php echo $value->contenttpl; ?>" ><?php echo $value->name; ?></option>
			                        <?php } ?>
			                    </select>
		                     </div>
		                </div>
		                
		                 <input type="hidden" name="type" id="type" value="<?php echo @$this->getVar('sort')->type;?>">
		                 
		                 <div class="layui-form-item">
		                     <label class="layui-form-label">列表页模板</label>
		                     <div class="layui-input-block">
			                     <select name="listtpl" id="listtpl">
			                     	<option value="<?php echo @$this->getVar('sort')->listtpl;?>"><?php echo @$this->getVar('sort')->listtpl;?></option>
			                     	<option value="">无</option>
			                     	<?php $num = 0;foreach ($this->getVar('tpls') as $key => $value) { $num++;?>
			                     		<?php if ($value!=$this->getVar('sort')->listtpl) {?>
			                        		<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
			                        	<?php } ?>
			                        <?php } ?>
			                     </select>
		                     </div>
		                </div>
		                
		                 <div class="layui-form-item">
		                     <label class="layui-form-label">详情页模板</label>
		                     <div class="layui-input-block">
			                     <select name="contenttpl" id="contenttpl" >
			                     	<option value="<?php echo @$this->getVar('sort')->contenttpl;?>"><?php echo @$this->getVar('sort')->contenttpl;?></option>
			                     	<option value="">无</option>
			                     	<?php $num = 0;foreach ($this->getVar('tpls') as $key => $value) { $num++;?>
			                     		<?php if ($value!=$this->getVar('sort')->contenttpl) {?>
			                        		<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
			                        	<?php } ?>
			                        <?php } ?>
			                     </select>
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">同步子栏目模板</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="modsub" value="1" title="是">
								<input type="radio" name="modsub" value="0" title="否" checked>
		                     </div>
		                </div> 
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">状态</label>
		                     <div class="layui-input-block">
		                     	<input type="radio" name="status" value="1" title="显示" <?php if ($this->getVar('sort')->status==1) {?>checked="checked"<?php } ?>>
								<input type="radio" name="status" value="0" title="隐藏" <?php if ($this->getVar('sort')->status==0) {?>checked="checked"<?php } ?>>
		                     </div>
		                </div>
		                
		                 <div class="layui-form-item">
			                     <label class="layui-form-label">浏览权限</label>
			                     <div class="layui-input-block">
									<select name="gid">
										<option value="">不限制</option>
				                        <?php $num = 0;foreach ($this->getVar('groups') as $key => $value) { $num++;?>
				                            <option value="<?php echo $value->id; ?>" <?php if ($this->getVar('sort')->gid==$value->id) {?>selected="selected"<?php } ?>><?php echo $value->gname; ?></option>
				                        <?php } ?>
				                    </select>
			                     </div>
			                </div>  
			                
			                <div class="layui-form-item">
			                     <label class="layui-form-label">权限类型</label>
			                     <div class="layui-input-block">
			                     	<select name="gtype" id="gtype" >
			                     		<option value="1" <?php if ($this->getVar('sort')->gtype==1) {?>selected="selected"<?php } ?>>小于</option>
			                     		<option value="2" <?php if ($this->getVar('sort')->gtype==2) {?>selected="selected"<?php } ?>>小于等于</option>
			                     		<option value="3" <?php if ($this->getVar('sort')->gtype==3) {?>selected="selected"<?php } ?>>等于</option>
			                     		<option value="4" <?php if ($this->getVar('sort')->gtype==4||(!$this->getVar('sort')->gtype)) {?>selected="selected"<?php } ?>>大于等于</option>
			                     		<option value="5" <?php if ($this->getVar('sort')->gtype==5) {?>selected="selected"<?php } ?>>大于</option>
									</select>
			                     </div>
			                </div> 

		                
				    </div>
				    <div class="layui-tab-item">
				    	<div class="layui-form-item">
		                     <label class="layui-form-label">栏目副名称</label>
		                     <div class="layui-input-block">
		                     	<input type="text" name="subname" value="<?php echo @$this->getVar('sort')->subname;?>" placeholder="请输入栏目副名称" class="layui-input">
		                     </div>
		                </div>
		                
		                 <div class="layui-form-item">
		                     <label class="layui-form-label">栏目描述1</label>
		                     <div class="layui-input-block">
		                     	<input type="text" name="def1"  value="<?php echo @$this->getVar('sort')->def1;?>"  placeholder="请输入栏目描述1内容"  class="layui-input">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">栏目描述2</label>
		                     <div class="layui-input-block">
		                     	<input type="text" name="def2" value="<?php echo @$this->getVar('sort')->def2;?>" placeholder="请输入栏目描述2内容"  class="layui-input">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">栏目描述3</label>
		                     <div class="layui-input-block">
		                     	<input type="text" name="def3" value="<?php echo @$this->getVar('sort')->def3;?>" placeholder="请输入栏目描述3内容"  class="layui-input">
		                     </div>
		                </div>
			                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">跳转链接</label>
		                     <div class="layui-input-block">
		                     	<input type="text" name="outlink" value="<?php echo @$this->getVar('sort')->outlink;?>" placeholder="请输入跳转链接" class="layui-input">
		                     </div>
		                </div>
		                
	                    <div class="layui-form-item">
		                     <label class="layui-form-label">权限不足提示</label>
		                     <div class="layui-input-block">
		                     	<input type="text" name="gnote" value="<?php echo @$this->getVar('sort')->gnote;?>"  placeholder="请输入权限不足时提示文本"  class="layui-input">
		                     </div>
		                </div>
		                
		                 <div class="layui-form-item">
		                     <label class="layui-form-label">栏目缩略图</label>
		                     <div class="layui-input-inline">
		                     	<input type="text" name="ico" id="ico" value="<?php echo @$this->getVar('sort')->ico;?>" placeholder="请上传栏目缩略图"  class="layui-input">
		                     </div>
		                     <button type="button" class="layui-btn upload" data-des="ico">
							 	 <i class="layui-icon">&#xe67c;</i>上传图片
							 </button>
							 <div id="ico_box" class="pic"><dl><dt><?php if ($this->getVar('sort')->ico) {?><img src='<?php echo SITE_DIR;?><?php echo @$this->getVar('sort')->ico;?>' data-url="<?php echo @$this->getVar('sort')->ico;?>"></dt><dd>删除</dd></dl><?php } ?></div>
		                </div>
		                
		                 <div class="layui-form-item">
		                     <label class="layui-form-label">栏目大图</label>
		                     <div class="layui-input-inline">
		                     	<input type="text" name="pic" id="pic" value="<?php echo @$this->getVar('sort')->pic;?>" placeholder="请上传栏目大图"  class="layui-input">
		                     </div>
		                     <button type="button" class="layui-btn upload" data-des="pic">
							 	 <i class="layui-icon">&#xe67c;</i>上传图片
							 </button>
							 <div id="pic_box" class="pic"><dl><dt><?php if ($this->getVar('sort')->pic) {?><img src='<?php echo SITE_DIR;?><?php echo @$this->getVar('sort')->pic;?>' data-url="<?php echo @$this->getVar('sort')->pic;?>"></dt><dd>删除</dd></dl><?php } ?></div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">SEO标题</label>
		                     <div class="layui-input-block">
		                     	<input type="text" name="title" value="<?php echo @$this->getVar('sort')->title;?>" placeholder="请输入栏目SEO标题，需前端调用" class="layui-input">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">SEO关键字</label>
		                     <div class="layui-input-block">
		                     	<input type="text" name="keywords" value="<?php echo @$this->getVar('sort')->keywords;?>" placeholder="请输入栏目SEO关键字，需前端调用" class="layui-input">
		                     </div>
		                </div>
		                
		                <div class="layui-form-item">
		                     <label class="layui-form-label">SEO描述</label>
		                     <div class="layui-input-block">
		                     	<textarea name="description" placeholder="请输入栏目SEO描述，需前端调用" class="layui-textarea"><?php echo @$this->getVar('sort')->description;?></textarea>
		                     </div>
		                </div>
				    </div>
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
  0 => 'D:/wwwroot/www.shangye1.com/apps/admin/view/default/common/head.html',
  1 => 'D:/wwwroot/www.shangye1.com/apps/admin/view/default/common/foot.html',
); ?>