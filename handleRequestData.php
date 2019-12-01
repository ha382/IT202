<?php
	echo "<pre>" . var_export($_GET, true) . "</pre>";
	if(isset($_GET['name'])){
		echo "<br>Hello, " . $_GET['name'] . "<br>";
	}
	if(isset($_GET['n1'])){
		$n1 = $_GET['n1'];
	}
	if(isset($_GET['n2'])){
		$n2 = $_GET['n2'];
	}
	if(isset($n1) && isset($n2)){
		if(is_numeric($n1) && is_numeric($n2)){
			$n1 = (int)$n1;
			$n2 = (int)$n2;
			echo "Sum: " . ($n1 + $n2);
		}
		else{
			echo "<br> Values aren't numbers";
		}
		echo "<br>";
		echo "Concat: " . ($n1 . $n2);
	}
	if(isset($_GET['parameter'])){
		echo "<div> " . $_GET['parameter'] . "</div>";
	}
?>