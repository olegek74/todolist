<?php defined('ROOTPATH') or die('access denied'); ?>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="display-6 mb-3">Add user</div>
        <?php
        require ROOTPATH . DS . 'html' . DS . 'utils'. DS .'messages.php';
        ?>
        <form action="index.php" novalidate>
           <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" id="name" name="name" value="<?php echo $this->name;?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" id="email" name="email" value="<?php echo $this->email;?>">
            </div>
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input class="form-control" id="login" name="login" value="<?php echo $this->login;?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $this->password;?>">
            </div>
            <div class="mb-3">
                <input class="form-check-input" type="checkbox"<?php echo ($this->manager) ? " checked" : ""; ?> value="1" id="manager" name="manager">
                <label class="form-check-label" for="manager">
                    Is manager?
                </label>
            </div>
            <input type="hidden" name="ctrl" value="user" />
            <input type="hidden" name="task" value="add" />
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>