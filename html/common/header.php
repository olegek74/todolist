<div class="layout__header">
    <div class="container">
        <?php if($menu){ ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav menu">
                        <?php foreach($menu->items as $link => $title){ ?>
                        <li class="nav-item">
                            <?php $active = '';
                            if($menu->isActive($link)) $active = ' active';?>
                            <a class="nav-link<?php echo $active;?>" href="<?php echo $link;?>"><?php echo $title;?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <?php } ?>
        <br>
    </div>
</div>
