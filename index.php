<?php
// include('global-metrics.php');
$url = 'https://pro-api.coinmarketcap.com/v1/global-metrics/quotes/latest';
$apiKey = 'your api key';

// Initialize a cURL session
$ch = curl_init();

// Set the URL
curl_setopt($ch, CURLOPT_URL, $url);

// Set the custom headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'X-CMC_PRO_API_KEY: ' . $apiKey
]);

// Return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL session
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo '<p>Error:' . curl_error($ch) . '</p>';
} else {
    // Decode the JSON response
    $data = json_decode($response, true);

    // Check if data is not empty
    if (!empty($data['data'])) {
        // print_r($data);
        $metrics = $data['data'];
      
    } else {
        echo '<p>No data available.</p>';
    }
}

// Close the cURL session
curl_close($ch);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
<div class="header">
  <div class="left-section">
    <!-- <span>Cryptos: <a href="#">2.4M+</a></span> -->
    <span>Exchanges: <a href="#"><b><?php echo $metrics['active_exchanges'] ?> </b></a></span>
    <span>Market Cap: <a href="#" ><b>$ <?php  echo number_format(($metrics['quote']['USD']['total_market_cap']),2) ?>  T </b> </a></span>
    <span style="font-size: 9px;">24h Vol: <b><a href="#">$<?php echo number_format(($metrics['quote']['USD']['total_volume_24h']),2) ?>B </b></a></span>
    <span>Dominance: <a href="#">BTC: <b><?php echo number_format(($metrics['btc_dominance']),1) ?>% </b></a> <a href="#">ETH: <b> <?php echo number_format(($metrics['eth_dominance']),1) ?>% </b></a></span>
  </div>
  <div class="right-section">
    <span><a href="#">English</a></span>
    <span><a href="#">USD</a></span>
    <span><a href="#">🌙</a></span>
    <span><a href="#">Get listed</a></span>
    <span><a href="#">API</a></span>
    <span><a href="#">💎</a></span>
    <button class="login-button">Log In</button>
    <button class="signup-button">Sign up 🎁</button>
  </div>
</div>
    <nav>
        <div class="left">
            <img src="logo-removebg-preview.png" alt="" >
            <span class="name">CoinMarketCap</span>
        </div>
        <!-- <div class="right">
            <ul>
                <li><a href="#">Cryptocurrencies</a></li>
                <li><a href="#">exchanges</a></li>
                <li><a href="#">Community</a></li>
                <li><a href="#">Product</a></li>
                <li><a href="#">Learn</a></li>
                <li class="toright"><a href="#">  Login / Signup</a></li>
            </ul>
        </div> -->
    </nav>

    <main>
        <!-- <h1>Today's Cryptocurrency prices by market cap</h1>
        <p>The global crypto market cap is $2.16T, a 1.41% increase over the last day. <a href="">Read More</a></p> -->
        <!-- <section class="slidersection">
        <div class="firstSection">
            <h1>firstSection</h1>
        </div>
        <div class="secondSection">
            <h1>secondsection</h1>
        </div>
        <div class="thirdsection">
            <h1>thirdsection</h1>
        </div>
    </section> -->
    <?php
$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
$apiKey = 'your api key';

// Initialize a cURL session
$ch = curl_init();

// Set the URL
curl_setopt($ch, CURLOPT_URL, $url);

// Set the custom headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'X-CMC_PRO_API_KEY: ' . $apiKey
]);

// Return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL session
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo '<p>Error:' . curl_error($ch) . '</p>';
} else {
    // Decode the JSON response
    $data = json_decode($response, true);

    // Check if data is not empty
    if (!empty($data['data'])) {
    
        ?>
        <table class="coins-bar">

        
        <thead>
        <tr>
        <th>#</th>
        <th >Name</th>
     
        <th>Price (USD)</th>
        <th>1h%</th>
        <th>24h%</th>
        <th>7d%</th>
        <th>Market Cap</th>
        <th>Volume(24h)</th>
        <th>Circulating supply</th>
        </tr>
        </thead>
        <tbody>
<?php
        // Loop through each cryptocurrency and display it in a table row
        foreach ($data['data'] as $crypto) {
            ?>
        
                <tr >
            <td > <?php echo $crypto['cmc_rank'] ?> </td>
            <td> <?php echo $crypto['name'] ?><span class="symbolfont">  <?php echo $crypto['symbol'] ?> </span> </td>
            <td> <?php  echo number_format(($crypto['quote']['USD']['price']),2) ?> </td>
            <td> <?php echo number_format(($crypto['quote']['USD']['percent_change_1h']),2) ?> </td>
            <td> <?php echo number_format(($crypto['quote']['USD']['percent_change_24h']),2) ?> </td>
            <td> <?php echo number_format(($crypto['quote']['USD']['percent_change_7d']),2) ?> </td>
            <td> <?php echo number_format(($crypto['quote']['USD']['market_cap']),2) ?> </td>
            <td> <?php echo number_format(($crypto['quote']['USD']['volume_24h']),2) ?> </td>
            <td> <?php echo number_format($crypto['circulating_supply'],2) ?> </td>
           
            </tr>
    
            
            <?php
        }
 ?>
     </tbody>
        </table>
        <?php
    } else {
        echo '<p>No data available.</p>';
    }
}

// Close the cURL session
curl_close($ch);
?>



        <footer>
    <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
      <p>© 2024 <b><a href="https://coinmarketcap.com/">Coin Market Cap</a> </b>, Inc. All rights reserved</p>
      <!-- <ul class="list-unstyled d-flex">
        <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
        <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
        <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
      </ul> -->
    </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>