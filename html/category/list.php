<?php
use App\Classes\Helper;
use Kernel\Router;
$view = Helper::getView();
$router = Router::instance();
?>
<h1 class="display-6">List of Category</h1>
    <br>
<?php
if(!empty($view->list)){ ?>
    <div class="table-responsive">

        <?php echo $view->messages(); ?>
        <table id="sort_table" class="table table-bordered" data-sort="<?php echo htmlspecialchars($view->sort());?>">
            <tr>
                <td style="width:5%">
                    <?php echo $view->buidSortLink('c.id', 'ID'); ?>
                </td>
                <td style="width:10%">
                    <?php echo $view->buidSortLink('c.name', 'NAME'); ?>
                </td>
                <td style="width:60%">DESCRIPTION</td>
                <td style="width:15%">
                    <?php echo $view->buidSortLink('c1.name', 'PARENT'); ?>
                </td>
                <td style="width:10%"><div style="margin:8px;"><b>Edit&nbsp;/&nbsp;Del</b></div></td>
            </tr>
            <?php
            foreach($view->list as $row){ ?>
                <tr>
                    <td><a href="<?php echo $router->getLink('/?ctrl=category&task=view_show&id='.$row['id']);?>"><?php echo $row['id'];?></a></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['description'];?></td>
                    <td><?php if($row['parent_id']) echo $row['parent'];?></td>
                    <td>
                        <?php if($allow_edit){ ?>
                            <a class="btn btn-success btn-sm" href="<?php echo $router->getLink('/?ctrl=category&task=view_edit&id='.$row['id']);?>">Edit</a>
                        <?php } ?>
                        <?php if($allow_delete){ ?>
                            <a onclick="if(!confirm('Do you really want to delete?')) return false;" class="btn btn-success btn-sm" href="<?php echo $router->getLink('/?ctrl=category&task=delete&id='.$row['id']);?>">Del</a>
                        <?php } ?>
                    </td>
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