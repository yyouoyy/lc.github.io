<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>検索結果</title>
    <link rel="stylesheet" href="css/sanitize.css">
   <link rel="stylesheet" href="css/lc_1.css">
   <div class="nav">
        <ul>
            
    
        <li class=”menu”><a href=index.html>Home</a></li>
        <li><a href=”#”>メイク</a></li>
        <li><a href=”#”>スキンケア</a></li>
        <li><a href="#">カレンダー</a></li>

        <li class ="sns"><a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </li>
        </ul>
   

   </div>
</head>
<body>

<?php


        $agent ="Mozilla/5.0 (Macintosh; Intel Mac OS X 11_1_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36";
        $url = 'https://fortune-girl.com/search?q=限定　　'.$_POST["cosmesearch"];
        // .$_POST["jobsearch"]
        $conn = curl_init(); // cURLセッションの初期化
        curl_setopt($conn, CURLOPT_USERAGENT, $agent);
        curl_setopt($conn, CURLOPT_URL, $url); //　取得するURLを指定
        curl_setopt($conn, CURLOPT_RETURNTRANSFER, true); // 実行結果を文字列で返す。
        $res =  curl_exec($conn);
        curl_close($conn); 
        // var_dump($res);
    
      
        
//画像
$pattern ='/<img.*?(.*?)>/';
preg_match_all($pattern,$res,$img);
// echo $img[0][6];

        
//見出し
  $pattern ='@<h4.*?("list-group-item-heading")>(.*?)</h4>@s';
  preg_match_all($pattern,$res,$title);

//本文
$pattern ='@<div.*?("hidden-xs")>(.*?)</div>@';
preg_match_all($pattern,$res,$sentence);

//発売日
$pattern ='/<div.*?("hidden-xs")>(.*)([0-9]{1,}月)(.*日|.+旬).+(発売).*<\/div>/';
preg_match_all($pattern,$res,$day);

for ($i = 0 ; $i < 15; $i++){
?>
<div class='cosme_result'>
<?php
echo "<div class = 'img'>".$img[0][$i+6]."</div>".
     "<div class = 'title'>". $title[2][$i]."</div>".
     "<div class = 'sentence'>".$sentence[0][$i]."</div>".
     "<div class= 'sell'>"."発売日: ".$day[3][0].$day[4][0]."</div>";
}
     ?>
</div>
</body>
</html>
