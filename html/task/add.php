<?php defined('ROOTPATH') or die('access denied'); ?>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="display-6 mb-3">Add task</div>
        <?php $this->tmpl('utils', 'messages', ['messages' => $messages]); ?>
        <form action="index.php" method="get" novalidate>
            <input type="hidden" name="ctrl" value="task" />
            <input type="hidden" name="task" value="add" />
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select id="user_id" class="form-select" name="user_id">
                    <?php foreach($userlist as $user){ ?>
                        <option value="<?php echo $user['uid'];?>">
                            <?php echo $user['name'];?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <?php
            if(!empty($cat_list)){ ?>
            <div class="mb-3">
                <label for="cat_id" class="form-label">Select Category</label>
                <select id="cat_id" class="form-select" name="cat_id">
                    <option>No category</option>
                    <?php foreach($cat_list as $category){ ?>
                        <option value="<?php echo $category['id'];?>">
                            <?php echo $category['name'];?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <?php } ?>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="number" class="form-control" id="status" name="status">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
