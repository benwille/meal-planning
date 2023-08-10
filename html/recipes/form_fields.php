<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($recipe)) {
    redirect_to(url_for('/recipes/index.php'));
}
$ingredients = $recipe->ingredients();
$instructions = $recipe->instructions();
?>


<div class="form-group">
	<label for="recipeName">Recipe Name</label>
	<input type="text" name="recipe[recipe_name]" class="form-control"
		value="<?php echo h($recipe->recipe_name); ?>"
		id="recipeName">
</div>
<div class="form-group">
	<label for="category">Category</label>
	<select class="form-select" name="recipe[category]">
		<option value=""></option>
		<?php
    foreach (Recipe::CATEGORY as $category_id => $category_name) { ?>
		<option value="<?php echo $category_id; ?>" <?php
                                if ($recipe->category == $category_id) {
                                    echo 'selected';
                                }
        ?>
			><?php echo $category_name; ?></option>
		<?php } ?>
	</select>
</div>
<div class="form-group">
	<label for="time">Time</label>
	<input type="text" name="recipe[time]" class="form-control"
		value="<?php echo h($recipe->time); ?>" placeholder="50 min"
		id="time">
</div>
<div class="form-group">
	<label for="ingredients">Ingredients</label>
	<?php foreach($ingredients as $i => $ingredient) { ?>
	<div class="input-group">
		<input type="text"
			name="recipe[ingredients][<?php echo $i;?>]"
			class="form-control"
			value="<?php echo h($ingredient); ?>" id="ingredients"
			placeholder="Ingredient <?php echo $i + 1;?>">
		<span class="input-group-text">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
				class="bi bi-x-square-fill text-primary" viewBox="0 0 16 16">
				<path
					d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z" />
			</svg>

		</span>
	</div>
	<?php } ?>
	<div class="invalid-feedback">
		You must have at least one ingredient.
	</div>
	<a href="" id="addIngredient" class="link-primary">Add Ingredient</a>
</div>
<div class="form-group">
	<label for="instructions">Instructions</label>
	<?php foreach($instructions as $i => $instruction) { ?>
	<div class="input-group">

		<textarea name="recipe[instructions][0]" class="form-control" id="instructions"
			placeholder="Step <?php echo $i + 1;?>"><?php echo h($instruction);?></textarea>
		<span class="input-group-text">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
				class="bi bi-x-square-fill text-primary" viewBox="0 0 16 16">
				<path
					d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z" />
			</svg>

		</span>
	</div>
	<?php } ?>
	<div class="invalid-feedback">
		You must have at least one step.
	</div>
	<a href="" id="addStep" class="link-primary">Add Step</a>
</div>
<div class="form-group">
	<label for="notes" class="form-label">Notes</label>
	<textarea class="form-control" id="notes" rows="5"
		name="recipe[notes]"><?php echo h($recipe->notes);?></textarea>
</div>