<?php include "p_header.php";
session_start();
?>
<body>
<?php
if(isset($_GET['UserID']))
{
    $UserID=$_GET['UserID'];
    $query="SELECT * FROM users WHERE UserID=$UserID";
    $send_query=mysqli_query($connection,$query);
    if(!$send_query)
    {
       die("ERROR!!".mysqli_error($connection));
    }else{
        $row=mysqli_fetch_assoc($send_query);
        $Fname = $row['Fname'];
        $Lname = $row['Lname'];
        $Nickname = $row['Nickname'];
        $ProfilePic = $row['ProfilePic'];
        $Phone1 = $row['Phone1'];
        $Phone2 = $row['Phone2'];
        $Gender = $row['Gender'];
        $Birthdate = $row['Birthdate'];
        $Hometown = $row['Hometown'];
        $RelationshipStatus = $row['RelationshipStatus'];
        $Bio = $row['Bio'];
    }
    
}

?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">FACEBOOK</a>
                
            </div>
            <!-- Top Menu Items -->
            <?php include"p_nav-bar.php";?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include "user_sidebar.php";?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php 
                            if(!empty($Nickname))
                            {?>
                                <small><?php echo $Nickname ?></small>
                           <?php }else{?>
                                <small><?php echo $Fname." ".$Lname?></small>
                           <?php }?>
                           
                            
                        </h1>
<!--
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
-->
                  <div class="row">
                   <div class="col-md-8">

                       <h4><strong>Posts:</strong></h4>
<!--                       FILL HERE WITH USER POSTS-->
                  <?php
                       if(empty($Nickname))
                       {
                           $name=$Fname." ".$Lname;
                       }else{
                           $name=$Nickname;
                       }
                       $query1="SELECT * FROM friends WHERE UserID={$_SESSION['UserID']} AND FriendID={$_GET['UserID']} OR UserID={$_GET['UserID']} AND FriendID={$_SESSION['UserID']}";
                       $send_query1=mysqli_query($connection,$query1);
                       if(!$send_query1)
                       {
                         die("ERROR!!".mysqli_error($connection));
                       }
                      $friend=mysqli_num_rows($send_query1);
                       if($friend==0)
                       {
                           $query="SELECT * FROM post WHERE AuthorID='{$UserID}' AND Public= 1 ORDER BY PostTime Desc";
                       }else{
                           $query="SELECT * FROM post WHERE AuthorID='{$UserID}' ORDER BY PostTime Desc";
                       }
                       $sent_query=mysqli_query($connection,$query);
                       if(!$sent_query)
                       {
                         die("ERROR!!".mysqli_error($connection));
                       }
                      
                        while($row=mysqli_fetch_assoc($sent_query))
                       {
                           $content=$row['Caption'];
                           $date=$row['PostTime'];
                           $AuthorID=$row['AuthorID'];
                           $Image=$row['Image'];
                           ?>
                           <hr>
                <p class="lead"><?php echo $name?></p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date?></p>
                
                <img class="img-responsive post-pic" src="../pictures/post-pic/<?php echo $Image?>" alt="">
                
                <p><?php echo $content?></p>
                <hr>
               <?php
                   }
                ?>
                   </div>
                </div>
                   
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
