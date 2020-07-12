<?php
ini_set('max_execution_time', 20);
require_once 'classes/jsonRPCClient.php';
require_once 'classes/recaptcha.php';
require_once 'config.php';

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo $faucetTitle; ?></title>
  <meta name="keywords" content="Bitcoin,BitBlocks,BBK,money,free,faucet,BTC,investing,investor">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="images/favicon.ico">
  <link rel="icon" type="image/icon" href="images/favicon.ico" >

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">

  <script>var isAdBlockActive=true;</script>
  <script src="js/advertisement.js"></script>
  <script>
  if (isAdBlockActive) {
    window.location = "./adblocker.php"
  }
  </script>

</head>

<body>

	<div class="container">
		<div id="login-form">
			<h3><a href="./"><img src="<?php echo $logo; ?>" height="256"></a><br /><br /> <?php echo $faucetSubtitle; ?></h3>
			<fieldset>

	<!-- ADS AREA --->

				<br />

						<?php
					$bbk = new jsonRPCClient($jsonrpc_server);
					$balance = $bbk->getbalance();

					$recaptcha = new Recaptcha($keys);
					//Available Balance
	        $avbalance = $balance - 300; // -300 To avoid problem, you can change

				?>

				<form action="request.php" method="POST">

				<?php
					if(isset($_GET['msg'])){
						$mensaje = $_GET['msg'];
						if($mensaje == "captcha"){
				?>
						<div  id="alert" class="alert alert-error radius">
							Invalid Captcha, enter the correct one.
						</div>
				<?php
						} else
						if($mensaje == "wallet"){
				?>
							<div id="alert" class="alert alert-error radius">
							Please enter the correct BitBlocks address.
							</div>
				<?php
						}else
						if($mensaje == "success"){
				?>

							<div class="alert alert-success radius">
							You won <?php echo $_GET['amount']; ?> BBK.<br/><br/>
							<a target="_blank" href="https://bbk.overemo.com/transaction/<?php echo $_GET['txid']; ?>">Check on explorer</a>
							</div>

				<?php } else
						if($mensaje == "notYet"){
				?>
						<div id="alert" class="alert alert-warning radius">
						  issued once every 2 hours. Come on later.
						</div>

				<?php }
					}
				?>
				<div class="alert alert-info radius">
				Balance: <?php echo $avbalance ?> BBK.<br>
				<?php
					$link = mysqli_connect($hostDB, $userDB, $passwordDB, $database);

					$query = "SELECT SUM(payout_amount) FROM `payouts`;";

					$result = mysqli_query($link, $query);
					$dato = mysqli_fetch_array($result);

					$query2 = "SELECT COUNT(*) FROM `payouts`;";

					$result2 = mysqli_query($link, $query2);
					$dato2 = mysqli_fetch_array($result2);

					mysqli_close($link);
				?>
				Distributed: <?php echo $dato[0] ?> BBK. by <?php echo $dato2[0];?> payouts.
            </div>

            <?php
				if($avbalance<50.0){
			?>
            <div class="alert alert-warning radius">
             The faucet balance is empty. <br> Come on later &ndash;
			</div>
			<?php
				} elseif (!$link) {
					// $link = mysqli_connect($hostDB, $userDB, $passwordDB, $database);

					die('Помилка піключення ' . mysql_error());
				}  else {
			?>

           <input type="text" name="wallet" required placeholder="Wallet address">

           <?php
				echo $recaptcha->render();
           ?>
          	<!-- ADS AREA --->

           <center><input type="submit" value="Get free BitBlocks!"></center>
           <br>



		   <?php
				}
		   ?>

		   <br>

		   <?php /*
			   <div class="table-responsive">
				<table class="table table-bordered table-condensed">
				  <thead>
					<tr>
					  <th><h6><b>Cleared Sites</b><br> <small>Sites that have their wallets allowed to request more than 1 time but only with a different payment id.</small></h6></th>
					</tr>
				  </thead>
				  <tbody>
					<?php foreach ($clearedAddresses as $key => $item) {
					  echo "<tr>
					  <th>".$key."</th>
					  </tr>";

					}?>
				  </tbody>
				</table>
			  </div>*/
		   ?>

          <div class="table-responsive">
            <h6><b>Last additions</b></h6>
            <table class="table table-bordered table-condensed">
              <thead>

				           <?php
					$deposits = ($bbk->listreceivedbyaddress());
					$exibir = $deposits[0]['txids'];
			        foreach($exibir as $values)
					{

					echo "<tr><th>Txid</th><th>";

					echo "<a href='https://bbk.overemo.com/transaction/$values'target='_blank'>$values</a>";

					echo "</th></td></tr>";
					}


                ?></td>

                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
          <p style="font-size:10px;">Donate BitBlocks to support this faucet. <br>Donnation address: <b><?php echo $faucetAddress; ?></b><br>If you donate BBK here, all coins go to faucet</p>
          	<!-- ADS AREA --->

		  <h3>What is BitBlocks?</h3>
		  <br>
		   BITBLOCKS is a business-oriented cryptocurrency directed towards entertainment, especially in video games and other areas that revolve around this current industry, such as championships, events, fairs, conferences, and game
development among others. We know that this business is in rapid expansion worldwide and that video games have not ceased to be something exclusively marketed to target age groups. The climbing value of the gamer world has
reached such a point of professionalism that there are currently athletes and video game teams, tournament achievements that are transmitted in real time on the internet and even on television.

<h6>Some links:</h6>
 <a href='https://bitcointalk.org/index.php?topic=5056486.0'>Ann</a><br>
 <a href='https://github.com/BitBlocksProject/BitBlocks/releases'>Wallets</a>
 <a href='https://discord.gg/7gDGVq8'>Discord</a>

		  <br>
		  <br>
	<p style="font-size:10px;">&#169; 2015 Faucet by

    <a href="https://github.com/Ratnet/Bytecoin-Faucet" target="_blank">Ratnet</a>
    <br />&#169; 2016
    <a href="https://github.com/seredat/Karbowanec-Faucet" target="_blank">Seredat</a>
    <br />&#169; 2018
    <a href="https://github.com/Looongcat/karbo-faucet-frontend" target="_blank">Looongcat</a>
    <br /> &#169; 2019
    <a href="https://github.com/ShzenBBK/BBK-faucet" target="_blank">SzhenBBK</a>

  </center>

          <footer class="clearfix">
          </footer>
        </form>

      </fieldset>
    </div> <!-- end login-form -->
  </div>


  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <?php if(isset($_GET['msg'])) { ?>
  <script>
  setTimeout( function(){
    $( "#alert" ).fadeOut(3000, function() {
    });
  }  , 10000 );
  </script>




  <?php } ?>


</body>
</html>
