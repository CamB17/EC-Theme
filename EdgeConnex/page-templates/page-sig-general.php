<?php
/*
Template Name: General Signature
*/

if( isset($_POST['firstName']) ) :

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $title = $_POST['title'];
    $title2 = $_POST['title2'];
    $officeDisplay = $_POST['officeDisplay'];
    $officeNumber = $_POST['officeNumber'];
    $cellDisplay = $_POST['cellDisplay'];
    $cellNumber = $_POST['cellNumber'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
?>

<body id="body" style="margin: 0; padding: 0;">
	
<style type="text/css">

	/* EMAIL CLIENT STYLE RESETS // DO NOT EDIT ME */
	/* */	/* Outlook 2007/2010/2013 */
	/* */	#outlook a {padding: 0;}
	/* */	table, td, p {mso-table-lspace: 0pt !important; mso-table-rspace: 0pt  !important;}
	/* */	img {-ms-interpolation-mode:bicubic;}
	/* */	/* Outlook/Hotmail */
	/* */	.ReadMsgBody, .ExternalClass {width: 100%; background-color: #ffffff;}
	/* */	.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
	/* */	h2, h3, h4, h5, h6 {color: inherit  !important;}
	/* */	html, body, table, td, p, a, div {-ms-text-size-adjust: none;}
	/* */	/* iOS/MacOS/Firefox */
	/* */	html, body, table, td, p, a, div {-webkit-text-size-adjust: none; -moz-text-size-adjust: none;}
	/* */	/* General Reset */
	/* */	html, body {margin: 0; padding: 0;}
	/* */	img {display: block; border: none; height: auto; line-height: 100%; outline: none; text-decoration: none;}
	/* */	a img {border: none;}
	/* */	table, td {border-collapse: collapse  !important;}
	/* */	p {margin: 0;}
	/* */	div {display: block  !important;}
	
	body, table, td, div, p, a {font-family: Verdana, Arial, Helvetica, sans-serif; color: #333F48; font-size: 10.5px; -webkit-text-size-adjust: none; -ms-text-size-adjust: none; mso-line-height-rule: exactly;}
	/* table table, table td, table p, lbtable a {-webkit-text-size-adjust: none;} */
	table#info {width: 100%; max-width: 100%;}
	p {line-height: 150%;}
	
	p.name {font-size: 13px; color: #27588d; font-weight: bold; line-height: 1.6;}
	p.title {font-size: 11px;  color: #27588d; font-weight: bold;}
	p.address, p.phone-number{font-size: 10.5px; color: #333F48;}
		p.address a, p.phone-number a {color: #333F48; text-decoration: none !important; border-bottom: none; font-size: 10.5px !important; -webkit-text-size-adjust: none !important;}
	span.phone-type {font-size: 9px; width: 15px; color: #019cdb; font-weight: bold;}
	p.website {font-size: 10.5px; font-weight: bold;}
		p.website a {color: #333F48; text-decoration: none !important; font-size: 10.5px !important; -webkit-text-size-adjust: none !important;}
	p.disclaimer {font-size: 8px; line-height: 1.6; color: #494b49; max-width: 502px;}
	div.spacer {height: 6px; font-size: 6px; line-height: 6px; margin: 0 auto; padding: 0;}
	div.spacer-large {height: 18px; line-height: 18px; margin: 0 auto;}
	u + #body a {color: #333F48; text-decoration: none; font-size: inherit; font-family: inherit; font-weight: inherit; line-height: inherit;}
	/* a[x-apple-data-detectors] {color: #333F48; text-decoration: none; border-bottom: none; font-size: inherit; font-family: inherit; font-weight: inherit; line-height: inherit;} */
	
</style>

<table cellpadding="0" cellspacing="0" border="0" style="border: 0; margin: 0; padding: 0px 10px 0px 0px; font-size: 10px; -webkit-text-size-adjust: none; -ms-text-size-adjust: none; text-size-adjust: none;">
	<tr>
		<td style="margin: 0; padding: 21px 0 0 10px; font-size: 10px; line-height: 1.6; -webkit-text-size-adjust: none; -ms-text-size-adjust: none; text-size-adjust: none; font-family: Verdana, Arial, Helvetica, sans-serif; color: #494b49; text-transform: uppercase; letter-spacing: 0.5px; width: 195px;" width="195">
			<a href="http://edgeconnex.com" target="_blank" style="text-decoration: none;"><img src="http://client-work.cameronbarclay.com/edge-connex/edge8474/img/edgeconnex-logo.png" alt="Edge Connex" style="display: block; border: 0; width: 167px; height: 30px;" width="167" height="30"></a>
		</td>
	</tr>
	<tr>
		<td style="margin: 0; padding: 15px 0 6px 10px; font-size: 13px; line-height: 1.6; -webkit-text-size-adjust: none; -ms-text-size-adjust: none; text-size-adjust: none; font-family: Verdana, Arial, Helvetica, sans-serif; color: #27588d;">
						
			<!-- Content -->
			<p class="name"><?= $firstName; ?> <?= $lastName; ?></p>
			<p class="title" style=" font-weight: normal;"><?= $title; ?></p>
			<? if ( $title2 ) : ?>
				<p class="title" style=" font-weight: normal;"><?= $title2; ?></p>
			<? endif; ?>
			<div class="spacer">&#8203;</div>
			
			<? if ( ($officeDisplay && $officeNumber) || ($cellDisplay && $cellNumber) ) : ?>
		
			    <div class="spacer">&#8203;</div>
			
			<? endif; ?>
			
			
			<? if ( $cellDisplay && $cellNumber ) : ?>
			<p class="phone-number"><span class="phone-type">C: </span><a href="tel:<?= $cellNumber; ?>"><span style="color: #333F48; text-decoration: none;"><?= $cellDisplay; ?></span></a></p>
			<? endif; ?>
			
			<? if ( $officeDisplay && $officeNumber ) : ?>
			<p class="phone-number"><span class="phone-type" style="#019cdb; font-weight: bold;">O: </span><a href="tel:<?= $officeNumber; ?>"><span style="color: #333F48; text-decoration: none;"><?= $officeDisplay; ?></span></a></p>
			<? endif; ?>
			
			<? if ( ($officeDisplay && $officeNumber) || ($cellDisplay && $cellNumber) ) : ?>
		
			    <div class="spacer">&#8203;</div>
			
			<? endif; ?>
			
			<p class="address">
				<a href="https://www.google.com/maps/place/<?= $address1; ?> <?= $address2; ?>" target="_blank" style="color: #333F48; text-decoration: none;">
					<?= $address1; ?><br>
					<?= $address2; ?>
				</a>
			</p>
			
			<div class="spacer">&#8203;</div>
			
			<p class="website"><a href="https://www.edgeconnex.com/" target="_blank"><span style="color: #019cdb; text-decoration: none;">edgeconnex.com</span></a></p>
			<!-- / Content -->
								
		</td>
	</tr>
	<tr>
		<td style="margin: 0; padding: 0 0 9px 10px;">
			<div class="spacer">&#8203;</div>
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td valign="middle" style="margin: 0; padding: 0 15px 0 0; width: 19px;" width="19">
						<a href="https://twitter.com/EdgeConneX" target="_blank" style="border: 0; text-decoartion: none;"><img src="http://client-work.cameronbarclay.com/edge-connex/edge8474/img/icon-twitter.png" alt="Twitter" style="display: block; border: 0; width: 19px; height: 16px;" width="19" height="16"></a>
					</td>
					<td valign="middle" style="margin: 0; padding: 0 15px 0 0; width: 18px;" width="18">
						<a href="https://www.linkedin.com/company/edgeconnex/" target="_blank" style="border: 0; text-decoartion: none;"><img src="http://client-work.cameronbarclay.com/edge-connex/edge8474/img/icon-linkedin.png" alt="LinkedIn" style="display: block; border: 0; width: 18px; height: 17px;" width="18" height="17"></a>
					</td>
					<td valign="middle" style="margin: 0; padding: 0 16px 0 0; width: 11px;" width="11">
						<a href="https://www.facebook.com/edgeconnex/" target="_blank" style="border: 0; text-decoartion: none;"><img src="http://client-work.cameronbarclay.com/edge-connex/edge8474/img/icon-facebook.png" alt="Facebook" style="display: block; border: 0; width: 11px; height: 20px;" width="11" height="20"></a>
					</td>
					<td valign="middle" style="margin: 0; padding: 0; width: 21px;" width="21">
						<a href="https://www.youtube.com/channel/UCeljpfTV9c-dEfKFl2bVVSg" target="_blank" style="border: 0; text-decoartion: none;"><img src="http://client-work.cameronbarclay.com/edge-connex/edge8474/img/icon-youtube.png" alt="YouTube" style="display: block; border: 0; width: 21px; height: 15px;" width="21" height="15"></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="margin: 0; padding: 12px 20px 0 10px; max-width: 420px;">
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td style="font-size: 8px; line-height: 1.6; -webkit-text-size-adjust: none; -ms-text-size-adjust: none; text-size-adjust: none; font-family: Verdana, Arial, Helvetica, sans-serif; color: #494b49;">
						This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. This message contains confidential information and is intended only for the individual named. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

</body>


<?

else :

get_template_part( 'includes/header' ); ?>
		
		
		
		<?
			if ( htmlspecialchars($_POST['password']) == get_field('password')) {
				$password = htmlspecialchars($_POST['password']);
	
				?>

<section class="section-wrap pb-mainstage_area light-gray-bg"><div class="mainstage-wrap gunmetal-bg">
    <div class="row expanded align-middle align-center">
        <div class="small-12 medium-11 large-10 columns content" style="margin-top: 0px; min-height: 0px; max-height: 0px">
            
        </div>
        
        
    </div>
</div>
</section>
<section class="signature">
    <div class="row">
        <div class="column small-12 title">
            <h2>
                Corporate Signature Creator
            </h2>
            <p>Star (*) indicates required field.</p>
        </div>
        <form action="<?= $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" method="post">
            <div class="column small-12">
                <h6>First Name*</h6>
                <input type="text" name="firstName" placeholder="Eg: John" required>
            </div>
            <div class="column small-12">
                <h6>Last Name*</h6>
                <input type="text" name="lastName" placeholder="Eg: Doe" required>
            </div>
            <div class="column small-12">
                <h6>Title*</h6>
                <input type="text" name="title" placeholder="Eg: President" required>
            </div>
            <div class="column small-12">
                <h6>Title 2</h6>
                <input type="text" name="title2" placeholder="Eg: President">
            </div>
            <div class="column small-12">
                <h6>Office Phone (Display)</h6>
                <p>Type how you would like the number to be displayed on your email signature. Ex: (555) 555-5555</p>
                <input type="text" name="officeDisplay" placeholder="Eg: 555 555 5555">
            </div>
            <div class="column small-12">
                <h6>Office Phone (Number)</h6>
                <p>Enter your office number with only numbers and + signs (if needed for International). Ex: 5555555555</p>
                <input type="text" name="officeNumber" placeholder="Eg: 5555555555">
            </div>
            <div class="column small-12">
                <h6>Cell Phone (Display)</h6>
                <p>Type how you would like the number to be displayed on your email signature. Ex: (555) 555-5555</p>
                <input type="text" name="cellDisplay" placeholder="Eg: 555 555 5555">
            </div>
            <div class="column small-12">
                <h6>Cell Phone (Number)</h6>
                <p>Enter your cell number with only numbers and + signs (if needed for International). Ex: 5555555555</p>
                <input type="text" name="cellNumber" placeholder="Eg:5555555555">
            </div>
            <div class="column small-12">
                <h6>Address (First Line)*</h6>
                <p>Enter the street address. Ex: 2201 Cooperative Way, Suite 400</p>
                <input type="text" name="address1" placeholder="Eg: 2201 Cooperative Way, Suite 400" required>
            </div>
            <div class="column small-12">
                <h6>Address (Second Line)*</h6>
                <p>Enter the city, state/province, etc to complete the address. Ex: Herndon, VA 20171</p>
                <input type="text" name="address2" placeholder="Eg: Herndon, VA 20171" required>
            </div>
            <div class="column small-12">
                <input type="submit" class="button secondary">
                <p>Click the above button to generate your signature. After you submit, if there's an issue with the signature and you need to change these values, simply click your back button.</p>
            </div>
        </form>
    </div>
</section>

<?
	
	}
else {
	?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" style="background-color:  #e4eaed; padding: 30px 0;">
		<section class="row">
			<div class="col-sm-12 content">
				<div class="content-well content-block print-preview wow fadeInUp" data-wow-delay=".25s">
					<h2>This page is password protected.</h2>
					<p>Please enter the password to continue.
							
	
					<div class="row">
						<div class="col-sm-12" id="password_input" style="margin-left: 25px;">
							<form action="<? the_permalink(); ?>" method="post">
								<input type="text" placeholder="Password" name="password">
								<input type="submit" value="Submit">
							</form>
						</div>
					</div>
				</div>
			</div>
		</section><!-- close row -->
	</article> <!-- end article -->
	<?
		}
	
	?>
	
<?php

get_template_part( 'includes/footer' );

endif;

?>
