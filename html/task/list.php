    <h1 class="display-6">List of Tasks</h1>
    <br>
<?php

$sort_data = json_decode($sort);
if(!empty($this->list)){ ?>
    <div class="table-responsive">

        <?php echo $messages; ?>
        <table id="sort_table" class="table table-bordered" data-sort="<?php echo htmlspecialchars($sort);?>">
            <tr>
                <td style="width:5%">
                    <?php echo $this->buidSortLink($sort_data, 't.id', 'ID'); ?>
                </td>
                <td style="width:59%">DESCRIPTION</td>
                <td style="width:10%">
                    <?php echo $this->buidSortLink($sort_data, 't.status', 'STATUS'); ?>
                </td>
                <td style="width:8%">
                    <?php echo $this->buidSortLink($sort_data, 'u.email', 'USER EMAIL'); ?>
                </td>
                <td style="width:8%">
                    <?php echo $this->buidSortLink($sort_data, 'c.name', 'CATEGORY'); ?>
                </td>
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
    echo $selector;
    echo $paginator;
    ?></div><?php
} else {
    echo "<p>Task list is empty</p>";
    ?><?php
} ?>