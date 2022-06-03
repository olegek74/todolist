<div class="col-auto">
    <select class="form-select" id="curr_list_opt">
        <?php foreach([3, 6, 12, 25, 50] as $opt){
            $selected = ($curr_list_opt == $opt) ? ' selected' : '';
        ?>
        <option<?php echo $selected;?> value="<?php echo $opt;?>"><?php echo $opt;?></option>
        <?php } ?>
    </select>
</div>