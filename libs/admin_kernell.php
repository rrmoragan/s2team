<?php

class dbase{
	private $host = 'localhost';
	private $user = 'examen';
	private $dbase = 'examen';
	private $pass = 'z4m-Kme-TR8-GiE';

	public function insert($s=''){
		if($s==''){ return null; }

		$mbd = new PDO( 
			'mysql:host='.$this->host.';dbname='.$this->dbase, 
			$this->user, 
			$this->pass
		);

		$query = $mbd->prepare( $s );

		try{
			$mbd->beginTransaction();

			$query->execute();
			$mbd->commit();

			return $mbd->lastInsertId();

		} catch ( PDOException $e ){
			print "error: " . $e->getMessage();
		    
		    return null;
		}

		return null;
	}
	public function select($s=''){
		if($s==''){ return null; }

		$mbd = new PDO( 
			'mysql:host='.$this->host.';dbname='.$this->dbase, 
			$this->user, 
			$this->pass
		);

		$query = $mbd->prepare( $s );

		try{

			$mbd->beginTransaction();
			$query->execute();
			$res = $query->fetchAll( PDO::FETCH_ASSOC );
			$mbd->commit();

			return $res;

		} catch ( PDOException $e ){
			print "error: " . $e->getMessage();
		    
		    return null;
		}

		return null;
	}
	public function update($s=''){
		if($s==''){ return null; }

		$mbd = new PDO( 
			'mysql:host='.$this->host.';dbname='.$this->dbase, 
			$this->user, 
			$this->pass
		);
		$query = $mbd->prepare( $s );

		try{
			$mbd->beginTransaction();
			$query->execute();
			$mbd->commit();

			return true;

		} catch ( PDOException $e ){
			print "error: " . $e->getMessage();
		    
		    return false;
		}

		return false;
	}
}

class xSystem{

	public $data = null;
	public $error = null;
	public $message = null;

	/* obtiene los datos del menu */
	public function data_menu(){
		$this->error = null;
		$this->message = '';

		$this->data = $this->sql_get_data_menu();

		if( $this->data != null ){ return true; }
		return false;
	}
	/* agrega una opcion al menu */
	public function add_menu($d=null){
		$this->data = null;
		if($d==null){
			$this->error[] = 'sin datos para agregar';
			return false;
		}

		/* validando datos */
		$d = $this->valid_add_menu($d);
		if(!$d){ return false; }

		/* checa si existe la url */
		if( !$this->is_url($d['xmi_url']) ){

			/* en caso de que no exista la url agrega el registro */
			$id = $this->sql_menu_insert($d);
			if( $id>0 ){ return true; }
		}

		return false;
	}
	/* validando existencia de datos */
	private function valid_add_menu($d=null){
		if($d==null){
			$this->error[] = 'sin datos para agregar';
			return null;
		}

		/* validando existencia de datos */

			$error = 0;
			if( !isset($d['xmi_parent']) ){ $error++; }
			if( !isset($d['xmi_tit']) ){ $error++; }
			if( !isset($d['xmi_desc']) ){ $error++; }
			if( !isset($d['xmi_url']) ){ $error++; }

			if($error>0){
				$this->error[] = 'faltan datos';
				return null;
			}

			$d['xmi_parent'] 	= trim( $d['xmi_parent'] );
			$d['xmi_tit'] 		= trim( $d['xmi_tit'] );
			$d['xmi_desc'] 		= trim( $d['xmi_desc'] );
			$d['xmi_url'] 		= trim( $d['xmi_url'] );

			if( $d['xmi_parent']=='' ){ $error++; }
			if( $d['xmi_tit']=='' ){ $error++; }
			if( $d['xmi_desc']=='' ){ $error++; }
			if( $d['xmi_url']=='' ){ $error++; }

			if($error>0){
				$this->error[] = 'hay registros vacios';
				return null;
			}

		/* validando caracteres raros en los registros */

			foreach ($d as $et => $r) {
				$d[ $et ] = htmlentities($r, ENT_QUOTES, "UTF-8");
			}

		return $d;
	}
	/* validando si ya existe la url */
	public function is_url($s=''){

		if($s==''){
			$this->error[] = "url, faltan datos";
			return false;
		}

		$s = "SELECT * FROM cntl_menu WHERE url like '$s' and activ = 1";
		$a = query($s);

		if( $a==null ){
			$this->error[] = 'url, no existe';
			return false;
		}

		if( count($a)>1 ){
			$this->error[] = 'base de datos corrupta';
			return false;
		}

		return true;
	}


	/* CAMBIOS */

	public function menu_changes($d=null){
		if($d==null){ return false; }

		/* validando la existencia de los datos */
		$dd = $this->valid_edit_menu($d);

		if($dd==null){ return false; }

		if($dd['xmi_id']==1){ return false; }

		/* validando url */
		if( !$this->valid_edit_url($dd['xmi_url'],$dd['xmi_id']) ){
			return false;			
		}

		$this->sql_menu_modif($dd['xmi_id'],'id_parent',$dd['xmi_parent']);
		$this->sql_menu_modif($dd['xmi_id'],'url',$dd['xmi_url']);
		$this->sql_menu_modif($dd['xmi_id'],'title',$dd['xmi_tit']);
		$this->sql_menu_modif($dd['xmi_id'],'description',$dd['xmi_desc']);

		return false;
	}
	/* validando existencia de datos */
	private function valid_edit_menu($d=null){
		if($d==null){
			return null;
		}

		/* validando existencia de datos */

			$error = 0;
			if( !isset($d['xmi_id']) ){ $error++; }
			if( !isset($d['xmi_parent']) ){ $error++; }
			if( !isset($d['xmi_url']) ){ $error++; }
			if( !isset($d['xmi_tit']) ){ $error++; }
			if( !isset($d['xmi_desc']) ){ $error++; }

			if($error>0){
				return null;
			}

			$d['xmi_id'] 	= trim( $d['xmi_id'] );
			$d['xmi_parent'] 		= trim( $d['xmi_parent'] );
			$d['xmi_url'] 		= trim( $d['xmi_url'] );
			$d['xmi_tit'] 		= trim( $d['xmi_tit'] );
			$d['xmi_desc'] 		= trim( $d['xmi_desc'] );

			if( $d['xmi_id']=='' ){ $error++; }
			if( $d['xmi_parent']=='' ){ $error++; }
			if( $d['xmi_url']=='' ){ $error++; }
			if( $d['xmi_tit']=='' ){ $error++; }
			if( $d['xmi_desc']=='' ){ $error++; }

			if($error>0){
				return null;
			}

		/* validando caracteres raros en los registros */

			foreach ($d as $et => $r) {
				$d[ $et ] = htmlentities($r, ENT_QUOTES, "UTF-8");
			}

		return $d;
	}
	/* validando la existencia de la url editada */
	private function valid_edit_url($s='',$id=0){
		if($s==''){ return 0; }
		if($id==0){ return 0; }

		$s = "SELECT * FROM cntl_menu WHERE url like '$s' and activ = 1";
		$a = query($s);

		/* no existe la url */
		if( $a==null ){ return true; }
		
		/* si existe la url */
		/* y es del mismo registro, no hubo cambios */
		if( $id == $a[0]['id'] ){
			return true;
		}

		/* si existe la url */
		/* y es de otro registro */
		return false;
	}

	/* BAJAS */

	/* NOTA
		falta borrar todas opciones hijas de la que se desea borrar ó que las hijas pasen a ser dependientes del padre del que se desea borrar, es decir de un nivel superior al que se desea borrar
	*/

	/* desabilita una opcion del menu */
	public function menu_delete($d=null){
		if($d==null){ return false; }

		if( !isset($d['xmi_id']) ){
			return false;
		}

		if($d['xmi_id']==1){ return false; }

		$this->sql_data_menu_option( array('xmi_id'=>$d['xmi_id']) );
		if(!$this->data){ return false; }

		$this->sql_menu_modif($d['xmi_id'],'url', '__'.$this->data['url']);
		$this->sql_menu_modif($d['xmi_id'],'activ', 0);

		return true;;
	}


	/* SQL */
	/* modificando registros del menu */
	private function sql_menu_modif($id=0,$campo='',$val=null){
		if($id==0){ return false; }
		if($campo==''){ return false; }

		$s = "update cntl_menu set $campo = '$val' where id = $id";
		
		$db = new dbase();
		$a = $db->update( $s );
		if( !$a ){
			return false;
		}

		return true;
	}
	/* guarda la nueva opcion del menu en base de datos */
	private function sql_menu_insert($d=null){
		if($d==null){
			return false;
		}

		$s = "INSERT INTO cntl_menu (id, url, title, id_parent, description, fing, activ) VALUES ".
			"(null, '".$d['xmi_url']."', '".$d['xmi_tit']."', ".$d['xmi_parent'].", '".$d['xmi_desc']."', ".time().", '1');";
		$db = new dbase();
		$id = $db->insert( $s );

		if( $id ){ return $id; }
		return 0;
	}

	public function sql_data_menu_option($d=null){
		if( $d==null ){
			return false;
		}

		$this->data = null;

		if( isset($d['xmi_id']) ){
			$s = "SELECT * from cntl_menu where id = ".$d['xmi_id']." and activ = 1";

			$db = new dbase();
			$a = $db->select( $s );
			if( $a==null ){
				return false;
			}

			$this->data = $a[0];			

			return true;
		}

		return false;
	}

	/* obtiene los datos del menu desde base de datos */
	private function sql_get_data_menu(){
		$s = "SELECT * from cntl_menu where activ=1 order by id ASC;";

		$db = new dbase();
		$a = $db->select( $s );
		if( $a==null ){ return null; }

		$b = null;
		foreach ($a as $et => $r) {
			if( $r['id'] == 1 ){ $r['id_parent'] = ''; }
			$r['parent'] = '';
			$b[ $r['id'] ] = $r;
		}

		foreach ($b as $et => $r) {
			if( $et==1 ){ continue; }
			
			$b[ $et ]['parent'] = 'raiz';
			if( isset($b[ $r['id_parent'] ]['title']) ){
				$b[ $et ]['parent'] = $b[ $r['id_parent'] ]['title'];
			}
		}

		return $b;
	}
}

?>