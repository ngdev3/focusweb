<div class="row">
    <?php //pr($res);die;?>
    <div class="col-md-12">
        <div class="portlet light">
<!--            <div class="portlet-title">
                <div class="caption"> <i class="fa fa-list font-red-sunglo"></i> <span class="caption-subject font-red-sunglo bold uppercase"><?php echo $page_title;?></span> </div>
                <div class="actions">
                        <select name="sample_country_length" aria-controls="sample_country" class="form-control">
                            <option value="10">Select Company</option>
                            <option value="25">AVA Marine</option>
                            <option value="50">Petro Inspect Group</option>
                        </select>
                        </div> 
            </div>-->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="portlet-body form"> 
                        <!-- BEGIN FORM-->
                        <form action="" id="nomination_form" method="post"class="form-horizontal">
                            <div class="form-body">
                                <div class="table-responsive">
                                    <table class="table table-border-none">
                                        <tr>
                                            <td colspan="3"> AVA Marine Group INC. are pleased to appoint you for the upcoming bunker survey details as follows: </td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="background:#f3f3f3;padding:15px;" colspan="3">
                                                <h4 class="pull-left "> AVA Marine Group</h4>
                                                <span><img src="<?php echo base_url(); ?>assets/admin/layout/img/logo.png" alt="logo" width="150px" height="55" class="mar_lt"/> </span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld"> Attending Surveyor</td>
                                            <td><?php echo @getcolumn_name('cz_users', 'fname', $res->attending_surveyor_id)[0]->fname; ?> <?php echo @getcolumn_name('cz_users', 'lname', $res->attending_surveyor_id)[0]->lname; ?></td>
                                        <input type="hidden" name="attending_surveyor_id" value="<?php echo $res->attending_surveyor_id ?>">
                                        <td><?php echo set_value("attending_surveyor_comment", $res->attending_surveyor_comment); ?>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld"> RFQ Number</td>
                                            <td><?php echo @getcolumn_name('cz_rfq', 'rfq_number', $res->rfq_id)[0]->rfq_number; ?></td>
                                        <input type="hidden" name="rfq_id" value="<?php echo $res->rfq_id; ?>">
                                        <td>
                                           <?php echo set_value("rfq_number_comment", $res->rfq_number_comment); ?>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Our File No</td>
                                            <td><?php echo @$res->our_file_number; ?></td>
                                        <input type="hidden" name="our_file_number" value="<?php echo @$res->our_file_number; ?>">

                                        <td>
                                         <?php echo set_value("our_file_number_comment", $res->our_file_number_comment); ?>

                                        </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Client Ref / PO</td>
                                            <td><?php echo @$res->client_reference_number; ?>  </td>
                                        <input type="hidden" name="client_reference_number" value="<?php echo @$res->client_reference_number; ?>">

                                        <td>
                                            <?php echo set_value("client_reference_number_comment", $res->client_reference_number_comment); ?>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Client </td>
                                            <td><?php echo @getcolumn_name('cz_client', 'first_name', $res->client_id)[0]->first_name; ?> <?php echo @getcolumn_name('cz_client', 'middle_name', $res->client_id)[0]->middle_name; ?> <?php echo @getcolumn_name('cz_client', 'last_name', $res->client_id)[0]->last_name; ?></td>
                                        <input type="hidden" name="client_id" value="<?php echo @$res->client_id; ?>">

                                        <td>
                                           <?php echo set_value("client_comment", $res->client_comment); ?>
                                            <span class="help-block text-danger"> <?php echo form_error("client_comment"); ?> </span>

                                        </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Vessel Operator</td>
                                            <td><?php echo @getcolumn_name('cz_operator', 'operator_name', $res->operator_id)[0]->operator_name; ?> </td>
                                        <input type="hidden" name="operator_id" value="<?php echo @$res->operator_id; ?>">

                                        <td>
                                         <?php echo set_value("vessel_operator_comment", $res->vessel_operator_comment); ?>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Remarks</td>
                                            <td><?php echo set_value("remarks", $res->remarks); ?>
                                            </td>

                                            <td>
                                           <?php echo set_value("remarks_comment", $res->remarks_comment); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Survey Type</td>
                                            <td>
                                                <?php echo @getcolumn_name('cz_survey_type', 'survey_type_name', $res->survey_type_id)[0]->survey_type_name; ?>
                                            </td>
                                        <input type="hidden" name="survey_type_id" value="<?php echo @$res->survey_type_id; ?>">

                                        <td>
                                           <?php echo set_value("survey_type_comment", $res->survey_type_comment); ?>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Vessel Name</td>
                                            <td><?php echo @getcolumn_name('cz_vessel_name', 'vessel_name', $res->vessel_id)[0]->vessel_name; ?></td>
                                        <input type="hidden" name="vessel_id" value="<?php echo @$res->vessel_id; ?>">

                                        <td>
                                            <?php echo set_value("vessel_comment", $res->vessel_comment); ?>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">IMO No</td>
                                            <td><?php echo $res->imo_number; ?></td>
                                        <input type="hidden" name="imo_number" value="<?php echo $res->imo_number; ?>">
                                        <td>
                                            <?php echo set_value("imo_number_comment", $res->imo_number_comment); ?>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Country</td>
                                            <td><?php echo @getcolumn_name('cz_countries', 'country_name', $res->country_id)[0]->country_name; ?></td>
                                        <input type="hidden" name="country_id" value="<?php echo $res->country_id; ?>">

                                        <td>
                                            <?php echo set_value("country_comment", $res->country_comment); ?>
                                                                    </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Port/Place</td>
                                            <td><?php echo @getcolumn_name('cz_place_port', 'place_port_name', $res->place_port_id)[0]->place_port_name; ?></td>
                                        <input type="hidden" name="place_port_id" value="<?php echo $res->place_port_id; ?>">

                                        <td><?php echo set_value("port_place_comment", $res->port_place_comment); ?>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">ETA</td>
                                            <td>
                                                <?php echo set_value("eta", $res->eta); ?>
                                            </td>
                                            <td>
                                                <?php echo set_value("eta_comment", $res->eta_comment); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">ETS</td>
                                            <td><?php echo set_value("ets", $res->ets); ?>

                                            </td>
                                            <td><?php echo set_value("ets_comment", $res->ets_comment); ?>


                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Agent</td>
                                            <td><?php echo $res->first_name . ' ' . $res->middle_name . ' ' . $res->last_name ?></td>
                                        <input type="hidden" name="agent_id" value="<?php echo $res->agent_id; ?>">
                                        <td>
                                            <?php echo set_value("agent_comment", $res->agent_comment); ?>

                                        </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Tel/Cell/Fax</td>
                                            <td> <?php
                                                if (!empty($res->business_first_country_code)) {
                                                    echo @$res->business_first_country_code . ' (' . @$res->business_first_area_code . ')' . @$res->business_first_phone_number . ' / ' . @$res->cell . '/' . @$res->business_fax;
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Address</td>
                                            <td><?php
                                                if (!empty($res->agent_countrys)) {
                                                    echo @$res->street . ' ,' . @$res->city . ',<br>' . @$res->state . ' , ' . @$res->agent_countrys . '-' . @$res->postal_code;
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Email</td>
                                            <td><?php echo $res->agent_email; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="background:#f3f3f3;padding:15px;"></td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Bunker Quantity Grade 1 </td>
                                            <td>
                                                <?php echo set_value("bunker_quantity_grade_1", $res->bunker_quantity_grade_1); ?>
                                            </td>
                                            <td>
                                             <?php echo set_value("bunker_quantity_grade_1_comment", $res->bunker_quantity_grade_1_comment); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Bunker Quantity Grade 2</td>
                                            <td>
                                                <?php echo set_value("bunker_quantity_grade_2", $res->bunker_quantity_grade_2); ?>
                                            </td>
                                            <td>
                                                <?php echo set_value("bunker_quantity_grade_2_comment", $res->bunker_quantity_grade_2_comment); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Bunker Quantity Grade 3</td>
                                            <td>
                                          <?php echo set_value("bunker_quantity_grade_3", $res->bunker_quantity_grade_3); ?>
                                            </td>
                                            <td>
                                          <?php echo set_value("bunker_quantity_grade_3_comment", $res->bunker_quantity_grade_3_comment); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Supplier</td>
                                            <td><?php echo $res->supplier_name .' '.$res->supp_middle_name.' '.$res->supp_last_name; ?></td>
                                        <input type="hidden" name="res_fuel_physical_supplier_id" value="<?php echo $res->res_fuel_physical_supplier_id; ?>">
                                        <td>
                                           <?php echo set_value("supplier_comment", $res->supplier_comment); ?>
                                            <span class="help-block text-danger"> <?php echo form_error("supplier_comment"); ?> </span> 

                                        </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Tel/Cell/Fax</td>
                                            <td> <?php
                                                if (!empty($res->supp_business_first_country_code)) {
                                                    echo @$res->supp_business_first_country_code . ' (' . @$res->supp_business_first_area_code . ')' . @$res->supp_business_first_phone_number . ' / ' . @$res->supp_cell . '/' . @$res->supp_business_fax;
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Address</td>
                                            <td><?php
                                                if (!empty($res->supplier_country)) {
                                                    echo @$res->supp_street . ' ,' . @$res->supp_city . ',<br>' . @$res->supp_state . ' , ' . @$res->supplier_country . '-' . @$res->supp_postal_code;
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Email</td>
                                            <td><?php echo $res->supp_email; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Custody Transfer Point</td>
                                <td><?php echo @getcolumn_name('cz_custody', 'custody_name', $res->custody_transfer_point_id)[0]->custody_name; ?></td>

                                            
                                            <td>
                                               <?php echo set_value("custody_transfer_point_comment", $res->custody_transfer_point_comment); ?>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="fnt_bld">Analysis </td>
                                       <td><?php echo @getcolumn_name('cz_analysis_name', 'analysis_name', $res->analysis_id)[0]->analysis_name; ?></td>

                                            <td>

                                               <?php echo set_value("analysis_comment", $res->analysis_comment); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Analysis Method</td>
                                     <td><?php echo @getcolumn_name('cz_analysis_type', 'analysis_type', $res->analysis_method_id)[0]->analysis_type; ?></td>

                                            <td>
                                                <?php echo set_value("analysis_method_comment", $res->analysis_method_comment); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">Analysis Laboratory</td>
                                          <td><?php echo @getcolumn_name('cz_analysis_lab', 'analysis_lab_name', $res->analysis_laboratory_id)[0]->analysis_lab_name; ?></td>

                                            <td>
                                         <?php echo set_value("analysis_laboratory_comment", $res->analysis_laboratory_comment); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="background:#f3f3f3;padding:15px;"></td>
                                        </tr>
<!--                                        <tr>
                                            <td class="fnt_bld">PIC 1</td>
                                            <td>

                                                <select name="pic1_id" id="pic1_id" aria-controls="sample_country" class="form-control" disabled>
                                                                                <option value="">Select Company</option>
<?php foreach ($users as $value) { ?>
                                                        <option value="<?= $value->id; ?>"  <?php echo set_select('pic1_id', $value->id, $value->id == @$res->pic1_id ? TRUE : FALSE); ?>><?= $value->fname . ' ' . $value->lname; ?></option>	
<?php } ?>

                                                </select>
                                                <span class="help-block text-danger"> <?php echo form_error("pic1_id"); ?> </span> 



                                            </td>
                                            <td>
                                                <?php echo set_value("pic1_comment", $res->pic1_comment); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Tel/Cell-    <span id="pic1_mobile_val"></span></td>
                                            <td>
                                              <?php echo set_value("pic1_tel_comment", $res->pic1_tel_comment); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Email -    <span id="pic1_email_val"></span></td>
                                          
                                            <td>

                                                <?php echo set_value("pic1_email_comment", $res->pic1_email_comment); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fnt_bld">PIC 2</td>
                                            <td>
                                                <select name="pic2_id" id="pic2_id" aria-controls="sample_country" class="form-control" disabled>
                                                                                <option value="">Select Company</option>
<?php foreach ($users as $value) { ?>
                                                        <option value="<?= $value->id; ?>"  <?php echo set_select('pic2_id', $value->id, $value->id == @$res->pic2_id ? TRUE : FALSE); ?>><?= $value->fname . ' ' . $value->lname; ?></option>	
<?php } ?>

                                                </select>
                                                <span class="help-block text-danger"> <?php echo form_error("pic2_id"); ?> </span> 

                                            </td>
                                            <td>

                                                <?php echo set_value("pic2_comment", $res->pic2_comment); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Tel/Cell-<span id="pic2_mobile_val"></span></td>
                                            <td>

                                            <?php echo set_value("pic2_tel_comment", $res->pic2_tel_comment); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Email-<span id="pic2_email_val"></span></td>
                                            <td>

                                            <?php echo set_value("pic2_email_comment", $res->pic2_email_comment); ?>
                                            </td>
                                        </tr>-->


                                        <tr>
                                            <td colspan="3"><label class="bolder">Remarks:- </label>
                                                <label>Please liaise with the local agents for the details of your visit and daily updated prospects in terms of arrival, berthing, sailing and bunkering if any, they have also been instructed to co-ordinate a joint visit with the off-hire surveyor, if applicable. In case of issues in getting to the port please contact the PIC immediately. In case of problems with access to the vessel please contact the local agents. In case of problems with the ship's officers and crew, please contact the PIC immediately.</label>
                                                </br>
                                                </br>
                                                <label class="text-danger">If case of sample test is off-spec advise PIC immediately</label>
                                                </br>
                                                </br>
                                                <label class="text-danger">In case of dispute in terms of the quantity delivered and/or quality issues, please investigate all the possibilities to challenge the situation and please only contact the PIC with proposed solution and clear facts.</label>
                                                </br></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
<!--                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn green">Submit</button>
                                        <button type="button" class="btn default cancel">Cancel</button>
                                    </div>
                                </div>
                            </div>-->
                        </form>
                        <!-- END FORM--> 
                        <a href="<?php echo base_url('nomination/list_items')?>"> Please Check </a>  
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




