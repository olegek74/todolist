<?php
if(!empty($messages)){
    foreach($messages as $message){?>
        <?php
        if(!$message) continue;
        list($type, $text) = explode('|', $message);
        if($type == 'error') { ?><span class="sys-messages error"><?php }
        elseif($type == 'success') { ?><span class="sys-messages success"><?php } ?>
        <?php echo $text;?><span onclick="this.parentNode.remove()" class="closer">&times;</span></span>
    <?php }
}
?>
<br>
