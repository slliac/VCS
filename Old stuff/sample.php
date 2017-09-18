<?php
session_start();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">

    <title>	My Calendar </title>
    <meta http-equiv="Content-Type" content="text/html; charset="UTF-8">
          <script src="js/jquery.min.js"></script>
           <script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
        
        
		<script src="js/init.js"></script>
	<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			
            <link rel="stylesheet" href="css/font-awesome.min.css" />
            
		</noscript>
    <link href="css/dailog.css" rel="stylesheet" type="text/css" />
    <link href="css/calendar.css" rel="stylesheet" type="text/css" /> 
    <link href="css/dp.css" rel="stylesheet" type="text/css" />   
    <link href="css/alert.css" rel="stylesheet" type="text/css" /> 
    <link href="css/main.css" rel="stylesheet" type="text/css" /> 
    <script src="src/jquery.js" type="text/javascript"></script>  
    <script src="src/Plugins/Common.js" type="text/javascript"></script>    
    <script src="src/Plugins/datepicker_lang_US.js" type="text/javascript"></script>     
    <script src="src/Plugins/jquery.datepicker.js" type="text/javascript"></script>

    <script src="src/Plugins/jquery.alert.js" type="text/javascript"></script>    
    <script src="src/Plugins/jquery.ifrmdailog.js" defer="defer" type="text/javascript"></script>
    <script src="src/Plugins/wdCalendar_lang_US.js" type="text/javascript"></script>    
    <script src="src/Plugins/jquery.calendar.js" type="text/javascript"></script>   
    
<meta name="viewport" content="width=device-width, initial-scale=0.7">

    <script type="text/javascript">
        $(document).ready(function() {     
           var view="day";          
           
            var DATA_FEED_URL = "php/datafeed.php";
            var op = {
                view: view,
                theme:3,
                showday: new Date(),
                EditCmdhandler:Edit,
                DeleteCmdhandler:Delete,
                ViewCmdhandler:View,    
                onWeekOrMonthToDay:wtd,
                onBeforeRequestData: cal_beforerequest,
                onAfterRequestData: cal_afterrequest,
                onRequestDataError: cal_onerror, 
                autoload:true,
                url: DATA_FEED_URL + "?method=list",  
                quickAddUrl: DATA_FEED_URL + "?method=add", 
                quickUpdateUrl: DATA_FEED_URL + "?method=update",
                quickDeleteUrl: DATA_FEED_URL + "?method=remove"        
            };
            var $dv = $("#calhead");
            var _MH = document.documentElement.clientHeight;
            var dvH = $dv.height() + 2;
            op.height = _MH - dvH;
            op.eventItems =[];

            var p = $("#gridcontainer").bcalendar(op).BcalGetOp();
            if (p && p.datestrshow) {
                $("#txtdatetimeshow").text(p.datestrshow);

            }
            $("#caltoolbar").noSelect();
            
            $("#hdtxtshow").datepicker({ picker: "#txtdatetimeshow", showtarget: $("#txtdatetimeshow"),
            onReturn:function(r){                          
                            var p = $("#gridcontainer").gotoDate(r).BcalGetOp();
                            if (p && p.datestrshow) {
                                $("#txtdatetimeshow").text(p.datestrshow);
                            }
                     } 
            });
            function cal_beforerequest(type)
            {
                var t="Loading data...";
                switch(type)
                {
                    case 1:
                        t="Loading data...";
                        break;
                    case 2:                      
                    case 3:  
                    case 4:    
                        t="The request is being processed ...";                                   
                        break;
                }
                $("#errorpannel").hide();
                $("#loadingpannel").html(t).show();    
            }
            function cal_afterrequest(type)
            {
                switch(type)
                {
                    case 1:
                        $("#loadingpannel").hide();
                        break;
                    case 2:
                    case 3:
                    case 4:
                        $("#loadingpannel").html("Success!");
                        window.setTimeout(function(){ $("#loadingpannel").hide();},2000);
                    break;
                }              
               
            }
            function cal_onerror(type,data)
            {
                $("#errorpannel").show();
            }
            function Edit(data)
            {
               var eurl="edit.php?id={0}&start={2}&end={3}&isallday={4}&title={1}";   
                if(data)
                {
                    var url = StrFormat(eurl,data);
                    OpenModelWindow(url,{ width: 300, height: 400, caption:"Manage  The Calendar",onclose:function(){
                       $("#gridcontainer").reload();
                    }});
                }
            }    
            function View(data)
            {
                var str = "";
                $.each(data, function(i, item){
                    str += "[" + i + "]: " + item + "\n";
                });
                alert(str);               
            }    
            function Delete(data,callback)
            {           
                
                $.alerts.okButton="Ok";  
                $.alerts.cancelButton="Cancel";  
                hiConfirm("Are You Sure to Delete this Event", 'Confirm',function(r){ r && callback(0);});           
            }
            function wtd(p)
            {
               if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $("#showdaybtn").addClass("fcurrent");
            }
            //to show day view
            $("#showdaybtn").click(function(e) {
                //document.location.href="#day";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("day").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            //to show week view
            $("#showweekbtn").click(function(e) {
                //document.location.href="#week";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("week").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }

            });
            //to show month view
            $("#showmonthbtn").click(function(e) {
                //document.location.href="#month";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("month").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            
            $("#showreflashbtn").click(function(e){
                $("#gridcontainer").reload();
            });
            
            //Add a new event
            $("#faddbtn").click(function(e) {
                var url ="edit.php";
                OpenModelWindow(url,{ width: 300, height: 400, caption: "Create New Calendar"});
            });
            //go to today
            $("#showtodaybtn").click(function(e) {
                var p = $("#gridcontainer").gotoDate().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }


            });
            //previous date range
            $("#sfprevbtn").click(function(e) {
                var p = $("#gridcontainer").previousRange().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }

            });
            //next date range
            $("#sfnextbtn").click(function(e) {
                var p = $("#gridcontainer").nextRange().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            
        });
    </script>    
</head>



<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jqcalendar";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

/*
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
*/

$sql = "SELECT Id,Subject,Location,EXTRACT(DAY FROM StartTime) AS year01,EXTRACT(HOUR FROM StartTime) AS year11,EXTRACT(MINUTE FROM StartTime) AS year12,EXTRACT(HOUR FROM EndTime) AS year21,EXTRACT(MINUTE FROM EndTime) AS year22,StartTime,EndTime,Description FROM jqcalendar WHERE EXTRACT(DAY FROM StartTime)= EXTRACT(DAY FROM NOW())AND EXTRACT(HOUR FROM StartTime)>= EXTRACT(HOUR FROM NOW()) AND `user`= '".$_SESSION['user_name']."' ORDER BY year11";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
     // output data of each row

echo '<input name ="speech-msg" id="speech-msg" type="hidden"  value="Hello user : Here are your following day schedule until current hour : ';

     while($row = $result->fetch_assoc()) {

echo 'You have event start in : '.$row["year11"].' o clock and '.$row["year12"].' minutes :  End in: '.$row["year21"].'o clock and '.$row["year22"].' minutes :  Subject is: '.$row["Subject"].' : Location is : '.$row["Location"].' : Here are your remark : '.$row["Description"].' :  '; 

}

echo ' "/>';

} 

else {
echo '<input name="speech-msg" id="speech-msg" type="hidden" value="Hello user You have NO event happen in today until current hours : AND make sure that event before current hours couldnt be announce">';

}

$conn->close();

?>  



<header id="header" class="alt">
				
		  <nav id="nav">
					<ul>
						<li class="submenu">


<a href="index.php">Hello,<?php echo $_SESSION['user_name']; ?></a>

							

							<ul>
<li><a href="index.php">Index</a></li>
								<li><a href="sample.php">Schedule</a></li>
								<li><a href="personalinfo.php">Personal Information</a></li>
								
			</ul>

<li><a href="index.php?logout" class="button special">Logout</a></li>
							</ul>
						</li>
			</ul>
			  </nav>
</header>





			<section id="cta">
		  <header>
					<h2>Check Your Schedule Today By Voice Now</h2>
					<p>Listen your Schedule,it 's now possible.</p>
 <p>Through our tools,you can listening to your schedule by any gadgets whatever android or i-products</p>
				</header>


<footer>


  <p id="msg"></p>

	
                        <input type="hidden" id="voice" value="native">
		<input type="hidden" name="volume" id="volume" value="1">
		<input type="hidden" name="rate" id="rate" value="1">
		<input type="hidden" name="pitch" id="pitch" value="1">

<br>
	<button id="speak" class="button special">Listen Schedule with Google Server</button>
<br><br><br>
<button class="button special" onclick="window.location.href='sample.php'">Refresh pages  </button>

<br>
					<ul class="buttons">
						<li>

<br>

</li>
					
				  </ul>
		       
 </footer>
			
<input name="filename" type="hidden" /><br />
<input type="hidden" name="save" /><br/>


			</section>


</div>



<body>
    <div>

      <div id="calhead" style="padding-left:1px;padding-right:1px;">          
            <div class="cHead"><div class="ftitle">Calendar View</div>
            <div id="loadingpannel" class="ptogtitle loadicon" style="display: none;">Loading data...</div>
             <div id="errorpannel" class="ptogtitle loaderror" style="display: none;">Sorry, could not load your data, please try again later</div>
            </div>          
            
 <div id="caltoolbar" class="ctoolbar">
              <div id="faddbtn" class="fbutton">
                <div><span title='Click to Create New Event' class="addcal">

                New Event                
                </span></div>
            </div>


            <div id="caltoolbar" class="ctoolbar">
            <div class="btnseparator"></div>
             <div id="showtodaybtn" class="fbutton">
                <div><span title='Click to back to today ' class="showtoday">
                Today</span></div>
            </div>
              <div class="btnseparator"></div>

            <div id="showdaybtn" class="fbutton fcurrent">
                <div><span title='Day' class="showdayview">Day</span></div>
            </div>

              <div  id="showmonthbtn" class="fbutton">
                <div><span title='Month' class="showmonthview">Month</span></div>

            </div>
            <div class="btnseparator"></div>
             <div class="btnseparator"></div>
            <div id="sfprevbtn" title="Prev"  class="fbutton">
              <span class="fprev"></span>

            </div>
            <div id="sfnextbtn" title="Next" class="fbutton">
                <span class="fnext"></span>
            </div>
            <div class="fshowdatep fbutton">
                    <div>
                        <input type="hidden" name="txtshow" id="hdtxtshow" />
                        <span id="txtdatetimeshow">Loading</span>


</div>
                    </div>
            </div>
            
            <div class="clear"></div>
            </div>
      </div>
      <div style="padding:1px;">

        <div class="t1 chromeColor">
            &nbsp;</div>
        <div class="t2 chromeColor">
            &nbsp;</div>
        <div id="dvCalMain" class="calmain printborder">
            <div id="gridcontainer" style="overflow-y: visible;">
            </div>
        </div>
        <div class="t2 chromeColor">

            &nbsp;</div>
        <div class="t1 chromeColor">
            &nbsp;
        </div>   
        </div>
     
  </div>
    










</body>


<script src="js/voice.js"></script>
<script src="js/index.js"></script>

</html>




