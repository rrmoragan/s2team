<?php

include('menu.php');

?>
<div class="messages"><?php echo $sys->message; ?></div>

<style type="text/css">
.messages {
    border: 1px solid #aaa;
    width: 80%;
    margin: 5% auto;
    text-align: center;
}
.messages div{
	display: none;
	padding: 20px;
}
</style>

<script type="text/javascript">

	var menu = document.getElementById('menu');
	var tag_a = menu.getElementsByTagName('a');

	var el = null;

	for(var i=0; i<tag_a.length; i++){
		tag_a[ i ].addEventListener("click",function(e){
			e.preventDefault();

			el = this;
			var id = el.attributes.dat.value;

			messages_hidden();

			document.getElementById(id).style.display = 'block';
		});
	}

	function messages_hidden(){
		for (var i=0; i<tag_a.length; i++) {
			id = tag_a[i].attributes.dat.value;
			document.getElementById(id).style.display = 'none';
		}
	}






</script>