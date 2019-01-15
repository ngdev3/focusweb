<!DOCTYPE html>
<html lang="en">
<head>
<title>Welcome</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<style type="text/css">

body{font-family:verdana !important; font-size:12px;}
/* CLIENT-SPECIFIC STYLES */
table p{margin:3px 0px; font-size:14px;}
#outlook a { padding:0; } /* Force Outlook to provide a "view in browser" message */
.ReadMsgBody { width:100%; }
.ExternalClass { width:100%; } /* Force Hotmail to display emails at full width */
.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; } /* Force Hotmail to display normal line spacing */
body, table, td, a { -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; } /* Prevent WebKit and Windows mobile changing default text sizes */
table, td { mso-table-lspace:0pt; mso-table-rspace:0pt;  } /* Remove spacing between tables in Outlook 2007 and up */
/*
    table  td{
         border: 1px solid black; 
    }
*/
img { -ms-interpolation-mode:bicubic; } /* Allow smoother rendering of resized image in Internet Explorer */
/* RESET STYLES */
body { margin:0; padding:0; }
img { border:0; height:auto; line-height:100%; outline:none; text-decoration:none;align:center }
table {border-collapse:collapse !important; }
body { height:100% !important; margin:0; padding:0; width:100% !important; }
/* iOS BLUE LINKS */
.appleBody a { color:#68440a; text-decoration: none; }
.appleFooter a { color:#999999; text-decoration: none; }
a.foot-links { color:#999999 !important; }


}
</style>
</head>
<body style="margin:0; padding: 0;">
<!-- HEADER -->

    
<table border="0" cellpadding="0" cellspacing="0" width="700px;">
<tr>
<td bgcolor="#ffffff" height="70px">&nbsp;</td>
</tr>

  <tr>
    <td bgcolor="#ffffff" align="left"><!-- HIDDEN PREHEADER TEXT -->
      
      
      <table border="0" cellpadding="0" cellspacing="0" width="660px" class="wrapper" style="margin:6px 16px 0px 0px;background-color:#ffffff;">
        <!-- LOGO/PREHEADER TEXT -->
               <tr>
                <td colspan="3" bgcolor="#00ffcc" align="center" style="padding:8px 20px 8px 30px; font-size:12px;font-weight: bold;" class="section-padding">REQUEST FOR QUOTATION (RFQ)</td>
               </tr>
                <tr>
                <td colspan="3" align="left" style="font-family: Calibri; padding:25px 20px 0px 30px; font-size:11px;background-color:#ffffff; line-height:30px;color:#000000;">Good Day <?php echo ucfirst($res->clients_names); ?>&nbsp;,</td>
                
              </tr>
			  <tr>
                <td colspan="3" align="left" style="font-family: Calibri; padding:2px 20px 0px 30px; font-size:11px;background-color:#ffffff; line-height:30px;color:#000000;"><br />We thank you for giving us the opportunity to provide you with a quote for the subject enquiry:</td>
                
              </tr>
      </table></td>
  </tr>
</table>
<!-- ONE COLUMN SECTION -->
<table border="0" cellpadding="0" cellspacing="0" width="660px">
    
  <tr>
    <td bgcolor="#ffffff" align="center" style="padding: 0px 15px 25px 15px;" class="section-padding">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" class="responsive-table">
        
        <tr>
          <td><!-- COPY -->
            
            <table width="660px" border="1" cellspacing="0" cellpadding="0" style="margin:15px 0px 0px 10px;">
                
                
                 <tr>
                <td align="center" colspan="5"  style="padding:17px 20px 12px 50px;height:67px; font-size:11px; line-height: 20px;  color: #404041; background-color:#ffffff; line-height:30px;background-color:#d6dce4;color:#000000;text-align: center;"><strong style="font-weight:800;">
                         <?php if (@$res->company_id == '1') { ?>
                        <img src="<?php echo base_url('assets/admin/layout/img/logo.png'); ?>" alt="logo" />
                          <?php } ?>
                
                <?php if (@$res->company_id == '2') { ?>
                        <img src="<?php echo base_url('assets/admin/layout/img/petro.png'); ?>" alt="logo" />
                         <?php } ?>
                    </strong></td>
               
               
              </tr>
        
              <tr>
                <td align="left" width="300px;" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Your Quotation No. / Ref:</td>
                <td align="left" width="200px;" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo  @$res->quotation_number; ?></td>
                <td align="left" width="200px;" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo @$res->quotation_number_comment;?></td>
              </tr>
                
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Quotation Date</td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"> 
				<?php
                                                if (!empty(strtotime(@$res->quotation_date))) {
                                                    echo set_value("quotation_date", date('M d, Y', strtotime(@$res->quotation_date)));
                                                } else {
                                                    echo set_value("quotation_date", date("M d, Y"));
                                                }
                                                ?>
												
				
				</td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo @$res->quotation_date_comment; ?></td>
              </tr>
                
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Quotation Valid Until</td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php
                                                if (!empty(strtotime(@$res->quotation_validity))) {
                                                    echo set_value("quotation_validity", date('M d, Y', strtotime(@$res->quotation_validity)));
                                                } else {
                                                    echo set_value("quotation_validity", date("M d, Y"));
                                                }
                                                ?></td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("quotation_validity_comment", @$res->quotation_validity_comment); ?></td>
              </tr>
                
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Vessel Name</td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;width:120px;"><strong><?php echo  @getcolumn_name('cz_vessel_name','vessel_name',$res->vessel_id)[0]->vessel_name;?></strong></td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"> <?php echo set_value("vessel_name_comment", @$res->vessel_name_comment); ?></td>
              </tr>
                
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Survey Location</td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo  @getcolumn_name('cz_countries','country_name',$res->country_id)[0]->country_name;?></td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("country_name_comment", @$res->country_name_comment); ?></td>
              </tr>
                
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Origin of Surveyor</td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo  @getcolumn_name('cz_countries','country_name',$res->origin_surveyor_id)[0]->country_name;?> </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("origin_of_surveyor_comment", @$res->origin_of_surveyor_comment); ?></td>
              </tr>
                
                <tr>
                <td align="left" style="padding:20px 20px 0px 20px; font-size:12px; line-height: 20px;  color: #404041; background-color:#ffffff; line-height:30px;background-color:#ddebf7;"> </td>
                <td align="left" style="padding:20px 20px 0px 20px; font-size:12px; line-height: 20px;  color: #404041; background-color:#ffffff; line-height:30px;background-color:#ddebf7;"> </td>
                <td align="left" style="padding:20px 20px 0px 20px; font-size:12px; line-height: 20px;  color: #404041; background-color:#ffffff; line-height:30px;background-color:#ddebf7;"> </td>
              </tr>
                              <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Multi-grade BQS Survey Fee </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php  if(@$res->bqs_survey_fee!='') echo set_value("bqs_survey_fee", @$res->bqs_survey_fee);else{echo"$0.00";} ?> </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("bqs_survey_fee_comment", @$res->bqs_survey_fee_comment); ?></td>
              </tr>
                              <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Additional Hours </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php if($res->additional_hours!='')echo set_value("additional_hours", @$res->additional_hours);else{ echo "$0.00"; } ?></td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("additional_hours_comment", @$res->additional_hours_comment); ?> </td>
              </tr>
                              <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Bunker Detective Survey (221B) Fee </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">$<?php if($res->bunker_detective_survey!='')echo set_value("bunker_detective_survey", @$res->bunker_detective_survey);else{ echo "0.00"; } ?></td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("bunker_detective_survey_comment", @$res->bunker_detective_survey_comment); ?>
</td>
              </tr>
                              <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Finder's Fee </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("finder_fee", @$res->finder_fee); ?></td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("finder_fee_comment", @$res->finder_fee_comment); ?>  </td>
              </tr>
                              <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">ROB Survey </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">
				$
				<?php 
				if($res->rob_survey>0){
						echo set_value("rob_survey", @$res->rob_survey);
				}
				else{ 
						echo "0.00"; 
				}
				?>

				</td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("rob_survey_comment", @$res->rob_survey_comment); ?></td>
              </tr>
                              <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Off/On Hire Survey Fee </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">$<?php if($res->hire_survey_fee!='')echo set_value("hire_survey_fee", @$res->hire_survey_fee);else{ echo "0.00"; } ?> </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("hire_survey_fee_comment", @$res->hire_survey_fee_comment); ?></td>
              </tr>
                              <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Condition Survey Fee </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">$<?php if($res->condition_survey_fee!='')echo set_value("condition_survey_fee", @$res->condition_survey_fee);else{ echo "0.00";} ?></td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("condition_survey_fee_comment", @$res->condition_survey_fee_comment); ?> </td>
              </tr>
                              <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Bunker Invesgative Survey Fee </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">$<?php if($res->bunker_invesgative_survey_fee) echo set_value("bunker_invesgative_survey_fee", @$res->bunker_invesgative_survey_fee);else{ echo "0.00"; } ?></td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"> <?php echo set_value("bunker_invesgative_survey_fee_comment", @$res->bunker_invesgative_survey_fee_comment); ?></td>
              </tr>
                              <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Bunker Sample Witnessing Fee </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">$<?php if($res->bunker_sample_witnessing_fee!='')echo set_value("bunker_sample_witnessing_fee", @$res->bunker_sample_witnessing_fee);else{echo "0.00"; } ?> </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("bunker_sample_witnessing_fee_comment", @$res->bunker_sample_witnessing_fee_comment); ?> </td>
              </tr>
                
                <tr>
                <td align="left" style="padding:20px 20px 0px 20px; font-size:12px; line-height: 20px;  color: #404041; background-color:#ffffff; line-height:30px;background-color:#ddebf7;"> </td>
                <td align="left" style="padding:20px 20px 0px 20px; font-size:12px; line-height: 20px;  color: #404041; background-color:#ffffff; line-height:30px;background-color:#ddebf7;"> </td>
                <td align="left" style="padding:20px 20px 0px 20px; font-size:12px; line-height: 20px;  color: #404041; background-color:#ffffff; line-height:30px;background-color:#ddebf7;"> </td>
              </tr>
                
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Surveyor Travel Time Charged </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">$<?php if($res->surveyor_travel_charged!='')echo set_value("surveyor_travel_charged", @$res->surveyor_travel_charged);else{echo "0.00"; } ?></td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("surveyor_travel_charged_comment", @$res->surveyor_travel_charged_comment); ?> </td>
              </tr>
                
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Fuel Analysis Cost per Grade </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">$<?php if($res->fuel_analysis_cost!='')echo set_value("fuel_analysis_cost", @$res->fuel_analysis_cost);else{ echo "0.00"; } ?> </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("fuel_analysis_cost_comment", @$res->fuel_analysis_cost_comment); ?> </td>
              </tr>
                
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Fuel Storage (Retention) Cost per Grade </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("fuel_storage_cost", @$res->fuel_storage_cost); ?> </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"> <?php echo set_value("fuel_storage_cost_comment", @$res->fuel_storage_cost_comment); ?></td>
              </tr>
                
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Airfare Cost </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("airfare_cost", @$res->airfare_cost); ?> </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("airfare_cost_comment", @$res->airfare_cost_comment); ?> </td>
              </tr>
                
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Hotel Cost </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"> <?php echo set_value("hotel_cost", @$res->hotel_cost); ?></td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("hotel_cost_comment", @$res->hotel_cost_comment); ?> </td>
              </tr>
                
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Transportation Cost </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("transportation_cost", @$res->transportation_cost); ?> </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("transportation_cost_comment", @$res->transportation_cost_comment); ?> </td>
              </tr>
                
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Launch Boat Cost </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("launch_boat_cost", @$res->launch_boat_cost); ?> </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("launch_boat_cost_comment", @$res->launch_boat_cost_comment); ?> </td>
              </tr>
                
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Other Cost </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("other_cost", @$res->other_cost); ?> </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("other_cost_comment", @$res->other_cost_comment); ?> </td>
              </tr>
                
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Total Estimated Cost </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">$<?php if($res->total_estimated_cost!='')echo set_value("total_estimated_cost", @$res->total_estimated_cost);else{ echo "0.00";} ?></td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("total_estimated_cost_comment", @$res->total_estimated_cost_comment); ?> </td>
              </tr>
              
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Delivery Date / Supply Date </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php
                                                if (!empty(strtotime(@$res->delivery_date))) {
                                                    echo set_value("delivery_date", date('M d, Y', strtotime(@$res->delivery_date)));
                                                } else {
                                                    echo set_value("delivery_date", date("M d, Y"));
                                                }
                                                ?> </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo set_value("delivery_date_comment", @$res->delivery_date_comment); ?> </td>
              </tr>
                <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Delivery Place / Supply Place </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo  @getcolumn_name('cz_place_port','place_port_name',$res->delivery_place_id)[0]->place_port_name;?> </td>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"> <?php echo set_value("delivery_place_comment", @$res->delivery_place_comment); ?> </td>
              </tr>
			  <tr>
                <td align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;">Remarks </td>
                <td colspan="2" align="left" style="padding:3px 2px 3px 1px; font-size:11px; line-height: 20px;  background-color:#ffffff;color:#000000;"><?php echo @$res->remarks;?> </td>
              </tr>
                <tr>
                

            
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
   

<!-- TWO COLUMN SECTION --> 


</body>
</html>
