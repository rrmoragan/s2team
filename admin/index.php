<?php

include("../libs/admin_kernell.php");

$sys = new xSystem();

if( $_POST && isset($_POST['process']) ){

	switch ($_POST['process']) {
		case 'new_menu':
			$sys->data_menu();
			include("template/new.php");
			break;
		case 'new_save_menu':
			if( $sys->add_menu($_POST) ){
				$sys->data_menu();
				include("template/new.php");
			}else{
				$sys->data_menu();
				include("template/list.php");
			}
			break;
		case 'edit_menu':
			$sys->sql_data_menu_option($_POST);
			include("template/edit.php");
			break;
		case 'save_menu':
			$sys->menu_changes($_POST);
			$sys->data_menu();
			include("template/list.php");
			break;
		case 'del_menu':
			$sys->menu_delete($_POST);
			$sys->data_menu();
			include("template/list.php");
			break;

		default:
			$sys->data_menu();
			include("template/list.php");
		break;
	}

}else{
	$sys->data_menu();
	include("template/list.php");
}

?>