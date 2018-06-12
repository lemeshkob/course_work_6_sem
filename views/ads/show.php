<div class="card" style="margin-top: 20px; background-color: aliceblue;">
    <?php
        if (isset($_SESSION['username'])) {
            if (intval($_SESSION['user_id']) == intval($ad->owner_id)) {
                echo '<span>
        <a class="float-right" style="margin-right: 1em;" href="?controller=ads&action=edit&id=' . $ad->id .'">Edit</a>
    </span>';
            }
            }
    ?>
    <span>
        <?php echo '<img class="rounded float-left" style="width: 40em; margin: 0.5em;"  src="data:image/jpeg;base64,'.base64_encode( $ad->image ).'"/>'; ?>
        <h2 class="title centered" align="center" style="margin-right: 0.5em;">
            <?php echo $ad->title; ?>
        </h2>

        <h5 style="color: coral; margin-right: 1em;" class="float-right">
            Crowdfunded:&nbsp<?php echo $ad->price?>$
        </h5>
        <h5 class="float-right" style="margin-right: 1em; color: cornflowerblue;">
            Votes: <?php echo $ad->rate?>
        </h5>
        <a href="?controller=ads&action=vote&id=<?php echo $ad->id?>"
           class="btn btn-outline-primary float-left
            <?php

           $db = Db::getInstance();
           $userId = $_SESSION['user_id'];
           $req = $db->query("SELECT * FROM votes WHERE user_id = '$userId' AND ad_id = '$ad->id'");
           $vote = $req->fetch();

           if ($vote || intval($ad->owner_id) == intval($_SESSION['user_id'])) {
               echo 'disabled';
           }
           ?>"
         style="margin-right: 1em;">Vote for ad</a>
        <br><br>
        <small class="float-left" style="color: cornflowerblue; margin-right: 1em;">
            <?php
            if ($vote) {
                echo 'You\'ve already voted for this ad <br> please leave a tip if you want';
            } else if (intval($ad->owner_id) == intval($_SESSION['user_id'])) {
                echo 'You cant vote for this ad! <br> You are the owner!';
            } else {
                echo 'Vote for this ad to advertise it to whole world';
            }
            ?>
        </small>
        <br>
        <p align="center" style="margin: 1em;">
            <?php echo $ad->content; ?>
        </p>
            <div class="centered">
        <form method="post" action="?controller=ads&action=tip&id=<?php echo $ad->id?>" class="form-inline">
            <div class="form-group" style="margin: 1em;">
                <label style="margin-right: 1em;">Size of tip</label>
                <input type="number" step="0.01" class="form-control", name="tip">
            </div>
            <button type="submit" class="btn btn-primary">Tip</button>
            <small style="color: indianred; margin-left: 1em;">Tip for this ad to help the dreams come true!</small>
        </form>
    </div>
    </span>
</div>
<?php
var_dump($_SESSION['user_id']);
var_dump($ad->owner_id);
die;
?>
<div class="container float-right" style="margin-right: 0.5em;">

</div>