<?php
use App\Classes\Helper;
use Kernel\Router;
$view = Helper::getObj();
$router = Router::instance();
?>
<h1 class="display-6">List of Users</h1>
    <br>
<?php
if(!empty($view->list)){ ?>
    <div class="table-responsive">

        <?php echo $view->messages(); ?>
        <table id="sort_table" class="table table-bordered" data-sort="<?php echo htmlspecialchars($view->sort());?>">
            <tr>
                <td style="width:10%">
                    <?php echo $view->buidSortLink('u.id', 'ID'); ?>
                </td>
                <td style="width:25%">
                    <?php echo $view->buidSortLink('u.name', 'NAME'); ?>
                </td>
                <td style="width:25%">
                    <?php echo $view->buidSortLink('m.login', 'LOGIN'); ?>
                </td>
                <td style="width:25%">
                    <?php echo $view->buidSortLink('u.email', 'EMAIL'); ?>
                </td>
                <td style="width:15%"><div style="margin:8px;"><b>Edit&nbsp;/&nbsp;Del</b></div></td>
            </tr>
            <?php
            foreach($view->list as $row){ ?>
                <tr>
                    <td><a href="<?php echo $router->getLink('/?ctrl=user&task=view_show&id='.$row['id']);?>"><?php echo $row['id'];?></a></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['login'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php if($allow_edit){ ?>
                    <a class="btn btn-success btn-sm" href="<?php echo $router->getLink('/?ctrl=user&task=view_edit&id='.$row['id']);?>">Edit</a>
                    <?php } ?>
                    <?php if($allow_delete){ ?>
                    <a onclick="if(!confirm('Do you really want to delete?')) return false;" class="btn btn-success btn-sm" href="<?php echo $router->getLink('/?ctrl=user&task=delete&id='.$row['id']);?>">Delete</a>
                    <?php } ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="row justify-content-end"><?php
    echo $view->selector();
    echo $view->pagination();
    ?></div><?php
} else {
    echo "<p>Task list is empty</p>";
    ?><?php
} ?>