<?php
require_once 'classes/recaptcha.php';
require_once 'classes/jsonRPCClient.php';
require_once 'config.php';
$link = mysqli_connect($hostDB, $userDB, $passwordDB, $database);
function GetRandomValue($min, $max)
	{
		$range = $max - $min;
		$num   = $min + $range * mt_rand(0, 32767) / 32767;
		$num   = round($num, 3);
		return ((float) $num);
	}
//Instantiate the Recaptcha class as $recaptcha
$recaptcha = new Recaptcha($keys);
if ($recaptcha->set())
	{
		if ($recaptcha->verify($_POST['g-recaptcha-response']))
			{
				//Check if address start with B (CHANGE FOR OTHER ALTCOIN)
				$wallet = $_POST['wallet'];
				if($wallet[0] != "B") { //

					header("Location: ./?msg=wallet");
						exit();

				}
				//Getting user IP
				$direccionIP   = $_SERVER["REMOTE_ADDR"];
				if (empty($wallet) OR (strlen($wallet) < 5))
					{
						header("Location: ./?msg=wallet");
						exit();
					}

				//Looking for cleared address or not
				$clave = array_search($wallet, $clearedAddresses);
				if (empty($clave))
					{

					$queryCheck = "SELECT `id` FROM `payouts` WHERE `timestamp` > NOW() - INTERVAL " . $rewardEvery . " HOUR AND ( `ip_address` = '$direccionIP' OR `payout_address` = '$wallet')";
					}

				$resultCheck = mysqli_query($link, $queryCheck);
				if ($row = @mysqli_fetch_assoc($resultCheck))
					{
						header("Location: ./?msg=notYet");
						exit();
					}
				$bbk             = new jsonRPCClient($jsonrpc_server);
				$hasta           = $bbk->getbalance();

				if ($hasta > $maxReward)
					{
						$hasta = $maxReward;
					}
				if ($hasta < $minReward + 0.1)
					{
						header("Location: ./?msg=dry");
						exit();
					}
				$aleatorio      = GetRandomValue($minReward, $hasta);
				$date           = new DateTime();
				$timestampUnix  = $date->getTimestamp() + 5;

				//Send
				$transferencia  = $bbk->sendtoaddress($wallet, $aleatorio);
				if ($transferencia == "")
					{
						header("Location: ./?msg=wallet");
						exit();
					}

				if (strlen($transferencia) > 5)
					{
						$query = "INSERT INTO `payouts` (`payout_amount`,`ip_address`,`payout_address`,`timestamp`) VALUES ('$aleatorio','$direccionIP','$wallet',NOW());";
						mysqli_query($link, $query);
						mysqli_close($link);
						header("Location: ./?msg=success&txid=" . $transferencia . "&amount=" . $aleatorio);
						exit();
					}
				else
					{
					}
			}
		else
			{
				header("Location: ./?msg=captcha");
				exit();
			}
	}
else
	{
		header("Location: ./?msg=captcha");
		exit();
	}
exit();
?>
