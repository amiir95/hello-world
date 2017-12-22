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
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
 <?php
             $userid= $_SESSION['UserID'];
            $query1="SELECT Fname,Lname,ProfilePic,Nickname,AuthorID,Caption,PostTime,Image,Public FROM post INNER JOIN users ON post.AuthorID=users.UserID WHERE ( Public=1 ) OR(Public=0 AND AuthorID=$userid) OR( AuthorID IN (SELECT FriendID AS ID FROM friends INNER JOIN users ON friends.FriendID =users.UserID WHERE friends.UserID=$userid UNION SELECT users.UserID AS ID FROM friends INNER JOIN users ON friends.UserID =users.UserID WHERE friends.FriendID=$userid))";

            

             $send_query=mysqli_query($connection,$query1);
                      if(!$send_query)
                       {
                         die("ERROR!!".mysqli_error($connection));
                       } 
                    while($row1=mysqli_fetch_assoc($send_query))
                    { 
                        if(empty($row1['Nickname']))
                       {
                            $name=$row1['Fname']." ".$row1['Lname'];
                             echo $row1['Caption'];
                            echo $row1['PostTime'];
                           
                       }else{
                            $name=$row1['Nickname'];
                       
                       
                        echo $row1['Caption'];
                        echo $row1['PostTime'];
                           
                        }
                       
                         $ProfilePic=$row1['ProfilePic'];
                        
                      $FriendID=$row1['AuthorID'];
                     
                    

                           
                ?>
                
                 <a href="profile/user_index.php?UserID=<?php echo $FriendID;?>"><img class="img-responsive img-thumbnail" width="100" height="100" src="pictures/profile-pic/<?php echo $ProfilePic?>" alt="" ></a>
                 <a href="profile/user_index.php?UserID=<?php echo $FriendID;?>"><p class="lead"><?php echo $name?></p></a>

                <hr>

                <?php } 

                ?>
                <!-- First Blog Post -->
                <h2>
                    <a href="#">Blog Post Title</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">Start Bootstrap</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <!-- Second Blog Post -->
                

                <!-- Third Blog Post -->
                

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
     

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
     <?php include "footer.php";?>
