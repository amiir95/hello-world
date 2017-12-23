           <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">FACEBOOK</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="Friends.php">Friends</a>
                    </li>
                    <li>
                        <a href="requests.php">Requests:<?php echo $_SESSION['Request_num']?></a>
                    </li>
                     <li>
                  <form action="search.php" method="post" class="form-inline my-2 my-lg-0 mr-lg-2" style="position:relative;top:10px;">
                    <div class="input-group">
                      <input class="form-control" name="Search_key" id="my-search" type="text" placeholder="Search for...">
                      <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" name="Search">
                          <i class="glyphicon glyphicon-search"></i>
                        </button>
                      </span>
                    </div>
                  </form>
               </li>
                    
                </ul>
                <ul class="nav navbar-nav navbar-right top-nav" >
                    <li >
                        <a href="profile/p_index.php">Profile</a>
                    </li>
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i>  <b class="caret"></b></a>
               <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
