<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
    <?php 
        foreach($this->get('menuCollection') as $item):
    ?>
        <li>
            <?= \Core\Url::getLink($item['path'], $item['name']);?>
        </li>
    <?php endforeach; ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo $this->getBP();?>/customer/info/"><span class="glyphicon glyphicon-ok"></span>
            <?php echo $_SESSION['data'];?></a></li>
        <li><a href="<?php echo $this->getBP();?>/logout/logout/"><span class="glyphicon glyphicon-log-out"></span>  Log out</a></li>
    </ul>
  </div>
</nav>