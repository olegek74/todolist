
jQuery(document).ready(function($){
    var curr_list_opt = $('#curr_list_opt');
    if(curr_list_opt.length){
        curr_list_opt.change(function(){
            document.cookie = 'curr_list_opt = ' + $(this).val() + '; path=/';
            $(this).closest('form').submit();
        });
    }

    var sort_data = $('#sort_table').data('sort');
    if(typeof(sort_data) != 'undefined') {
        var sort_link = sort_data.main_link;
        if (sort_link.search('/') !== 0) {
            sort_link = '/?' + sort_link;
        } else sort_link += '?';
        $('div.sort').click(function () {
            if (!$(this).hasClass('active')) {
                var sort_dir = 'asc';
                if (sort_data.sort_dir == 'asc') sort_dir = 'desc';

                var href = sort_link + 'sort=' + sort_dir + ':' + $(this).data('name');
                document.location.href = href;
            }
        });
    }
});