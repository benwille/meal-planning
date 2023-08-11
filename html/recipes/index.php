<?php require_once('../../private/initialize.php'); ?>
<?php //require_login();
?>
<?php

// Find all admins
$recipes = Recipe::find_all();
// $admin = User::find_by_username($session->username);

?>
<?php $page_title = 'Recipes';
$show_header = true;?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div class="recipes listing">
	<h1>Recipes</h1>
	<?php //if ($admin->is_admin()) {?>
	<div class="actions">
		<a class="action"
			href="<?php echo url_for('/recipes/new.php'); ?>">Add
			Recipe</a>
	</div>
	<?php //}?>
	<div class="table-responsive">
		<table class="list table">
			<tr>
				<th>Recipe</th>
				<th>Time</th>
				<th>Rating</th>
				<th>Category</th>
				<th>Last Cooked</th>
				<th>&nbsp;</th>
				<?php //if ($user->is_admin()) {?>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<!-- <th>&nbsp;</th> -->
				<?php //}?>
			</tr>
			<?php foreach ($recipes as $recipe) { ?>
			<tr>
				<td><?php echo h($recipe->recipe_name); ?></td>
				<td><?php echo h($recipe->time);?></td>
				<td><?php echo h($recipe->rating); ?></td>
				<td><?php echo h($recipe->category()); ?></td>
				<td><?php echo h($recipe->last_cooked);?></td>
				<td class="align-middle"><a class="action"
						href="<?php echo url_for('/recipes/show.php?id=' . h(u($recipe->id))); ?>">View</a>
				</td>
				<?php //if ($user->is_admin()) {?>
				<td class="align-middle"><a class="action"
						href="<?php echo url_for('/recipes/edit.php?id=' . h(u($recipe->id))); ?>">Edit</a>
				</td>
				<td class="align-middle"><a class="action"
						href="<?php echo url_for('/recipes/delete.php?id=' . h(u($recipe->id))); ?>">Delete</a>
				</td>
				<!-- <td class="align-middle"><input type="submit" value="Update" /></td> -->
				<?php // }?>

			</tr>
			<?php } ?>
		</table>
	</div><!-- Featured Posts -->



</div>


<?php include(SHARED_PATH . '/footer.php'); ?>