<?php use App\Classes\Helper;
$view = Helper::getView();
?>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="display-6 mb-3">Show Category</div>
        <?php echo $view->messages(); ?>
        <div class="mb-3">
            <label for="status" class="form-label">Parent</label>
            <div class="form-control" id="status"><?php echo $view->parent ? : "None";?></div>
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">Name</label>
            <div id="user_id" class="form-control"><?php echo $view->name;?></div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <div class="form-control" id="description"><?php echo trim($view->description);?></div>
        </div>
    </div>
</div>