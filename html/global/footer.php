            </div>
        </div>
        <div class="layout__footer">
            <div class="container">
                <div style="bottom:0px;height:40px; background: #eaeaea;width:100%;text-align:center;margin-top:20px;">
                    ABC todolist
                </div>
            </div>
        </div>
</div>
</body>
<script>
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
</script>
</html>