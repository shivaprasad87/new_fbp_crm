<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   if($this->session->userdata("user_type") == "admin")
       $this->load->view('inc/admin_header');
   else
       $this->load->view('inc/header'); 
   
       echo "<script>var base_url='".base_url()."'</script>"; 

   ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css">
<body>
   <div class="se-pre-con"></div>
   <div class="page-container">
      <!--/content-inner-->
      <div class="left-content">
         <div class="inner-content">
            <!-- header-starts -->
            <div class="header-section">
               <!--menu-right-->
               <div class="top_menu">
                  <div class="profile_details_left">
                     <?php $this->load->view('notification');?>
                  </div>
                  <div class="clearfix"></div>
                  <!--//profile_details-->
               </div>
               <!--//menu-right-->
               <div class="clearfix"></div>
            </div>
            <!-- //header-ends -->
            <div class="outter-wp">
               <div class="container">
                  <div class="page-header">
                     <h1><?php echo $heading; ?></h1>
                  </div>
                                <?php
    if ($this->session->flashdata('success')) {
        ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong style="color: #3c763d;"><i class="fa fa-save" aria-hidden="true"></i></strong> <span
                    style="color: #3c763d;"><?= $this->session->flashdata('success') ?></span>
        </div>
        <?php
    }
    if ($this->session->flashdata('error')) {
        ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong style="color: #a94442;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></strong> <span
                    style="color: #a94442;"><?= $this->session->flashdata('error') ?></span>
        </div>
        <?php
    } 
    ?>
                  <form method="post" enctype="multipart/form-data">
                  <div class="col-sm-3 form-group">
                    <input type="hidden" name="prop_id" id="prop_id" value="<?=$property_data[0]->id?>">
                     <label for="builder">Builder:</label>
                     <select id="builder" name="builder" class="form-control" required="required" onchange="populate_projects(this.value);">
                        <option value="">Select</option>
                        <?php $allbuilders = $this->common_model->all_active_builders(); 
                           foreach ($allbuilders as $builder) { ?>
                        <option value="<?php echo $builder->id; ?>" <?php if($builder->id==$property_data[0]->b_id) echo "selected"; ?>><?php echo $builder->name; ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="emp_code">Project:</label>
                     <select  class="form-control"  id="m_project" name="m_project" required="required">
                        <option value="">Select</option>
                        <?php $projects= $this->common_model->all_active_projects(); 
                           foreach( $projects as $projectData){ ?>
                        <option value="<?php echo $projectData->id ?>"<?php if($projectData->id==$property_data[0]->p_id) echo "selected"; ?>><?php echo $projectData->name ?></option>
                        <?php }?>               
                     </select>
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="p_location">Project Location:</label>
                     <input type="text" name="p_location" class="form-control" value="<?=$property_data[0]->location?>">
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="ps_price">Project Starting Price:</label>
                     <input type="text" name="ps_price" class="form-control" value="<?=$property_data[0]->starting_price?>">
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="c_name">Name:</label>
                     <input type="text" name="c_name" class="form-control" value="<?=$property_data[0]->name?>">
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="c_email">Email:</label>
                     <input type="text" name="c_email" class="form-control" value="<?=$property_data[0]->email?>">
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="c_number">Number:</label>
                     <input type="text" name="c_number" class="form-control" value="<?=$property_data[0]->number?>">
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="pos_year">Posession:</label>
                     <input type="text" name="pos_year" id="pos_year" class="form-control pos_year" value="<?=date('Y',strtotime($property_data[0]->possession))?>">
                  </div> 
                          <div class="col-sm-6 col-md-6 col-lg-6">
                     <div class="form-group">
                         <label class="control-label">Project Files</label>
                         <div class="">
                             <div class="dropzone gallery">
                                 <div id="hiddenimages" class="hide"></div>
                             </div>
                         </div>
                     </div>
                     </div>
                  <div class="col-sm-3 form-group">
                     <button type="submit" id="edit_property_data" name="fileSubmit" style="margin-top:25px;" class="btn btn-success btn-block">Update Project Data</button>
                  </div>
                  </form>
               </div>
            </div>
            <!--/tabs-->

            <div class="tab-main">
               <!--/tabs-inner-->
            </div>
            <!--//tabs-inner-->
            <!--footer section start-->
            <footer>
               <p>&copy <?= date('Y')?> Fullbasket Property . All Rights Reserved | Design by <a href="https://secondsdigital.com/" target="_blank">Seconds Digital Solutions.</a></p>
            </footer>
            <!--footer section end-->
         </div>
      </div>
      <!--//content-inner-->
      <!--/sidebar-menu-->
      <div class="sidebar-menu">
         <header class="logo">
            <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a>  
            <span id="logo">
               <h1>FBP</h1>
            </span>
            <!--<img id="logo" src="" alt="Logo"/>--> 
            </a> 
         </header>
         <div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
         <!--/down-->
         <div class="down">
            <a href="#"><img src="<?php echo base_url()?>assets/images/admin.jpg"></a>
            <span class=" name-caret"><?php echo $this->session->userdata('user_name'); ?></span>
            <p><?php echo $this->session->userdata('user_type'); ?></p>
            <ul>
               <li><a class="tooltips" href="<?= base_url('dashboard/profile'); ?>"><span>Profile</span><i class="lnr lnr-user"></i></a></li>
               <li><a class="tooltips" style=" color: #00C6D7 !important; " href="#"><span>Team Size</span><?php if($this->session->userdata("manager_team_size")) echo $this->session->userdata("manager_team_size")?$this->session->userdata("manager_team_size"):''?></a></li>
               <li><a class="tooltips" href="<?php echo base_url()?>login/logout"><span>Log out</span><i class="lnr lnr-power-switch"></i></a></li>
            </ul>
         </div>
         <!--//down-->
         <?php $this->load->view('inc/header_nav'); ?>
      </div>
      <div class="clearfix"></div>
   </div>
   <script>
                    function populate_projects(obj)
                    {     
                      $('#m_project').empty(); 
                      $.ajax({
                              type: "POST",
                              url: "<?=base_url('admin/get_projects')?>",
                              data: { 'builder_id': obj  },
                              success: function(data){
                                  //console.log(data);
                                  var opts = $.parseJSON(data); 
                                  $.each(opts, function(i, d) { 
                                      $('#m_project').append('<option value="' + d.id + '">' + d.name + '</option>');
                                  });
                              }
                          });
                    }
                  </script>
   <script>
      var toggle = true;
                
      $(".sidebar-icon").click(function() {                
        if (toggle)
        {
        $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
        $("#menu span").css({"position":"absolute"});
        }
        else
        {
        $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
        setTimeout(function() {
          $("#menu span").css({"position":"relative"});
        }, 400);
        }
                    
                    toggle = !toggle;
                });
   </script>
   <script type="text/javascript" src="<?php echo base_url()?>assets/js/TweenLite.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url()?>assets/js/CSSPlugin.min.js"></script>
   <!--<script src="<?php echo base_url()?>assets/js/scripts.js"></script>-->
   <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js?v=3.4.5"></script> 
   <script type="text/javascript"src="<?php echo base_url()?>assets/js/properties_edit.js"></script>
   <!-- Bootstrap Core JavaScript -->
</body>
</html>