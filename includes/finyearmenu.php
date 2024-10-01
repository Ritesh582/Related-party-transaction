<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
							<? $logo_image=getrecord('tbl_company','logo_image','where company_code="'.$_SESSION['comp_code_tmp'].'"'); 
							if($logo_image!="")
							{?>
                            <img alt="image" class="img-rounded" src="img/<?=$logo_image;?>" width="100px" />
                            <? }else{ ?>
							<<img alt="image" class="img-rounded" src="img/savvybiz_logo.png" width="100px" />
							<? }?>
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs"><strong class="font-bold"><?=$_SESSION['name_tmp'];?></strong></span>
                                <span class="text-muted text-xs block"><?php echo $_SESSION['username_tmp'];?><b class="caret"></b></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="change_password.php">Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="<? if( $_SESSION['admin_user_tmp']>=1){?> admin/logout.php <? }else if($_SESSION['admin_user_tmp']>=0){?>company/logout.php <? }else{?> logout.php<?}?>">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        GST
                    </div>
                </li>
                
				
                <li class="active"><a href="#myModalforPop" id="sidebar-logOut" data-toggle="modal"><i class="fa fa-sitemap"></i> <span class="nav-label">Logout</span></a></li> 
            </ul>
        </div>
    </nav>