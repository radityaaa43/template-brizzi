# Template Brizzi

This is a simple template for Brizzi BRI API using PHP.

module:
- [BRIZZI - Check Topup Status](https://developers.bri.co.id/en/snap-bi/apidocs-virtual-account-briva-online-snap-bi)
- [BRIZZI - Topup Deposit](https://developers.bri.co.id/en/snap-bi/apidocs-virtual-account-briva-ws-snap-bi)
- [BRIZZI - Validate Card Number](https://developers.bri.co.id/en/snap-bi/apidocs-virtual-account-briva-ws-snap-bi)

## List of Content
- [Instalasi](#instalasi)
  - [Prerequisites](#prerequisites)
  - [How to Setup Project](#how-to-setup-project)
  - [Check Topup Status](#check-topup-status)
  - [Topup Deposit](#topup-deposit)
  - [Validate Card Number](#validate-card-number)
- [Env Example](#env-example)
- [Caution](#caution)
- [Disclaimer](#disclaimer)

## Instalasi

### Prerequisites
- php
- composer

### How to Setup Project

```bash
1. run command `cd briapi-template-brizzi-php` to change directory
2. copy .env file by typing `cp .env.example .env` in the terminal
3. fill the .env file with the required values
4. run composer install to install all dependencies
```

### Check Topup Status
```bash
1. fill variable $username, eg: 'test'
2. fill variable $brizziCardNo, eg: '6013500601496673'
3. fill variable $amount, eg: '1000.00'
4. fill variable $reff, eg: '1356040'
5. run command `php src/check_topup_status.php serve`
```

### Topup Deposit
```bash
1. fill variable $username,  eg: 'test'
2. fill variable $brizziCardNo, eg: '6013500601496673'
3. fill variable $amount, eg: '5123.00'
4. run command `php src/topup_deposit.php serve`
```

### Validate Card Number
```bash
1. fill variable $username, eg: 'test'
2. fill variable $brizziCardNo, eg: '6013500601496673'
3. run command `php src/validate_card_number.php serve`
```

## .ENV Example
you can find consumer key and consumer secret in https://developers.bri.co.id

click menu My Apps then select apps

![developers bri](assets/image.png)

```bash
CONSUMER_KEY=pqYYBsSc6rHwCqp6o4R8ExmBRubEpqtY 
CONSUMER_SECRET=idbaNFh0mGSZ7xol
```

## Caution

Please delete the .env file before pushing to github or bitbucket

## Disclaimer

Please note that this project is just a template on the use of BRI-API php sdk and may have bugs or errors.
