iniciando sistema
<?php

/**
 * 
 */

include('admin_kernell.php');

class xSystem_fron extends xSystem {
	public $data = null;
	public $message = null;
	
	function __construct($argument=null) {}

	public function menu(){
		$this->data = null;

		// obteniendo datos
		$this->data_menu();

		// generando links
		$this->menu_html();

		$this->menu_struct();

		$this->data = $this->data[1]['html_link'];
		
		return true;
	}

	public function menu_html(){
		foreach ($this->data as $et => $r) {
			$this->data[ $et ]['html_link'] = '';

			if( $r['id'] == 1 ){ continue; }

			$this->data[ $et ]['html_link'] = '<li><a href="'.$r['url'].'" title="'.$r['title'].'" dat="'.$r['url'].'">'.$r['title'].'</a>';

			$this->message .= '<div id="'.$r['url'].'">'.$r['description'].'</div>';
		}
	}

	private function menu_struct(){
		while ( count($this->data)>1 ) {
			$this->menu_struct_max();
		}

		return true;
	}
	private function menu_struct_max(){
		$max = 0;
		foreach ($this->data as $et => $r) {
			if( $r['id_parent'] > $max ){
				$max = $r['id_parent'];
			}
		}

		$s = '';
		foreach ($this->data as $et => $r) {
			if( $r['id_parent'] == $max ){
				//tt("[ ".$r['id']." ]");
				$s .= "\n\t\t".$r['html_link'].'</li>';
				unset( $this->data[ $et ] );
			}
		}

		$this->data[ $max ]['html_link'] .= '<ul>'.$s.'</ul>';

		return true;
	}

}


?>