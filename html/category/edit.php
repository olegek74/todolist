<?php use App\Classes\Helper;
$view = Helper::getView();
?>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="display-6 mb-3">Edit category</div>
        <?php echo $view->messages(); ?>
        <form action="/index.php" method="get" novalidate>
            <input type="hidden" name="ctrl" value="category" />
            <input type="hidden" name="task" value="edit" />
            <input type="hidden" name="id" value="<?php echo $view->id;?>" />
            <?php if(!empty($catlist)){ ?>
                <div class="mb-3">
                    <label for="parent_id" class="form-label">Parent</label>
                    <select id="parent_id" class="form-select" name="parent_id">
                        <option>No category</option>
                        <?php foreach($catlist as $category){
                                if($category['id'] == $view->id) continue;
                                $selected = ($view->parent_id == $category['id']) ? ' selected' : '';?>
                                <option<?php echo $selected;?> value="<?php echo $category['id'];?>">
                                <?php echo $category['name'];?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $view->name;?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description"><?php echo trim($view->description);?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>