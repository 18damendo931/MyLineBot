<?php

//Botプログラムの読み込み
require_once('serif/serif.php');
require_once('account/account.php');
require_once('chocolate/chocolate.php');

//ログファイルの設定
define('DEBUG', 'debug.txt');

//共通ツールの読み込み
require_once('tool.php');

//リクエストの取得
$input = file_get_contents('php://input');

//ログファイルへの出力
debug('input', $input);

//リクエストが空でないことの確認
if(!empty($input)) {
	//イベントの取得
	$events = json_decode($input)->events;
	
	//各イベントに対するBotプログラムの実行
	foreach($events as $event) {
		$text = $event->message->text;
		if($text == "チョコちょうだい") {
			searchChocolate($event);
		}
		else
		{
			$res = responseAccount($event);
			if($res == "") {
				bot($event);
			}
		}
	}
}
