<div class="col-auto">
    <ul class="pagination">
        <?php
        if($sort){
            list($sort_dir, $sort_by) = explode(':', $sort);
        }
        else {
            $sort_dir = false;
            $sort_by = false;
        }
        $append = '';
        if($sort_dir == 'asc' || $sort_dir == 'desc'){
            $append = '&sort='.$sort_dir.':'.$sort_by;
        }
        $numpages = $count/$curr_list_opt;
        $num = intval($numpages);
        if($numpages != $num) $numpages = $num+1;
        $page = 1;
        for($item = 0; $item < $numpages; $item++){ ?>
            <?php
            $_list_start = $item*$curr_list_opt;
            if($_list_start == $list_start){?>
                <li class="page-item active">
                    <a class="page-link"><?php echo $page;?></a>
                </li>
            <?php } else {
                ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?<?php echo $main_link;?>list_start=<?php echo $_list_start;?><?php echo $append;?>"><?php echo $page;?></a>
                </li>
            <?php } ?>

            <?php $page++; } ?>
    </ul>
</div>
