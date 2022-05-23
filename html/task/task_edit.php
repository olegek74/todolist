<?php defined('ROOTPATH') or die('access denied'); ?>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="display-6 mb-3">Edit task</div>
        <form action="index.php" method="get" novalidate>
            <input type="hidden" name="ctrl" value="task" />
            <input type="hidden" name="task" value="edit" />
            <input type="hidden" name="id" value="<?php echo $data['id'];?>" />
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="number" class="form-control" id="status" name="status" value="<?php echo $data['status'];?>">
            </div>
            <?php if(!empty($userlist)){ ?>
                <div class="mb-3">
                    <label for="user_id" class="form-label">User</label>
                    <select id="user_id" class="form-select" name="user_id">
                        <?php foreach($userlist as $user){
                                $selected = ($data['user_id'] == $user['uid']) ? ' selected' : '';?>
                                <option<?php echo $selected;?> value="<?php echo $user['uid'];?>">
                                <?php echo $user['name'];?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description"><?php echo trim($data['description']);?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>