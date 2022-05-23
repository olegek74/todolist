<?php defined('ROOTPATH') or die('access denied'); ?>

<div class="col-auto">
    <ul class="pagination">
        <?php
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
                    <a class="page-link" href="index.php?list_start=<?php echo $_list_start;?><?php echo $append;?>"><?php echo $page;?></a>
                </li>
            <?php } ?>

            <?php $page++; } ?>
    </ul>
</div>
