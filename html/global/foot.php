<?php defined('ROOTPATH') or die('access denied'); ?>
</div>
</body>
<script>
    document.getElementById('curr_list_opt').onchange = function(){
        document.cookie = 'curr_list_opt = ' + this.value;
        document.location.href = '/index.php';
    }
</script>
</html>