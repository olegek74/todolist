curr_list_opt = document.getElementById('curr_list_opt');
if(curr_list_opt) {
    curr_list_opt.onchange = function () {
        document.cookie = 'curr_list_opt = ' + this.value;
        var href = document.location.href;
        if (href.search('list_start=') > -1) {
            href = href.replace(/(\?|\&)list_start\=([0-9]+)/, '');
            if(href.search('&sort=') > -1){
                href = href.replace('&sort=', '?sort=');
            }
        }
        document.location.href = href;
    }
}