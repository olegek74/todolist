<?php defined('ROOTPATH') or die('access denied'); ?>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="display-6 mb-3">Login</div>
        <?php $this->tmpl('utils', 'messages', ['messages' => $messages]); ?>
        <form action="index.php" novalidate>
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input class="form-control" id="login" name="login">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <input type="hidden" name="ctrl" value="user" />
            <input type="hidden" name="task" value="login" />
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>