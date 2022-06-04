    <h1 class="display-6">List of Category</h1>
    <br>
<?php
$sort_data = json_decode($sort);
if(!empty($this->list)){ ?>
    <div class="table-responsive">

        <?php echo $messages; ?>
        <table id="sort_table" class="table table-bordered" data-sort="<?php echo htmlspecialchars($sort);?>">
            <tr>
                <td style="width:5%">
                    <?php echo $this->buidSortLink($sort_data, 'c.id', 'ID'); ?>
                </td>
                <td style="width:10%">
                    <?php echo $this->buidSortLink($sort_data, 'c.name', 'NAME'); ?>
                </td>
                <td style="width:60%">Description</td>
                <td style="width:15%">
                    <?php echo $this->buidSortLink($sort_data, 'c1.name', 'PARENT'); ?>
                </td>
                <td style="width:10%"><div style="margin:8px;"><b>Edit&nbsp;/&nbsp;Del</b></div></td>
            </tr>
            <?php
            foreach($this->list as $row){ ?>
                <tr>
                    <td><a href="/?ctrl=category&task=view_show&id=<?php echo $row['id'];?>"><?php echo $row['id'];?></a></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['description'];?></td>
                    <td><?php if($row['parent_id']) echo $row['parent'];?></td>
                    <td>
                        <?php if($allow_edit){ ?>
                            <a class="btn btn-success btn-sm" href="/?ctrl=category&task=view_edit&id=<?php echo $row['id'];?>">Edit</a>
                        <?php } ?>
                        <?php if($allow_delete){ ?>
                            <a onclick="if(!confirm('Do you really want to delete?')) return false;" class="btn btn-success btn-sm" href="/?ctrl=category&task=delete&id=<?php echo $row['id'];?>">Del</a>
                        <?php } ?>
                    </td>
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