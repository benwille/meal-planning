<?php require_once('../private/initialize.php'); ?>

<?php
$today = date('U', strtotime('today'));

if(is_post_request()) {

    // Create record using post parameters
    $args = $_POST['calendar'];
    $x = 0;
    foreach($args as $day) {
        if (!$day['recipe_name']) {
            continue;
        }
        $plan = new Calendar($day);
        if(!strlen($plan->id > 0)) {
            console_log('unset');
            unset($plan->id);
        }
        $result = $plan->save();

        if($result === true) {
            continue;
        } else {
            // show errors
            console_log($plan);
            $x++;
        }
        if($x > 0) {
            $session->message('There were ' . $x . ' errors. Please try again.');
        } else {
            $session->message('Weekly meal plan was updated successfully');

        }
        // redirect_to(url_for('/index2.php'));
    }

} else {
    // display the form
}

?>

<?php
$page_title = 'Home';
$page_classes[] = 'home';
$show_header = true;

$date = date_create_from_format('U', date("U", strtotime("sunday -1 week")));
// console_log(($date));
$active_week[] = date_format($date, "U");
for($i = 1; $i < 7; $i++) {
    $d = date_add($date, date_interval_create_from_date_string('1 day'));
    $active_week[] = date_format($d, "U");
}
// console_log($active_week);
$i=0;
?>
<?php include(SHARED_PATH . '/header.php'); ?>


<div id="calendar"></div>

<main class="container <?php //echo 'vh-100';?>">
	<form action="index2.php" method="post">
		<div
			class="row row-cols-1 g-0 <?php //echo 'h-100';?>">
			<div class="col text-center my-1">
				<div class="btn btn-secondary" id="previous">Previous</div>
				<div class="btn btn-secondary" id="next">Next</div>
			</div>
			<div id="main">

				<?php foreach($active_week as $day) {
				    $plan = Calendar::find_by_did($day);
				    ?>
				<div class="col day">
					<div class="card h-100">
						<div
							class="card-body <?php echo $day === $today ? 'active' : '';?>">
							<h6 class="card-subtitle mb-2 text-uppercase">
								<?php echo $plan ? $plan->date() : date('l M j', $day);?>
							</h6>
							<div class="card-text display-5">
								<input type="hidden"
									name="calendar[<?php echo $i;?>][d_id]"
									value="<?php echo $day;?>" />
								<input type="text"
									name="calendar[<?php echo $i;?>][recipe_name]"
									value="<?php echo $plan ? $plan->recipe_name : '';?>" />
								<input type="hidden"
									name="calendar[<?php echo $i; ?>][id]"
									value="<?php echo $plan ? $plan->id : null;?>">
							</div>
						</div>
					</div>
				</div>
				<?php
				    $i++;
				} ?>

			</div>
		</div>
		<div class="col my-1">
			<div class="btn btn-primary" id="submit">Submit</div>
		</div>
	</form>
</main>
<?php include(SHARED_PATH . '/footer.php'); ?>