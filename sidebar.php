<div class="col-md-3">
<div class="well">
  <?php session_start();?>  
   <img class="img-responsive img-thumbnail" width="250" height="200" src="pictures/profile-pic/<?php echo $_SESSION['ProfilePic']?>" alt="" >
    <h4>  Welcome <?php 
        if(!empty($_SESSION['Nickname'])){
           echo $_SESSION['Nickname'];    
        }else{
            echo $_SESSION['Fname']." ".$_SESSION['Lname'];
        }
        
        ?>
        </h4>
    
</div>
                <!-- Blog Search Well -->
<!--
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                     /.input-group 
                </div>
-->

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                          <ul class="list-unstyled">
                           <?php
                            $query="SELECT UserID,Nickname,Fname,Lname FROM users ";
                            $send_query=mysqli_query($connection,$query);
                            if(!$send_query)
                            {
                                die("ERROR!!".mysqli_error($connection));
                            }else{
                                while($row=mysqli_fetch_assoc($send_query))
                                {
                                    $Nickname=$row['Nickname'];
                                    $Fname=$row['Fname'];
                                    $Lname=$row['Lname'];
                                    $UserID=$row['UserID'];
                                    if($UserID!=$_SESSION['UserID'])
                                    {
                                if(empty($Nickname))
                                    {
                        echo"<li><a href='profile/user_index.php?UserID=$UserID'>$Fname $Lname</a></li>";
                                    }else{
                            echo"<li><a href='profile/user_index.php?UserID=$UserID'>$Nickname</a></li>";
                                    }
                                    }
                                    
                                }
                            }
                            ?>
                            
                                
                                
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->


            </div>