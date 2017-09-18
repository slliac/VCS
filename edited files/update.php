
<?php 
session_start();
?>

<link rel="stylesheet" href="css/speech-input.css">

<link rel="stylesheet" type="text/css" href="css/login2.css"/>

<meta name="viewport" content="width=device-width, initial-scale=0.6">

<!-- register form -->


<?php
if(isset($_POST['update']))
{
$dbhost = 'localhost';
$dbuser = 'root';
$conn = mysql_connect($dbhost, $dbuser);

if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

$login_input_username= $_POST['login_input_username'];
$login_input_email= $_POST['login_input_email'];

$sql = "UPDATE jqcalendar ".
       "SET user_name = $user_name ".
       "WHERE user_name = $emp_id" ;


mysql_select_db('jqcalendar');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not update data: ' . mysql_error());
}

echo "Updated data successfully\n";
mysql_close($conn);
}


?>


<form method="post" action="<?php $_PHP_SELF ?>" name="registerform" class="login-form">

<p class="login-text">

<span>
<img src="images/info.png">
</span>


<br>
Update Your information by simply few steps

<br><br>


    <!-- the user name input field uses a HTML5 pattern check -->

<b><h5>Your state now:   ACTIVE</h5></b>
<br><br>


    <h5>Enter New Name: OR Keep:</h5> 
<div class="si-wrapper">      <input id="login_input_username" class="login-username  si-input "   type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" value=<?php echo $_SESSION['user_name'];?> />
<span></span>
<button class="si-btn2" id="login_input_username_voicebtn">
speech input
<span class="si-mic" ></span>
<span class="si-holder"></span>
</button>

</div>



<br>

    <!-- the email input field uses a HTML5 email type check -->

  <h5>Enter New EMail OR Keep :</h5> 

<div class="si-wrapper">      
             
    <input id="login_input_email" class="login-username si-input" type="email" name="user_email" placeholder="User Email"  value=<?php echo $_SESSION['user_email'];?>  required />
<span></span>

<button class="si-btn2" id="login_input_username_voicebtn">
		speech input
		<span class="si-mic" ></span>
		<span class="si-holder"></span>
	</button>
</div>



<br>

<br>
    <input type="submit"  name="register" value="Change" class="login-submit" />

    <input type="button"  value="Back to main page"  class="login-submit" onclick="window.location.href='index.php'" />

</p>

<p class="login-text2">

</form>

<!-- backlink -->


<div class="underlay-photo"></div>
<div class="underlay-black"></div> 

<script src="js/speech-input.js"></script>
