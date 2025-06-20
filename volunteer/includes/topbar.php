
<!-- Topbar -->

<?php
	if (isset($deeper_page_rel)) {
		$real_page_rel = $page_rel;
		$page_rel = $deeper_page_rel;
	}
?>


<link rel="stylesheet" href="<?php echo $page_rel; ?>assets/css/header.css">
<link rel="stylesheet" href="<?php echo $page_rel; ?>property-owner/assets/css/includes/topbar.css">


<header id="topbar" class="w-100 z-99999 fixed">
	<nav class="navbar bg-gradient navbar-expand-lg py-3 px-4 px-lg-5"> 
		
		<div class="d-flex flex-nowrap justify-content-between align-items-center w-100 w-lg-25">

			<a href="<?php echo $page_rel; ?>" class="navbar-brand">
				<img src="<?php echo $page_rel; ?>assets/images/logo.png">
			</a>

			<div id="menuToggle" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navmenu">
				<input id="checkbox" type="checkbox">
				<label class="toggle" for="checkbox">
					<div class="bar bar--top"></div>
					<div class="bar bar--middle"></div>
					<div class="bar bar--bottom"></div>
				</label>
			</div>

		</div>


		<div class="collapse navbar-collapse justify-content-between p-3 p-lg-0" id="navmenu" ">
			


			<div class="d-flex flex-column flex-lg-row align-items-center justify-content-end gap-5" style=" width:100%;">	

				<div class="d-flex flex-column flex-lg-row align-items-center gap-4 me-5">

					<div class="sprites d-flex gap-4  align-items-center">
						
						<div>
							<p><?php echo date('j F, Y'); ?></p>
						</div>

						<div>
							<span class="sprite cursor-pointer">
								<img src="<?php echo $page_rel; ?>assets/images/icons/notification-bell.png" width="30" alt="">
							</span>
						</div>
						
						

					</div>

					<div class="d-flex flex-lg-row-reverse align-items-center gap-3  p-1 rounded-3" style="border: 1px solid #66391B;">
						<a href="<?php echo $page_rel; ?>admin/settings/profile">
							<img src="<?php echo $page_rel; ?>property-owner/assets/images/profile/girl.png" alt="" style="width: 40px;">
						</a>
						<p class="small lh-base">Johnson Faith</p>
					</div>
				</div>

				<div>
					<a href="<?php echo $page_rel; ?>admin/includes/log-out" class="sprite logout" >
						<div class="d-flex align-items-center gap-2 px-2 py-1" style="background-color: #F9EFE9; color: #66391B; border-radius: 5px;">
							<p>Logout</p><i class="fas fa-sign-out-alt" style="font-size: 19px; margin-left:10px;"></i>
						</div>
					</a>
				</div>

			</div>

		</div>

	</nav>
</header>


<?php
	if (isset($deeper_page_rel)) {
		$page_rel = $real_page_rel;
	}
?>

