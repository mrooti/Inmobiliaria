<div class="menu-right">
	<div class="user-panel-top">  	
		<div class="profile_details_left">
			<ul class="nofitications-dropdown">
				<li class="dropdown">
					<!--<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">3</span></a>-->
						
							<!--<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>You have 3 new messages</h3>
									</div>
								</li>
								<li><a href="#">
								   <div class="user_img"><img src="images/1.png" alt=""></div>
								   <div class="notification_desc">
									<p>Lorem ipsum dolor sit amet</p>
									<p><span>1 hour ago</span></p>
									</div>
								   <div class="clearfix"></div>	
								 </a></li>
								 <li class="odd"><a href="#">
									<div class="user_img"><img src="images/1.png" alt=""></div>
								   <div class="notification_desc">
									<p>Lorem ipsum dolor sit amet </p>
									<p><span>1 hour ago</span></p>
									</div>
								  <div class="clearfix"></div>	
								 </a></li>
								<li><a href="#">
								   <div class="user_img"><img src="images/1.png" alt=""></div>
								   <div class="notification_desc">
									<p>Lorem ipsum dolor sit amet </p>
									<p><span>1 hour ago</span></p>
									</div>
								   <div class="clearfix"></div>	
								</a></li>
								<li>
									<div class="notification_bottom">
										<a href="#">See all messages</a>
									</div> 
								</li>
							</ul>-->
				</li>
				<!--<li class="login_box" id="loginContainer">
						<div class="search-box">
							<div id="sb-search" class="sb-search">
								<form>
									<input class="sb-search-input" placeholder="Enter your search term..." type="search" id="search">
									<input class="sb-search-submit" type="submit" value="">
									<span class="sb-icon-search"> </span>
								</form>
							</div>
						</div>
							
				</li>-->
				<!--<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
						<ul class="dropdown-menu">
							<li>
								<div class="notification_header">
									<h3>You have 3 new notification</h3>
								</div>
							</li>
							<li><a href="#">
								<div class="user_img"><img src="images/1.png" alt=""></div>
							   <div class="notification_desc">
								<p>Lorem ipsum dolor sit amet</p>
								<p><span>1 hour ago</span></p>
								</div>
							  <div class="clearfix"></div>	
							 </a></li>
							 <li class="odd"><a href="#">
								<div class="user_img"><img src="images/1.png" alt=""></div>
							   <div class="notification_desc">
								<p>Lorem ipsum dolor sit amet </p>
								<p><span>1 hour ago</span></p>
								</div>
							   <div class="clearfix"></div>	
							 </a></li>
							 <li><a href="#">
								<div class="user_img"><img src="images/1.png" alt=""></div>
							   <div class="notification_desc">
								<p>Lorem ipsum dolor sit amet </p>
								<p><span>1 hour ago</span></p>
								</div>
							   <div class="clearfix"></div>	
							 </a></li>
							 <li>
								<div class="notification_bottom">
									<a href="#">See all notification</a>
								</div> 
							</li>
						</ul>
				</li>	
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">22</span></a>
						<ul class="dropdown-menu">
							<li>
								<div class="notification_header">
									<h3>You have 8 pending task</h3>
								</div>
							</li>
							<li><a href="#">
									<div class="task-info">
									<span class="task-desc">Database update</span><span class="percentage">40%</span>
									<div class="clearfix"></div>	
								   </div>
									<div class="progress progress-striped active">
									 <div class="bar yellow" style="width:40%;"></div>
								</div>
							</a></li>
							<li><a href="#">
								<div class="task-info">
									<span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
								   <div class="clearfix"></div>	
								</div>
							   
								<div class="progress progress-striped active">
									 <div class="bar green" style="width:90%;"></div>
								</div>
							</a></li>
							<li><a href="#">
								<div class="task-info">
									<span class="task-desc">Mobile App</span><span class="percentage">33%</span>
									<div class="clearfix"></div>	
								</div>
							   <div class="progress progress-striped active">
									 <div class="bar red" style="width: 33%;"></div>
								</div>
							</a></li>
							<li><a href="#">
								<div class="task-info">
									<span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
								   <div class="clearfix"></div>	
								</div>
								<div class="progress progress-striped active">
									 <div class="bar  blue" style="width: 80%;"></div>
								</div>
							</a></li>
							<li>
								<div class="notification_bottom">
									<a href="#">See all pending task</a>
								</div> 
							</li>
						</ul>
				</li>-->	   							   		
				<div class="clearfix"></div>	
			</ul>
		</div>
		<div class="profile_details">		
			<ul>
				<li class="dropdown profile_details_drop">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<div class="profile_img">	
							<span style="background:url(../images/icon-user.png) no-repeat center; background-size: cover"> </span> 
							 <div class="user-name">
							 	<?php
							 		global $mysqli;
							 		$persona=seguridad($_SESSION['user']['id_persona']);
							 		$resultado=$mysqli->query("SELECT Nombres, Apellido_p, apellido_m FROM persona WHERE id_persona='{$persona}'")or die("Error en: ".$mysqli->error);
							 		$row=$resultado->fetch_array(MYSQLI_ASSOC);
							 	?>
								<p><?php echo $row['Nombres']; ?> <span><?php echo $row['Apellido_p']." ".$row['apellido_m']; ?></span></p><!--Nombre de Usuario-->
							 </div>
							 <i class="lnr lnr-chevron-down"></i>
							 <i class="lnr lnr-chevron-up"></i>
							<div class="clearfix"></div>	
						</div>	
					</a>
					<ul class="dropdown-menu drp-mnu">
						<li> <a href="../control/close.php"><i class="fa fa-sign-out"></i> Salir</a> </li>
					</ul>
				</li>
				<div class="clearfix"> </div>
			</ul>
		</div>					             	
		<div class="clearfix"></div>
	</div>
	</div>