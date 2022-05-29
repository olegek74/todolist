<?php defined('ROOTPATH') or die('access denied'); ?>
</div>
</body>
<script>
    document.getElementById('curr_list_opt').onchange = function(){
        document.cookie = 'curr_list_opt = ' + this.value;
        var href = document.location.href;
        if(href.search('list_start=')>-1){
            href = href.replace(/(\?|\&)list_start\=([0-9]+)/, '');
        }
        document.location.href = href;
    }
</script>
</html>