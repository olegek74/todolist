    <h1 class="display-6">List of Tasks</h1>
    <br>
<?php
if(!empty($this->list)){ ?>
    <div class="table-responsive">

        <?php echo $messages; ?>
        <table class="table table-bordered">
            <tr>
                <td style="width:5%">ID</td>
                <td style="width:59%">DESCRIPTION</td>
                <td style="width:10%">STATUS<?php echo $sort;?><br><a href="index.php">&nbsp;Refresh</a></td>
                <td style="width:8%">USER EMAIL</td>
                <td style="width:8%">Category</td>
                <td style="width:10%"><div style="margin:8px;"><b>Edit&nbsp;/&nbsp;Del</b></div></td>
            </tr>
            <?php
            foreach($this->list as $row){ ?>
                <tr>
                    <td><a href="/?ctrl=task&task=view_show&id=<?php echo $row['id'];?>"><?php echo $row['id'];?></a></td>
                    <td><?php echo $row['description'];?></td>
                    <td><?php echo $row['status'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo isset($row['category_name']) ? $row['category_name'] : '';?></td>
                    <td>
                    <?php if($allow_edit){ ?>
                        <a class="btn btn-success btn-sm" href="/?ctrl=task&task=view_edit&id=<?php echo $row['id'];?>">Edit</a>
                        <?php } ?>
                    <?php if($allow_delete){ ?>
                        <a onclick="if(!confirm('Do you really want to delete?')) return false;" class="btn btn-success btn-sm" href="/?ctrl=task&task=delete&id=<?php echo $row['id'];?>">Del</a>
                    <?php } ?>
                    </td>
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