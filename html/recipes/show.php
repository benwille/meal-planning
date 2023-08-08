<?php require_once('../../private/initialize.php'); ?>
<?php //require_login();?>
<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$recipe = Recipe::find_by_id($id);

?>

<?php $page_title = 'Show Recipe: ' . h($recipe->recipe_name);
$show_header = true; ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<a class="backlink"
	href="<?php echo url_for('/recipes/index.php'); ?>">&laquo;
	Back to List</a>

<div class="recipe show">

	<h1 class="mb-0"><?php echo h($recipe->recipe_name); ?></h1>
	<div class="rating"><?php echo($recipe->rating());?>
	</div>
	


	<div class="attributes">
		<dl>
			<dt>Prep Time:</dt>
			<dd><?php echo h($recipe->time); ?></dd>
		</dl>
		<dl>
			<dt>Last Cooked:</dt>
			<dd><?php echo h($recipe->last_cooked()); ?></dd>
		</dl>
		<dl>
			<dt>Username</dt>
			<dd><?php echo h($user->username); ?></dd>
		</dl>
		<dl>
			<dt>Role</dt>
			<dd><?php echo $recipe->is_admin() ? 'Admin' : 'User'; ?>
			</dd>
		</dl>
	</div>
	<a class="card-link"
		href="<?php echo url_for('/recipes/edit.php?id=' . h(u($recipe->id))); ?>">Edit</a>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>