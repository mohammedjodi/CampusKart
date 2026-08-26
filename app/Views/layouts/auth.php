<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title><?= $this->renderSection('title') ?></title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="<?= base_url('vendors/images/apple-touch-icon.png')?>"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="<?= base_url('vendors/images/favicon-32x32.png')?>"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="<?= base_url('vendors/images/favicon-16x16.png')?>"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="<?= base_url('vendors/styles/core.css')?>" />
		<link
			rel="stylesheet"
			type="text/css"
			href="<?= base_url('vendors/styles/icon-font.min.css') ?>"
		/>
		<link rel="stylesheet" type="text/css" href="<?= base_url('vendors/styles/style.css')?>" />
		<link rel="stylesheet" type="text/css" href="<?= base_url('src/styles/style.css')?>" />

		
	</head>
	<body class="login-page">
		<div class="login-header box-shadow">
			<div
				class="container-fluid d-flex justify-content-center align-items-center"
			>
				<div class="brand-logo">
					<a href="login.html">
						<img src="<?= base_url('vendors/images/CampusKart.svg')?>" alt="" />
					</a>
				</div>
				<!-- <div class="login-menu">
					<ul>
						<li><a href="register.html">Register</a></li>
					</ul>
				</div> -->
			</div>
		</div>
		
		<?= $this->renderSection('content')?>
						
		
			
		<!-- js -->
		<script src="<?= base_url('vendors/scripts/core.js')?>"></script>
		<script src="<?= base_url('vendors/scripts/script.min.js')?>"></script>
		<script src="<?= base_url('vendors/scripts/process.js')?>"></script>
		<script src="<?= base_url('vendors/scripts/layout-settings.js')?>"></script>
		
	</body>
</html>
