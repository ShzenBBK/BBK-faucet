# BBK Faucet

This faucet runs on a Linux environment with PHP and MYSQL, and it was tested on:
1) Ubuntu 16.04 with 7.2.29 and MariaDB 5.5 (original faucet)

Faucet is set to work on the same server with BitBlocks CLI.

## How to install
First of all you need to create a new database and create this table on it for the faucet to save all requests:

```mysql
CREATE TABLE IF NOT EXISTS `payouts` (
`id` bigint(20) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `payout_amount` double NOT NULL,
  `payout_address` varchar(100) NOT NULL,
  `payment_id` varchar(75) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
```

## Config the remote daemon

In your BitBlocks.conf you need to use only lowercase letters for rcpuser and rcppassword and allow the RPC-JSON connection example:

```rpcallowip=<YOURWEBSITEIP>
rpcuser=bbkfaucet
rpcpassword=nobodycanhackme
server=1
rpcport=59866```


After you create database you need to edit config.php with all your custom parameters and also database information.


Advertisements can be edited on the index.php they are between this lines for an easy location:

           	<!-- ADS AREA --->
           	<!-- ADS AREA --->
