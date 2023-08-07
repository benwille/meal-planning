<?php require_once('../private/initialize.php'); ?>

<?php
    $today = date('U', strtotime('today'));

if(is_post_request()) {
    $args = array_keys($_POST, '')[0];

    $date = date_create_from_format('U', date("U", $args));

    console_log(($date));
    $active_week[] = date_format($date, "U");
    for($i = 1; $i < 7; $i++) {
        $d = date_add($date, date_interval_create_from_date_string('1 day'));
        $active_week[] = date_format($d, "U");
    }

    $i=0;
    ?>


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


<?php } else {
    redirect_to(url_for('/'));
}
?>