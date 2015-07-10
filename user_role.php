<?php
include 'header.php';
include './includes/config_inc.php';

?>
    <body>
<?php
    include './menu_sider_nav.php';

?>
        <div class="container-fluid">
            <div class="row-fluid">
<?php
    include './menu_sider_left_nav.php';

?>
                <!--/span-->
                <div class="span9" id="content">

                 <div id="update"></div>
<form method="post" action="javascript:void(0)" role="form">
    <table class="table table-bordered table-hover table-condensed"><tr><th>id</th><th>Role name</th><th>Action</th></tr><tr>
        <td>
            <input class="form-control" type="text" name="rol_id" id="rol_id" placeholder="id" data-toggle="tooltip"  data-original-title="id" required="required" />
        </td>
        <td>
            <input class="form-control" type="text" name="rol_name" id="rol_name" placeholder="Role name" data-toggle="tooltip"  data-original-title="Role name" required="required" />
        </td>
        <td>
            <button onclick="insertData()" class="btn btn-success btn-block-level">Submit</button></td></tr></table></form>

<script type="text/javascript">
    function insertData() {
        jQuery.ajax({
            url: 'ajax/ajax.php',
            type: 'POST',
            data: jQuery( "form" ).serialize(),
            beforeSend: function(b) {jQuery('#update').html('<i class="glyphicon glyphicon-refresh"></i>')},
            error: function(e) {alert('ERROR: '+e)},
            success: function(s) {jQuery('#update').html(s);}
        });
    }
    
    function deleterow(pk) {
        var answer=confirm("Are you sure you want to Delete");
        if ( answer==true ) {
            jQuery.ajax({
                url: 'ajax/ajax.php',
                type: 'POST',
                data: 'pk='+encodeURIComponent(pk)+'&delete=true',
                beforeSend: function(b) {jQuery('#update').html('<i class="glyphicon glyphicon-refresh"></i>')},
                error: function(e) {alert('ERROR: '+e)},                
                success: function(s) {jQuery('#update').html(s);}
            });
        } else {
            return false;
        }
    }
    jQuery(document).ready(function() {
        $('.edit').editable({
            validate: function(value) {
              if($.trim(value) == '') 
                return 'This field is required';
            },
            success: function(data) {
                jQuery('#update').html(data); 
            }
        });
        jQuery('input').each(function() {
            jQuery( this ).tooltip();
        });
        jQuery('button.delete').each(function() {
            jQuery(this).tooltip();
        });
    });
</script>

<?php


 

if(!isset($_GET['page'])) {
	 $_GET['page'] = 1; }

	 if(!isset($_GET['ipp'])) { $_GET['ipp'] = 5; }
require_once(dirname(__FILE__).'/includes/paginator.class.php');

	$pages = new Paginator;
	$fetchRoom = $mysqli->query("SELECT rol_id from usr_roles");


	if($fetchRoom->num_rows > 0) {
	 $pages->items_total = $fetchRoom->num_rows; 
	echo '<span class="pull-right">'.$pages->display_items_per_page().'</span>
	<div class="clearfix"></div>'; 
	} else {
	 $pages->items_total = 1; 
	}
	$pages->mid_range = 9; $pages->paginate();

		$fetchCol = $mysqli->query("SELECT rol_id, rol_id, rol_name from usr_roles $pages->limit");
		if($fetchCol->num_rows > 0){
		 echo "<table class=\"table table-bordered table-hover table-condensed\">
		<tr><th>rol_id</th><th>rol_name</th><th>Action</th></tr>";
		while($row = $fetchCol->fetch_assoc()) {
	 echo "<tr>
		<td><span class=\"edit\" data-type=\"text\" data-pk=\"".$row['rol_id']."\" data-name=\"rol_id\" data-placement=\"top\" data-send=\"always\" data-url=\"ajax/ajax.php\" data-original-title=\"Update\">".$row["rol_id"]."</span>
		</td>
		<td><span class=\"edit\" data-type=\"text\" data-pk=\"".$row['rol_id']."\" data-name=\"rol_name\" data-placement=\"top\" data-send=\"always\" data-url=\"ajax/ajax.php\" data-original-title=\"Update\">".$row["rol_name"]."</span>
		</td>
		<td><button data-toggle=\"tooltip\" data-original-title=\"Delete Row\" type=\"button\" class=\"btn btn-danger delete\" onclick='deleterow(\"".$row['rol_id']."\")' ><i class=\" glyphicon glyphicon-trash\"></i></button>
	</td></tr>"; 
	}
		echo "</table>"; 
		} else {
		 echo "<div class=\"alert alert-danger alert-block\">There is no data available.</div>"; 
		}

	echo "<section class='row text-center'><ul class='pagination'>".$pages->display_pages()."</ul></section>";
	

?>
              
                </div>
            </div>
            <hr>
        <!--/.fluid-container-->

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
   

        <script>
        $(function() {
            
        });
        </script>
<?php
include 'footer.php';

?>