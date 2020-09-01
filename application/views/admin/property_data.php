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
                     <label for="builder">Builder:</label>
                     <select id="builder" name="builder" class="form-control" required="required" onchange="populate_projects(this.value);">
                        <option value="">Select</option>
                        <?php $allbuilders = $this->common_model->all_active_builders(); 
                           foreach ($allbuilders as $builder) { ?>
                        <option value="<?php echo $builder->id; ?>"><?php echo $builder->name; ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="emp_code">Project:</label>
                     <select  class="form-control"  id="m_project" name="m_project" required="required">
                        <option value="">Select</option>
                        <?php $projects= $this->common_model->all_active_projects(); 
                           foreach( $projects as $projectData){ ?>
                        <option value="<?php echo $projectData->id ?>"><?php echo $projectData->name ?></option>
                        <?php }?>               
                     </select>
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="p_location">Project Location:</label>
                     <input type="text" name="p_location" class="form-control">
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="ps_price">Project Starting Price:</label>
                     <input type="text" name="ps_price" class="form-control">
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="c_name">Name:</label>
                     <input type="text" name="c_name" class="form-control">
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="c_email">Email:</label>
                     <input type="text" name="c_email" class="form-control">
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="c_number">Number:</label>
                     <input type="text" name="c_number" class="form-control">
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="pos_year">Posession:</label>
                     <input type="text" name="pos_year" id="pos_year" class="form-control pos_year">
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
                     
                  <div class="col-md-3 form-group">
                     <label for="emp_code">City:</label>
                     <select  class="form-control"  id="city_id" name="city_id" required="required">
                        <option value="">Select</option>
                        <?php  
                           foreach( $active_cities as $active_cities){ ?>
                        <option value="<?php echo $active_cities->id ?>"><?php echo $active_cities->name ?></option>
                        <?php }?>               
                     </select>
                  </div>
                  <div class="col-sm-3 form-group">
                     <button type="submit" id="add_property_data" name="fileSubmit" style="margin-top:25px;" class="btn btn-success btn-block">Add Project Data</button>
                  </div>
                  </form>
               </div>
            </div>
            <!--/tabs-->
            <div class="container">
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="priority-1">No</th>
                    <th class="priority-2">Builder</th> 
                    <th class="priority-3">Project</th>
                    <th class="priority-4">Project Location</th>
                    <th class="priority-5">Project Starting Price</th>
                    <th class="priority-8">Name</th>
                    <th class="priority-9">Email</th>
                    <th class="priority-9">Number</th>
                    <th class="priority-10">Date Added</th>
                    <!-- <th>Last Update</th> -->
                    <th class="priority-11">Action</th>
                </tr>
            </thead> 
            <tbody id="main_body">
                <?php $i= 1;
                if(count($prop_data)>0){
                  // echo $this->session->userdata('self');
                foreach ($prop_data as $data) {
                  ?>
                    <tr id="row<?php echo $i ?>" >
                        <td class="priority-1"><?php echo $i; ?></td>
                        <td class="priority-2"><?php echo $data->builder_name; ?></td>
                        <td class="priority-3"><?php echo $data->project_name ?></td>
                        <td class="priority-4"><?php echo $data->location; ?></td>
                        <td class="priority-5"><?php echo $data->starting_price; ?></td>
                        
                        <td class="priority-8"><?php echo $data->name; ?></td>
                        <td class="priority-9"><?php echo $data->email; ?></td>
                        <td class="priority-8"><?php echo $data->number; ?></td>
                        <td class="priority-10"><?php echo $data->date_created; ?></td>
                        <!-- <td><?php echo $data->last_update; ?></td> -->
                        <td class="priority-11">
                            <table>
                            <tr class="icon" style="background-color: #ffffff00;">
                                    <td> 
                                        <a href="<?= base_url('admin/download_projectdata_files?id='.$data->id) ?>" >
                                            <i class="fa fa-download fa-2x"  title="Detail" style="" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/delete_project_data?id='.$data->id) ?>">
                                            <i class="fa fa-trash fa-2x" title="Notes" style="" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/property_data_edit/'.$data->id) ?>" target="_blank">
                                            <i class="fa fa-edit fa-2x" title="Notes" style="" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <?php $i++; } }
                else
                {
                    echo "<tr><td colspan=13 align=center>No Data Found</td></tr>";
                }

                ?>
            </tbody>
        </table>
    
    
        <div style="margin-top: 20px">
             <span class="pull-left"><p>Showing <?php echo ($this->uri->segment(3)) ? $this->uri->segment(3)+1 : 1; ?> to <?= ($this->uri->segment(3)+count($prop_data)); ?> of <?= $totalRecords; ?> entries</p></span>
              <ul class="pagination pull-right"><?php echo $links; ?></ul> 
        </div>
    </div>
<br/><br/>


 
 

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
                              url: "get_projects",
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
   <!--js -->
   <script> 
    $(document).ready(function() {
        $('#example').DataTable({
              "paging":   false,
              "info": false
 
        });
      });
      function add(){
          $(".se-pre-con").show();
          var broker=$('#broker').val();
          if(broker!=''){
              $.ajax({
                  type:"POST",
                  url: "<?php echo base_url()?>admin/add_broker",
                  data:{broker:broker},
                  success:function(data){
                      alert("add successful");
                  }
              });
              location.reload();
          }
          else{
              $(".se-pre-con").hide("slow");
              alert("Please Enter a value");
          }
      }
      function change_status(id){
          $(".se-pre-con").show();
          $.ajax({
              type:"POST",
              url: "<?php echo base_url()?>admin/change_status_broker",
              data:{id:id},
              success:function(data){
                  if(data.active){
                      $('#brokerus_sp_'+id).text('Active');
                      $('#b1'+id).removeClass("btn-danger");
                      $('#b1'+id).addClass("btn-info");
                  }else{
                      $('#brokerus_sp_'+id).text('Inactive');
                      $('#b1'+id).removeClass("btn-info");
                      $('#b1'+id).addClass("btn-danger");
                  }
                  $(".se-pre-con").hide("slow");
              }
          });
      }
      function check_broker(name){
          $(".se-pre-con").show();
          $('#add_broker').prop('disabled', true);
          $.ajax({
              type:"POST",
              url: "<?php echo base_url()?>admin/check_broker",
              data:{code:name},
              success:function(data){
                  if(data.count){
                      alert("Duplicate Code! try again");
                      $('#broker').val('');
                  }
                  else
                      $('#add_broker').prop('disabled', false);
                  $(".se-pre-con").hide("slow");
              }
          });
      }
   </script>
   <script type="text/javascript" src="<?php echo base_url()?>assets/js/TweenLite.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url()?>assets/js/CSSPlugin.min.js"></script>
   <!--<script src="<?php echo base_url()?>assets/js/scripts.js"></script>-->
   <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js?v=3.4.5"></script>
   <script type="text/javascript"src="<?php echo base_url()?>assets/js/properties.js"></script>
   <!-- Bootstrap Core JavaScript -->
</body>
</html>