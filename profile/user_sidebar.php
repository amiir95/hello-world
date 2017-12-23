<?php
if(isset($_POST['add']))
{
    $query="INSERT INTO add_user (SenderID,ReceiverID) VALUES ('{$_SESSION['UserID']}','{$_GET['UserID']}') ";
    $send_query=mysqli_query($connection,$query);
    if(!$send_query)
    {
        die("ERROR!!".mysqli_error($connection));
    }
    header("Location: user_index.php?UserID={$_GET['UserID']} ");
}
?>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                 
                   <li>
                       <img class="img-responsive img-thumbnail" width="200" height="200" src="../pictures/profile-pic/<?php echo $ProfilePic;?>" alt="" style="margin-left:10px;margin-top:10px;">
                   </li>
    
                  
                    <?php
                    $query1="SELECT COUNT(*) as 'friends' FROM friends WHERE UserID={$_SESSION['UserID']} AND FriendID={$_GET['UserID']} OR UserID={$_GET['UserID']} AND FriendID={$_SESSION['UserID']}";
                    $send_query1=mysqli_query($connection,$query1);
                    if(!$send_query1)
                    {
                        die("ERROR!!".mysqli_error($connection));
                    }
                    $query="SELECT COUNT(*) as 'request' FROM add_user WHERE SenderID={$_SESSION['UserID']} AND ReceiverID={$_GET['UserID']} OR SenderID={$_GET['UserID']} AND ReceiverID={$_SESSION['UserID']}";
                    $send_query=mysqli_query($connection,$query);
                        if(!$send_query)
                        {
                            die("ERROR!!".mysqli_error($connection));
                        }
                        $row1=mysqli_fetch_assoc($send_query);
                        $num_requests=$row1['request'];
                        $row2=mysqli_fetch_assoc($send_query1);
                        $num_friends=$row2['friends'];
                        if($num_requests==0&&$num_friends==0)
                        {
                        
                         ?>
                    <div>
                    <li>  
                       <form action="" method="post">
                           <input style="margin-left:10px;margin-top:10px;" class="btn btn-success" type="submit" name="add" value="ADD FRIEND">
                       </form>
                   </li>
                        </div>
                   <?php    
                        }else if($num_requests!=0&&$num_friends==0)
                            {
                            ?>
                    <div><li style='margin-left:10px;margin-top:10px;'><i class='glyphicon glyphicon-flag'> Request Pending</i></li></div>
                       <?php
                            }
                         $query="SELECT * FROM users  WHERE UserID='{$_GET['UserID']}' ";
                         $send_query=mysqli_query($connection,$query);
                         if(!$send_query)
                         {
                             die("ERROR!!".mysqli_error($connection));
                         }
                       $row=mysqli_fetch_assoc($send_query);
                   ?>
                    <?php
                    if($num_friends!=0)
                    {
                        ?>
                   
                    <div>
                    <li>
                        <i class="fa fa-fw fa-info-circle"></i> BIO:<?php echo $row['Bio']."<br>";?>
                    </li>
                    </div>
                     <?php
                    }
                        ?>
                    <div>
                    <li>
                        <i class="fa fa-fw fa-intersex"></i> Gender:<?php  if($row['Gender']==1){echo"Male";}else{echo "Female";}?>
                    </li>
                    </div>
                     <?php
                    if($num_friends!=0)
                    {
                        ?>
                    <div>
                    <li>
                        <i class="fa fa-fw fa-wrench"></i> Birthdate:<?php echo $row['Birthdate'];?>
                    </li>
                    </div>
                     <?php
                    }
                        ?>
                    <div>
                    <li>
                        <i class="fa fa-fw fa-wrench"></i> Status:<?php echo $row['RelationshipStatus'];?>
                    </li>
                    </div>
                    <li>
                        <i class="fa fa-fw fa-wrench"></i> Lives In:<?php echo $row['Hometown'];?>
                    </li>

                </ul>
            </div>