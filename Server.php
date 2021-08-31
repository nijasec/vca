<?php
/**
 * @author Nijas 
 * @date  Aug 2021
 */


class Server
{
    public function index()
    {
        $servers = $this->getIceServers();
$servers= str_replace("url","urls",$servers);
        header('Content-Type: Application/json');
$iceservers=array(
//array("urls"=>"stun:iphone-stun.strato-iphone.de:3478"),
array("urls"=>"stun:ws-turn5.xirsys.com","username"=>"245fS58-xCOT7Tn2jct4c-mgsSs5dSX4SPpQGpp2JECKhJNQ5TVoO29tuH0yUonJAAAAAGEn2c5qZXJ6aWxsYQ=="),
array("urls"=>"turn:ws-turn5.xirsys.com:80?transport=udp","credential"=>"53debb48-0699-11ec-beba-0242ac140004","username"=>"245fS58-xCOT7Tn2jct4c-mgsSs5dSX4SPpQGpp2JECKhJNQ5TVoO29tuH0yUonJAAAAAGEn2c5qZXJ6aWxsYQ=="),
//array("urls"=>"turn:ws-turn5.xirsys.com:3478?transport=udp","credential"=>"53debb48-0699-11ec-beba-0242ac140004","username"=>"245fS58-xCOT7Tn2jct4c-mgsSs5dSX4SPpQGpp2JECKhJNQ5TVoO29tuH0yUonJAAAAAGEn2c5qZXJ6aWxsYQ=="),
array("urls"=>"turn:ws-turn5.xirsys.com:80?transport=tcp","credential"=>"53debb48-0699-11ec-beba-0242ac140004","username"=>"245fS58-xCOT7Tn2jct4c-mgsSs5dSX4SPpQGpp2JECKhJNQ5TVoO29tuH0yUonJAAAAAGEn2c5qZXJ6aWxsYQ=="),
//array("urls"=>"turn:ws-turn5.xirsys.com:3478?transport=tcp","credential"=>"53debb48-0699-11ec-beba-0242ac140004","username"=>"245fS58-xCOT7Tn2jct4c-mgsSs5dSX4SPpQGpp2JECKhJNQ5TVoO29tuH0yUonJAAAAAGEn2c5qZXJ6aWxsYQ=="),
//array("urls"=>"turns:ws-turn5.xirsys.com:443?transport=tcp","credential"=>"53debb48-0699-11ec-beba-0242ac140004","username"=>"245fS58-xCOT7Tn2jct4c-mgsSs5dSX4SPpQGpp2JECKhJNQ5TVoO29tuH0yUonJAAAAAGEn2c5qZXJ6aWxsYQ=="),
//array("urls"=>"turns:ws-turn5.xirsys.com:5349?transport=tcp","credential"=>"53debb48-0699-11ec-beba-0242ac140004")
);

   echo json_encode($iceservers);
$ar=json_decode($servers)->v->iceServers;
//var_dump($ar);
///	echo json_encode($ar);
    }


    private function getIceServers()
    {
        // PHP Get ICE STUN and TURN list
        $data = ["format"=>"urls"];
        $json_data = json_encode($data);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER => ["Content-Type: application/json", "Content-Length: " . strlen($json_data)],
            CURLOPT_POSTFIELDS => $json_data,
            CURLOPT_URL => "https://demo.xirsys.com/webrtc/_turn",//Replace 'YOUR-CHANNEL-NAME' with the name of your xirsys channel
            CURLOPT_USERPWD => "YOUR PASSWORD",
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => TRUE
        ]);

        $res = curl_exec($curl);
        
        if(curl_error($curl)){
            echo "Curl error: " . curl_error($curl);
        };

        curl_close($curl);
        
        return $res;
    }
}


$server = new Server;

$server->index();
