<?php
if(!$sort || $sort == 'desc') {
    $sort = 'asc';
    $icon = '&uarr;';
}
else {
    $sort = 'desc';
    $icon = '&darr;';
}
?>
<a href="index.php?<?php echo $main_link;?>sort=<?php echo $sort;?>">&nbsp;<?php echo $icon;?>&nbsp;</a>
