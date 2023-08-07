<?php require_once('../../private/initialize.php'); ?>
<?php //require_login();?>
<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$recipe = Recipe::find_by_id($id);

?>

<?php $page_title = 'Show Recipe: ' . h($recipe->full_name()); ?>
<?php include(SHARED_PATH . '/header.php'); ?>


<a class="backlink"
	href="<?php echo url_for('/recipes/index.php'); ?>">&laquo;
	Back to List</a>

<div class="recipe show">

	<h1>Recipe: <?php echo h($recipe->full_name()); ?></h1>

	<div class="attributes">
		<dl>
			<dt>First name</dt>
			<dd><?php echo h($recipe->first_name); ?></dd>
		</dl>
		<dl>
			<dt>Last name</dt>
			<dd><?php echo h($recipe->last_name); ?></dd>
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