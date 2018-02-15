<?
require_once ('src/GoogleTranslate.php');
use \Statickidz\GoogleTranslate;

$input = file_get_contents('input.json');
$json = json_decode($input); 
$trans = new GoogleTranslate();

foreach($json as $clave => $valor) {
	$source = 'en';
	$text = $valor->en;	
	foreach ($valor as $lang => $target){
		if ($lang != "en"){
			$json->{$clave}->$lang = $trans->translate($source, $lang, $text);
			echo $text . " => ". $json->{$clave}->$lang.PHP_EOL;
		}
	}
}

$ar = fopen('result.json',"w");  
fwrite($ar,json_encode($json));
fclose($ar);
