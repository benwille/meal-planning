<?php require_once('../private/initialize.php'); ?>

<?php
    if(is_post_request()) {

        // Create record using post parameters
        $args = $_POST['plan'];
        // var_dump($_POST['plan']);
        // die;
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
        }
        if($x > 0) {
            echo 'There were ' . $x . ' errors. Please try again.';
        } else {
            echo 'Weekly meal plan was updated successfully';

        }

    } else {
        redirect_to(url_for('/'));
    }
?>