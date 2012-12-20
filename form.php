<?php
	/* Step 1a: Set the name of the form that this code relates to */
	$multiFormName = 'frm-test';

	/* Leave these 2 lines as they are */
	require '/var/www/shared/formincludes/signupFormHeader.php';
	$fh = $multiForms[$multiFormName];

	/* Step 1b: Set site id */
	
	$siteId = 3;
	
	/* Step 2: Set which fields you want to be required */
	
	$forenameRequired = true;
	$surnameRequired = false;
	$companyRequired = false;
	$dobRequired = true;
	$dobYearRequired = false;
	$emailRequired = false;
	$phoneRequired = false;
	$addressRequired = false;			// Set to 'postcode' (with quotes) to just make postcode required
	$additionalInfoRequired = false;
	$cvRequired = false;
	$commentsRequired = false;
	$reservationDateRequired = false;
	$reservationYearRequired = false;
	$reservationDepartureRequired = false;
	$reservationTimeRequired = false;
	$reservationGuestsRequired = false;
	
	$mailingListRequired = false;		// If true, mailing list box *must* be checked for form to validate
	
	/* Step 3: Set whether you want an email sending */
	
	$sendEmail = true;
	
	/* Step 3a: If sending an email, set email subject and from & to addresses */

	$email->setSubject('test enquiry');
	
	$email->setFromEmail('web@site.co.uk');				// Email is sent 'from' this address
	$email->setFromName('Propeller');							// "Friendly" name emails are sent from (usually "<pubname> Website")
	
	$email->addRecipient('anthony.armstrong@propcom.co.uk');
	//$email->addRecipient('ruth.nachum@propcom.co.uk');		// Add a recipient to the email
	//$email->addRecipient('claire@yellowstoneskilodge.co.uk');
	
	//$email->addBccRecipient('andy-signups@propcomm.co.uk');	// Add a bcc to the email (remove the // at the start to enable a line)
	//$email->addBccRecipient('john@propcomm.co.uk');
	
	/* Step 4: Set whether you want the user adding to the database
	 *         If you *are* using the 'Join our mailing list' checkbox, leave set to 'checkbox'
	 *         If you want to make an 'opt-out' checkbox, set to 'checkbox-optout'
	 *		   If *not* using the checkbox, set to true if you want the user adding; or set to false if not
	 */
	
	$addToDatabase = false;
	
	/* Step 4a: Set whether you want a welcome mailer sent (if set up in the control panel) (true - send mailer; false - do not send mailer) */
	
	$sendWelcomeMailer = false;
	
	/* Step 4b: Set the groups/lists you want the user to be put in (set to true to be put in group or add the list ID (new CP only)) */
	
	$group1 = false;
	$group2 = false;
	$group3 = false;
	$group4 = false;
	$group5 = false;
	
	//$listIDs[] = 0000;
	//$listIDs[] = 0000;
	
	/* Step 5: Add any custom fields here */
	
	/* Leave this line as is */
	require '/var/www/shared/formincludes/signupFormFooter.php';
?>