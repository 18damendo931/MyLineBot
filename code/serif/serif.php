<?php

function bot($event) {
	//ユーザーのメッセ―ジがない時は終了
	if(empty($event->message->text)) return;

	//応答文の読み込み
	if (rand(0, 100) > 80) {
		$text = load('serif/dere.txt');
	} else {
		$text = load('serif/thun.txt');
	}
	
	reply($event, $text[rand(0, count($text)-1)]);
}
