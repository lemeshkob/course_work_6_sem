<?php
/**
 * Created by Borys Lemeshko.
 * Date: 6/10/18
 * Time: 5:16 PM
 */

require_once ('models/Vote.php');

/**
 * Class Ad
 * @author Borys Lemeshko
 */
class Ad {

    public $id;
    public $title;
    public $content;
    public $image;
    public $rate;
    public $price;
    public $owner_id;


    /**
     * Ad constructor.
     * @param $id
     * @param $title
     * @param $content
     * @param $image
     * @param $rate
     * @param $price
     * @param $owner_id
     */
    public function __construct($id, $title, $content, $image, $rate, $price, $owner_id) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->image = $image;
        $this->rate = $rate;
        $this->price = $price;
        $this->owner_id = $owner_id;
    }

    /**
     * @return array
     */
    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query("SELECT * FROM ads ORDER BY rate DESC, price DESC LIMIT 8 ");

        foreach ($req->fetchAll() as $ad) {
            $list[] = new Ad(
                $ad['id'],
                $ad['title'],
                $ad['content'],
                $ad['image'],
                $ad['rate'],
                $ad['price'],
                $ad['owner_id']
            );
        }

        return $list;
    }

    /**
     * @param $title
     * @param $content
     * @param $image
     * @param $price
     */
    public static function create_ad($title, $content, $image, $owner_id) {
        $db = Db::getInstance();
        $req = $db->query("INSERT INTO ads (title, content, image, owner_id) VALUES ('$title', '$content', '$image', '$owner_id')");
    }

    /**
     * @param $id
     * @return Ad
     */
    public static function show($id) {
        $db = Db::getInstance();
        $req = $db->query("SELECT * FROM ads WHERE id = {$id}");
        $req->execute();
        $ad = $req->fetch();

        return new Ad(
            $ad['id'],
            $ad['title'],
            $ad['content'],
            $ad['image'],
            $ad['rate'],
            $ad['price'],
            $ad['owner_id']
        );

    }


    /**
     * @param $id
     * @param $user_id
     * @return Vote
     */
    public static function vote($id, $user_id) {
        $db = Db::getInstance();
        $ad = Ad::show($id);
        $ad->rate = $ad->rate + 1;
        try {
            $req = $db->query("UPDATE ads SET rate={$ad->rate} WHERE id={$id}");
            $newReq = $db->query("INSERT INTO votes (user_id, ad_id) VALUES ('$user_id', '$id')");

            $voteReq = $db->query("SELECT * FROM votes WHERE user_id='$user_id' AND ad_id='$id'");
            $vote = $voteReq->fetch();

            return new Vote(
                $vote['id'],
                $vote['user_id'],
                $vote['ad_id']
            );
        } catch (Exception $e) {
            echo $e;
        }

    }

    public static function tip($id, $tip) {
        $db = Db::getInstance();
        $ad = Ad::show($id);

        $ad->price = $ad->price + $tip;

        try {
            $req = $db->query("UPDATE ads SET price={$ad->price} WHERE id={$id}");
        } catch (Exception $e) {
            echo $e;
        }

    }

    public static function edit($data, $id) {
        $db = Db::getInstance();

        try {
            if (isset($data['title'])) {
                $title = $data['title'];
                $req = $db->query("UPDATE ads SET title='$title' WHERE id = '$id'");
                $req->execute();
            }

            if (isset($data['content'])) {
                $content = $data['content'];
                $req = $db->query("UPDATE ads SET content='$content' WHERE id = '$id'");
                $req->execute();
            }

            if (isset($data['image'])) {
                $image = $data['image'];
                $req = $db->query("UPDATE ads SET image = '$image' WHERE id = {$id}");
                $req->execute();
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
}