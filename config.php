<?php
/*
Faucet by Ratnet - Made in México - 2015

I developed this for free to help spread the word about Bytecoin but if you want to tip me, everything will be appreciated :D

Donations to Ratnet Personal Wallet for Developing:

Bytecoin: 28qwqrRWSF7Ad8GjwUgR142yvhmnsa6GGbvf8KpxzWkqU1FEhK5LBijZhXseeQvDzij7cRETY3DPJ3e7opXQc5AhURdFt9U
Bitcoin: 1MXPDKMSbCr41n2imq2BEMivtu9SJyd4ES

Donations to Ratnet's Bytecoin Faucet:
Bytecoin: 24gKv1yqZ2oZ7Ln4KWcL3q7D7CXibndxhDzLvrJxxw1x7tiaQ5euuduT9EkHzDta144vmwToddz9Khct4pqSVzuBCxgVTYP

Changes for KRB by Karbo Dev team 2016, Looongcat 2018, ShzenBBK 2019

Karbo Dev team donation wallet:
Kdev1L9V5ow3cdKNqDpLcFFxZCqu5W2GE9xMKewsB2pUXWxcXvJaUWHcSrHuZw91eYfQFzRtGfTemReSSMN4kE445i6Etb3

Looongcat donation wallet:
KfS4P6eape7iT9m12XVGr5MpTTicPHDANji41wTZ55AuLVq32Tu7NuoJqc1GHKqh3YjorSwytGegBRUxu2fZDMPMAffx9VN

SzhenBBK donation Wallet
Bytecoin: 23wxqbU24rGhhjSNV2mWvxNNXHjUdT6ts2x8s9Nd3entJ1CDTf6XEUM43z54VwGg1YhsTGKbiwXa4GpBZHdR98MA2BYhUF
BitBlocks: BNVzRjtNiYy8achuUsvvaaAuUWwi3qZ3dE


*/

$faucetTitle      = "BitBlocks Faucet";
$faucetSubtitle   = "Every 2 hours you can get free BBK";
$logo             = "images/bitblocks.png";

// Address for RPC client
$jsonrpc_server = 'http://RPCUSER:RPCPASSWORD@YOURIP:YOURVPSPORT';

//Faucet address for donations
$faucetAddress    = ""; // Your BitBlocks address

// Transaction for 1 fee and divider to convert atomic currency units to BBK
$transactionFee   = 0;
$dividirEntre     = 0;

//Reward time in hours
$rewardEvery      = "2";

//Max reward and min reward as decimals, e.g. Min = 10.0 & Max = 20.0
$minReward        = "0.01";
$maxReward        = "10";

//Database connection
$hostDB           = "";
$database         = "";
$userDB           = "";
$passwordDB       = "";

//Recaptcha Keys. You can get yours here: https://www.google.com/recaptcha/
$keys             = array(
		'site_key' => '',
		'secret_key' => ''
);

//Addresses that can request more than one time but with a different payment ID.
$clearedAddresses = array(
/*	"Eobot" => "22694R3K1JvGf1m98pBsbaXCA3ULQz4xdQiYHgnNAdsVDqZDjiTH9CMj6QHhKD232wPeYtfypNzp5TX5L3NcGGSmJ8pWnPJ",
	"Poloniex" => "25cZNQYVAi3issDCoa6fWA2Aogd4FgPhYdpX3p8KLfhKC6sN8s6Q9WpcW4778TPwcUS5jEM25JrQvjD3XjsvXuNHSWhYUsu",
	"HitBTC" => "24zavX3Bi2PiKGWLKh4bPGTiMsn4iHf3Y6JnKCF6V1PeBpDpuwiAMZ8di7ok6B5SQT6UXUtQgusruCoXbqUZm8VJAfq2xKK"
*/ );
?>
