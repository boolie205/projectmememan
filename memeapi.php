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

	if(($memes = getMemes())) {
		if($memes->success) {
			foreach($memes->data->memes as $meme) {
				$validMemeIds[] = $meme->id;
			}
		}
	}

	if($_GET && in_array(key($_GET), $validMemeIds) && isset($_GET["top_text"]) && isset($_GET["bottom_text"])) {
		echo json_encode(array(makeMeme(key($_GET), $_GET["top_text"], $_GET["bottom_text"])), JSON_UNESCAPED_SLASHES);
	} else {
		echo json_encode(getMemes()->data->memes, JSON_UNESCAPED_SLASHES);
	}
?>