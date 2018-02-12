<?php

//チャネルアクセストークン
define('TOKEN', '');

//ログファイルの削除
if (file_exists(DEBUG)) unlink(DEBUG);

//ログファイルへの追加
function debug($title, $text) {
	file_put_contents(DEBUG, '['.$title.']'."\n".$text."\n\n", FILE_APPEND);
}

//リプライとプッシュの共通処理
function post($url, $object) {
	//JSON形式への変換
	$json = json_encode($object);
	debug('output', $json);

	//送信準備
	$curl = curl_init('https://api.line.me/v2/bot/message/'.$url);
	curl_setopt($curl, CURLOPT_POST, TRUE);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
	curl_setopt($curl, CURLOPT_HTTPHEADER, [
		'Content-Type: application/json',
		'Authorization: Bearer '.TOKEN
	]);

	//送信実行
	$result = curl_exec($curl);
	debug('result', $result);

	//送信終了
	curl_close($curl);
}

//リプライ
function reply($event, $text) {
	//送信データ作成
	$object = [
		'replyToken'=>$event->replyToken,
		'messages'=>[['type'=>'text', 'text'=>$text]]
	];
	
	//送信
	post('reply', $object);
}

//画像用リプライ
function reply_image($event, $original, $preview) {
	$object=[
		'replyToken'=>$event->replyToken, 
		'messages'=>[[
			'type'=>'image', 
			'originalContentUrl'=>$original, 
			'previewImageUrl'=>$preview
		]]
	];
	post('reply', $object);
}

//プッシュ
function push($to, $text) {
	//送信データの作成
	$object = [
		'to'=>$to,
		'message'=>[['type'=>'text', 'text'=>$text]]
	];
	
	//送信
	post('push', $object);
}

//ロード
function load($file) {
	//JSON形式のファイル読み込み
	$json = file_get_contents($file);
	
	//JSONからPHPへの変換
	return json_decode($json);
}
