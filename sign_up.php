<?php include 'db.php';
include 'header.php';
session_start(); ?>
<!DOCTYPE html>
<html lang="en">


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
              <?php
if(isset($_POST['sign_up']))
{


$Fname=$_POST['Fname'];
$Lname=$_POST['Lname'];
$Nickname=$_POST['Nickname'];
$Password=$_POST['password'];
$Phone1=$_POST['Phone1'];
$Phone2=$_POST['Phone2'];
$Email=$_POST['Email'];
$Gender=$_POST['Gender'];
$Birthdate=$_POST['bday'];
$PP="";
$Hometown=$_POST['Hometown'];
$RelationshipStatus=$_POST['Status'];;
$Bio=$_POST['Bio'];

$_SESSION["Email"] = $Email;
$_SESSION["message"]=0;
//$_SESSION["message"]=1;


$query = "SELECT Email From Users WHERE Email = '$Email'";
$search = mysqli_query($connection,$query);

if(mysqli_num_rows($search) > 0){
 
$_SESSION["message"] = 1;
}
else 
{
    $Password2 = password_hash($password,PASSWORD_BCRYPT,array('cost'=>12));
$sql = "INSERT into Users(Fname,Lname,Nickname,Password,Phone1,Phone2,Email,Gender,Birthdate,ProfilePic,Hometown,RelationshipStatus,Bio) values ('$Fname','$Lname','$Nickname','$Password2','$Phone1','$Phone2','$Email','$Gender','$Birthdate','$PP','$Hometown','$RelationshipStatus','$Bio')";
$search = mysqli_query($connection,$sql);
header("Location: test.php");
}
$connection->close();
}
?>

<html>
    <head>
        <script type="text/javascript">
            function signUpForm(){
                var Fname = document.getElementById("Fname").value;
                var Lname = document.getElementById("Lname").value;
                var password = document.getElementById("password").value;
                var Email = document.getElementById("Email").value;
                
            
                if(Fname == null || Fname == ""){
                    alert("Enter your first name! ");
                    return false;
                }
                
                else if(Lname == null || Lname == "")
                {
                    alert("Enter your last name! ");
                    return false;
                }
                else if(password == null || password == "")
                {
                    alert("Please Enter the Password! ");
                    return false;
                }
                else if(password.length < 8)
                {
                    alert("Password is too short Please Enter a longer password! (minimum 8) ");
                    return false;
                }
                else if(Email == null || Email == "")
                {
                    alert("Please Enter the Email! ");
                    return false;
                }
                else if(document.getElementById('Male').checked == false && document.getElementById('Female').checked == false ) 
                {
                    alert("Please choose your Gender! ");
                    return false;
                }
                
                    else return true;
                }
                </script>
    </head>
    <body>
        <div> <h3>SignUp</h3> </div>
            <form id="form1" name="form1" action="" method="post" onsubmit="return signUpForm()">
                <h3>*First Name (Required)</h3>
                <input type = "text" Name ="Fname" ID="Fname"  placeholder="First Name" >
                <br />
                <h3>*Last Name Required)</h3>
                <input type = "text" Name ="Lname" ID="Lname" placeholder="Last Name" >
                <br />
                <h3>Nickname :</h3>
                <input type = "text" Name ="Nickname" ID="Nickname" placeholder="Nickname" >
                <br />
                <h3>*Password (Required)</h3>
                <input type = "password" Name ="password" ID="password" placeholder="password min:8" >
                <br />
                <h3>Phone(s) </h3>
                <input type = "number" Name ="Phone1" ID="Phone1" placeholder="Phone(1)ex:01XXXXXXXXX" >
                <input type = "number" Name ="Phone2" ID="Phone2" placeholder="Phone(2)ex:01XXXXXXXXX" >
                <br />
                <h3>*Email (Required)</h3>
                <input type = "text" Name ="Email" ID="Email" placeholder="E-mail e.g: asdfgh@qwert.ds" >
                
                <?php
                if($_SESSION["message"] == 1){
                    $_SESSION["message"]=0;
                echo "email is already taken!! ";
            }
                ?>

                <br />
                <h3>*Gender (Required)</h3>
                <input type="radio" name="Gender" ID="Male" value="0" > Male
                <input type="radio" name="Gender" ID="Female" value="1"> Female<br>
                <br />
                <h3>*Birthdate (Required)</h3>
                <input type="date" name="bday" required="true">
                <br />
                <h3>Hometown:</h3>
                <input type = "text" Name ="Hometown" ID="Hometown"  placeholder="Hometown" >
                <h3>*Marital status:</h3>
                <input type="radio" name="Status" ID="Single" value="Single" > Single
                <input type="radio" name="Status" ID="Enagaged" value="Engaged"> Engaged
                <input type="radio" name="Status" ID="Married" value="Married"> Married
                <br />
                <h3>About me:</h3>
                <input type = "text" Name ="Bio" ID="Bio"  placeholder="bio.." >
                <br />
                <br />
                <input type ="submit" Name="sign_up" value = "SIGN UP">
            </form>
    </body>
</html>

            </div>

            <!-- Blog Sidebar Widgets Column -->
     

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
     <?php include "footer.php";?>