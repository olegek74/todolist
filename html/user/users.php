    <h1 class="display-6">List of Users</h1>
    <br>
<?php

$sort_data = json_decode($sort);
if(!empty($this->users_list)){ ?>
    <div class="table-responsive">

        <?php echo $messages; ?>
        <table id="sort_table" class="table table-bordered" data-sort="<?php echo htmlspecialchars($sort);?>">
            <tr>
                <td style="width:10%">ID</td>
                <td style="width:25%">
                    <?php echo $this->buidSortLink($sort_data, 'u.name', 'NAME'); ?>
                </td>
                <td style="width:25%">
                    <?php echo $this->buidSortLink($sort_data, 'm.login', 'LOGIN'); ?>
                </td>
                <td style="width:25%">
                    <?php echo $this->buidSortLink($sort_data, 'u.email', 'EMAIL'); ?>
                </td>
                <td style="width:15%"><div style="margin:8px;"><b>Edit&nbsp;/&nbsp;Del</b></div></td>
            </tr>
            <?php
            foreach($this->users_list as $row){ ?>
                <tr>
                    <td><a href="/?ctrl=user&task=view_show&id=<?php echo $row['id'];?>"><?php echo $row['id'];?></a></td>
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
    echo $selector;
    echo $paginator;
    ?></div><?php
} else {
    echo "<p>Task list is empty</p>";
    ?><?php
} ?>