<?php defined('ROOTPATH') or die('access denied'); ?>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="display-6 mb-3">Unlogin</div>
        <form action="index.php" novalidate>
            <input type="hidden" name="ctrl" value="user" />
            <input type="hidden" name="task" value="unlogin" />
            <button type="submit" class="btn btn-primary">Unlogin</button>
        </form>
    </div>
</div>
