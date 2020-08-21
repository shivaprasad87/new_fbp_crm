
<style>
    .tooltip {
		position: relative;
    display: contents;
    /* border-bottom: 1px dotted black; */
    font-size: 15px;
  }
  
  .tooltip .tooltiptext {
	visibility: hidden;
	width: 80px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    top: 100%;
    left: 50%;
    margin-left: -35px;
  }
  
  .tooltip:hover .tooltiptext {
	visibility: visible;
  }
  </style>
  
 
<?php
$baseURL = ($this->session->userdata('user_type') == 'admin') ? base_url('admin') : base_url();
$i=1;
?>


<div class="menu headerScroll">
									<ul id="menu" class="scrollbar2">
										<li class="<?php if($name=='index'){echo 'active';}?>"><a href="<?php echo $baseURL; ?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
	<?php
    $this->load->model('Common_model');
    $parentModules = $this->common_model->getNavbarByClause(['parentId'=>0]);
    $aAttr = '';
    $permissionArry = json_decode($this->session->userdata('permissions'), true);
    if($parentModules) {
        foreach ($parentModules as $pModule) {
            if($permissionArry && in_array($pModule['id'], $permissionArry)) {
                
                $baseLink = ($this->session->userdata('user_type') == 'admin') ? base_url('admin/'.$pModule['permalink']) : base_url($pModule['permalink']);
                $childModules = $this->common_model->getNavbarByClause(['parentId' => $pModule['id']]);
                // echo $this->db->last_query();
                if($childModules) 
                {
                 $aAttr  = 'data-toggle="dropdown" dropdown-toggle'; 
                }
                    
                ?>

 <li class="tooltip <?= ($this->router->fetch_method() == $pModule['permalink']) ? 'active' : '' ?>">
                    <a href="<?= $baseLink;?>" <?= $aAttr; ?> ><i class="<?php  echo $pModule['class']?>"></i> <span><?= $pModule['module'].((count($childModules)>0) ? '<span class="caret"></span>' :'') ?></span></a>
                    <?php
                    if(count($childModules)>0){
                        echo '<ul>';
                        foreach ($childModules as $cModule) {
                            $baseLink = ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'City_head') ? base_url('admin/'.$cModule['permalink']) : base_url($cModule['permalink']);
                            if(in_array($cModule['id'], $permissionArry))
                                 echo '<li><a href="'.$baseLink.'">'.$cModule['module'].'</a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                </li>
                <?php
            }
            $i++;
        }
    }
    ?>
                  </ul>
                  

                  
                <!-- </div>
                </div> -->
  </div>








  
		<style>
    .table {
        color: green;
       /* display: block;*/
        max-width: 100%;
        overflow: scroll; <!-- Available options: visible, hidden, scroll, auto -->

    }
</style>
<script>
//   $(document).ready(function(){
//   $(".menu").click(function(){
//     // alert("hii");
//     $( "li" ).parent().removeClass("scrollbar2");
//   });
// }); 


$(document).ready(function(){
  $("#menu li ul").addClass("submenuhidden")
  });

  var ul = document.getElementById('menu');
 // console.log(ul)
    ul.onclick = function(event) {
        var target = getEventTarget(event);
        
        if($(target).parents('li').children('ul').attr("class")=="submenuhidden")
        {
          $(target).parents('li').children('ul').removeClass("submenuhidden")
          $(target).parents('li').children('ul').addClass("submenushow")
          
        }
        else{
          $(target).parents('li').children('ul').addClass("submenuhidden")
          $(target).parents('li').children('ul').removeClass("submenushow")
        }
        
        
        
    };
    function getEventTarget(e) {
        e = e || window.event;
        return e.target || e.srcElement; 
    }
//});
</script>
<script type="text/javascript">
     window.setInterval(function(){
                $.ajax({
                          //dataType : "json",
                          url: 'make_user_online',
                          success:function(data)
                          {
                         // alert('user is actice');
                          },
                          error: function (jqXHR, status, err) {
                             //alert('Local error callback');
                          }
                    }); 
}, 5000);
//           window.setInterval(function(){
//                 $.ajax({
//                           //dataType : "json",
//                           url: 'logout',
//                           success:function(data)
//                           {
//                          alert('Your session has been expired. Please Re-login');
//                           },
//                           error: function (jqXHR, status, err) {
//                              //alert('Local error callback');
//                           }
//                     }); 
// }, 30 * 60 * 1000);
</script>


