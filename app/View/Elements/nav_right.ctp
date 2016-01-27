<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>
            <?php 
			//$user = $this->Session->read("userdetails"); 
			//echo "Welcome, ".ucfirst($userdetail['User']['username'])."!"; 
			?> 
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
            <?php
			//echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-user fa-fw')) . "User Profile",array('controller' => 'users', 'action' => 'view',$userdetail['User']['id']),array('escape' => false));
			?>
            </li>
            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
            </li>
            <li class="divider"></li>
            <!--<li><a href="/users/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>-->
            <?php
			echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-sign-out fa-fw')) . "Logout",array('controller'=>'users','action' => 'logout'),array('escape' => false));
			?>
        </ul>
    </li>
</ul>