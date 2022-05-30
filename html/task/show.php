<?php defined('ROOTPATH') or die('access denied'); ?>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="display-6 mb-3">Show task</div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <div class="form-control" id="status"><?php echo $this->status;?></div>
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">User name</label>
            <div id="user_id" class="form-control"><?php echo $this->name;?></div>
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">User email</label>
            <div id="user_id" class="form-control"><?php echo $this->email;?></div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <div class="form-control" id="description"><?php echo trim($this->description);?></div>
        </div>
    </div>
</div>