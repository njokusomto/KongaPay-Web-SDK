<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KongaPay Test</title>
    <style>
        .container{
            width: 760px;
            margin: 0 auto;
        }
        .pull_left{
            float: left;
        }
    </style>

</head>
<body>
<div class="container">
    <header>
        <img src="https://media03.konga.com/Landing_pages/mob-app/kongapaylogo.png">
    </header>

    <div class="pull_left">
        <div class="cart_total">
            <h2>Test Amount</h2>
            <h1 class="amount"><span>&#8358</span>2000</h1>
            <div id="kpay-pay-component"></div>
        </div>
    </div>
</div>
<script src="https://sandbox.kongapay.com/plugins/web-plugin/js/kpay-sand.min.js"></script>
<script>
    new KongaPay({
        buttonSize: 140,
        merchantId: "testmerchant",
        merchantName: "KongaPay Test",
        callBack: "http://localhost/kongapay/callback.php",
        transactionReference: "TEST-" + Math.floor((Math.random() * 99999999) + 1),
        amount: "2000",
        description: "Testing Payment with KongaPay"
    });
</script>
</body>
</html>
