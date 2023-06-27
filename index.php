<?PHP


$sessionActiva = true; // false

if($sessionActiva){

	header('Location:sistema.php');

}else{

	header('Location:login.php');

}






?>