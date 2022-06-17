<div class="col-auto">
    <form method="get" action="<?php echo rtrim($main_link, '&');?>">
        <input type="hidden" name="sort" value="<?php echo $sort;?>" />
        <select class="form-select" id="curr_list_opt">
            <?php foreach([3, 6, 12, 25, 50] as $opt){
                $selected = ($curr_list_opt == $opt) ? ' selected' : '';
            ?>
            <option<?php echo $selected;?> value="<?php echo $opt;?>"><?php echo $opt;?></option>
            <?php } ?>
        </select>
    </form>
</div>