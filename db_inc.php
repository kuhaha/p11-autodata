<?php
$conn = mysql_connect("localhost","root",""); //接続IDを変数$connに代入
mysql_select_db("p11autodata", $conn);       // データベースを指定
mysql_query('set names utf8', $conn);         //接続時の文字コードをutf8に設定