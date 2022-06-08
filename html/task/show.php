<?php use App\Classes\Helper;
$view = Helper::getView();
?>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="display-6 mb-3">Show task</div>
        <?php echo $view->messages(); ?>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <div class="form-control" id="status"><?php echo $view->status;?></div>
        </div>
        <div class="mb-3">
            <label for="create_date" class="form-label">Create</label>
            <div class="form-control" id="create_date"><?php echo date('Y-m-d H:i', $view->create_date);?></div>
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">User name</label>
            <div id="user_id" class="form-control"><?php echo $view->name;?></div>
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">User email</label>
            <div id="user_id" class="form-control"><?php echo $view->email;?></div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <div class="form-control" id="description"><?php echo trim($view->description);?></div>
        </div>
    </div>
</div>