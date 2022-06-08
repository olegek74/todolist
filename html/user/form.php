<?php use App\Classes\Helper;
$view = Helper::getView();
?>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="display-6 mb-3"><?php echo $view->title;?></div>
        <?php echo $view->messages(); ?>
        <form action="/index.php" novalidate>
           <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" id="name" name="name" value="<?php echo $view->name;?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" id="email" name="email" value="<?php echo $view->email;?>">
            </div>
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input class="form-control" id="login" name="login" value="<?php echo $view->login;?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="">
            </div>
            <div class="mb-3">
                <input class="form-check-input" type="checkbox"<?php echo ($view->manager) ? " checked" : ""; ?> value="1" id="manager" name="manager">
                <label class="form-check-label" for="manager">
                    Is manager?
                </label>
            </div>
            <input type="hidden" name="ctrl" value="user" />
            <?php if($view->id){ ?>
            <input type="hidden" name="id" value="<?php echo $view->id;?>" />
                <?php if($view->is_self) { ?>
                <input type="hidden" name="task" value="self_update" />
                <?php } else { ?>
                <input type="hidden" name="task" value="update" />
                <?php } ?>
            <?php } else { ?>
            <input type="hidden" name="task" value="add" />
            <?php } ?>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>