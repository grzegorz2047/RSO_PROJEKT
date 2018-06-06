<?php
		$service_url = 'https://glosbe.com/gapi/translate?from=eng&dest=pl&format=json&phrase='.'hello'.'&pretty=true';
		print "Link: ".$service_url;
		$json = json_decode(file_get_contents($service_url), true);
		foreach($json['tuc'] as $item) {
			print "Znaczenie: ";
			print $item['phrase']['text'];
			print '<br>';
		}
?>