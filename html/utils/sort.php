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
$sort_data = new stdClass;
$sort_data->main_link = $main_link;
$sort_data->sort_dir = $sort_dir;
$sort_data->sort_by = $sort_by;
$sort_data->icon = $icon;
echo json_encode($sort_data);
?>
