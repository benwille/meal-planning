<!doctype html>
<?php
// $start = microtime(true);
$loginTime = $_SESSION['last_login'] ?? null;
if ($loginTime) {
    $loginDate = date("M d h:i:s A", $loginTime);
}
$msg = $loginDate ?? 'Not logged in';
echo '<script>console.log("' . $msg . '");</script>';
?>
<html lang="en">

<head>
	<title><?php // TODO: page title?>Meal Planning
		<?php if (isset($page_title)) {
		    echo '- ' . h($page_title);
		} ?>
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
	<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
	<link rel="stylesheet" media="all"
		href="<?php echo url_for('/css/theme.min.css'); ?>" />
	<link rel="shortcut icon"
		href="<?php // TODO echo url_for('');?>"
		type="image/x-icon">
	<link rel="icon"
		href="<?php // TODO: echo url_for('');?>"
		type="image/x-icon">
	<link rel="apple-touch-icon"
		href="<?php echo url_for('/images/apple-touch-icon.png'); ?>">
	<link rel="apple-touch-icon" size="152x152"
		href="<?php echo url_for('/images/apple-touch-icon-ipad.png'); ?>">
	<link rel='manifest' href='/manifest.json'>
	<meta name="theme-color" content="#ef5350">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta rel="apple-touch-startup-image"
		href="<?php echo url_for('/images/apple-touch-icon.png'); ?>">
	<!-- iOS Splash Screen Images -->
	<link rel="apple-touch-startup-image"
		href="<?php echo url_for('/images/apple-splash-640.png'); ?>"
		media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
	<link rel="apple-touch-startup-image"
		href="<?php echo url_for('/images/apple-splash-750.png'); ?>"
		media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
	<link rel="apple-touch-startup-image"
		href="<?php echo url_for('/images/apple-splash-1242.png'); ?>"
		media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
	<link rel="apple-touch-startup-image"
		href="<?php echo url_for('/images/apple-splash-828.png'); ?>"
		media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
	<link rel="apple-touch-startup-image"
		href="<?php echo url_for('/images/apple-splash-1125.png'); ?>"
		media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
	<link rel="apple-touch-startup-image"
		href="<?php echo url_for('/images/apple-splash-1536.png'); ?>"
		media="(min-device-width: 768px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">
	<link rel="apple-touch-startup-image"
		href="<?php echo url_for('/images/apple-splash-1668.png'); ?>"
		media="(min-device-width: 834px) and (max-device-width: 834px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">
	<link rel="apple-touch-startup-image"
		href="<?php echo url_for('/images/apple-splash-2048.png'); ?>"
		media="(min-device-width: 1024px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">

	<?php // TODO: decide what JS files you want to include?>

	<!-- <script src="<?php echo url_for('/js/yall.min.js'); ?>">
	</script> -->
	<!-- <script src="<?php echo url_for('/js/app.js'); ?>">
	</script> -->
	<!-- <script>
    document.addEventListener("DOMContentLoaded", yall);
  </script> -->

	<?php // TODO:?>
	<meta property="og:url" content="<?php echo getURL(); ?>" />
	<meta property="og:title"
		content="<?php echo h($page_title); ?>" />
	<meta property="og:description" content="<?php // TODO:?>" />
	<meta property="og:image"
		content="<?php // TODO: echo url_for('');?>" />

</head>

<body <?php if ($page_classes) : ?>
	class="<?php echo implode(", ", $page_classes); ?>"
	<?php endif; ?>>
	<?php if ($show_header == true) { ?>
	<header class="bg-primary">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-dark">
				<div class="container-fluid">
					<a class="navbar-brand"
						href="<?php echo url_for('/'); ?>">Meal
						Planning</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
						data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
						aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
						<div class="navbar-nav">
							<a class="nav-item nav-link"
								href="<?php echo url_for('/'); ?>">Schedule</a>
							<a class="nav-item nav-link"
								href="<?php echo url_for('/recipes/'); ?>">Recipes</a>
							<?php if ($session->is_logged_in()) { ?>
							<a class="nav-item nav-link"
								href="<?php echo url_for('/users/show.php?id=' . h(u($session->admin_id()))); ?>">Admin</a>
							<div class="d-inline d-sm-none text-light"><a
									href="<?php echo url_for('/users/show.php?id=' . h($session->admin_id())); ?>"
									class="text-white"><img
										src="<?php echo url_for('/images/user.svg'); ?>"
										style="height:25px" alt="user" /> User:
									<?php echo $session->username; ?></a>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</nav>

			<!-- nav -->

		</div>

	</header><!-- Header Container -->
	<?php } ?>


	<div class="<?php echo $container ?: 'container'; ?>"
		id="content">
		<?php echo display_session_message(); ?>