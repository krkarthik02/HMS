<?php include "../inc/navbar.php";
include "../inc/sidebar.php";
include "../inc/connect.php";
$usrname=$_REQUEST['username'];
$sql1 = "SELECT * FROM `user_tab` WHERE `username` = '$usrname' AND user_type='staff'";
$result = mysqli_query($conn,$sql1);
$pf = mysqli_fetch_array($result);

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
{
  if(matchPassword())
  {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $pin=$_POST['pin'];
    $dob=$_POST['dob'];
    $phno=$_POST['phno'];
    $password=$_POST['password'];
    $gender=$_POST['gender'];
    $imagename = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    if (!file_exists($imagename)) {
      move_uploaded_file($tempname,"/HMS/img/$imagename");
    }  
    $dept = $_POST['dept'];
    $sql = "UPDATE `user_tab` SET `fname` = '$fname',`lname` = '$lname',`email` = '$email',`address` = '$address',`city` = '$city',`state` = '$state',`pincode` = '$pin',`dob` = '$dob',`phno` = '$phno',`password` = '$password',`gender` = '$gender',`image` = '$imagename',`dept_id`='$dept' WHERE `username`='$usrname' ;";
    $query = mysqli_query($conn,$sql);
    if($query)
    {
      header("Location: staff_man.php");
    }
  }
}
function matchPassword() 
{  
  $pswd1=$_POST['password'];  
  $pswd2=$_POST['confirm'];  
  if($pswd1 != $pswd2)  
  {   
   echo "<script> alert('Password Doesnot Match!'); </script>";
  } 
  else
   {  
    return true;  
  } 

}
  ?> 
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/HMS/css/registerstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="/HMS/admin/formValidate.js"></script>
    <title>Update form</title>
   </head>
<body>

<div class="reg">
  <div class="container">
    <div class="title">Staff Profile Updation</div>
    <div class="content">
      <form action="updateform2.php" method="POST" class="form" enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" name="fname" placeholder="Enter your name" value="<?php echo $pf["fname"]; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" name="lname" placeholder="Enter your name" value="<?php echo $pf["lname"]; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="username" id="username" disabled value="<?php echo $pf["username"]; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="email" id="email" placeholder="Enter your email" onkeyup="ValidateEmail();">
              <p class="message" id="emailmsg"></p>
          </div>
          <div class="input-box">
            <span class="details">Address</span>
            <input type="text" name="address" placeholder="Enter your address" value="<?php echo $pf["address"]; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">City</span>
            <input type="text" name="city" placeholder="Enter your city" value="<?php echo $pf["city"]; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">State</span>
            <select type="select" name="state" id="state" required> 
            <option value="">Select One State</option>
                <option value="Andhra Pradesh">Andhra Pradesh</option>
                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                <option value="Assam">Assam</option>
                <option value="Bihar">Bihar</option>
                <option value="Chandigarh">Chandigarh</option>
                <option value="Chhattisgarh">Chhattisgarh</option>
                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                <option value="Daman and Diu">Daman and Diu</option>
                <option value="Delhi">Delhi</option>
                <option value="Lakshadweep">Lakshadweep</option>
                <option value="Puducherry">Puducherry</option>
                <option value="Goa">Goa</option>
                <option value="Gujarat">Gujarat</option>
                <option value="Haryana">Haryana</option>
                <option value="Himachal Pradesh">Himachal Pradesh</option>
                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                <option value="Jharkhand">Jharkhand</option>
                <option value="Karnataka">Karnataka</option>
                <option value="Kerala">Kerala</option>
                <option value="Madhya Pradesh">Madhya Pradesh</option>
                <option value="Maharashtra">Maharashtra</option>
                <option value="Manipur">Manipur</option>
                <option value="Meghalaya">Meghalaya</option>
                <option value="Mizoram">Mizoram</option>
                <option value="Nagaland">Nagaland</option>
                <option value="Odisha">Odisha</option>
                <option value="Punjab">Punjab</option>
                <option value="Rajasthan">Rajasthan</option>
                <option value="Sikkim">Sikkim</option>
                <option value="Tamil Nadu">Tamil Nadu</option>
                <option value="Telangana">Telangana</option>
                <option value="Tripura">Tripura</option>
                <option value="Uttar Pradesh">Uttar Pradesh</option>
                <option value="Uttarakhand">Uttarakhand</option>
                <option value="West Bengal">West Bengal</option>
          </select></div>
          <div class="input-box">
            <span class="details">Pin code</span>
            <input type="text" name="pin" placeholder="Enter your Pin Code" value="<?php echo $pf["pincode"]; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">DOB</span>
            <input type="text" name="dob" placeholder="Enter your Blood Group" value="<?php echo $pf["dob"]; ?>" required>
          </div>
          <div class="input-box">
              <span class="details">Department</span>
              <select type="select" name="dept" id="dept" required>
                <option value="">Select One Department</option>
                <?php
                $q1 = "SELECT * FROM `dept_tab`";
                $result = mysqli_query($conn, $q1);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <option value="<?php echo $row['dept_id']; ?>"><?php echo $row['dept_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="phno" id="phno" placeholder="Enter your number" onkeyup="ValidatePh();" required>
              <p class="message" id="phmsg">*10 mobile digit number</p>
          </div>
          <div class="input-box">
              <span class="details">Password</span>
              <input type="password" name="password" id="pswd1" placeholder="Enter your password" onkeyup="ValidatePswd();" required>
              <p class="message" id="pswdmsg">*7 to 14 characters,at least one numeric digit, one uppercase and one lowercase letter</p>
            </div>
            <div class="input-box">
              <span class="details">Confirm Password</span>
              <input type="password" name="confirm" id="pswd2" placeholder="Confirm your password" onkeyup="ConfirmPswd();" required>
              <p class="message" id="cpmsg"></p>
            </div>
            <div class="input-box">
              <span class="details">DOB</span>
              <input type="date" name="dob" placeholder="Enter your DOB" required>
            </div>
          <div class="input-box">
            <span class="details">Profile Picture</span>
            <input type="file" name="image">
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" name="gender" value="Male" id="dot-1">
          <input type="radio" name="gender" value="Female" id="dot-2">
          <input type="radio" name="gender" value="Null" id="dot-3">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div>
        <div class="button">
          <input type="reset" name="reset" value="Clear">
        </div>
        <div class="button">
          <input type="submit" name="submit" id="submit" value="Update">
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
