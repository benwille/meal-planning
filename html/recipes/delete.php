<?php

require_once('../../private/initialize.php');
// require_login();
// require_admin();

if(!isset($_GET['id'])) {
    redirect_to(url_for('/recipes/index.php'));
}
$id = $_GET['id'];
$recipe = Recipe::find_by_id($id);
if($recipe == false) {
    redirect_to(url_for('/recipes/index.php'));
}

if(is_post_request()) {

    // Delete task
    $recipe->delete();
    $session->message('The recipe was deleted successfully.');
    redirect_to(url_for('/recipes/index.php'));

} else {
    // Display form
}

?>

<?php $page_title = 'Delete recipe';
$show_header = true; ?>
<?php include(SHARED_PATH . '/header.php'); ?>



<a class="backlink"
	href="<?php echo url_for('/recipes/index.php'); ?>">&laquo;
	Back to List</a>

<div class="recipes delete">
	<h1>Delete recipe</h1>
	<p>Are you sure you want to delete this recipe?</p>
	<p class="item"><?php echo h($recipe->recipe_name); ?></p>

	<form
		action="<?php echo url_for('/recipes/delete.php?id=' . h(u($id))); ?>"
		method="post">
		<div class="form-group row" id="operations">
			<div class="col-auto">
				<button class="btn btn-primary" type="submit" name="commit" value="Delete recipe">Delete recipe</button>
			</div>
		</div>
	</form>
</div>



<?php include(SHARED_PATH . '/footer.php'); ?>