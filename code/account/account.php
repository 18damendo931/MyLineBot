<?php

function responseAccount($event) {

	$res = "";
	$text = $event->message->text;
	
	//ユーザーのメッセ―ジがない時は終了
	if(empty($text)) return "";

	//資産か確認
	$res = checkAssets($text);
	if($res == "") {
		//負債か確認
		$res = checkLiabilities($text);
		if($res == "") {
			//純資産か確認
			$res = checkNetassets($text);
			if($res == "") {
				//収益か確認
				$res = checkIncome($text);
				if($res == "") {
					//費用か確認
					$res = checkExpenses($text);
					if($res == "") {
						//その他の科目か確認
						$res = checkOthers($text);
					}
				}
			}
		}
	}
	
	//通知
	if($res != "") {
		reply($event, $res);
	}
	
	return $res;
}

function checkAssets($text) {

	$res = "";
	$accountnames = load('account/assets.txt');
	
	foreach($accountnames as $name) {
		if($name == $text) {
			$res = "資産(BS科目)";
			break;
		}
	}
	
	return $res;
}

function checkLiabilities($text) {

	$res = "";
	$accountnames = load('account/liabilities.txt');
	
	foreach($accountnames as $name) {
		if($name == $text) {
			$res = "負債(BS科目)";
			break;
		}
	}
	
	return $res;
}

function checkNetassets($text) {

	$res = "";
	$accountnames = load('account/netassets.txt');
	
	foreach($accountnames as $name) {
		if($name == $text) {
			$res = "純資産(BS科目)";
			break;
		}
	}
	
	return $res;
}

function checkIncome($text) {

	$res = "";
	$accountnames = load('account/income.txt');
	
	foreach($accountnames as $name) {
		if($name == $text) {
			$res = "収益(PL科目)";
			break;
		}
	}
	
	return $res;
}

function checkExpenses($text) {

	$res = "";
	$accountnames = load('account/expenses.txt');
	
	foreach($accountnames as $name) {
		if($name == $text) {
			$res = "費用(PL科目)";
			break;
		}
	}
	
	return $res;
}

function checkOthers($text) {

	$res = "";
	$accountnames = load('account/others.txt');
	
	foreach($accountnames as $name) {
		if($name == $text) {
			$res = "その他";
			break;
		}
	}
	
	return $res;
}