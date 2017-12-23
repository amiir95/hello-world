<?php include "p_header.php";
session_start();
?>
<body>
<?php

if(isset($_POST['post']))
{
  if(!empty($_POST['content']))
  {
      $content=$_POST['content'];
      if(isset($_POST['privacy'])){
          $privacy=0;
      }else{
          $privacy=1;
      }
      if($_FILES['image']['size'])
      {
      $post_image = $_FILES['image']['name'];
      $post_image_temp = $_FILES['image']['tmp_name'];
      move_uploaded_file($post_image_temp,"../pictures/post-pic/$post_image");
      $query = "INSERT INTO post(Caption , Image, AuthorID, Public) ";
      $query .= "VALUES('{$content}','{$post_image}','{$_SESSION['UserID']}','{$privacy}' ) ";
          
      }else{
          $query="INSERT INTO post (Caption,AuthorID,Public) VALUES ('{$content}','{$_SESSION['UserID']}','{$privacy}' ) ";

      }
    
      $send_query=mysqli_query($connection,$query);
      header("Location: p_index.php");

      
      if(!$send_query)
      {
        die("ERROR!!".mysqli_error($connection));
      }
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
            <?php include "p_sidebar.php";?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <?php 
                            if(!empty($_SESSION['Nickname']))
                            {?>
                                <small><?php echo $_SESSION['Nickname'] ?></small>
                           <?php }else{?>
                                <small><?php echo $_SESSION['Fname'].' '.$_SESSION['Lname']?></small>
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
                      <div class="well">
                       <form action="" method="post" enctype="multipart/form-data">
                          <h4><strong>Write a new Post:</strong></h4>
                           <div class="form-group">
                               <label for="image">Add Image</label>
                               <input name="image" type="file">
                            </div>
                           <div class="form-group">
                                <textarea name="content" class="form-control" rows="4"></textarea>
                           </div>
                            <div class="form-group">
                              <label class="checkbox-inline"><input name="privacy" type="checkbox" value="0">Private</label>
                               <input class="btn btn-primary float-right" name="post"  type="submit" value="Post">
                            </div>
                            
                       </form>
                       </div>
                       <h4><strong>Posts:</strong></h4>
<!--                       FILL HERE WITH USER POSTS-->
                  <?php
             $query1="SELECT Nickname,Fname,Lname FROM users WHERE UserID='{$_SESSION['UserID']}' ";
                    $send_query=mysqli_query($connection,$query1);
                      if(!$send_query)
                       {
                         die("ERROR!!".mysqli_error($connection));
                       } 
                    $row1=mysqli_fetch_assoc($send_query);
                       if(empty($row1['Nickname']))
                       {
                           $name=$row1['Fname']." ".$row1['Lname'];
                       }else{
                           $name=$row1['Nickname'];
                       }
                       
                    $query="SELECT * FROM post WHERE AuthorID='{$_SESSION['UserID']}' ORDER BY PostTime Desc";
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
