<div class="container">
    <form method="POST" action="?controller=ads&action=edit&id=<?php echo $ad->id?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="example-text-input">Title</label>
            <input class="form-control" type="text" name='title' value="<?php echo $ad->title ?>">
        </div>
        <div class="form-group">
            <label for="exampleTextarea">Ad content</label>
            <textarea class="form-control" id="exampleTextarea" rows="3" name='content'><?php echo $ad->content ?></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name="image">
            <small id="fileHelp" class="form-text text-muted">Please, choose a picture to make your ad looks better</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>