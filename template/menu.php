<div id="menu"><?php echo $sys->data; ?></div>

<style type="text/css">
#menu {
    border: 1px solid #aaa;
    display: block;
    background-color: #eee;
    padding: 5px;
}
#menu ul{
	list-style-type: none;
	padding: 0;
	margin: 0;
}
#menu ul li{
	display: inline-block;
}
#menu ul li a{
	border:1px solid #aaaaaa;
	display: block;
	padding: 5px 15px;
	text-decoration: none;
	color: black;
	background-color: #5BB95C;
}
#menu ul li a:hover{
	background-color: #8Be98C;	
}
#menu ul ul{
	display: none;
	position: absolute;
	border: 1px solid #aaaaaa;
	width: 200px;
}
#menu ul ul ul {
    margin-left: 150px;
    margin-top: -8px;
}
#menu ul ul li{
	display: block;
}
#menu ul li:hover ul{display: block;}
#menu ul li:hover ul ul{display: none;}
#menu ul ul li:hover ul{display: block;}
#menu ul ul li:hover ul ul{display: none;}
#menu ul ul ul li:hover ul{display: block;}
#menu ul ul ul li:hover ul ul{display: none;}
#menu ul ul ul ul li:hover ul{display: block;}
#menu ul ul ul ul li:hover ul ul{display: none;}
#menu ul ul ul ul ul li:hover ul{display: block;}
#menu ul ul ul ul ul li:hover ul ul{display: none;}
#menu ul ul ul ul ul ul li:hover ul{display: block;}
#menu ul ul ul ul ul ul li:hover ul ul{display: none;}
</style>
