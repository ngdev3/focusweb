<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="" />
	<title>Nomination</title>
</head>
<body>
<div style="width:600px;margin:0 auto;">
 <table style="font-family:calibri;font-size:14px;width:100%;border:0px solid #fff;border-spacing:0px;
" border="0" cellpedding="0" cellspecing="0">
  <tr align="center">
   <td colspan="3" style="padding: 5px;">
     <?php if (@$rfq_company_id->company_id == '1') { ?>  
    <img src="<?php echo base_url('assets/admin/layout/img/logo.png'); ?>"/>
     <?php } ?>
                
                <?php if (@$rfq_company_id->company_id  == '2') { ?>
     <img src="<?php echo base_url('assets/admin/layout/img/petro.png'); ?>"/>
    <?php } ?>
   </td>
  </tr>
  
  <tr>
   <td colspan="3" style="background:#ffe799;font-family: arial;font-size:16px;font-weight:bold;text-align:center;padding:5px;">SURVEY REQUEST &amp; AUTHORIZATION</td>
  </tr>
  <tr>
   <td colspan="3" style="font-family: arial;font-size:12px;">&nbsp;</td>
  </tr>
  
  <tr>
  <td colspan="3" style="font-family:calibri;font-size:14px;">
     We are pleased to appoint you for the upcoming bunker survey details as follows:					
  </td>
  </tr>
  
  <tr>
   <td colspan="3" style="font-family: arial;font-size:12px;">&nbsp;</td>
  </tr>
  </table>
  
   <table style="font-family:calibri;font-size:14px;width:100%;border:1px dotted #333;border-spacing:0px;
" border="0" cellpedding="0" cellspecing="0">
  
   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Attention:</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;">Mr. <?php echo @getcolumn_name('cz_users', 'fname', $res->attending_surveyor_id)[0]->fname; ?> <?php echo @getcolumn_name('cz_users', 'lname', $res->attending_surveyor_id)[0]->lname; ?></td>
  </tr>
   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Our File No:
</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo @$res->our_file_number; ?>
</td>
  </tr>
   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Client Ref / PO:
</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo @$res->client_reference_number; ?> 
</td>
  </tr>
   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Vessel Name:
</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;font-weight:bold;"><?php echo @getcolumn_name('cz_vessel_name', 'vessel_name', $res->vessel_id)[0]->vessel_name; ?>
</td>
  </tr>
   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">IMO No:
</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo $res->imo_number; ?>
</td>
  </tr>
   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Client:
</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo @getcolumn_name('cz_client', 'clients_names', $res->client_id)[0]->clients_names; ?> 	
</td>
  </tr>
   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Name of Operator:
</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo @getcolumn_name('cz_operator', 'operator_name', $res->operator_id)[0]->operator_name; ?>
</td>
  </tr>
<!--   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Tel / Cell:
</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;">65 (08) 455-3323
</td>
  </tr>
   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Email:
</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><a href="mailto:xyz@cargill.com
">xyz@cargill.com
</a></td>
  </tr>-->
   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Port / Location:
</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo @getcolumn_name('cz_place_port', 'place_port_name', $res->place_port_id)[0]->place_port_name; ?> , <?php echo @getcolumn_name('cz_countries', 'country_name', $port_country->place_code)[0]->country_name; ?>
</td>
  </tr>
   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">ETA:
</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"> <?php echo set_value("eta", $res->eta); ?>
</td>
  </tr>
   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">ETS:
</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo set_value("ets", $res->ets); ?>
</td>
  </tr>
   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Agent
</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo $res->first_name . ' ' . $res->middle_name . ' ' . $res->last_name ?>
</td>
  </tr>
   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Tel / Cell:
</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><?php
                                                if (!empty($res->business_first_country_code)) {
                                                    echo @$res->business_first_country_code . ' (' . @$res->business_first_area_code . ')' . @$res->business_first_phone_number . ' - ' . @$res->cell ;
                                                }
                                                ?>  
     
       
       
</td>
  </tr>
   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Email:
</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><a href="<?php echo $res->agent_email; ?>
"><?php echo $res->agent_email; ?>
</a></td>
  </tr>
  
  <tr>
   <td colspan="3" style="font-family: arial;font-size:12px;background:#f2f2f2;">&nbsp;</td>
  </tr>
  
  
  <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;"> Bunker Quantity Grade 1:</td>
   <td width="35%" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo set_value("bunker_quantity_grade_1", $res->bunker_quantity_grade_1); ?></td>
   <td width="35%" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo set_value("bunker_quantity_grade_1_comment", $res->bunker_quantity_grade_1_comment); ?></td>
  </tr>
 			
<tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;"> Bunker Quantity Grade 2:
</td>
   <td width="35%" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo set_value("bunker_quantity_grade_2", $res->bunker_quantity_grade_2); ?>
</td>
   <td width="35%" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo set_value("bunker_quantity_grade_2_comment", $res->bunker_quantity_grade_2_comment); ?>
</td>
  </tr>
  
  <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;"> Bunker Quantity Grade 3:</td>
   <td width="35%" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo set_value("bunker_quantity_grade_3", $res->bunker_quantity_grade_3); ?></td>
   <td width="35%" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo set_value("bunker_quantity_grade_3_comment", $res->bunker_quantity_grade_3_comment); ?></td>
  </tr>
  
  <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Supplier:

</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo $res->supplier_name .' '.$res->supp_middle_name.' '.$res->supp_last_name; ?>

</td>
  </tr>
  
  <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Tel / Cell:
</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><?php
                                                if (!empty($res->supp_business_first_country_code)) {
                                                    echo @$res->supp_business_first_country_code . ' (' . @$res->supp_business_first_area_code . ')' . @$res->supp_business_first_phone_number . ' - ' . @$res->supp_cell ;
                                                }
                                                ?>
</td>
  </tr>
 
   <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Email:

</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><a href="<?php echo $res->supp_email; ?>
"><?php echo $res->supp_email; ?>
</a></td>
  </tr>
  
  <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Custody Transfer Point:

</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo @getcolumn_name('cz_custody', 'custody_name', $res->custody_transfer_point_id)[0]->custody_name; ?>

</td>
  </tr>
  
  <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Analysis:


</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo @getcolumn_name('cz_analysis_name', 'analysis_name', $res->analysis_id)[0]->analysis_name; ?></td>
  </tr>
<tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Analysis Method:



</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo @getcolumn_name('cz_analysis_type', 'analysis_type', $res->analysis_method_id)[0]->analysis_type; ?></td>
  </tr>
  		
          <tr>
   <td width="30%" style="font-family: calibri;font-size:15px;background:#ffe799;padding:5px;text-align:right;">Analysis Laboratory:




</td>
   <td width="70%" colspan="2" style="font-family: calibri;font-size:15px;padding:5px;"><?php echo @getcolumn_name('cz_analysis_lab', 'analysis_lab_name', $res->analysis_laboratory_id)[0]->analysis_lab_name; ?>
</td>
  </tr>			

  
 </table>
 
 
 <table style="font-family:calibri;font-size:14px;width:100%;border:0px solid #fff;border-spacing:0px;
" border="0" cellpedding="0" cellspecing="0">
  
   <tr>
    <td>
    &nbsp;
    </td>
   </tr>
  
  <tr>
   <td style="padding: 5px;font-family:tahoma;font-size:12px;color:red;font-weight:bold;text-decoration: underline;">
    PRINT OUT A COPY OF THIS AUTHORIZATION TO SHOW TO THE MASTER/CHIEF ENGINEER 						
						
   </td>
  </tr>
   <tr>
    <td>
    &nbsp;
    </td>
   </tr>
  
   <tr>
   <td style="padding: 5px;font-family:tahoma;font-size:14px;color:#000;">
      Please confirm this request by clicking <a href="<?php echo base_url('nomination/list_items')?>" style="color: red;font-weight:bold;text-decoration: underline;">Accept </a>
          <span style="color: red;font-weight:bold;padding:0 5px;">/</span>  
      <a href="<?php echo base_url('nomination/list_items')?>" style="color: red;font-weight:bold;text-decoration: underline;">Reject request </a> 
   </td>
  </tr>
  
  <tr>
    <td>
    &nbsp;
    </td>
   </tr>
   <tr>
    <td>
    &nbsp;
    </td>
   </tr>
  </table>
 
 
 <table style="font-family:calibri;font-size:14px;width:35%;border:0px solid #fff;border-spacing:0px;
" border="0" cellpedding="0" cellspecing="0">
    
   <tr>
   <td style="font-family: calibri;font-size: 15px;background: #ffe799;padding: 5px;font-weight:bold;">
     Petro Inspect Asia Pte. Ltd.
   </td>
  </tr>
  <tr>
   <td style="font-family: calibri;font-size: 15px;background: #ffe799;padding: 5px;font-weight:bold;">
    Stanley Kwok </td>
  </tr>
  
   <tr>
    <td>
    &nbsp;
    </td>
   </tr>
 </table>
 
</div>
</body>
</html>