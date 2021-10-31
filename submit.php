<?php
	
	if(isset($_POST['submit'])){
		$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
		$date = date('H:i, jS F Y');

		$name = $_POST["name"];
		$email = $_POST["email"];
		$zipcode = $_POST["zipcode"];
		$household = $_POST["household"];
		$elec = $_POST["elec"];
		$gas = $_POST["gas"];
		$food = $_POST["selected"];
		$car_n = $_POST["car_n"];
		$car = $_POST["car"];
		$motor_s = $_POST["motor_s"];
		$motor = $_POST["motor"];
		$bus = $_POST["bus"];
		$waste = $_POST["checked"];

		//electricity
		$result_elec = $elec * 1.634 / $household * 12;
		//cooking gas
		$result_gas = $gas * 12.52 * 12;

		//food
		if($food == "Above Average"){
			$result_food = 1323;
		}
		else if($food == "Average"){
			$result_food = 882;
		}
		else if($food == "Below Average"){
			$result_food = 551;
		}
		else if($food == "Lacto-vegetarian"){
			$result_food = 220;
		}
		else if($food == "Vegan"){
			$result_food = 0;
		}

		//car
		$result_car = $car_n * $car * 5.27 * 12;

		//motor
		$result_m = 0;
		if($motor_s == "none"){
			$result_m = 0; 
		}
		else if($motor_s == "small"){
			$result_m = $motor * 0.1825 * 12;
		}
		else if($motor_s == "medium"){
			$result_m = $motor * 0.2224 * 12;
		}
		else if($motor_s == "large"){
			$result_m = $motor * 0.2918 * 12;
		}
		else if($motor_s == "average"){
			$result_m = $motor * 0.2499 * 12;
		}

		//bus
		$result_bus = $bus * 1.812 * 12;

		//waste (offset)

		$check_total = 0;
		foreach ($_POST['checked'] as $val) {
			$check_total += $val;
		}

		$total = 692 + $result_elec + $result_gas + $result_food + $result_car + $result_m + $result_bus - $check_total;
		$final_total = round($total);

		//elements to include in the text file
		$outputstring = $date."\t".$name."\t".$email."\t".$zipcode."\t".$household." people \t".$elec."kWh\t".$gas." gallon \t".$food." meat \t".$car_n." cars \t".$car."litres(car) \t".$motor_s." motor\t".$motor."km(motor) \t".$bus."km(bus) \t".$check_total."lbs(offset) \t".$final_total
					."lbs \n";

		//open file
		@ $fp = fopen("$DOCUMENT_ROOT/ST4/data.txt", 'ab');

		flock($fp, LOCK_EX);

		//message boxes to show if data is successfully added
		if (!$fp) { ?>
		  <script type="text/javascript">
		  	alert("Data not added.");
		  	window.location = "calculator.php";
		  </script>
		<?php
		} else{ ?>
		  <script type="text/javascript">
		  	alert("Data added.");
		  	window.location = "data.php";
		  </script>
		<?php
		}
	       
	      // write the file
		fwrite($fp, $outputstring, strlen($outputstring));
		flock($fp, LOCK_UN);
		fclose($fp);

    }    
?>