    <?php

	require_once('inc/form.php');

	/* Set this to the same name as you set in the backend code above */
	$multiFormName = 'frm-test';

	/* Leave this line as is */
	$fh = $multiForms[$multiFormName];
	?>

    <div id="<?=$multiFormName; ?>-wrapper">

    <? // Success Text ?>
    <? if($fh->showSuccessText): ?>

	   <p class="successText">Thank you.<br />We will be in touch soon.</p>

    <? endif; ?>

    <? // To be displayed at page load ?>
    <? if($fh->showForm): ?>
    
        <? // To be displayed if the repsonse comes back with errors ?>
        <? if($fh->showErrorText): ?>
    
    	<p class="errorText">You have not filled in all required fields correctly, please check the form and try again.</p>

        <? else: ?>

        <p class="welcomeText">Enter your name and email address below to hear the latest news from us.</p>
    
        <? endif; ?>
	
        <form action="" method="post" enctype="multipart/form-data" id="<?=$multiFormName; ?>">
        
            <div class="field-wrap<?php if($fh->fields['forename']->isError) {?> error<?}?>">
                <label for="<?=$multiFormName?>-forename">First Name</label>
                <input type="text" name="forename" id="<?=$multiFormName?>-forename" value="<?php echo $fh->fields['forename']->value?>" data-required="<?=$forenameRequired; ?>" />
            </div>
            
            <div class="field-wrap<?php if($fh->fields['surname']->isError) {?> error<?}?>">
                <label for="<?=$multiFormName?>-surname">Surname</label>
                <input type="text" name="surname" id="<?=$multiFormName?>-surname" value="<?php echo $fh->fields['surname']->value?>" data-required="<?=$surnameRequired; ?>" />
            </div>
            
            <div class="field-wrap<?php if($fh->fields['company']->isError) {?> error<?}?>">
                <label for="<?=$multiFormName?>-company">Company</label>
                <input type="text" name="company" id="<?=$multiFormName?>-company" value="<?php echo $fh->fields['company']->value?>" data-required="<?=$companyRequired; ?>" />
            </div>
          
            <div class="field-wrap<?php if($fh->fields['dob']->isError) {?> error<?}?>">
                <label for="dob">Date of Birth</label>
                <select name="dob-day" id="dob-day" data-required="<?=$dobRequired; ?>" data-group="dob">
                	<option value="Day" >Day</option>
                	<?php for($i=1;$i<=31;$i++){?>
                    <option value="<?php echo $i?>"<?php echo $fh->fields['dob']->day==$i?' selected="selected"':''?>><?php echo $i?></option>
                    <?}?>
                </select>

                <select name="dob-month" id="dob-month" data-required="<?=$dobRequired; ?>" data-group="dob">
                	<option value="Month">Month</option>
                	<?php for($i=1;$i<=12;$i++){?>
                    <option value="<?php echo $i?>"<?php echo $fh->fields['dob']->month==$i?' selected="selected"':''?>><?php echo date('M',mktime(0,0,0,$i,1))?></option>
                    <?}?>
                </select>

                <select name="dob-year" id="dob-year" data-required="<?=$dobYearRequired; ?>" data-group="dob">
                	<option value="Year">Year</option>
                	<?php for($i=date('Y')-102;$i<=date('Y');$i++){?>
                    <option value="<?php echo $i?>"<?php echo $fh->fields['dob']->year==$i?' selected="selected"':''?>><?php echo $i?></option>
                    <?}?>
                </select>
            </div>
            
            <div class="field-wrap<?php if($fh->fields['email']->isError) {?> error<?}?>">
                <label for="<?=$multiFormName?>-email">E-Mail</label>
                <input type="text" name="email" id="<?=$multiFormName?>-email" value="<?php echo $fh->fields['email']->value?>" data-required="<?=$emailRequired; ?>" />
            </div>
           
            <div class="field-wrap<?php if($fh->fields['phone']->isError) {?> error<?}?>">
                <label for="<?=$multiFormName?>-phone">Phone</label>
                <input type="text" name="phone" id="<?=$multiFormName?>-phone" value="<?php echo $fh->fields['phone']->value?>" data-required="<?=$phoneRequired; ?>" />
            </div>
            
            <div class="field-wrap<?php if($fh->fields['address']->fields['address1']->isError) {?> error<?}?>">
                <label for="<?=$multiFormName?>-address-address1">Address 1</label>
                <input type="text" name="address-address1" id="<?=$multiFormName?>-address-address1" value="<?php echo $fh->fields['address']->fields['address1']->value?>" data-required="<?=$addressRequired; ?>" />
            </div>
           
            <div class="field-wrap<?php if($fh->fields['address']->fields['address2']->isError) {?> error<?}?>">
                <label for="<?=$multiFormName?>-address-address1">Address 2</label>
                <input type="text" name="address-address2" id="<?=$multiFormName?>-address-address2" value="<?php echo $fh->fields['address']->fields['address2']->value?>" data-required="0" />
            </div>
            
            <div class="field-wrap<?php if($fh->fields['address']->fields['town']->isError) {?> error<?}?>">
                <label for="<?=$multiFormName?>-address-town">Town/City</label>
                <input type="text" name="address-town" id="<?=$multiFormName?>-address-town" value="<?php echo $fh->fields['address']->fields['town']->value?>" data-required="<?=$addressRequired; ?>" />
            </div>
            
            <div class="field-wrap<?php if($fh->fields['address']->fields['county']->isError) {?> error<?}?>">
                <label for="<?=$multiFormName?>-address-county">County</label>
                <input type="text" name="address-county" id="<?=$multiFormName?>-address-county" value="<?php echo $fh->fields['address']->fields['county']->value?>" data-required="0" />
            </div>
            
            <div class="field-wrap<?php if($fh->fields['address']->fields['postcode']->isError) {?> error<?}?>">
                <label for="<?=$multiFormName?>-address-postcode">Postcode</label>
                <input type="text" name="address-postcode" id="<?=$multiFormName?>-address-postcode" value="<?php echo $fh->fields['address']->fields['postcode']->value?>" data-required="<?=$addressRequired; ?>" />
            </div>

            <div class="field-wrap<?php if($fh->fields['address']->fields['country']->isError) {?>error<?}?>">
                <label for="<?=$multiFormName?>-address-country">Country</label>
                <input type="text" name="address-country" id="<?=$multiFormName?>-address-country" value="<?php echo $fh->fields['address']->fields['country']->value?>" data-required="0" />
            </div>
            
            <div class="field-wrap<?php if($fh->fields['additional-info']->isError) {?> error<?}?>">
                <label for="<?=$multiFormName?>-additional-info">Additional Info</label>
                <input type="text" name="additional-info" id="<?=$multiFormName?>-additional-info" value="<?php echo $fh->fields['additional-info']->value?>" data-required="<?=$additionalInfoRequired; ?>" />
            </div>

            <? /*<label for="<?=$multiFormName?>-cv">CV</label><br />
            <input name="cv" type="file" class="file" id="<?=$multiFormName?>-cv" size="15" data-required="<?=$cvRequired; ?>" />
    	    <?php if($fh->fields['cv']->isError) {?> 
            <span class="error">*<?php 
    			if($fh->fields['cv']->isError==='size') {?> 
                    File must be &lt; 2mb <?php 
                }
                if($fh->fields['cv']->isError==='ext') {?> 
                    Invalid file type <?php 
                } ?>
            </span>
            <?php } ?> */ ?>
            
            <div class="field-wrap<?php if($fh->fields['comments']->isError) {?> error<?}?>">
                <label for="<?=$multiFormName?>-comments">Comments</label>
                <textarea name="comments" cols="" rows="5" id="<?=$multiFormName?>-comments" data-required="<?=$commentsRequired; ?>"><?php echo $fh->fields['comments']->value?></textarea>
            </div>
 
            <div class="field-wrap<?php if(@$fh->fields['mailing-list']->isError) {?> error<?}?>">
                <label for="<?=$multiFormName?>-mailinglist">Join Mailing List?</label>
                <input name="mailing-list" id="<?=$multiFormName?>-mailinglist" type="checkbox" value=""<?php echo @$fh->fields['mailing-list']->checked?'checked="checked" ':''?> />
            </div>
            
            <div class="field-wrap<?php if($fh->fields['reservation-date']->isError) {?> error<?}?>">
        	    <h4 class="clear">Restaurant/Hotel/Function Booking</h4>
        	
                <label for="reservation-date" >Arrival/Reservation Date</label>
                <select name="reservation-date-day" id="reservation-date-day" data-required="<?=$reservationDateRequired; ?>" data-group="reservation-date">
                	<option value="Day">Day</option>
                	<?php for($i=1;$i<=31;$i++){?>
                    <option value="<?php echo $i?>"<?php echo $fh->fields['reservation-date']->day==$i?' selected="selected"':''?>><?php echo $i?></option>
                    <?}?>
                </select>

                <select name="reservation-date-month" id="reservation-date-month" data-required="<?=$reservationDateRequired; ?>" data-group="reservation-date">
                	<option value="Month">Month</option>
                	<?php for($i=1;$i<=12;$i++){?>
                    <option value="<?php echo $i?>"<?php echo $fh->fields['reservation-date']->month==$i?' selected="selected"':''?>><?php echo date('M',mktime(0,0,0,$i,1))?></option>
                    <?}?>
                </select>

                <select name="reservation-date-year" id="reservation-date-year" data-required="<?=$reservationYearRequired; ?>" data-group="reservation-date">
                	<option value="Year">Year</option>
                	<?php for($i=date('Y');$i<=date('Y')+2;$i++){?><option value="<?php echo $i?>"<?php echo $fh->fields['reservation-date']->year==$i?' selected="selected"':''?>><?php echo $i?></option>
                    <?}?>
                </select>
            </div>
    	   
            <div class="field-wrap<?php if($fh->fields['reservation-departure']->isError) {?> error<?}?>">
                <label for="reservation-departure" >Departure Date</label>
                <select name="reservation-departure-day" id="reservation-departure-day" data-required="<?=$reservationDepartureRequired; ?>" data-group="reservation-departure">
                	<option value="Day">Day</option>
                	<?php for($i=1;$i<=31;$i++){?>
                    <option value="<?php echo $i?>"<?php echo $fh->fields['reservation-departure']->day==$i?' selected="selected"':''?>><?php echo $i?></option>
                    <?}?>
                </select>

                <select name="reservation-departure-month" id="reservation-departure-month" data-required="<?=$reservationDepartureRequired; ?>" data-group="reservation-departure">
                	<option value="Month">Month</option>
                	<?php for($i=1;$i<=12;$i++){?><option value="<?php echo $i?>"<?php echo $fh->fields['reservation-departure']->month==$i?' selected="selected"':''?>><?php echo date('M',mktime(0,0,0,$i,1))?></option>
                    <?}?>
                </select>

                <select name="reservation-departure-year" id="reservation-departure-year" data-required="<?=$reservationDepartureRequired; ?>" data-group="reservation-departure">
                	<option value="Year">Year</option>
                	<?php for($i=date('Y');$i<=date('Y')+2;$i++){?>
                    <option value="<?php echo $i?>"<?php echo $fh->fields['reservation-departure']->year==$i?' selected="selected"':''?>><?php echo $i?></option>
                    <?}?>
                </select>
            </div>
            
            <div class="field-wrap<?php if($fh->fields['reservation-time']->isError) {?> error<?}?>">
                <label for="reservation-time">Time</label>
                <select name="reservation-time-hour" id="reservation-time-hour" data-required="<?=$reservationTimeRequired; ?>" data-group="reservation-time">
                    <option value="Hour">Hour</option>
                    <?php for($i=0;$i<=23;$i++){?>
                    <option value="<?php echo $i?>"<?php echo $fh->fields['reservation-time']->hour==$i?' selected="selected"':''?>><?php echo $i<10?"0$i":$i?></option>
                    <?}?>
                </select>

                <select name="reservation-time-minute" id="reservation-time-minute" data-required="<?=$reservationTimeRequired; ?>" data-group="reservation-time">
                    <option value="Minute">Minute</option>
                    <?php for($i=0;$i<=55;$i+=5){?>
                    <option value="<?php echo $i?>"<?php echo $fh->fields['reservation-time']->minute==$i?' selected="selected"':''?>><?php echo $i<10?"0$i":$i?></option>
                    <?}?>
                </select>
            </div>
            
            <div class="field-wrap<?php if($fh->fields['reservation-guests']->isError) {?> error<?}?>">
                <label for="<?=$multiFormName?>-reservation-guests">Number of Guests</label>
                <input type="text" name="reservation-guests" id="<?=$multiFormName?>-reservation-guests" value="<?php echo $fh->fields['reservation-guests']->value?>" data-required="<?=$reservationGuestsRequired; ?>" />
            </div>
            
            <div style="display:none !important;">
                <textarea name="textboxfilter" rows="" cols=""></textarea>
                <input type="hidden" name="multiFormName" value="<?=$multiFormName?>" />
            </div>

            <input type="submit" name="submitted" value="Send" class="submit" />

        </form>

    <? endif; ?>

    </div>
