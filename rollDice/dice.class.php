<?php

Class dice{

	public function getRolls(){

		if(!empty($_POST)){
			$rollsDice = array();
			foreach ($_POST as $key => $value){
				foreach($_POST as $key => $value){
					if($value ==! 0){
						$rollsDice[$key] = $value;
					}
				}
			}

			$temp = array();
			foreach ($rollsDice as $key => $value) {
				$arrayRandom = array();
				for ($i=0; $i < $value; $i++) { 
					$randomDice = rand(1,$key);
					array_push($arrayRandom, $randomDice);
					array_push($temp, $randomDice);
				}
				$implodeRandom = implode(",",$arrayRandom);
				$resultat .=  $key. "d" .$value. "[".$implodeRandom."] ";
			}

		$resultats = substr_replace($resultat, "=" , -1);
		$sum = array_sum($temp);
		$resulatFinal = $resultat. " = " .$sum;
		}

		return $resulatFinal;	


	}


}