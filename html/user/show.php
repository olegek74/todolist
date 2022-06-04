<div class="row">
    <div class="col-12 col-md-6">
        <div class="display-6 mb-3">Show User</div>
        <?php echo $messages; ?>
        <div class="mb-3">
            <label for="user_id" class="form-label">Name</label>
            <div id="user_id" class="form-control"><?php echo $this->name;?></div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Email</label>
            <div class="form-control" id="description"><?php echo $this->email ? : "";?></div>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Login</label>
            <div class="form-control" id="status"><?php echo $this->login ? : "";?></div>
        </div>
    </div>
</div>