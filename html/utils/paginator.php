<div class="col-auto">
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
    if($numpages > 1){ ?>
        <ul class="pagination">
            <?php
            $page = 1;
            for($item = 0; $item < $numpages; $item++){ ?>
                <?php
                if($current_page == $page) {
                    ?>
                    <li class="page-item active">
                        <a class="page-link"><?php echo $page;?></a>
                    </li>
                <?php } else { ?>
                    <li class="page-item">
                        <?php if($page < 2){ ?>
                        <a class="page-link" href="<?php echo $router->getLink('index.php?'.$main_link.$append);?>"><?php echo $page;?></a>
                        <?php } else { ?>
                        <a class="page-link" href="<?php echo $router->getLink('index.php?'.$main_link.'page='.$page.$append);?>"><?php echo $page;?></a>
                        <?php } ?>
                    </li>
                <?php } $page++;
            } ?>
        </ul>
    <?php } ?>
</div>
