<?php

function bot($event) {
	//ユーザーのメッセ―ジがない時は終了
	if(empty($event->message->text)) return;

	//応答文の読み込み
	$text = load('hello/hello.txt');
	
	reply($event, $text[rand(0, count($text)-1)]);
}
