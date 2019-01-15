<div class="col-md-12 col-xs-12">
<div class="white-box" style="margin-top: 40px;">
<div class="portlet-title" >
                    <div class="card-icon_headings" style="height:auto;text-align: left;" >
                    <div class="caption"> <i class="fa fa-list font-red-sunglo"></i>
                      <span class="caption-subject font-red-sunglo bold uppercase mainpage-title"> 
                        <?php echo $page_title; ?> 
                      </span>
                     </div>
                   </div>
                   <br>
               
                      
                   
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-0 p-0 mB-0">
                                    <!--<h4 class="c-grey-900 mB-20">Simple Table</h4>-->
                                   


                                  <table class="table">
                                       
                                            <tr>
                                                <th>Page Name</th>
                                                <td ><?php echo $res->page_name;?></td>
                                            </tr>

                                       
                                            <tr>
                                                <th  class="table_bg" scope="col">Image</th>
                                                <td><img src="<?php echo base_url().'uploads/profile_image/'.$res->image; ?>" alt ="loading" height = "60px" width = "60px"></td>
                                            </tr>
                                          
                                       
                                            <tr>
                                                <th  class="table_bg" scope="col">Title </th>
                                                <td scope="col"><?php echo $res->title;?></td>
                                            </tr>
                                          
                                       
                                            <tr>
                                                <th  class="table_bg" scope="col">Description</th>
                                                <td scope="col"><?php echo $res->description;?></td>
                                            </tr>
                                          
                                       
<!--                                             <tr>
                                                <th  class="table_bg" scope="col">Meta Title</th>
                                                <td scope="col"><?php echo $res->metatitle;?></td>
                                            </tr>

                                          
                                            <tr>
                                                <th  class="table_bg" scope="col">Meta Keyword</th>
                                                <td scope="col"><?php echo $res->metakeyword;?></td>
                                            </tr>

                                          
                                            <tr>
                                                <th  class="table_bg" scope="col">Meta Description</th>
                                                <td scope="col"><?php echo $res->metadescription;?></td>
                                            </tr>
 -->
                                             <tr>
                                                <th  class="table_bg" scope="col">Status</th>
                                                <td scope="col"><?php if($res->status==1){
                                                    echo "Active";
                                                    }else{
                                                        echo "Inactive" ;
                                                    }
                                                    ?></td>
                                            </tr>
                                          

                                          
                                           
                    
                                    </table><br><br>
                                    <center><a href="<?=base_url()?>pages/list_items/" id="back-btn" class="btn cur-p btn-primary">Back</a>
                                   </center> <br><br>
                                
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            