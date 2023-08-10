<?php

class Recipe extends DatabaseObject
{
    protected static $table_name = "recipe";
    protected static $db_columns = ['id', 'recipe_name', 'category', 'rating', 'time', 'ingredients', 'instructions', 'last_cooked'];

    public $id;
    public $recipe_name;
    public $category;
    public $rating;
    public $time;
    public $ingredients;
    public $instructions;
    public $last_cooked;

    public const CATEGORY = [
        1 => 'Other',
        2 => 'Beef',
        3 => 'Pork',
        4 => 'Chicken',
        5 => 'Turkey',
        6 => 'Seafood',
        7 => 'Vegetarian',
        8 => 'Salad',
        9 => 'Pasta',
        10 => 'Soups',
        11 => 'Breakfast',
        12 => 'Smoothie'
    ];

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

    public function category()
    {
        if($this->category) {
            return self::CATEGORY[$this->category];
        } else {
            return 'Unknown';
        }
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

    public function rating()
    {
        if(!$this->rating) {
            return '<span class="text-muted">No ratings</span>';
        } else {
            $rating = '';
            $r = (int)$this->rating;

            for($x=1;$x<=$r; $x++) {
                $rating .= '<i class="bi bi-star-fill text-warning"></i>';
            }
            while($x<=5) {
                $rating .= '<i class="bi bi-star text-warning"></i>';
                $x++;
            }
            return $rating;
        }
    }

    public function last_cooked()
    {
        if(!$this->last_cooked) {
            return 'Never been cooked';
        }

        $date = date_create($this->last_cooked);
        return date_format($date, 'M j, Y');

        // $diff = date_diff($date, date_create('now'));
        // $d = [];
        // // setlocale(LC_ALL, 'en_US');


        // if($diff->y > 0) {
        //     $d[] = $diff->format('%y years');
        //     // $d[] = sprintf(gettext('%d year', '%d years', $diff->y),$diff->y);
        // } elseif ($diff->m > 0) {
        //     $d[] = $diff->format('%m months');
        //     // $d[] = sprintf(ngettext('%d month', '%d months', $diff->m), $diff->m);

        // } elseif ($diff->d > 0) {
        //     $d[] = $diff->format('%d days');
        //     // $d[] = sprintf(ngettext('%d day', '%d days', $diff->d), $diff->d);

        // } else {
        //     return 'Never been cooked';
        // }

        // return implode(",", $d). ' ago';
    }

}
