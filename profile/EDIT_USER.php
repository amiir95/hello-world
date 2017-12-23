<?php include "p_header.php";
session_start();
?>
<body>
<?php
    if(isset($_POST['submit']))
    { if($_FILES['image']['size'])
    { $new_image = $_FILES['image']['name'];
      $new_image_temp = $_FILES['image']['tmp_name'];
      move_uploaded_file($new_image_temp,"../pictures/profile-pic/$new_image"); 
    copy("../pictures/profile-pic/$new_image","../pictures/post-pic/$new_image");
     if(empty($_POST['NickName']))
        {$query="UPDATE users SET ProfilePic='{$new_image}' where UserID='{$_SESSION['UserID']}' ";
        $send_query=mysqli_query($connection,$query);
          if(!$send_query)
      {
        die("ERROR!!".mysqli_error($connection));
      }  $_SESSION['ProfilePic']=$new_image;
        }else{
            $query1="UPDATE users SET ProfilePic='{$new_image}',Nickname='{$_POST['NickName']}' where UserID='{$_SESSION['UserID']}' ";
        $send_query=mysqli_query($connection,$query1);
          if(!$send_query)
      {
        die("ERROR!!".mysqli_error($connection));
      }  $_SESSION['ProfilePic']=$new_image;
            $_SESSION['Nickname']=$_POST['NickName'];
            
        }
    
    $content =$_SESSION['Fname']." has changed his profile picture";
        
    $query = "INSERT INTO post(Caption , Image, AuthorID, Public) ";
      $query .= "VALUES('{$content}','{$new_image}','{$_SESSION['UserID']}',0 ) ";
          
     
      $send_query=mysqli_query($connection,$query);

      
      if(!$send_query)
      {
        die("ERROR!!".mysqli_error($connection));
      }

        
    
    
    
    
    }
     else{if(!empty($_POST['NickName']))
     {
          $query1="UPDATE users SET Nickname='{$_POST['NickName']}' where UserID='{$_SESSION['UserID']}' ";
        $send_query=mysqli_query($connection,$query1);
          if(!$send_query)
      {
        die("ERROR!!".mysqli_error($connection));
      }
         $_SESSION['Nickname']=$_POST['NickName'];
         
         
     }
         
         
         
     }
    
        if($_FILES['image']['size'])
        { 
        
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
                       
                       
                <form method="post" action="" enctype="multipart/form-data">
                       <h4 >change profile pic</h4>
                     <input name="image" type="file">
                    <h4>change nickname</h4>  
                    <input type ="text" name="NickName" placeholder="Enter new Nickname..." class="form-control" >
                    <input type="submit" name="submit" value="submit" class="btn btn-primary">

                       
                       
                       
                       </form>
                                                                     </div>

               
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
