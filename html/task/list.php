<?php defined('ROOTPATH') or die('access denied'); ?>
    <h1 class="display-6">List of Tasks</h1>
    <br>
<?php
if(!empty($this->list)){ ?>
    <div class="table-responsive">

        <?php require ROOTPATH . DS . 'html' . DS . 'utils'. DS .'messages.php'; ?>
        <table class="table table-bordered">
            <tr>
                <td style="width:5%">ID</td>
                <td style="width:60%">DESCRIPTION</td>
                <td style="width:10%">STATUS<?php echo $sort;?><br><a href="index.php">&nbsp;Refresh</a></td>
                <td style="width:15%">USER EMAIL</td>
                <?php if(!$allow_delete){ ?>
                    <td style="width:10%">EDIT</td>
                <?php } else { ?>
                <td style="width:5%">EDIT</td>
                <td style="width:5%">Delete</td>
                <?php } ?>
            </tr>
            <?php
            foreach($this->list as $row){ ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['description'];?></td>
                    <td><?php echo $row['status'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><div data-id="<?php echo $row['id'];?>" class="edit"><a class="btn btn-success btn-sm" href="/?ctrl=task&task=view_edit&id=<?php echo $row['id'];?>">Edit</a></div></td>
                    <?php if($allow_delete){ ?><td><a onclick="if(!confirm('Do you really want to delete?')) return false;" class="btn btn-success btn-sm" href="/?ctrl=task&task=delete&id=<?php echo $row['id'];?>">Delete</a></td><?php }?>
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