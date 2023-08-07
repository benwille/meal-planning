<?php

class Recipe extends DatabaseObject
{
    protected static $table_name = "recipe";
    protected static $db_columns = ['id', 'recipe_name', 'rating', 'time', 'ingredients', 'instructions', 'last_cooked'];

    public $id;
    public $recipe_name;
    public $rating;
    public $time;
    public $ingredients;
    public $instructions;
    public $last_cooked;

    public function __construct($args=[])
    {
        // $this->id = $args['id'] ?? '';
        $this->recipe_name = $args['recipe_name'] ?? '';
        $this->rating = $args['d_id'] ?? null;
        $this->time = $args['time'] ?? null;
        $this->ingredients = serialize($args['ingredients']) ?? '';
        $this->instructions = serialize($args['instructions']) ?? '';
        $this->last_cooked = $args['last_cooked'] ?? '';
    }

    public function ingredients()
    {
        if(unserialize($this->ingredients) != null) {
            return unserialize($this->ingredients);
        } else {
            return [
                0 => ''
            ];
        }
    }

    public function instructions()
    {
        if(unserialize($this->instructions) != null) {
            return unserialize($this->instructions);
        } else {
            return [
                0 => ''
            ];
        }
    }

}
