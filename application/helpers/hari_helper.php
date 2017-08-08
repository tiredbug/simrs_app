<?php if(!defined("BASEPATH")) exit("No script direct access allowed.");

function hari_indo($hari)
{
	switch ($hari) {
		case 'Sunday':
			# code...
			return "Minggu";
			break;

		case "Monday":
			return "Senin";
			break;

		case"Tuesday":
			return"Selasa";
			break;

		case"Wednesday":
			return"Rabu";
			break;

		case"Thursday":
			return"Kamis";
			break;

		case"Friday":
			return"Jum'at";
			break;

		case"Saturday":
			return"Sabtu";
			break;
	}
}