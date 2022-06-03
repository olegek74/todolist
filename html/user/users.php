    <h1 class="display-6">List of Users</h1>
    <br>
<?php
if(!empty($this->users_list)){ ?>
    <div class="table-responsive">

        <?php echo $messages; ?>
        <table class="table table-bordered">
            <tr>
                <td style="width:10%">ID</td>
                <td style="width:25%">NAME</td>
                <td style="width:25%">LOGIN<?php echo $sort;?><br><a href="index.php?ctrl=user&task=view_list">&nbsp;Refresh</a></td>
                <td style="width:25%">EMAIL</td>
                <td style="width:15%"><div style="margin:8px;"><b>Edit&nbsp;/&nbsp;Del</b></div></td>
            </tr>
            <?php
            foreach($this->users_list as $row){ ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['login'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php if($allow_edit){ ?>
                    <a class="btn btn-success btn-sm" href="/?ctrl=user&task=view_edit&id=<?php echo $row['id'];?>">Edit</a>
                    <?php } ?>
                    <?php if($allow_delete){ ?>
                    <a onclick="if(!confirm('Do you really want to delete?')) return false;" class="btn btn-success btn-sm" href="/?ctrl=user&task=delete&id=<?php echo $row['id'];?>">Delete</a>
                    <?php } ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="row justify-content-end"><?php
    require ROOTPATH . DS . 'html' . DS . 'utils'. DS .'selector.php';
    echo $paginator;
    ?></div><?php
} else {
    echo "<p>Task list is empty</p>";
    ?><?php
} ?>