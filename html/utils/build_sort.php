<?php
$sort_data = json_decode($sortData);

if($sort_data->sort_by == $sort_by){ ?>
    <div data-name="<?php echo $sort_by;?>" class="sort active"><?php echo $title;?>&nbsp;&nbsp;<a href="/?<?php echo $sort_data->main_link.'sort='.$sort_data->sort_dir.':'.$sort_by;?>"><?php echo $sort_data->icon;?></a></div>
<?php } else { ?>
    <div data-name="<?php echo $sort_by;?>" class="sort"><?php echo $title;?></div>
<?php }