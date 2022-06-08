<?php use App\Classes\Helper;
$view = Helper::getView();
?>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="display-6 mb-3">Add Category</div>
        <?php echo $view->messages(); ?>
        <form action="/index.php" method="get" novalidate>
            <input type="hidden" name="ctrl" value="category" />
            <input type="hidden" name="task" value="add" />
            <div class="mb-3">
                <label for="parent_id" class="form-label">Parent</label>
                <select id="parent_id" class="form-select" name="parent_id">
                    <option>No category</option>
                    <?php foreach($catlist as $category){ ?>
                        <option value="<?php echo $category['id'];?>">
                            <?php echo $category['name'];?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
