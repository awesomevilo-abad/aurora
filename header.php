<!-- start: header -->

			<header class="header">
				<div class="logo-container">
					<a href="../" class="logo">
						<img src="assets/images/aurora2.png" height="43" alt="Porto Admin" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
				
			
					<?php
							 include_once 'startChecklist/Class.php';
							 $crudcontroller = new CrudController();
							 $dao = new Dao();
							 $conn = $dao->openConnection();
					 
								$areaglobal = $conn->prepare("SELECT * FROM accounts WHERE Username=:pid");
								$areaglobal->execute(array(":pid"=>$_SESSION['username']));
								$rowAreaglobal = $areaglobal->fetch(PDO::FETCH_ASSOC);
					?>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
							<img src="icons/user.png" alt="<?php echo $rowAreaglobal['AcName'];?>" class="img-circle" data-lock-picture="icons/user2.png" />
							</figure>
							<div class="profile-info" data-lock-name="<?php echo $rowAreaglobal['AcName'];?>" data-lock-email="johndoe@okler.com">
								<span class="name"><?php echo $rowAreaglobal['AcName'];?></span>
								<span class="role"><?php echo $rowAreaglobal['Position'];?></span>
							</div>
							<!-- <i class="fa custom-caret"></i> -->
						</a>
						
					<span class="separator"></span>
						<div class="profile-info"  data-lock-name="<?php echo $rowAreaglobal['AcName'];?>">
								<span class='logout' style='cursor:pointer'><img style='height:30px;' src="icons/logout.png"/> </span>
						</div>
					</div>
				</div>
			</header>