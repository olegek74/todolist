<?php defined('ROOTPATH') or die('access denied'); ?>
    <h1 class="display-6">List of Users</h1>
    <br>
<?php
if(!empty($this->users_list)){ ?>
    <div class="table-responsive">

        <?php $this->tmpl('utils', 'messages', ['messages' => $messages]); ?>
        <table class="table table-bordered">
            <tr>
                <td style="width:5%">ID</td>
                <td style="width:60%">NAME</td>
                <td style="width:10%">LOGIN<?php echo $sort;?><br><a href="index.php?ctrl=user&task=view_list">&nbsp;Refresh</a></td>
                <td style="width:15%">EMAIL</td>
                <?php if(!$allow_edit){ ?>
                <td style="width:10%"></td>
                <?php } else { ?>
                <td style="width:5%">EDIT</td>
                <?php } ?>
                <?php if(!$allow_delete){ ?>
                    <td style="width:10%"></td>
                <?php } else { ?>
                    <td style="width:5%">Delete</td>
                <?php } ?>
            </tr>
            <?php
            foreach($this->users_list as $row){ ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['login'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <?php if($allow_edit){ ?>
                    <td><div data-id="<?php echo $row['id'];?>" class="edit"><a class="btn btn-success btn-sm" href="/?ctrl=user&task=view_edit&id=<?php echo $row['id'];?>">Edit</a></div></td>
                    <?php } else { ?><td></td><?php } ?>
                    <?php if($allow_delete){ ?>
                    <td><a onclick="if(!confirm('Do you really want to delete?')) return false;" class="btn btn-success btn-sm" href="/?ctrl=user&task=delete&id=<?php echo $row['id'];?>">Delete</a></td>
                    <?php } else { ?><td></td><?php } ?>
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