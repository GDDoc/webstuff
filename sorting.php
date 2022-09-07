<!DOCTYPE html>
<html>
<head>
	<title>Allokation: topic Prio</title>
	<link rel="icon" 
		type="image/png" 
		href="../../includes/image/icon_16x16.ico" />
	  	<meta charset="utf-8"/>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="../../includes/style_dcc.css" type="text/css" />
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.css"> -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>

<header>
			<?php 
			include '../includes/owheader.html'; 
			?>
		</header>
			<div id="block">

			<?php 
			include '../includes/menu_allokation.html'; 
			?>

			</div>

<?php
include("../includes/dbconnect_fpscript.php");

$q = "SELECT prio, topic_name, call_doc FROM allokation.prio p
		left join playground_schroeder.topic_id ti on p.topic_id = ti.topic_id
		order by prio
		";
$result = mysqli_query($con,$q);
if(mysqli_num_rows($result)>0)
{
	?>
	<table class="table">
		<tr>
			<th>topic_name</th>
			<th>call_doc</th>
			
		</tr>
		<tbody class="sortable">
	
		<?php
		while($row=mysqli_fetch_object($result))
		{
			?>
			<tr id="<?php echo $row->prio;?>">
				<td><?php echo $row->topic_name;?></td>
				<td><?php echo $row->call_doc;?></td>
				
			</tr>
			<?php
		}
		?>
	</tbody>
	</table>
	<?php
}
?>



<script type="text/javascript">
	$(function(){
		$('.sortable').sortable({
			stop:function()
			{
				var ids = '';
				$('.sortable tr').each(function(){
					id = $(this).attr('id');
					if(ids=='')
					{
						ids = id;
					}
					else
					{
						ids = ids+','+id;
					}
				})
				$.ajax({
					url:'save_order.php',
					data:'ids='+ids,
					type:'post',
					success:function()
					{
						alert('Order saved successfully');
					}
				})
			}
		});
	});
</script>
</body>
</html>
