<?php defined('ROOTPATH') or die('access denied'); ?>
<?php
if(!empty($list)){ ?>
    <div class="table-responsive">

        <?php require ROOTPATH . DS . 'html' . DS . 'utils'. DS .'messages.php'; ?>
        <table class="table table-bordered">
            <tr>
                <td style="width:5%">ID</td>
                <td style="width:60%">DESCRIPTION</td>
                <td style="width:10%">STATUS<?php echo $sort;?><br><a href="index.php">&nbsp;Refresh</a></td>
                <td style="width:15%">USER EMAIL</td>
                <td style="width:10%">EDIT</td>
            </tr>
            <?php
            foreach($list as $row){ ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['description'];?></td>
                    <td><?php echo $row['status'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><div data-id="<?php echo $row['id'];?>" class="edit"><a class="btn btn-success btn-sm" href="/?ctrl=task&task=viewedit&id=<?php echo $row['id'];?>">Edit</a></div></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
    echo $paginator;
} else {
    echo "<p>Task list is empty</p>";
    ?><?php
} ?>