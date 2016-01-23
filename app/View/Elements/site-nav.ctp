<nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Yalachi</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">All</a></li>
            <li><a href="#contact">Contact</a></li>
			
          </ul>
          <div style="float:right">
		  <a href="/#/cart" title="go to shopping cart"  style="color:#f00">
                <i class="icon-shopping-cart"></i>
                <b class="ng-binding">{{totalQty()}}</b> items, <b class="ng-binding">${{total()}}</b>
            </a>
		  </div>
        </div><!--/.nav-collapse -->
      </div>
    </nav>