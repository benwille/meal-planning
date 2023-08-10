<?php

require_once('../../private/initialize.php');
// require_login();
//require_admin();

if(!isset($_GET['id'])) {
    redirect_to(url_for('/recipes/index.php'));
}
$id = $_GET['id'];
$recipe = Recipe::find_by_id($id);
if($recipe == false) {
    redirect_to(url_for('/recipes/index.php'));
}

if(is_post_request()) {

    // Save record using post parameters
    $args = $_POST['recipe'];
    $args['ingredients'] = serialize($args['ingredients']);
    $args['instructions'] = serialize($args['instructions']);

    $recipe->merge_attributes($args);
    var_dump($recipe);
    // die;
    $result = $recipe->save();

    if($result === true) {
        $session->message('The recipe was updated successfully.');
        redirect_to(url_for('/recipes/edit.php?id=' . $id));
    } else {
        // show errors
    }

} else {

    // display the form

}

?>

<?php $page_title = 'Edit Recipe';
$show_header = true;
?>
<?php include(SHARED_PATH . '/header.php'); ?>

<a class="backlink"
	href="<?php echo url_for('/recipes/index.php'); ?>">&laquo;
	Back to List</a>

<div class="recipe edit">
	<h1>Edit Recipe</h1>

	<?php echo display_errors($recipe->errors); ?>

	<form
		action="<?php echo url_for('/recipes/edit.php?id=' . h(u($id))); ?>"
		method="post">

		<?php include('form_fields.php'); ?>
		<button type="submit" class="btn btn-primary my-3">Edit Recipe</button>

	</form>

</div>



<?php include(SHARED_PATH . '/footer.php'); ?>