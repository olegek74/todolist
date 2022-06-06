<?php
if($sort){
    list($sort_dir, $sort_by) = explode(':', $sort);
}
else {
    $sort_dir = false;
    $sort_by = false;
}

if(!$sort_dir || $sort_dir == 'desc') {
    $sort_dir = 'asc';
    $icon = '&#129073;';
}
else {
    $sort_dir = 'desc';
    $icon = '&#129075;';
}
echo '{"main_link":"'.$main_link.'", "sort_dir":"'.$sort_dir.'", "sort_by":"'.$sort_by.'", "icon":"'.$icon.'"}';
?>
