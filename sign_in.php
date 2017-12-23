<!DOCTYPE html>
<html lang="en">
<?php include "header.php";?>
<?php
session_start();
if(isset($_POST['Submit']))
{
    $email    = mysqli_real_escape_string($connection,trim($_POST['email']));
    $password = mysqli_real_escape_string($connection,trim($_POST['password']));
    //Error handler to make sure no one left anything Empty
    if (empty($email) || empty($password))
    {
        echo "<script>
        alert('Please fill all the information');
        window.location.href='';
        </script>";

    }
    else
    {
        $sql= "SELECT * FROM users WHERE  Email='$email'";
        $result= mysqli_query($connection,$sql);
        $resultCheck=mysqli_num_rows($result);
        if($resultCheck < 1)
        {
            echo "<script>
            alert('User does not exist');
            window.location.href='';
            </script>";
        }
        else    //we will check if the password matches with the user
        {
            if ($row = mysqli_fetch_assoc($result))
            {

                if ( !password_verify($password,$row['Password']))
                {
                    echo "<script>
                    alert('Wrong Password');
                    window.location.href='';
                    </script>";
                }
                elseif (password_verify($password,$row['Password']))
                {
//Log in the user
                    
                    $_SESSION['UserID'] = $row['UserID'];
                    $_SESSION['Fname'] = $row['Fname'];
                    $_SESSION['Lname'] = $row['Lname'];
                    $_SESSION['Nickname'] = $row['Nickname'];
                    $_SESSION['ProfilePic'] = $row['ProfilePic'];
                    $_SESSION['Phone1'] = $row['Phone1'];
                    $_SESSION['Phone2'] = $row['Phone2'];
                    $_SESSION['Gender'] = $row['Gender'];
                    $_SESSION['Birthdate'] = $row['Birthdate'];
                    $_SESSION['Hometown'] = $row['Hometown'];
                    $_SESSION['RelationshipStatus'] = $row['RelationshipStatus'];
                    $_SESSION['Bio'] = $row['Bio'];
                    $query="SELECT COUNT(*) as Request_num FROM add_user WHERE ReceiverID='{$row['UserID']}'";
                    $send_query=mysqli_query($connection,$query);
                    if(!$send_query)
                    {
                        die("ERROR!!".mysqli_error($connection));
                    }
                    $row=mysqli_fetch_assoc($send_query);
                    $_SESSION['Request_num']=$row['Request_num'];
                    header("Location: profile/p_index.php");


                }
            }
        }
    }
}
else    //if he didn't press the actual login button
{
//    echo "<script>
//    alert('Error');
//    window.location.href=' ../sign_in.php';
//    </script>";
//    exit();
}




?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
                    <!-- Side Bar start Entries Column -->

                       <!-- Side Bar end Entries Column -->

            <!-- Blog Entries Column -->
            <div class="col-md-8">

<!--              PUT YOUR SIGN UP FORM HERE-->
        <div class="row">
            <div class=" well col-xs-8 col-xs-offset-5">
            <h1>Sign In</h1>
            <form action="" method="post">
                 <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
                            </div>
                        </div>
                <div class="form-group">
                           <div class="input-group">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        </div>
                        <div class="row">
                        <div class=" col-xs-4">
                            <div class="form-group">
                            <input type="submit" class="btn btn-primary my-button" name="Submit" value="sign in">
                            </div>
                        </div>
                        <div class=" col-xs-4 col-xs-offset-4">
                            <div class="form-group">
                            <a class="btn btn-success my-button" href="sign_up.php">Sign-Up</a>
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            
                        </div>
            </form>
            </div>
         </div>

            </div>

            <!-- Blog Sidebar Widgets Column -->


        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
     <?php include "footer.php";?>
