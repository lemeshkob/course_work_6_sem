<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/11/18
 * Time: 3:21 AM
 */

class Vote {

    public $id;
    public $user_id;
    public $ad_id;

    public function __construct($id, $user_id, $ad_id) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->ad_id = $ad_id;
    }
}