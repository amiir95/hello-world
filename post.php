<!DOCTYPE html>
<html lang="en">

<?php session_start();?>
<?php include "header.php";?>
    <!-- Navigation -->
<?php include "nav-bar.php";?>

    <!-- Navigation -->
   

    <!-- Page Content -->
    <div class="container">

        <div class="row">
<?php include "sidebar.php";?>
            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->
        <?php
            if(isset($_GET['Pid']))
            {
                $pid=$_GET['Pid'];
                $query="SELECT * FROM post INNER JOIN users ON post.AuthorID=users.UserID WHERE Pid='{$pid}'";
                $send_query=mysqli_query($connection,$query);
                if(!$send_query)
                {
                    die("ERROR!".mysqli_error($connection));
                }
                $row=mysqli_fetch_assoc($send_query);
                $AuthorID= $row['AuthorID'];
                $Caption = $row['Caption'];
                $Image   = $row['Image'];
                $PostTime= $row['PostTime'];
                $Fname   = $row['Fname'];
                $Lname   = $row['Lname'];
                $Nickname = $row['Nickname'];
                $ProfilePic=$row['ProfilePic'];
                if(empty($Nickname))
                       {
                            $name=$Fname." ".$Lname;
                            
                           
                       }
                        else{
                            $name=$Nickname;
                        }
            }
    if(isset($_POST['Submit']))
    {
        $content=$_POST['content'];
        $commenterID=$_SESSION['UserID'];
        $Pid=$_GET['Pid'];
        $query="INSERT INTO comment (Pid,commenterID,commentContent) VALUES ('{$Pid}','{$commenterID}','{$content}')";
        $send_query=mysqli_query($connection,$query);
        header("location: post.php?Pid=$Pid");
        if(!$send_query)
                {
                    die("ERROR!".mysqli_error($connection));
                }
        
        
    }
            
        ?>
                <!-- Title -->
                <h1>Post</h1>

                <!-- Author -->
               <div class="row">
                <div class="col-xs-1">
                        <a href="profile/user_index.php?UserID=<?php echo $AuthorID;?>"><img class="img-responsive img-thumbnail" src="pictures/profile-pic/<?php echo $ProfilePic;?>" alt=""></a>
                    </div>
                    <div class="col-xs-3">
                        <p class="lead"><a href="profile/user_index.php?UserID=<?php echo $AuthorID;?>"><?php echo $name?></a> Posted: </p>
                    </div>
                </div>
                
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $PostTime; ?> </p>
                <img class="img-responsive" style="max-height: 300px;max-width: 900px;" src="pictures/post-pic/<?php echo $Image;?>"  alt="">
                <p> <?php echo $Caption; ?>
                </p>
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="Submit">Comment</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
<?php
                $Pid=$_GET['Pid'];
                $query="SELECT * FROM comment INNER JOIN users ON comment.commenterID=users.UserID WHERE Pid='{$Pid}' ORDER BY commentTime DESC";
                $send_query=mysqli_query($connection,$query);
                if(!$send_query)
                {
                    die("ERROR!".mysqli_error($connection));
                }
                while($row1=mysqli_fetch_assoc($send_query))
                {
                    $content=$row1['commentContent'];
                    $commentTime=$row1['commentTime'];
                    $Fname   = $row1['Fname'];
                    $Lname   = $row1['Lname'];
                    $Nickname = $row1['Nickname'];
                    $ProfilePic=$row1['ProfilePic'];
                    $commenterID=$row1['commenterID'];
                    if(empty($Nickname))
                           {
                                $name=$Fname." ".$Lname;


                           }
                            else{
                                $name=$Nickname;
                            }
                    if($commenterID!=$_SESSION['UserID'])
                    {
                        $Link="profile/user_index.php?UserID=$commenterID";
                    }else{
                        $Link="profile/p_index.php";
                    }
 ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left " href="<?php echo $Link;?>">
                        <img class="media-object img-thumbnail" style="height: 50px;width: 50px;" src="pictures/profile-pic/<?php echo $ProfilePic;?>" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><a  href="<?php echo $Link;?>"><?php echo $name;?></a>
                            <small><?php echo $commentTime;?></small>
                        </h4>
                        <?php echo $content;?>
                    </div>
                </div>
<?php
}
?>
                <!-- Comment -->
                

            </div>

            <!-- Blog Sidebar Widgets Column -->

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
