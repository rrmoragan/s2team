<?php

$menu_n = 0;
$menu_padre = '';

if( isset( $sys->data ) ){

	$menu_n = count( $sys->data );

	if( $menu_n <= 1 ){
		$menu_padre = 'raiz <input type="hidden" name="xmi_parent" value="1">';
	}else{
		foreach ($sys->data as $et => $r) {
			$menu_padre .= '<option value="'.$r['id'].'">'.$r['title'].'</option>';	
		}
		$menu_padre = '<select name="xmi_parent">'.$menu_padre.'</select>';
	}
}

?>

<div class="xw">
	<div class="xw_title">Agregar opciones de menú</div>
	<div class="xw_cont">
		<form method="post" action="index.php">
			<input type="hidden" name="process" value="new_save_menu">

			<div class="xw_data">
				<div class="xw_data_reg">
					<label>Menu Padre</label>
					<span><?php echo $menu_padre; ?></span>
				</div>
				<div class="xw_data_reg">
					<label>Url</label>
					<span><input type="text" name="xmi_url"></span>
				</div>
				<div class="xw_data_reg">
					<label>Nombre</label>
					<span><input type="text" name="xmi_tit"></span>
				</div>
				<div class="xw_data_reg">
					<label>Descripción</label>
					<span><textarea name="xmi_desc"></textarea></span>
				</div>
			</div>
			<div class="xw_button">
				<div class="xw_button_dat">
					<a href="index.php">Cancelar</a>
				</div>
				<div class="xw_button_dat" style="text-align:right">
					<input type="submit" value="Guardar">
				</div>
			</div>
		</form>
	</div>
</div>

<style type="text/css">
*{font-family: Verdana, Geneva, sans-serif;}
.xw {
    border: 1px solid #aaa;
    width: 75%;
    margin: 0 auto;
}
.xw .xw_title{
	background-color:  #418BCA;
	padding: 5px 20px;
	color: white;
}
.xw .xw_cont{
	padding: 20px;
}
.xw .xw_cont .xw_data{
	display: block;
}
.xw .xw_cont .xw_data .xw_data_reg{
	display: block;
	margin-bottom: 10px;
	border-bottom: 2px dotted #aaaaaa;
}
.xw .xw_cont .xw_data .xw_data_reg label {
    display: inline-block;
    width: 30%;
    text-align: right;
    padding-right: 2%;
}
.xw .xw_cont .xw_data .xw_data_reg span{
	display: inline-block;
	width: 65%;
	vertical-align: top;
}
.xw .xw_cont .xw_data .xw_data_reg span input,
.xw .xw_cont .xw_data .xw_data_reg span select,
.xw .xw_cont .xw_data .xw_data_reg span textarea{
	width: 100%;
}

.xw .xw_cont .xw_data .xw_data_reg span input{}
.xw .xw_cont .xw_data .xw_data_reg span select{}
.xw .xw_cont .xw_data .xw_data_reg span textarea{
	height: 200px;
}
.xw .xw_cont .xw_button{
	display: block;
}
.xw .xw_cont .xw_button .xw_button_dat{
	display: inline-block;
	width: 49%;
}
.xw .xw_cont .xw_button .xw_button_dat a{
	text-decoration: none;
	color: black;
    border: 1px solid #aaa;
    padding: 5px 20px;
    background-color:  #f5b7b1;
    font-size: 1em;
}
.xw .xw_cont .xw_button .xw_button_dat a:hover{}
.xw .xw_cont .xw_button .xw_button_dat input {
    border: 1px solid #aaa;
    padding: 5px 20px;
    background-color: #7Bd97C;
    font-size: 1em;
}
.xw .xw_cont .xw_button .xw_button_dat input:hover{}
</style>