<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->view('inc/header'); 
    if(!$this->session->userdata('permissions') && $this->session->userdata('permissions')=='' ) {
    ?>

    <style type="text/css">
    .alrtMsg{padding-top: 50px;}
    .alrtMsg i {
        font-size: 60px;
        color: #f1c836;
    }
    </style>
    <div class="container"> 
        <div class="row"> 
            <div class="text-center alrtMsg">
                <i class="fa fa-exclamation-triangle"></i>
                <h3>You Do Not have permission as of now. Please contact your Administration and Request for Permission.</h3>
            </div>
        </div>
    </div>
    <?php
}


    ?>
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
                       <div>
					   <style>
	@media screen and (min-width: 768px) {
		modal_
		.modal-dialog  {
			width:900px;
		}
	}
	.form-group input[type="checkbox"] {
		display: none;
	}
	.form-group input[type="checkbox"] + .btn-group > label span {
		width: 20px;
	}
	.form-group input[type="checkbox"] + .btn-group > label span:first-child {
		display: none;
	}
	.form-group input[type="checkbox"] + .btn-group > label span:last-child {
		display: inline-block;   
	}
	.form-group input[type="checkbox"]:checked + .btn-group > label span:first-child {
		display: inline-block;
	}
	.form-group input[type="checkbox"]:checked + .btn-group > label span:last-child {
		display: none;   
	}
	tr.highlight_past td.due_date{
		background-color: #cc6666 !important;
	}
	tr.highlight_now td.due_date{
		background-color: #e4b13e !important;
	}
	tr.highlight_future td.due_date{
		background-color: #65dc68 !important;
	}
	#history_table td {
		border: 1px solid #aaa;
		padding: 5px
    }
    
    
</style>

<div class="container">
	<div class="page-header">
		<h1><?php echo $heading; ?></h1>
	</div>
    <form method="POST">
        <div class="row">

   <?php
    if ($this->session->userdata('success')) {
        ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong style="color: #3c763d;"><i class="fa fa-save" aria-hidden="true"></i></strong> <span
                    style="color: #3c763d;"><?= $this->session->userdata('success') ?></span>
        </div>
        <?php
        $this->session->unset_userdata('success');
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
                  <div class="col-sm-3 form-group">
                     <label for="builder">Builder:</label>
                     <select id="builder" name="builder" class="form-control" required="required" onchange="populate_projects(this.value);">
                        <option value="">Select</option>
                        <?php $allbuilders = $this->common_model->all_active_builders(); 
                           foreach ($allbuilders as $builder) { ?>
                        <option value="<?php echo $builder->id; ?>" <?php if($this->session->flashdata('builder_id')==$builder->id) echo "selected"; ?>><?php echo $builder->name; ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="emp_code">Project:</label>
                     <select  class="form-control"  id="m_project" name="m_project" required="required">
                        <option value="">Select</option>
                        <?php $projects= $this->common_model->all_active_projects(); 
                           foreach( $projects as $projectData){ ?>
                        <option value="<?php echo $projectData->id ?>" <?php if($this->session->flashdata('project_id')==$projectData->id) echo "selected"; ?>><?php echo $projectData->name ?></option>
                        <?php }?>               
                     </select>
                  </div>
                  <div class="col-md-3 form-group">
                     <label for="p_location">Project Location:</label>
                     <input type="text" name="p_location" id="p_location" class="form-control" value="<?=$this->session->flashdata('p_location')?>">
                  </div>
                                     <script>
                      $(document).ready(function(){
         $( "#p_location" ).autocomplete({
            source: function( request, response ) {
              $.ajax({
                url: "<?=base_url()?>admin/property_locations/",
                type: 'post',
                dataType: "json",
                data: {
                  Location: request.term
                },
                success: function( data ) {
                    response($.map(data, function (value, key) {
                    return {
                        label: value.name, 
                    }
                }));
                }
              });
            },
            select: function (event, ui) {
              $('#p_location').val(ui.item.label);
              return false;
            }
          });

        });
                    </script>
                  <div class="col-md-3 form-group">
                     <label for="ps_price">Project Starting Price:</label>
                     <input type="text" name="ps_price" id="property_budget" class="form-control" value="<?=$this->session->flashdata('ps_price')?>">
                  </div>
                                                       <script>
                      $(document).ready(function(){
         $( "#property_budget" ).autocomplete({
            source: function( request, response ) {
              $.ajax({
                url: "<?=base_url()?>admin/property_budget/",
                type: 'post',
                dataType: "json",
                data: {
                  budget: request.term
                },
                success: function( data ) {
                    response($.map(data, function (value, key) {
                    return {
                        label: value.name, 
                    }
                }));
                }
              });
            },
            select: function (event, ui) {
              $('#property_budget').val(ui.item.label);
              return false;
            }
          });

        });
                    </script>
                  <div class="col-md-3 form-group">
                     <label for="pos_year">Posession:</label>
                     <input type="text" name="pos_year" id="pos_year" class="form-control pos_year" placeholder="only year"value="<?=$this->session->flashdata('pos_year')?>">
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
            <div class="col-sm-4 col-md-4 form-group">
                <button type="submit" name="seacrh" id="search" style="margin-top:25px;" class="btn btn-success btn-block">Search</button>
            </div>
        </div>
    </form>
<div class="clearfix"></div>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){ ?>
    <form action="<?=base_url('dashboard/send_project_data_email');?>" method="post">
        <div class="row">
            <div class="col-sm-4 col-md-4 form-group">
               <input type="email" class="form-control" name="c_mail" placeholder="Please Enter Customer Email" required="">
               <input type="hidden" name="p_d_id" value="<?=$p_d_id?>">
            </div>
            <div class="col-sm-4 col-md-4 form-group">
                <button type="submit" name="email" style="margin-top:0px;" id="email" style="margin-top:25px;" class="btn btn-danger btn-block">Send Detail through Email</button>
            </div>
        </div>
    </form>
    <div class="clearfix"></div>
   <!--  <form method="post"> -->
        <div class="row">
            <div class="col-sm-4 col-md-4 form-group">
               <input type="email" class="form-control" name="c_number" placeholder="Please Enter Customer Whastapp Number" >
               <input type="hidden" name="p_d_id" value="<?=$p_d_id?>">
            </div>
            <div class="col-sm-4 col-md-4 form-group">
                <button type="" onclick="alert('This Option Will Work Soon!');" name="whatsapp" style="margin-top:0px;"  id="whatsapp" style="margin-top:25px;" class="btn btn-success btn-block">Send Deatils through Whastapp</button>
            </div>
        </div>
   <!--  </form> -->
<?php } ?>
                       </div>
                       </div>
<div class="clearfix"></div>
                       <div style="height: 1000px"></div>

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
                    <header class="logo"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a>  <span id="logo"> <h1>FBP</h1></span> 
                    <!--<img id="logo" src="" alt="Logo"/>--> 
                  </a> 
                </header>
            <div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
            <!--/down-->
                            <div class="down">  
                                      <?php $this->load->view('profile_pic');?>
                                      <span class=" name-caret"><?php echo $this->session->userdata('user_name'); ?></span>
                                       <p><?php echo $this->session->userdata('user_type'); ?></p>
                                     <?php if($this->session->userdata('user_type')=='user')
                                       {?>
                                      <span class="name-caret">RM:</span> <?php echo $this->session->userdata('manager_name'); ?><br>
                                        <?php } ?>
                                    
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
<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/css/vroom.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/js/vroom.js"></script> -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/TweenLite.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/CSSPlugin.min.js"></script>

<!--<script src="<?php echo base_url()?>assets/js/scripts.js"></script>-->

<!-- Bootstrap Core JavaScript -->
      <script>
                    function populate_projects(obj)
                    {     
                      $('#m_project').empty(); 
                      $.ajax({
                              type: "POST",
                              url: "<?=base_url('admin/')?>get_projects",
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


</body>
</html>