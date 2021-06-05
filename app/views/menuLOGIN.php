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
        <li><a href="<?php echo $this->getBP();?>/signup/signup/"><span class="glyphicon glyphicon-user"></span>  Sign up</a></li>
        <li><a href="<?php echo $this->getBP();?>/login/login/"><span class="glyphicon glyphicon-log-in"></span>  Log in</a></li>
    </ul>
  </div>
</nav>