<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>

<!-- END PAGE LEVEL SCRIPTS -->


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.min.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/login.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
		jQuery(document).ready(function() {   
		
		  Metronic.init(); // init metronic core components
		  Layout.init(); // init current layout
		  Login.init();
		  
		  
		});
	</script>
  
  
    
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
<a href="<?php echo Yii::app()->params->base_path ; ?>site">
	<img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/logo.png" height="90%" width="90%"/>
	</a>
		<!-- BEGIN REGISTRATION FORM -->
	<form class="register-form" action="<?php echo Yii::app()->params->base_path;?>site/register" method="post" style="display:block;">
		<h3>Sign Up</h3>
		<p>
			 Enter your personal details below:
		</p>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Full Name</label>
			<div class="row">
				<div class="col-md-6">
					<div class="input-icon">
						<i class="fa fa-font"></i>
						<input class="form-control placeholder-no-fix" type="text" placeholder="First Name" name="firstname" value="<?php if(isset($_POST['firstname'])){ echo $_POST['firstname'];} ?>"/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="input-icon">
						<i class="fa fa-font"></i>
						<input class="form-control placeholder-no-fix" type="text" placeholder="Last Name" name="lastname" value="<?php if(isset($_POST['lastname'])){ echo $_POST['lastname'];} ?>"/>
					</div>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>"/>
			</div>
		</div>
		<p>
			 Enter your account details below:
		</p>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" value="<?php if(isset($_POST['username'])){ echo $_POST['username'];} ?>"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
			<div class="controls">
				<div class="input-icon">
					<i class="fa fa-check"></i>
					<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/>
				</div>
			</div>
		</div>
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Register as</label>
            <label>Register as:</label>
			<div class="radio-list">
                <label class="radio-inline">
                <input type="radio" name="usertype" id="usertype" value="0" checked> Diver </label>
                <label class="radio-inline">
                <input type="radio" name="usertype" id="usertype" value="1"> Business </label>
            </div>
		</div>
		<div class="form-group">
			<label>
			<input type="checkbox" name="tnc"/> I agree to the <a class="mix-link" data-toggle="modal" href="#terms_of_service">
			Terms of Service </a>
			and <a class="mix-link" data-toggle="modal" href="#privacy_policy">
			Privacy Policy </a>
			</label>
			<div id="register_tnc_error">
			</div>
		</div>
		<div class="form-actions">
			<button type="button" class="btn" onClick="window.location.href='<?php echo Yii::app()->params->base_path;?>site'">
			<i class="m-icon-swapleft"></i> Back </button>
			<button type="submit" id="register-submit-btn" name="register-btn" class="btn green pull-right">
			Sign Up <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
<div class="modal fade" tabindex="-1" data-width="760" aria-hidden="true" id="terms_of_service" >
								<div class="modal-dialog modal-lg">
									<div class="modal-content" >
										<div class="modal-header" >
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											
                                            <h3 class="modal-title" style="margin-top:15px;margin-bottom:0px; color:white; background-color:#698EE7">
                                            <img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/img/Service-icon.png" width="30px" height="35px">&nbsp;Terms of Service</h3>
										</div>
										<div class="modal-body">
                                       
                                     <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible="1" data-rail-color="blue" data-handle-color="red">
                                     <h3 style="color:blue">INTRODUCTION</h3>
<p>                                     
Dive Flag App (“we”/“us”) are excited that you’ve chosen our mobile application (the Dive Flag App”) to enhance your love of diving.  While we want you to have fun with the Dive Flag App, we do have to set some ground rules.  These terms and conditions (“these Terms”) govern your use of the Dive Flag App and as a condition of your downloadingthe Dive Flag App, you’ve agreed to these Terms.  So please read them carefully and if you decide that you don’t want to agree to these Terms, then you must not use the Dive Flag App and uninstall the Dive Flag App from your mobile device.  These Terms apply whether you are an individual user or a business user of the Dive Flag App.
</p>
<p>
Please also take caution when disclosing any of your personal information while usingthe Dive Flag App.  We cannot be held responsible for who may access your personal information or what they may do with it.  Further details are provided in the “Privacy Policy” section of these Terms.
 </p>
<p>
Every so often, we may push through an update to these Terms.  Your continued use of the Dive Flag Appwill be deemed your agreement to be bound by the updated version of these Terms.  As with these Terms, if you don’t want to agree to any updated version of these Terms, then you must discontinue usingthe Dive Flag App.
</p>
<p>
The Dive Flag Appis meant for your personal, non-commercial enjoyment.  Although we use reasonable care in choosing content, the content may not be up-to-date, accurate,or complete. The availability or use of the content is not intended to create, and does not create, any relationship between you and us.
 </p>
 <p>
Please note that you must be of the age of majority in your jurisdiction in order to usethe Dive Flag App.  Additionally, your wireless carrier may charge you a fee to use the Dive Flag Appand you agree to be responsible for payment of any such fees.
</p>
 
 <h3 style="color:blue">JOINING OUR COMMUNITY</h3>
<p>In order to get the most out of your use ofthe Dive Flag App, we encourage you to create a user profile.  Once you’re set up, you can take full advantage ofthe Dive Flag App’s features.  We invite you to submit content via your user profile but please note that we don’t pre-screen, monitor, review or edit user content and that we have the right (but not the obligation) at our sole discretion to refuse or remove any user content, in whole or part, that does not comply with these Terms or any content that is otherwise undesirable, inappropriate or inaccurate. We are not responsible for any failure, non-failure or delay in removing any such user content.
</p>
 
  <h3 style="color:blue">REGISTRATION</h3>
<p>
In order to create a user profile, you need to complete the registration process.  You’ll create a user name and password (collectively “User Account”).  All information is collected according to the privacy policy terms below.  Please note, however, that we don’t solicit,nor dowe wish to receive, any confidential, secret or proprietary information or other material from you andany information or material submitted or sent to us will be deemed not to be confidential, secret or proprietary and not covered by the below privacy policy terms.
</p>
<p>
You’re responsible for all activities that occur under your User Account so please take care to maintain its security and confidentiality. It’s your responsibility to notify us immediately of any unauthorized use of your User Account and you will be responsible for any unauthorized use of the Dive Flag Appincluding, without limitation, any direct, indirect, or actual damages.  You may not transfer, assign or sell your User Account to anyone.  The information in your User Account must not be false, inaccurate, incomplete, misleading, infringing on any third party’s rights nor may it violate any laws or create any liability to us.

 </p>
 <p>
You hereby warrant and represent that you are free and under no disability to complete a user registration and to agree to these Terms.  You will hold us harmless against, and at your expense handle and defend, any suit basedon any claim that your use of the Dive Flag Appdisrupted or caused harm to our computers, systems or infrastructure or to other parties, or if your use of the Dive Flag Appwas otherwise in violation of these Terms.
 </p>
 <p>
We may terminate your User Account – and your access to the Dive Flag App– if you fail to comply with these Terms, and we hereby reserve the right to refuse access to or use of the Dive Flag Appto anyone, at anytime, in our sole discretion.
 </p>                                   
  <h3 style="color:blue">USER CONDUCT</h3>

<p>We want all of our users to have a great time withthe Dive Flag App.  We therefore have to maintain rules of conduct so that it’s a great time for everyone usingthe Dive Flag App.  We have to post these rules so that everyone is on notice about what is and is not acceptable.  You therefore agree, as part of your use ofthe Dive Flag App:</p>
<p>You won’t submit any material that is illegal, misleading,threatening, abusive, harassing, defamatory, libelous, derogatory,indecent, obscene, vulgar, bigoted, hateful, intimidating, profane, scandalous, pornographic, or otherwise objectionable or in poor taste, infringing of any third party proprietary rights including copyright, trademark, or trade secret,prohibited under contractual or fiduciary relationships (such as inside information, proprietary and confidential information learned or disclosed as part of employment relationships or under nondisclosure agreements),is an expression or implication that statements you make are endorsed by us, without our prior written consent, invasive of personal privacy, harmful to minors or otherwise objectionable.</p>
<p>You won’t solicit, encourage, or promote the use of illegal substances or activities or forany other purpose that is prohibited by any law or regulation, or to facilitate the violation of any law or regulation.</p>
<p>As a business user, you will not use the Dive Flag App to place false or misleading advertisements;</p>
<p>As a business user, you will not pay for ratings or reviews of your business;</p>
<p>You won’t use conductadvertising or commercial solicitations, in connection with any political campaign materials, chain letters, mass mailings, “spam”, or to compete in any manner with us.</p>
<p>You won’t attempt to use any “deep-link”, “scraper”, “robot”, “bot”, “spider”, “data mining”, “computer code” or any other automated device, program, tool, algorithm, process or methodology or manual process having similar processes or functionality, to access, acquire, copy, or monitor any portion of the Dive Flag Appor any of our content.</p>
<p>You won’t violate the security of the Dive Flag Appor attempt to gain unauthorized access tothe Dive Flag App, data, materials, information, computer systems or networks connected to any server associated with the Dive Flag Appthrough hacking, password mining or any other means.</p>
<p>You won’t impersonate any person or entity, or falsely state or otherwise represent an affiliation with a person or entity.</p>
<p>You won’t upload or transmit any computer viruses, trojan horses, worms or anything else designed to interfere with, interrupt or disrupt the normal operating procedures of a computer or mobile service.</p>
<p>You may not interfere with, attempt to interfere with or otherwise disrupt the proper working of the Dive Flag Appor any servers or networks connected tothe Dive Flag App.  You may not use the Dive Flag Appto harvest or collect information about other users without their express consent or otherwise manipulate identifiers in order to disguise the origin of any content transmitted to or throughthe Dive Flag App, tocreate a database by systematically downloading and storing our contentto frame or mirror any part ofthe Dive Flag App, without our prior written consent.</p>
<p>
In order to make sure that these rules are adhered to, we may preserve and disclose user content and identify you if required to do so by law or in the good faith belief that such preservation or disclosure is reasonably necessary to comply with legal processes, to enforce these Terms, to respond to claims that any user content violates the rights of third parties, or to protect the rights, property, or our personal safety or that of,our users or the public.  If you have any concerns about content that you see while using the Dive Flag Appyou may email us at fvorster28@gmail.com.</p>

 <h3 style="color:blue">OUR USE OF USER CONTENT</h3>
<p>
By communicating with us, whether it’s by uploading user content or by submittingfeedback about the content onthe Dive Flag App, you grant us the royalty-free, unrestricted, world-wide, perpetual, irrevocable, non-exclusive and fully sub-licensable right and license to use, reproduce, modify, adapt, publish, translate, create derivative works from, distribute, perform and display such content (in whole or part), including any information, suggestions, ideas, drawings or concepts contained in such comments, worldwide and/or to incorporate it in other works in any form, media, or technology now known or later developed. You remain responsible for the accuracy, copyright compliance, legality, decency, or any other aspect of such submitted material, including any contribution or part thereof, or other communication to us.
</p>
 
  <h3 style="color:blue">LINKS TO THIRD PARTY WEBSITES</h3>
<p>
To enhance your experience usingthe Dive Flag App, we may provide links to third party websites that we believe are appropriate to be linked through the use ofthe Dive Flag App.  Thesewebsites are not under our control and we are not responsible for the contents or linkscontained on them or for any changes or updates to them. Although we will take care in selecting appropriate websites, the links we provide do not imply our endorsement of or association with these websites. It is your sole responsibility to comply with the appropriate “terms of service” of the linked websites as well as with any other obligation under copyright, secrecy, defamation, decency, privacy, security and export laws related to the use of such linked websites and any content contained thereon. In no event shall we be liable, directly or indirectly, to anyone for any loss or damage arising from or occasioned by the creation or use of the linked websites or the information or material accessed through these linked websites. You should direct any concerns about any of these websites to that website’s administrator or webmaster. We may, inour sole discretion, to add, change, decline or remove, without notice, any feature or link to any of the linked websites from the Dive Flag Appand/or to introduce different features or links.                                     
 </p>
 
 <h3 style="color:blue">INTELLECTUAL PROPERTY</h3>

<p>
 
Our app and all content contained within the Dive Flag App (except for content submitted by our users)are our property and are protected by copyright laws, trademark laws and other intellectual property laws and treaties. By “content”, we mean all of the software and code comprising or used to operatethe Dive Flag App, and all of the text, photographs, images, illustrations, graphics, sound recordings, video and audio-video clips, our name and logo, and other materials available on or throughthe Dive Flag App.  Weretain all rights in ourcontent and no license with respect thereto is granted to you.</p>
<p> 
Just to be clear, our content may not be used, copied, reproduced, distributed, republished, downloaded, modified, displayed, posted or transmitted in any form or by any means, including, but not limited to, electronic, mechanical, photocopying, recording, or otherwise, without our express prior written permission.</p>

<p> 
Additionally, if you believe in good faith that any of our or any user content infringes your intellectual property rights, you may send us a notice requesting that the material be removed, or access to it blocked. The notice must include the following information:
<p> a physical or electronic signature of a person authorized to act on behalf of the owner of an exclusive right that is allegedly infringed;</p>
<p> identification of the copyrighted work claimed to have been infringed (or if multiple copyrighted works located on the Dive Flag App are covered by a single notification, a representative list of such works);</p>
<p>identification of the material that is claimed to be infringing or the subject of infringing activity, and information reasonably sufficient to allow us to locate the material onthe Dive Flag App;</p>
<p> the name, address, telephone number and e-mail address (if available) of the complaining party;</p>
<p>a statement that the complaining party has a good faith belief that use of the material in the manner complained of is not authorized by the copyright owner, its agent or the law; and</p>
<p>a statement that the information in the notification is accurate and, under penalty of perjury, that the complaining party is authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.</p>
 </p>                      
 </div>             
										</div>
										
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>


<div class="modal fade" tabindex="-1" data-width="760" aria-hidden="true" id="privacy_policy">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h3 class="modal-title" style="margin-top:15px;margin-bottom:0px; color:white; background-color:#698EE7">
                                            <img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/img/privacypolicy.png" width="35px" height="40px">&nbsp;Privacy Policy</h3>
										</div>
										<div class="modal-body">
										 <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible="1" data-rail-color="blue" data-handle-color="red">  
<p>
We take the privacy of our users seriously and we are fully committed to ensuring that your privacy is respected and protected.</p> 
 <p>We will not collect information that you do not expressly provide. We will never sell, rent or share your personal information, including your email address, with any third parties for marketing purposes, without your express permission.
</p>
<p><b>When you use the Dive Flag App, we may collect the following information:</b></p>
<p>Mobile device-specific information including, without limitation, the unique device id assigned to your phone, platform type and version, hardware and processor type, screen resolution and human readable hardware name.  This information is necessary in order to select appropriate art for the screen resolution, to identify your account to simplify sign-on, and to determine the hardware requirements of our users.</p>
<p> User session identification and length (a randomly generated identification created for each time you use the Dive Flag App and the amount of time you use the Dive Flag Appin one session).  We use this information in aggregated form in order to improve future development ofthe Dive Flag App.  Such aggregated information may include, without limitation, how many unique users logged in on a given day or how many separate user sessions occurred during a given time period.</p>
<p> Facebook, Twitter and other social network information to the extent that you connect these networks withthe Dive Flag App.</p>
<p> If you are a business user, we will collect personally identifiable information including, without limitation, your name and your company’s name, your address and your company’s address, your phone number and your company’s phone number, your email address(es) and your credit card information.</p>


<h3 style="color:blue">WHY WE COLLECT YOUR INFORMATION</h3>
<p>
Our primary purpose in collecting information on the Dive Flag Appis to improve your experience using the Dive Flag Appon by offering you relevant content and services and by maintaining an efficient experience. We only collect information that we consider necessary for achieving this purpose.  The personally identifiable information that we collect from our business users will be used only for processing of payments of subscription and other fees.
</p>

 <h3 style="color:blue">KEEPING YOUR INFORMATION SECURE</h3>

<p>
We use commercially reasonable methods to keep your personally identifiable information securely in our files and systems.  Notwithstanding the foregoing, you hereby acknowledge that we cannot and do not guarantee the privacy or confidentiality of your personally identifiable information that passes over wireless networks.
</p>
 <h3 style="color:blue">DISCLAIMER OF WARRANTIES</h3>

<p>THE DIVE FLAG APP MAY BE SUBJECT TO LIMITATIONS, DELAYS, AND OTHER PROBLEMS INHERENT IN THE USE OF WIRELESS SERVICES AND ELECTRONIC COMMUNICATIONS. WE ARE NOT RESPONSIBLE FOR ANY DELAYS, DELIVERY FAILURES, OR OTHER DAMAGE RESULTING FROM SUCH PROBLEMS.</p>
 
<p>YOU HEREBY EXPRESSLY AGREE THAT YOUR USE OF THE DIVE FLAG APP IS AT YOUR SOLE RISK.  NEITHER WE NOR OUR EMPLOYEES, AFFILIATES, AGENTS, THIRD-PARTY INFORMATION PROVIDERS, MERCHANTS, LICENSORS OR THE LIKE, WARRANTS THAT THE DIVE FLAG APP WILL BE UNINTERRUPTED OR ERROR FREE OR FREE OF INFECTION BY VIRUSES, WORMS, TROJAN HORSES OR ANYTHING ELSE MANIFESTING CONTAMINATING OR DESTRUCTIVE PROPERTIES; NOR DO ANY OF THE AFORESAID MAKE ANY WARRANTY AS TO THE RESULTS THAT MAY BE OBTAINED FROM THE USE OF THE DIVE FLAG APP.  YOU ASSUME THE ENTIRE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION.  WE MAKE NO WARRANTY AS TO THE ACCURACY, RELIABILITY OR CONTENT OF ANY INFORMATION, SERVICES, OR MERCHANDISE PROVIDED THROUGH THE DIVE FLAG APP.</p>
 
<p>THE DIVE FLAG APP IS PROVIDED ON AN “AS IS,” “AS AVAILABLE” BASIS WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, WARRANTIES OF TITLE, OF NON-INFRINGEMENT, OR IMPLIED WARRANTIES OF MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE, OTHER THAN THOSE WARRANTIES WHICH ARE IMPLIED BY AND INCAPABLE OF EXCLUSION, RESTRICTION OR MODIFICATION UNDER THE LAWS APPLICABLE TO THESE TERMS.  NO ORAL ADVICE OR WRITTEN INFORMATION GIVEN BY US, OUR EMPLOYEES, AGENTS, THIRD-PARTY INFORMATION PROVIDERS, MERCHANTS, LICENSORS OR THE LIKE, SHALL CREATE A WARRANTY; NOR SHALL YOU RELY ON ANY SUCH INFORMATION OR ADVICE.  WITHOUT LIMITATION OF THE FOREGOING, WE ARE NOT RESPONSIBLE OR LIABLE IN ANY WAY IF ANY INFORMATION PROVIDED IS INACCURATE IN ANY WAY.</p>
 
<p>WEARE NOT RESPONSIBLE OR LIABLE IN ANY MANNER FOR ANY USER CONTENT. ALTHOUGH THESE TERMS CONTAINSTRICT PROVISIONS REGARDING USER CONTENT, WEDON’T CONTROL AND WE AREN’T RESPONSIBLE FOR WHAT USERS POST ON OR THROUGH THE DIVE FLAG APP AND WE AREN’TRESPONSIBLE FOR ANY INACCURATE, OFFENSIVE, INAPPROPRIATE, OBSCENE, UNLAWFUL, INFRINGING OR OTHERWISE OBJECTIONABLE OR ILLEGAL CONTENT YOU MAY ENCOUNTER ON THE DIVE FLAG APP.</p>
 
 <h3 style="color:blue">LIMITATION OF LIABILITY</h3>

<p>
	
UNDER NO CIRCUMSTANCES, INCLUDING BREACH OF CONTRACT, TORT OR NEGLIGENCE, SHALL WE, OR ANYONE ELSE INVOLVED IN CREATING, PRODUCING OR DISTRIBUTING THE DIVE FLAG APP, BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL OR CONSEQUENTIAL DAMAGES THAT RESULT FROM THE USE OF OR INABILITY TO USE THE DIVE FLAG APP INCLUDING, BUT NOT LIMITED TO, RELIANCE BY YOU ON ANY INFORMATION OBTAINED THROUGH THE DIVE FLAG APP OR THAT RESULT FROM MISTAKES, OMISSIONS, INTERRUPTIONS, DELETION OF FILES OR EMAIL, ERRORS, DEFECTS, VIRUSES, DELAYS IN OPERATION, OR TRANSMISSION, OR ANY FAILURE OF PERFORMANCE, WHETHER OR NOT LIMITED TO ACTS OF GOD, COMMUNICATIONS FAILURE, THEFT, DESTRUCTION OR UNAUTHORIZED ACCESS TO OUR RECORDS.BECAUSE SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OR LIMITATION OF LIABILITY FOR CONSEQUENTIAL OR INCIDENTAL DAMAGES, IN SUCH STATES OUR LIABILITY IS HEREBY LIMITED TO THE GREATEST EXTENT PERMITTED BY LAW.
</p>

 <h3 style="color:blue">APPLICABLE LAWS</h3>

<p> 

These Terms shall be treated as though they were executed and performed inQueensland, Australia, and shall be governed by and construed in accordance with the laws ofQueensland, Australia, without regard to conflict of law principles.  You agree to submit to the personal jurisdiction and venue of such courts in the event of any legal claim arising out of these Terms, which such claim will be settled by binding arbitration in accordance with the commercial arbitration rules of the Australian Arbitration Association. The arbitration shall be conducted inQueensland, Australia, and judgment on the arbitration award may be entered into any court having jurisdiction thereof.
 
</p>
 </div>

										</div>
										
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
</body>
<!-- END BODY -->
</html>