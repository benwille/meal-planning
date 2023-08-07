<?php

class Calendar extends DatabaseObject
{
    protected static $table_name = "calendar";
    protected static $db_columns = ['id', 'd_id', 'date', 'recipe_name', 'recipe_id'];

    public $id;
    public $d_id;
    protected $date;
    public $recipe_name;
    public $recipe_id;

    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? '';
        $this->d_id = $args['d_id'] ?? '';
        $this->date = date('Y-m-d', $args['d_id']);
        $this->recipe_name = $args['recipe_name'] ?? '';
        $this->recipe_id = $args['recipe_id'] ?? '';
    }

    public static function find_by_did($d_id)
    {

        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE d_id='" . self::$database->escape_string($d_id) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }

    }

    public function date()
    {
        $date = date_create($this->date);
        return date_format($date, "l M j");
    }

}
