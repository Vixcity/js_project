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
	    <li class="layui-this" lay-id="t1">表单列表</li>
	    <li lay-id="t2">表单新增</li>
	  </ul>
	  <div class="layui-tab-content">
	  	   <div class="layui-tab-item layui-show">
	  	   		<table class="layui-table">
	            	<thead>
	                    <tr>
	                    	<th>编码</th>
							<th>表单名称</th>
	                        <th>表名称</th>
	                        <th>数据</th>
	                        <th>字段</th>
	                        <th>操作</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php $num = 0;foreach ($this->getVar('forms') as $key => $value) { $num++;?>
	                    <tr>
	                    	<td><?php echo $value->fcode; ?></td>
							<td><?php echo $value->form_name; ?></td>
	                    	<td><?php echo $value->table_name; ?></td>
	                    	<td>
	                    	<?php if ($value->id==1) {?>
	                    	<a href="<?php echo \core\basic\Url::get('/admin/Message/index');?>"><i class="fa fa-list"></i> 查看数据</a></td>
	                    	<?php } else { ?>
	                    	<a href="<?php echo \core\basic\Url::get('/admin/Form/index/fcode/'.$value->fcode.'/action/showdata');?>"><i class="fa fa-list"></i> 查看数据</a></td>
	                    	<?php } ?>
	                    	<td><a href="<?php echo \core\basic\Url::get('/admin/Form/index/fcode/'.$value->fcode.'/action/showfield');?>"><i class="fa fa-pencil-square-o"></i> 编辑字段</a></td>
	                        <td>
								
	                        	<?php if ($value->id!=1) {?>
									<a href="<?php echo \core\basic\Url::get('/admin/Form/mod/id/'.$value->id.'/action/addmenu');?><?php echo $this->getVar('btnqs');?>" class="layui-btn layui-btn-xs layui-btn-primary">添加到菜单</a>
	                        		<a href="<?php echo \core\basic\Url::get('/admin/Form/del/id/'.$value->id.'/action/delform');?>" onclick="return confirm('您确定要删除么？')" class="layui-btn layui-btn-xs layui-btn-danger" title="删除">删除</a>
	                            <?php } ?>
	                            <a href="<?php echo \core\basic\Url::get('/admin/Form/mod/id/'.$value->id.'/action/modform');?><?php echo $this->getVar('btnqs');?>" class="layui-btn layui-btn-xs">修改</a>
								
	                        </td>
	                    </tr>
	                    <?php } ?>
	                </tbody>
	            </table>
	            <div class="page"><?php echo $this->getVar('pagebar');?></div>
	  	   </div>
	  	   
	  	    <div class="layui-tab-item">
	   			<form action="<?php echo \core\basic\Url::get('/admin/Form/add/action/addform');?>" method="post" class="layui-form">
	   				<input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
	   				<div class="layui-form-item">
	                     <label class="layui-form-label">表单名称</label>
	                     <div class="layui-input-block">
	                     	<input type="text" name="form_name" maxlength=20 required lay-verify="required"  placeholder="请输入表单名称，如：报名表" class="layui-input">
	                     </div>
	                </div>
	                
	                <div class="layui-form-item">
	                     <label class="layui-form-label">表名称</label>
	                     <div class="layui-input-block">
	                     	<input type="text" name="table_name" maxlength=30 required lay-verify="required"  placeholder="请输入表名称，如：baoming" class="layui-input">
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
	
	<?php if ($this->getVar('showdata')) {?>
	<div class="layui-tab layui-tab-brief" lay-filter="tab">
	  <ul class="layui-tab-title">
	    <li class="layui-this" lay-id="t1"><?php echo @$this->getVar('form')->form_name;?> — 数据</li>
	  </ul>
	  <div class="layui-tab-content">
	  	   <div class="layui-tab-item layui-show">
	  	   		<?php $num = 0;foreach ($this->getVar('formdata') as $key => $value) { $num++;?>
	  	   		<table class="layui-table table-two">
	  	   			<thead>
				  		<tr>
					  		<th colspan="2">
					  			<?php echo @$this->getVar('form')->form_name;?>-<?php echo @(PAGE-1)*PAGESIZE+$num; ?> 
					  			<span style="float:right"><a href="<?php echo \core\basic\Url::get('/admin/Form/del/id/'.$value->id.'/fcode/'.$this->getVar('form')->fcode.'/action/deldata');?>" onclick="return confirm('您确定要删除么？')" class="layui-btn layui-btn-xs layui-btn-danger" style="margin-bottom:0px" title="删除">删除</a></span>
					  		</th>
					  	</tr>
				    </thead>
	  	   			<tbody>
		  	   			<?php $num2 = 0;foreach ($this->getVar('fields') as $key2 => $value2) { $num2++;?>
			  	   			<tr>
						      	<th><?php echo $value2->description; ?></th>
						      	<?php   $field=$value2->name ?>
						      	<td><?php echo $value->$field; ?></td>
						    </tr>
		  	   			<?php } ?>
		  	   			<tr>
					      	<th>时间</th>
					      	<td><?php echo $value->create_time; ?></td>
					    </tr>
	  	   			</tbody>
	            </table>
	            <?php } ?>
	            
	            <?php if (session('ucode')==10001 && $this->getVar('formdata')) {?>
			     	<a href="<?php echo \core\basic\Url::get('/admin/Form/clear/fcode/'.$this->getVar('form')->fcode.'');?>"  onclick='return confirm("您确定要清空么？")' class="layui-btn layui-btn-sm">清空记录</a>
			    <?php } ?>
			    
			    <?php if ($this->getVar('formdata')) {?>
			    	<a href="<?php echo \core\basic\Url::get('/admin/Form/index/fcode/'.$this->getVar('form')->fcode.'/action/showdata/export/1');?>" class="layui-btn layui-btn-sm">导出记录</a>
			    <?php } ?>
			    
	            <div class="page"><?php echo $this->getVar('pagebar');?></div>
	  	   </div>
	  	 </div>
	  </div>
	<?php } ?>  	  
	
	<?php if ($this->getVar('showfield')) {?>
	<div class="layui-tab layui-tab-brief" lay-filter="tab">
	  <ul class="layui-tab-title">
	    <li class="layui-this" lay-id="t1"><?php echo @$this->getVar('form')->form_name;?>-表单字段</li>
	    <li lay-id="t2">新增字段</li>
	  </ul>
	  <div class="layui-tab-content">
	  	   <div class="layui-tab-item layui-show">
	  	   		<table class="layui-table">
	            	<thead>
	                    <tr>
	                    	<th width=40>序号</th>
	                    	<th>描述</th>
	                    	<th>字段</th>
	                    	<th>长度</th>
	                    	<th>是否必填</th>
	                    	<th>排序</th>
	                        <th>操作</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php $num = 0;foreach ($this->getVar('fields') as $key => $value) { $num++;?>
	                    <tr>
	                    	<td><?php echo @(PAGE-1)*PAGESIZE+$num; ?></td>
	                    	<td><?php echo $value->description; ?></td>
	                    	<td><?php echo $value->name; ?></td>
	                    	<td><?php echo $value->length; ?></td>
	                    	<td>
		                        <?php if ($value->required) {?>
		                        <a href="<?php echo \core\basic\Url::get('/admin/'.C.'/mod/id/'.$value->id.'/field/required/value/0');?>"><i class='fa fa-toggle-on' title="点击关闭必填"></i></a>
		                        <?php } else { ?>
		                        <a href="<?php echo \core\basic\Url::get('/admin/'.C.'/mod/id/'.$value->id.'/field/required/value/1');?>"><i class='fa fa-toggle-off' title="点击开启必填"></i></a>
		                        <?php } ?>
	                    	</td>
	                    	<td><?php echo $value->sorting; ?></td>
	                        <td>
	                       		<a href="<?php echo \core\basic\Url::get('/admin/Form/del/id/'.$value->id.'/fcode/'.get('fcode').'');?>" onclick="return confirm('您确定要删除么？')" class="layui-btn layui-btn-xs layui-btn-danger" title="删除">删除</a>
	                            <?php echo get_btn_mod($value->id);?>
	                        </td>
	                    </tr>
	                    <?php } ?>
	                </tbody>
	            </table>
	            <div class="page"><?php echo $this->getVar('pagebar');?></div>
	            <div><a href="<?php echo \core\basic\Url::get('/admin/Form/index');?>" class="layui-btn">返回表单</a></div>
	  	   </div>
	  	   
	  	   <div class="layui-tab-item">
	   			<form action="<?php echo \core\basic\Url::get('/admin/Form/add');?>" method="post" class="layui-form">
					<input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
	                <div class="layui-form-item">
	                     <label class="layui-form-label">字段描述</label>
	                     <div class="layui-input-block">
	                     	<input type="hidden" value="<?php echo get('fcode');?>" name="fcode" >
	                     	<input type="text" name="description" required lay-verify="required"  placeholder="请输入字段描述，如：联系人" class="layui-input">
	                     </div>
	                </div>
	                
	                <div class="layui-form-item">
	                     <label class="layui-form-label">字段名称</label>
	                     <div class="layui-input-block">
	                     	<input type="text" name="name" required maxlength="20" lay-verify="required"  placeholder="请输入字段名称，必须以字母开头，如：contacts" class="layui-input">
	                     </div>
	                </div>
	                
	                <div class="layui-form-item">
	                     <label class="layui-form-label">字段长度</label>
	                     <div class="layui-input-block">
	                     	<input type="text" name="length" value="20" required lay-verify="required" class="layui-input">
	                     </div>
	                </div>
	                
	                <div class="layui-form-item">
	                     <label class="layui-form-label">是否必填</label>
	                     <div class="layui-input-block">
	                     	<input type="radio" name="required" value="1" title="必填" checked>
							<input type="radio" name="required" value="0" title="非必填"  checked>
	                     </div>
	                </div>
	                
	                <div class="layui-form-item">
	                     <label class="layui-form-label">字段排序</label>
	                     <div class="layui-input-block">
	                     	<input type="text" name="sorting" value="255" required lay-verify="required" class="layui-input">
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
	
	
	<?php if (@$this->getVar('mod')) {?>
	
	<?php if ($this->getVar('form')) {?>
	<div class="layui-tab layui-tab-brief" lay-filter="tab">
	  <ul class="layui-tab-title">
	    <li class="layui-this">自定义表单修改</li>
	  </ul>
	  <div class="layui-tab-content">
	  	<div class="layui-tab-item layui-show">
	  		<form action="<?php echo \core\basic\Url::get('/admin/Form/mod/id/'.get('id').'/action/modform');?><?php echo $this->getVar('backurl');?>" method="post" class="layui-form">
	  			<input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
	  			<div class="layui-form-item">
                     <label class="layui-form-label">表单名称</label>
                     <div class="layui-input-block">
                     	<input type="text" name="form_name" maxlength=20 required value="<?php echo @$this->getVar('form')->form_name;?>" lay-verify="required"  placeholder="请输入表单名称，如：报名表" class="layui-input">
                     </div>
                </div>
                
                <div class="layui-form-item">
                     <label class="layui-form-label">表名称</label>
                     <div class="layui-input-block">
                     	<input type="text" maxlength=30 required readonly value="<?php echo @$this->getVar('form')->table_name;?>" lay-verify="required"  placeholder="请输入表名称，如：baoming" class="layui-input readonly">
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
	 
	 <?php if (@$this->getVar('field')) {?>
	 <div class="layui-tab layui-tab-brief" lay-filter="tab">
	  <ul class="layui-tab-title">
	    <li class="layui-this">表单字段修改</li>
	  </ul>
	  <div class="layui-tab-content">
	  	<div class="layui-tab-item layui-show">
	  		<form action="<?php echo \core\basic\Url::get('/admin/Form/mod/id/'.get('id').'');?><?php echo $this->getVar('backurl');?>" method="post" class="layui-form">
	  			<input type="hidden" name="formcheck" value="<?php echo $this->getVar('formcheck');?>" > 
                <div class="layui-form-item">
                     <label class="layui-form-label">字段描述</label>
                     <div class="layui-input-block">
                     	<input type="text" name="description"  value="<?php echo @$this->getVar('field')->description;?>" placeholder="请输入字段描述，如：联系人" class="layui-input">
                     </div>
                </div>
                
                <div class="layui-form-item">
                     <label class="layui-form-label">字段名称</label>
                     <div class="layui-input-block">
                     	<input type="text" name="name" readonly value="<?php echo @$this->getVar('field')->name;?>" class="layui-input readonly">
                     </div>
                </div>
                
                <div class="layui-form-item">
                     <label class="layui-form-label">字段长度</label>
                     <div class="layui-input-block">
                     	<input type="text" name="length" readonly value="<?php echo @$this->getVar('field')->length;?>" class="layui-input readonly">
                     </div>
                </div>
                
                <div class="layui-form-item">
                     <label class="layui-form-label">是否必填</label>
                     <div class="layui-input-block">
                     	<input type="radio" name="required" value="1" title="必填" <?php if ($this->getVar('field')->required==1) {?>checked<?php } ?>>
						<input type="radio" name="required" value="0" title="非必填" <?php if ($this->getVar('field')->required==0) {?>checked<?php } ?>>
                     </div>
                </div>
                
                <div class="layui-form-item">
                     <label class="layui-form-label">字段排序</label>
                     <div class="layui-input-block">
                     	<input type="text" name="sorting" value="<?php echo @$this->getVar('field')->sorting;?>" required lay-verify="required" class="layui-input">
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