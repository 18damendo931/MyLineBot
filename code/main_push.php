<?php

//ログファイルの設定
define('DEBUG', 'push_debug.txt');

//共通ツールの読み込み
require_once('tool.php');

//ボット実行
push('', 'push機能のテストです。');
