<?php

function searchChocolate($event) {
	if (rand(0, 100) > 10) {
		//Googleカスタム検索エンジンのID、キーを設定
		$cx = "";
		$key = "";
		
		//検索キーワードに「高級チョコ」を設定
		$keyword = "高級チョコ";

		//Googleカスタム検索用のURL作成(画像検索)
		$url='https://www.googleapis.com/customsearch/v1';
		$url.='?cx='.$cx;
		$url.='&key='.$key;
		$url.='&q='.urlencode($keyword);
		$url.='&searchType=image';
		debug('url', $url);

		//検索実施
		$items=load($url)->items;

		//検索結果をランダムに表示
		$item=$items[rand(0, count($items)-1)];
		
		//オリジナル画像URL
		$original=$item->link;
		$original=preg_replace('/^http:/', 'https:', $original);	//httpsに無理やり変更
		debug('original', $original);

		//プレビュー画像URL
		$preview=$item->image->thumbnailLink;
		$preview=preg_replace('/^http:/', 'https:', $preview);		//httpsに無理やり変更
		debug('preview', $preview);
		
		//画像投稿
		reply_image($event, $original, $preview);
	} else {
		reply($event, "塩でも舐めてろ！");
	}
}
