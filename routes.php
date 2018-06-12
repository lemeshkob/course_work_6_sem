<?php 
	function call($controller, $action) {
		require_once('controllers/'.$controller.'_controller.php');

		switch ($controller) {
			case 'ads':
				require_once('models/Ad.php');
				$controller = new AdsController();
			break;

            case 'users':
                require_once('models/User.php');
                $controller = new UsersController();
                break;
		}

		$controller->{ $action }();
	}

	$controllers = array(
	    'ads' => [
            'index',
            'create_ad',
            'show',
            'about',
            'vote',
            'tip',
            'edit',
            'error',
            ],
        'users' => [
            'register',
            'login',
            'logout'
        ]);

	if (array_key_exists($controller, $controllers)) {
		if (in_array($action, $controllers[$controller])) {
			call($controller, $action);
		} else {
			call('ads', 'error');
		}
	}  else {
			call('ads', 'error');
	}
?>