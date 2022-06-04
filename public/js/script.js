
jQuery(document).ready(function($){
    var curr_list_opt = $('#curr_list_opt');
    if(curr_list_opt.length){
        curr_list_opt.change(function(){
            document.cookie = 'curr_list_opt = ' + $(this).val();
            var href = document.location.href;
            if (href.search('list_start=') > -1) {
                href = href.replace(/(\?|\&)list_start\=([0-9]+)/, '');
                if(href.search('&sort=') > -1 && href.search('&task=') == -1){
                    href = href.replace('&sort=', '?sort=');
                }
            }
            document.location.href = href;
        });
    }
    var sort_data = $('#sort_table').data('sort');

    $('div.sort').click(function(){
        if(!$(this).hasClass('active')){
            var sort_dir = 'asc';
            if(sort_data.sort_dir == 'asc') sort_dir = 'desc';
            var href = '/?' + sort_data.main_link + 'sort=' + sort_dir + ':' + $(this).data('name');
            document.location.href = href;
        }
    })
});