<div class="row" style="margin: 0;">
    <?php foreach ($ads as $ad) { ?>
        <div class="col-sm-3" style="margin-top: 20px;">
            <div class="card" style="width: 20rem; height: 35em;">
                <?php echo '<img class="card-img-top" style="height: 20em;"  src="data:image/jpeg;base64,'.base64_encode( $ad->image ).'"/>'; ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $ad->title?></h5>
                    <p class="card-text">
                        <?php
                        if (strlen($ad->content) > 50) {
                            echo substr($ad->content, 0, 50) . "<a href='?controller=ads&action=show&id={$ad->id}'>...</a>";
                        } else {
                            echo $ad->content;
                        }
                        ?>
                        </p>
                    <?php
                    if (strlen($ad->content) <=40) {
                        echo '<br>';
                    }
                    ?>
                    <h6 style="color: dimgray">Votes: <?php echo $ad->rate?> <span class="float-right" style="color: coral">Crowdfunded: <?php echo $ad->price?>$</span></h6>
                    <span>
                        <a href="?controller=ads&action=show&id=<?php echo $ad->id?>" class="btn btn-info">Details</a>
                    </span>

                </div>
            </div>
        </div>
    <?php } ?>
</div>
