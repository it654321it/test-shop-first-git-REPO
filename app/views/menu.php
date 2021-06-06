<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
    <?php 
        foreach($this->get('menuCollection') as $item)  :
    ?>
        <li>
            <?= \Core\Url::getLink($item['path'], $item['name']); ?>
        </li>
    <?php endforeach; ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <?php 
        if( !empty($_SESSION['data']) ) { 
        echo '<li><a href="' . $this->getBP();
        ?>/customer/info?customer_id=
        <?php echo $_SESSION['id'];
        ?>
        "><span class="glyphicon glyphicon-ok"></span>
         <?php echo $_SESSION['data'];?></a></li>
        <li><a href="<?php echo $this->getBP();?>/logout/logout/"><span class="glyphicon glyphicon-log-out"></span>  Log out</a></li>
        <?php  
        } else { 
        ?>
        <li><a href="<?php echo $this->getBP();?>/signup/signup/"><span class="glyphicon glyphicon-user"></span>  Sign up </a></li>
        <li><a href="<?php echo $this->getBP();?>/login/login/"><span class="glyphicon glyphicon-log-in"></span>  Log in</a></li>
        <?php
        }
        ?>
    </ul>
  </div>
</nav>