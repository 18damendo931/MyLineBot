<?php

function aclhelp_Extract($event) {
	//ユーザーのメッセ―ジがない時は終了
	if(empty($event->message->text)) return;

	//応答文の読み込み
	$text = "OPEN 対象テーブル\nEXTRACT RECORD(又はFIELDS フィールド名) TO 出力テーブル名 IF 抽出条件 PRESORT";
	
	reply($event, $text);
}

function aclhelp_Summarize($event) {
	//ユーザーのメッセ―ジがない時は終了
	if(empty($event->message->text)) return;

	//応答文の読み込み
	$text = "OPEN 対象テーブル\nSUMMARAIZE ON キーフィールド (SUBTOTAL 数値フィールド) OTHER 追加フィールド TO 出力テーブル名 IF 条件 PRESORT";
	
	reply($event, $text);
}

function aclhelp_Join($event) {
	//ユーザーのメッセ―ジがない時は終了
	if(empty($event->message->text)) return;

	//応答文の読み込み
	$text = "OPEN 主テーブル\nOPEN 副テーブル SECONDARY\nJOIN PKEY 主キー FIELDS 主フィールド SKEY 副キー WITH 副フィールド (キーワードなし|PRIMARY|SECONDARY|PRIMARY SECONDARY|UNMATCHED|MANY) TO 出力テーブル名 PRISORT SECSORT";
	
	reply($event, $text);
}
