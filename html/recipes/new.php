<?php

require_once('../../private/initialize.php');
// require_login();
// require_admin();

if(is_post_request()) {

    // Create record using post parameters
    $args = $_POST['recipe'];
    $recipe = new Recipe($args);
    // var_dump($recipe);
    // die;
    $result = $recipe->save();
    // var_dump($result);
    // die;
    // print_r ($recipe->sanitized_attributes());


    if($result === true) {
        $new_id = $recipe->id;
        // $session->message('The recipe was created successfully.');
        redirect_to(url_for('/recipes/show.php?id=' . $new_id));
    } else {
        // show errors
    }

} else {
    // display the form
    $recipe = new Recipe();
}


$sql = 'SELECT * FROM calendar';
$query = $recipe->query($sql);
// var_dump($query[6]);

?>

<?php $page_title = 'Create Recipe';
$show_header = true;?>
<?php include(SHARED_PATH . '/header.php'); ?>


<a class="backlink"
	href="<?php echo url_for('/recipes/index.php'); ?>">&laquo;
	Back to List</a>

<div class="recipe new">
	<h1>Create Recipe</h1>

	<?php echo display_errors($recipe->errors); ?>

	<form
		action="<?php echo url_for('/recipes/new.php'); ?>"
		method="post">

		<?php include('form_fields.php'); ?>

		<button type="submit" class="btn btn-primary my-3">Create Recipe</button>

	</form>

</div>


<?php include(SHARED_PATH . '/footer.php'); ?>