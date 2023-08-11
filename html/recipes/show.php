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
	href="<?php echo url_for('/recipes/index.php'); ?>"><i
		class="bi bi-arrow-left fs-2"></i>
</a>

<div class="recipe show">

	<div class="attributes py-5">
		<h1 class="mb-0"><?php echo h($recipe->recipe_name); ?></h1>
		<div class="rating" aria-description="recipe rating">
			<?php echo($recipe->rating());?>
		</div>

		<dl aria-description="Time to Cook">
			<dt><i class="bi bi-clock"></i></dt>
			<dd><?php echo h($recipe->time); ?></dd>
		</dl>
		<dl aria-description="Last Cooked Date">
			<dt><i class="bi bi-calendar4-event"></i></dt>
			<dd><?php echo h($recipe->last_cooked()); ?></dd>
		</dl>

	</div>

	<div class="recipe-info">
		<ul class="nav nav-tabs" id="recipeTab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="ingredients-tab" data-bs-toggle="tab" data-bs-target="#ingredients"
					type="button" role="tab" aria-controls="ingredients" aria-selected="true">Ingredients</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="instructions-tab" data-bs-toggle="tab" data-bs-target="#instructions"
					type="button" role="tab" aria-controls="instructions" aria-selected="false">Instructions</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notes" type="button"
					role="tab" aria-controls="notes" aria-selected="false">Notes</button>
			</li>

		</ul>
		<div class="tab-content" id="recipeTabContent">
			<div class="tab-pane fade show active py-3" id="ingredients" role="tabpanel"
				aria-labelledby="ingredients-tab">
				<?php if($recipe->ingredients) { ?>

				<ul>
					<?php $ingredients = $recipe->ingredients();?>
					<?php foreach($ingredients as $i) {?>
					<li><?php echo h($i);?></li>
					<?php } ?>
				</ul>
				<?php } ?>
			</div>
			<div class="tab-pane fade py-3" id="instructions" role="tabpanel" aria-labelledby="instructions-tab">
				<?php if($recipe->instructions) {
				    $s = 1;?>
				<?php $instructions = $recipe->instructions();?>
				<?php foreach($instructions as $i) {?>
				<div class="step py-3">
					<div class="step-num fs-5">Step <?php echo $s;?>
					</div>
					<div class="instruction">
						<?php echo h($i);?>
					</div>
				</div>

				<?php
				    $s++;
				} ?>

				<?php } ?>
			</div>
			<div class="tab-pane fade py-3" id="notes" role="tabpanel" aria-labelledby="notes-tab">
				<?php echo nl2br(h($recipe->notes));?>
			</div>
		</div>
	</div>
	<div class="category">
		<div class="badge rounded-pill bg-secondary text-uppercase fw-bold">
			<?php echo h($recipe->category());?>
		</div>
	</div>
</div>
<div class="edit-link mt-3">
	<a class="card-link"
		href="<?php echo url_for('/recipes/edit.php?id=' . h(u($recipe->id))); ?>">Edit</a>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>