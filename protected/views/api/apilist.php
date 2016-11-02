<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Face Off API</title>
<link href="<?php echo Yii::app()->params->base_url; ?>css/apipage.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>

<script>
$(document).ready(function(){

	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
</script>


</head>
<body>
<div class="maincontainer">
    <div class="hdr">
                <div class="container">
                    <div class="logo">
                        <img src="themefiles/assets/admin/layout/img/logo_dashboard.png" width="150" height="150" style="" />
                    </div>
                    
                    <div class="links">
                    
                        <h1 >Welcome to Face Off REST API!</h1>	
                        
                        <ul>
                        
                        
                        <li> <a target="_blank"  href="<?php echo Yii::app()->params->base_path; ?>admin/">ADMIN PANEL</a></li>
                       <br />
                        <li> <a href="<?php echo Yii::app()->params->base_path; ?>api">Refresh Page</a> </li>
                    </ul>
                </div>
            
        </div>
    </div>
    <div class="container">
      <div class="txt">
    <p>If you are exploring Face Off REST API for the very first time, you should start by reading the Guide. 	</p>
    </div>
    
      <div style="float:right">
        <ul style="list-style:none">
        
        <a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/showLogs"><li class="btn">ShowLog</li></a><br /><li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
        
        <a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/clearLogs"><li class="btn">ClearLogs</li></a>
        
        </ul>
      </div>
      
    </div>
    <div class="container">
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/registerUser&UserName=vishaleyes&EmailId=vishal.panchal@bypt.in&Password=111111&FirstName=vishal& <br />LastName=panchal&Gender=1&ProfileImage=test.png&BirthDate=2013-11-29&DeviceType=1&AppVersion=1.1&DeviceToken=83473487347837848734873487">registerUser</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserName, EmailId, Password </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>UserName, FirstName, LastName, Gender[0 female / 1 male], BirthDate[yyyy-mm-dd], EmailId, <br />Password, ProfileImage, DeviceToken, DeviceType, AppVersion</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserName=vishaleyes&EmailId=vishal.panchal@bypt.in&Password=111111&FirstName=vishal& <br />LastName=panchal&Gender=1&ProfileImage=test.png&BirthDate=2013-11-29&DeviceType=1&AppVersion=1.1&deviceToken=83473487347837848734873487 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>ProfileImage is a user profile pic.(send it in base64 formate)</td>
                  </tr>
                </table>
          </div>
         	<br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/login&UserName=vishaleyes&Password=111111">login</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserName, Password </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>UserName, Password, DeviceToken, DeviceType, AppVersion</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserName=vishaleyes&EmailId=vishal.panchal@bypt.in&Password=111111&FirstName=vishal& <br />LastName=panchal&Gender=1&ProfileImage=test.png&BirthDate=2013-11-29&DeviceType=1&AppVersion=1.1&deviceToken=83473487347837848734873487 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>ProfileImage is a user profile pic.(send it in base64 formate)</td>
                  </tr>
                </table>
          </div>
          <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/socialLogin&UserName=vishaleyes&EmailId=vpanchal911@gmail.com&FirstName=vishal255&LastName=panchal&SocialLoginId=13272472&LoginType=2&AppVersion=1.0&DeviceToken=asdfasdf&Gender=1&BirthDate=15-12-1986&DeviceType=1">socialLogin</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>EmailId, UserName </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>SocialLoginId, LoginType,Gender, BirthDate  DeviceToken, DeviceType, AppVersion</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> EmailId=vpanchal911@gmail.com&FirstName=vishal255&LastName=panchal&SocialLoginId=13272472&LoginType=2&AppVersion=1.0&DeviceToken=asdfasdf&Gender=1&BirthDate=15-12-1986&DeviceType=1 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
            <br/>
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/logout&UserId=5&SessionId=111111">logout</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>UserId, SessionId</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=5&SessionId=111111 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
            <br/>
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/updateProfile&UserId=12&SessionId=A4c235tRSd&FirstName=Vishal911&LastName=Panchal&Gender=1&BirthDate=15-12-1986&ProfileImage=testasdfsaf3908asjkdfjasdlfksadf">updateProfile</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>FirstName, LastName, Gender, BirthDate, ProfileImage </td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=12&SessionId=A4c235tRSd&FirstName=Vishal911&LastName=Panchal&Gender=1&BirthDate=15-12-1986&ProfileImage=testasdfsaf3908asjkdfjasdlfksadf </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>ProfileImage is a user profile pic.(send it in base64 formate)</td>
                  </tr>
                </table>
          </div>
            <br/>
             <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getCategoryList&UserId=8&SessionId=A4c235tRSd">getCategoryList</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=8&SessionId=A4c235tRSd</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
            <br/>
             <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getSubCategoryList&UserId=8&SessionId=A4c235tRSd">getSubCategoryList</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=8&SessionId=A4c235tRSd</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
            <br/>
              <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getGameListOfType&UserId=8&SessionId=A4c235tRSd&type=1&startFrom=0&limit=10">getGameListOfType</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>type, startFrom, limit</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=8&SessionId=A4c235tRSd&type=1&startFrom=0&limit=10</td>
                  </tr>
                  <tr>
                    <td>Note 1</td>
                    <td>:</td>
                    <td>type =>  1: Snap Reaction,2:Snap around me, 3: DrawBlank, 4: DrawOnSomething</td>
                  </tr>
                  <tr>
                    <td>Note 2</td>
                    <td>:</td>
                    <td>startFrom is an id from where you want to fetch records. And limit means No of records you want.</td>
                  </tr>
                </table>
          </div>
          <br/>
              <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/GetGamePlayList&UserId=8&SessionId=A4c235tRSd&startFrom=0&limit=10">GetGamePlayList</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>startFrom, limit</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=8&SessionId=A4c235tRSd&startFrom=0&limit=10</td>
                  </tr>
                  <tr>
                    <td>Note 1</td>
                    <td>:</td>
                    <td>startFrom is an id from where you want to fetch records. And limit means No of records you want.</td>
                  </tr>
                </table>
          </div>
          <br/>
              <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/GetGamePlayListByTypeSection&UserId=8&SessionId=A4c235tRSd&startFrom=0&limit=10&TypeSection=1">GetGamePlayListByTypeSection</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>TypeSection, startFrom, limit</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=8&SessionId=A4c235tRSd&startFrom=0&limit=10&TypeSection=1</td>
                  </tr>
                  <tr>
                    <td>Note 1</td>
                    <td>:</td>
                    <td>startFrom is an id from where you want to fetch records. And limit means No of records you want.</td>
                  </tr>
                  <tr>
                    <td>Note 2</td>
                    <td>:</td>
                    <td>TypeSection Values (1:SNAP,2:DRAW,3:DRAW) </td>
                  </tr>
                </table>
          </div>
          <br/>
              <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getRandomGameOfType&UserId=8&SessionId=bOynZBiBnK&startFrom=0&limit=10">getRandomGameOfType</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>startFrom, limit</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=8&SessionId=A4c235tRSd&startFrom=0&limit=10 </td>
                  </tr>
                  <tr>
                    <td>Note 1</td>
                    <td>:</td>
                    <td>startFrom is an id from where you want to fetch records. And limit means No of records you want.</td>
                  </tr>
                </table>
          </div>
          
           
            
             <br/>
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getTotListOfCategory&UserId=8&SessionId=Z94okLqXyo&startFrom=0&limit=10">getTotListOfCategory</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>startFrom, limit</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=8&SessionId=A4c235tRSd&startFrom=0&limit=10 </td>
                  </tr>
                  <tr>
                    <td>Note 1</td>
                    <td>:</td>
                    <td>startFrom is an id from where you want to fetch records. And limit means No of records you want.</td>
                  </tr>
                </table>
          </div>
             <br/>
              <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/sendFriendRequest&UserId=8&SessionId=A4c235tRSd&FriendSocialId=2">sendFriendRequest</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId, FriendSocialId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=8&SessionId=0xD7iJl86D&FriendSocialId=1</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
            <br/>
              <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/responseFriendRequest&UserId=8&SessionId=A4c235tRSd&FriendSocialId=1&responseType=1">responseFriendRequest</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId, FriendSocialId, responseType </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=8&SessionId=A4c235tRSd&FriendSocialId=2&responseType=1</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>responseType = 1 => accept and 2 -> reject</td>
                  </tr>
                </table>
          </div>
            <br/>
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/cancelFriendRequest&UserId=8&SessionId=A4c235tRSd&FriendSocialId=1">cancelFriendRequest</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId, FriendSocialId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=8&SessionId=A4c235tRSd&FriendSocialId=2</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          
           <br/>
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/removeFriend&UserId=8&SessionId=bOynZBiBnK&FriendSocialId=3">removeFriend</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId, FriendSocialId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=8&SessionId=A4c235tRSd&FriendSocialId=2</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          
            <br/>
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getSentFriendRequestList&UserId=8&SessionId=XCI0SdMj5O">getSentFriendRequestList</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=8&SessionId=A4c235tRSd</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          
           <br/>
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getRecievedFriendRequestList&UserId=8&SessionId=XCI0SdMj5O">getRecievedFriendRequestList</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=8&SessionId=A4c235tRSd</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          
          
           <br/>
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/reportUser&UserId=8&SessionId=60dSY60dSYf7t1z60dSY60dSYf7t1zl3RFd&ReportedUserId=3&ReportType=1&Reason=testing">reportUser</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId, ReportedUserId, ReportType,   </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>Reason</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>UserId=8&SessionId=60dSY60dSYf7t1z60dSY60dSYf7t1zl3RFd&ReportedUserId=3<br/>&ReportType=1&Reason=testing</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>ReportType = 1:Profanity,2:Irrelevant Content,3:Inappropriate Comments,4:Other</td>
                  </tr>
                </table>
          </div>
          
          <br/>
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/reportImage&UserId=8&SessionId=60dSY60dSYf7t1z60dSY60dSYf7t1zl3RFd&ReportedGamePlayId=3&ImageOwnerType=1&ImageOwnerId=1&ReportType=1&Reason=testing">reportImage</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId, ReportedGamePlayId, ImageOwnerId, ImageOwnerType, ReportType, Reason  </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>Reason</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>UserId=8&SessionId=60dSY60dSYf7t1z60dSY60dSYf7t1zl3RFd&ReportedGamePlayId=3&ImageOwnerId=1&ImageOwnerType=1&ReportType=1&Reason=testing</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>ReportType = 1:Profanity,2:Irrelevant Content,3:Inappropriate Comments,4:Other<br/>
                    ImageOwnerType = 1:User's Image ,2:Opponent's Image
                    </td>
                  </tr>
                </table>
          </div>
            
           <br />
           
           <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getGamePlayOfUser&UserId=8&SessionId=v7YTrv7YTrzmycNv7YTrv7YTrzmycN8AMm0">getGamePlayOfUser</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=8&SessionId=v7YTrv7YTrzmycNv7YTrv7YTrzmycN8AMm0</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          
          <br />
           
           <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getAllGameList&UserId=2&SessionId=zQ6fVzQ6fVMdKByzQ6fVzQ6fVMdKByWs3hu&start=0&limit=4">getAllGameList</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>start,limit</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=2&SessionId=zQ6fVzQ6fVMdKByzQ6fVzQ6fVMdKByWs3hu&start=0&limit=4</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>start => start record from where<br />limit => total number of records you want</td>
                  </tr>
                </table>
          </div>
          
           <br />
           
           <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getAllGiftList&UserId=2&SessionId=AkVO8AkVO8SVJHVAkVO8AkVO8SVJHVl6ZNG&start=0&limit=2">getAllGiftList</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>start,limit</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=2&SessionId=zQ6fVzQ6fVMdKByzQ6fVzQ6fVMdKByWs3hu&start=0&limit=4</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>start => start record from where<br />limit => total number of records you want</td>
                  </tr>
                </table>
          </div>
       
           <br />
           
           <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getAllReceivedGiftByUser&UserId=2&SessionId=AkVO8AkVO8SVJHVAkVO8AkVO8SVJHVl6ZNG&start=0&limit=2">getAllReceivedGiftByUser</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>start,limit</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=2&SessionId=zQ6fVzQ6fVMdKByzQ6fVzQ6fVMdKByWs3hu&start=0&limit=4</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>start => start record from where<br />limit => total number of records you want</td>
                  </tr>
                </table>
          </div>
          
          <br />
           
           <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/addVoteToGame&UserId=2&SessionId=AkVO8AkVO8SVJHVAkVO8AkVO8SVJHVl6ZNG&GamePlayUniqueId=1&type=1">addVoteToGame</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId, GamePlayUniqueId, type </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> UserId=2&SessionId=zQ6fVzQ6fVMdKByzQ6fVzQ6fVMdKByWs3hu&GamePlayUniqueId=1&type=1 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>type = 1 when vote is for user Image , type = 2 when type is for opponent Image</td>
                  </tr>
                </table>
          </div>
          
           <br />
           
           <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/removeUserFromVoteList&userId=2">removeUserFromVoteList</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>userId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>UserId=2</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          
          <br/>
          
          <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getProfileDetailsById&UserId=2&SessionId=sadfsadfsdf&ProfileId=3">getProfileDetailsById</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId, ProfileId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>UserId=2&SessionId=9gjWD9gjWDDQFj49gjWD9gjWDDQFj4HnMjb&ProfileId=333</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          
          <br/>
          <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/AddGamePlayToFavorite&UserId=2&SessionId=mkuTSmkuTS6jg6rmkuTSmkuTS6jg6rV8A5H&GamePlayUniqueId=2">AddGamePlayToFavorite</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId, GamePlayUniqueId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>UserId=2&SessionId=mkuTSmkuTS6jg6rmkuTSmkuTS6jg6rV8A5H&GamePlayUniqueId=2</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          
          
           <br/>
          <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getFavoritGamePlayList&UserId=2&SessionId=mkuTSmkuTS6jg6rmkuTSmkuTS6jg6rV8A5H&FavouriteGameplayId=1,2,3">getFavoritGamePlayList</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId, FavouriteGameplayId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>UserId=2&SessionId=mkuTSmkuTS6jg6rmkuTSmkuTS6jg6rV8A5H&FavouriteGameplayId=1,2,3</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          
          <br/>
          <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getThisOrThatContentsList&UserId=2&SessionId=mkuTSmkuTS6jg6rmkuTSmkuTS6jg6rV8A5H">getThisOrThatContentsList</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>UserId=2&SessionId=mkuTSmkuTS6jg6rmkuTSmkuTS6jg6rV8A5H</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>Image path => <?php echo Yii::app()->params->base_url; ?>assets/upload/polls/Choice_Image_1_1422616768.jpeg</td>
                  </tr>
                </table>
          </div>
          
           <br/>
          <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getComments&UserId=2&SessionId=mkuTSmkuTS6jg6rmkuTSmkuTS6jg6rV8A5H&GamePlayUniqueId=1">getComments</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId, GamePlayUniqueId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>UserId=2&SessionId=mkuTSmkuTS6jg6rmkuTSmkuTS6jg6rV8A5HUserId=2&SessionId=mkuTSmkuTS6jg6rmkuTSmkuTS6jg6rV8A5H&GamePlayUniqueId=1</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          
           <br/>
          <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/likeComment&UserId=2&SessionId=RU8BhRU8BhiquCfRU8BhRU8BhiquCfF2PmA&CommentUniqueId=4">likeComment</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId, CommentUniqueId </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>UserId=2&SessionId=mkuTSmkuTS6jg6rmkuTSmkuTS6jg6rV8A5HUserId=2&SessionId=mkuTSmkuTS6jg6rmkuTSmkuTS6jg6rV8A5H&CommentUniqueId=1</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          
          
             <br/>
          <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/giveComment&UserId=2&SessionId=RU8BhRU8BhiquCfRU8BhRU8BhiquCfF2PmA&GamePlayUniqueId=4&Comment=testy">giveComment</a> </td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>UserId, SessionId, GamePlayUniqueId, Comment</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>&UserId=2&SessionId=RU8BhRU8BhiquCfRU8BhRU8BhiquCfF2PmA&GamePlayUniqueId=4&Comment=testy</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          
          
          
          
          
          
          
          
          
          
          
          
    </div>
</div>
<div style="height:50px;"></div>
<p id="back-top" style="display: block;">
    <a href="#top"><span></span></a>
</p>
</body>    
</html>