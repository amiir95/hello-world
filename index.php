<!DOCTYPE html>
<html lang="en">
<?php session_start();?>
<?php include "header.php";?>
    <!-- Navigation -->
<?php include "nav-bar.php";?>
    <!-- Page Content -->
    <div class="container-fluid">

        <div class="row">
                    <!-- Side Bar start Entries Column -->

         <?php include "sidebar.php";?>
                       <!-- Side Bar end Entries Column -->

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Home
                    
                </h1>
 <?php
             $userid= $_SESSION['UserID'];
            $query1="SELECT Fname,Lname,ProfilePic,Nickname,AuthorID,Caption,PostTime,Image,Public,Pid FROM post INNER JOIN users ON post.AuthorID=users.UserID WHERE ( Public=1 ) OR(Public=0 AND AuthorID=$userid) OR( AuthorID IN (SELECT FriendID AS ID FROM friends INNER JOIN users ON friends.FriendID =users.UserID WHERE friends.UserID=$userid UNION SELECT users.UserID AS ID FROM friends INNER JOIN users ON friends.UserID =users.UserID WHERE friends.FriendID=$userid)) ORDER BY PostTime DESC";

            

             $send_query=mysqli_query($connection,$query1);
                      if(!$send_query)
                       {
                         die("ERROR!!".mysqli_error($connection));
                       } 
                    while($row1=mysqli_fetch_assoc($send_query))
                    { 
                        $Pid=$row1['Pid'];
                        $Image=$row1['Image'];
                        if(empty($row1['Nickname']))
                       {
                            $name=$row1['Fname']." ".$row1['Lname'];
                            $caption= $row1['Caption'];
                            $date= $row1['PostTime'];
                           
                       }else{
                        $name=$row1['Nickname'];
                        $caption= $row1['Caption'];
                        $date= $row1['PostTime'];
                           
                        }
                       
                         $ProfilePic=$row1['ProfilePic'];
                         $FriendID=$row1['AuthorID'];
                     
                    

                           
                ?>
                
                
                
                <!-- First Blog Post -->
                <div class="row">
                    <div class="col-xs-1">
                        <a href="profile/user_index.php?UserID=<?php echo $FriendID;?>"><img class="img-responsive img-thumbnail" src="pictures/profile-pic/<?php echo $ProfilePic;?>" alt=""></a>
                    </div>
                    <div class="col-xs-3">
                        <p class="lead"><a href="profile/user_index.php?UserID=<?php echo $FriendID;?>"><?php echo $name?></a> Posted: </p>
                    </div>
                </div>
                
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?> </p>
                <img class="img-responsive" style="max-height: 300px;max-width: 400px;" src="pictures/post-pic/<?php echo $Image;?>"  alt="">
                <p> <?php echo $caption; ?>
                </p>
                <a class="btn btn-primary" href="post.php?Pid=<?php echo $Pid;?>">View Comments <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php } 

                ?>

                <!-- Second Blog Post -->
                

                <!-- Third Blog Post -->
                

                <!-- Pager -->
<!--
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>
-->

            </div>

            <!-- Blog Sidebar Widgets Column -->
     

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
     <?php include "footer.php";?>
