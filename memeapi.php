<!DOCTYPE html>
<html>
<head>
	<title>Meme API Test</title>
	<meta charset="utf-8">
</head>
<body>

<?php
	function getMemes() {
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.imgflip.com/get_memes");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($rescode == 200) {
        	return json_decode($response);
        } else {
        	return false;
        }
	}

	function makeMeme($templateId, $topText, $bottomText) {
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.imgflip.com/caption_image");
        curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "template_id=".$templateId."&username=Milice&password=mch73h52&text0=".$topText."&text1=".$bottomText);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($rescode == 200) {
        	$data = json_decode($response);
        	if(!$data->success) {
        		return false;
        	}

        	return $data->data->url;
        } else {
        	return false;
        }
	}

	$validMemesIds = array();

	echo "<select id=\"meme\">";
	echo "<option value=\"0\">Choose a meme</option>";
	if(($memes = getMemes())) {
		if($memes->success) {
			foreach($memes->data->memes as $meme) {
				$validMemeIds[] = $meme->id;
				echo "<option value=\"".$meme->id."\">".$meme->name."</option>";
			}
		}
	}

	echo "</select><br>";
	echo "<input type=\"text\" placeholder=\"Top Text\" id=\"tt\"><br>";
	echo "<input type=\"text\" placeholder=\"Bottom Text\" id=\"bt\"><br>";
	echo "<button onclick=\"window.location = '?' + document.getElementById('meme').value + '&top_text=' + document.getElementById('tt').value + '&bottom_text=' + document.getElementById('bt').value;\">Make a meme</button><br><br>";
	// Who neeeds error handling anyway

	if($_GET && in_array(key($_GET), $validMemeIds) && isset($_GET["top_text"]) && isset($_GET["bottom_text"])) {
		echo "<img src=\"".makeMeme(key($_GET), $_GET["top_text"], $_GET["bottom_text"])."\">";
	}
?>

</body>
</html>