<div class="row">
    <div class="col-12 col-md-6">
        <div class="display-6 mb-3">Unlogin</div>
        <form action="index.php" novalidate>
            <input type="hidden" name="ctrl" value="user" />
            <input type="hidden" name="task" value="unlogin" />
            <button type="submit" class="btn btn-primary">Unlogin</button>
        </form>
        <hr>
        <div class="display-6 mb-3">Edit profile</div>
        <form action="index.php" novalidate>
            <input type="hidden" name="ctrl" value="user" />
            <input type="hidden" name="task" value="view_add" />
            <input type="hidden" name="id" value="<?php echo $this->user_id;?>" />
            <!--<input type="hidden" name="self" value="1" />-->
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
    <div class="col-12 col-md-6">
        <div class="display-6 mb-3">Show Profile</div>
        <div class="mb-3">
            <label for="username" class="form-label">User Name</label>
            <div class="form-control" id="username"><?php echo $this->name;?></div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">User Email</label>
            <div id="email" class="form-control"><?php echo $this->email;?></div>
        </div>
        <div class="mb-3">
            <label for="login" class="form-label">User Login</label>
            <div id="login" class="form-control"><?php echo $this->login;?></div>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">User Role</label>
            <div class="form-control" id="role"><?php echo ($this->role == '1') ? 'admin' : 'manager'; ?></div>
        </div>
    </div>
</div>
