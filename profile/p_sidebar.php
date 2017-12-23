         <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                   <li>
                       <img class="img-responsive img-thumbnail" width="200" height="200" src="../pictures/profile-pic/<?php echo $_SESSION['ProfilePic'];?>" alt="" style="margin-left:10px;margin-top:10px;">
                   </li>
                   <br>
                   <div>
                       
                    <li>
                       
                        <i class="fa fa-fw fa-info-circle"></i> BIO:<?php echo $_SESSION['Bio']."<br>";?>
                        
                    </li>
                    </div>
                    <div>
                    <li>
                        <i class="fa fa-fw fa-venus-mars"></i> Gender:<?php  if($_SESSION['Gender']==1){echo"Male";}else{echo "Female";}?>
                    </li>
                    </div>
                    <div>
                    <li>
                        <i class="fa fa-fw fa-wrench"></i> Birthdate:<?php echo $_SESSION['Birthdate'];?>
                    </li>
                    </div>
                    <div>
                    <li>
                        <i class="fa fa-fw fa-wrench"></i> Status:<?php echo $_SESSION['RelationshipStatus'];?>
                    </li>
                    </div>
                    <li>
                        <i class="fa fa-fw fa-wrench"></i> Lives In:<?php echo $_SESSION['Hometown'];?>
                    </li>
                    
                </ul>
            </div>