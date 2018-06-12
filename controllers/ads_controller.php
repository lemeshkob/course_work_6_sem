<?php 
	class AdsController {
		public function index() {
		    if (isset($_GET['page'])) {
		        $page = $_GET['page'];
            }
			$ads = Ad::all();
			require_once('views/ads/index.php');
		}

		public function create_ad(){
		    require_once ('views/ads/create_ad.php');
		    if(isset($_POST['title']) && isset($_POST['content']) && isset($_FILES['image']['tmp_name'])) {
		        $title = $_POST['title'];
		        $content = $_POST['content'];
		        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

		        ob_start();
		        session_start();

		        $owner_id = intval($_SESSION['user_id']);
		        Ad::create_ad($title, $content, $image, $owner_id);

                header("Location: ?controller=ads&action=index");
            } else {
		        //return call('ads', 'error');
            }
        }

        public function show() {
		    if (isset($_GET['id'])) {

                if (session_status() != 2) {
                    ob_start();
                    session_start();
                }


		        $id = intval($_GET['id']);
		        $ad = Ad::show($id);

		        require_once ('views/ads/show.php');
            }
        }

        public function vote() {
		    if (isset($_GET['id'])) {
		        $id = intval($_GET['id']);

		        if (!session_start()) {
                    ob_start();
                    session_start();
                }

                $user_id = intval($_SESSION['user_id']);
		        $vote = Ad::vote($id, $user_id);

		        $ad = $this->show($id);

		        require_once ('views/ads/show.php');


                header("Location: ?controller=ads&action=show&id={$id}");
            }
        }

        public function tip() {
		    if (isset($_GET['id']) && isset($_POST['tip'])) {

                $id = intval($_GET['id']);
                $tip = floatval($_POST['tip']);

                Ad::tip($id, $tip);

                header("Location: ?controller=ads&action=show&id={$id}");
            }
        }

        public function edit() {
		    if(isset($_GET['id'])) {
		        $adId = $_GET['id'];

		        $data = [];

		        $ad = Ad::show($adId);

                require_once ('views/ads/edit.php');

		        if (isset($_POST['title'])) {
		            $data['title'] = $_POST['title'];
                }
                if (isset($_POST['content'])) {
		            $data['content'] = $_POST['content'];
                }
                if(!empty($_FILES['image']['tmp_name'])) {
		            $data['image'] = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                }

                if (isset($data)) {
		            Ad::edit($data, $adId);
                }

                $this->show($adId);


            }
        }

		public function error() {
			require_once('views/ads/error.php');
		}

		public function about() {
		    require_once ('views/about.php');
        }
	}
?>