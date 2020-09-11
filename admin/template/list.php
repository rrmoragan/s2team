<?php

$table = '';
$table_h = null;
$table_header = '';

if( isset($sys->data) ){

	$nr = 0;
	foreach ($sys->data as $et => $r) {
		$nr++;
		$table_reg = '';
		foreach ($r as $etr => $rr) {
			if( $etr=='id_parent' || $etr=='fing' || $etr=='activ' ){ continue; }

			$table_h[ $etr ] = 1;
			$table_reg .= '<div class="table_cell">'.$rr.'</div>';
		}

		if( $r['id']>1 ){
			$table_h[ 'action' ] = 2;
			$table_reg .= '<div class="table_cell sbutton">'.'
				<div class="bar">
				<div class="button"><form method="post" action="index.php">
					<input type="hidden" name="process" value="edit_menu">
					<input type="hidden" name="xmi_id" value="'.$r['id'].'">
					<input type="submit" value="Editar">
				</form></div>
				'.'
				<div class="button button_del"><form method="post" action="index.php">
					<input type="hidden" name="process" value="del_menu">
					<input type="hidden" name="xmi_id" value="'.$r['id'].'">
					<input type="submit" value="Eliminar">
				</form></div>
				'.'</div></div>';
		}

		$table_reg = '<div class="table_reg '.( (($nr%2)==0)?'table_color_b':'' ).'">'.$table_reg.'</div>';
		$table .= $table_reg;
	}

	foreach ($table_h as $et => $r) {
		$table_header .= '<div class="table_cell">'.$et.'</div>';
	}
	$table_header = '<div class="table_header">'.$table_header.'</div>';
}

?>

<div class="xwl">
	<div class="xwl_title">
		Menu
		<div class="fright sbutton" style="width: auto;">
			<form method="post" action="index.php">
				<input type="hidden" name="process" value="new_menu">
				<input type="submit" value="Nuevo">
			</form>
		</div>
	</div>
	<div class="xwl_cont">
		<div class="table">
			<?php echo $table_header.$table; ?>
		</div>
	</div>
</div>

<?php

//pre( $sys );


?>
<style type="text/css">
	*{font-family: Verdana, Geneva, sans-serif;}

.xwl{
	width: 90%;
	margin: 0 auto;
	border: 1px solid #aaa;
}
.xwl .xwl_title{
	display: block;
	overflow: hidden;
	background-color: #418BCA;
	padding: 5px 15px;
	color: white;
}
.xwl .xwl_cont{}

.fright{float: right;}

.table{
	display: table;
	width: 100%;
	margin:0 auto;
}
.table .table_cont{}
.table .table_header{
	display: table-row;
}
.table .table_header .table_cell{
	background-color: #cccccc;
	font-weight: bold;
	font-size: 0.85em;
	padding-left: 10px;
	padding-top: 5px;
	padding-bottom: 5px;
}
.table .table_reg{
	display: table-row;
	width: 100%;
}
.table .table_cell{
	display: table-cell;
	padding: 2px;
}
.table .table_color_b{
	background-color: #eeeeee;
}
.sbutton{width: 210px;}
.sbutton .button{display: inline-block;}
.sbutton form{
	margin: 0;
}
.sbutton input{
	border: 1px solid #aaa;
    padding: 5px 20px;
    background-color: #5BB95C;
    font-size: 1em;
    cursor: pointer;
}
.sbutton input:hover{background-color: #7Bd97C;}
.button_del input{background-color: #e59791;}
.button_del input:hover{background-color: #f5b7b1;}
</style>

