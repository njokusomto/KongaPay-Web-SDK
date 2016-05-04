#KongaPay-Web-SDK

The KongaPay Web Plugin is designed for use on the web. This plugin allow merchants to receive payments from a KongaPay user. This plugin will be implemented using HTML and Javascript.

####Requirements
1. Merchant must be signed up as a Merchant on KongaPay. If you are yet to sign up, send an email to support@kongapay.com to come onboard.
2. KongaPay will provide the Merchant with Merchant ID and Client Secret (To be kept secretly by merchant).
3. Merchant can provide a logo to be displayed alongside Merchant name. The image should be saved using merchant ID as name and should be either .jpg or .png format
4. Implement web plugin on websites, android SDK on android app and iOS SDK on iOS app.

###How to Implement KongaPay Payment Web Plugin. (PART 1)
##### 1. Add Javascript Link to the page
On the page where the Merchant wants to receive payment the link to the Javascript file is to be added on the page. It is preferable to have it close to the javascript object.

Sample: 

`<script src="https://sandbox.kongapay.com/plugins/web-plugin/js/kpay-sand.min.js
"></script>`

##### 2. Create Javascript Object
Javascript object is to built for the transaction. 

Sample Script:

```
<script>
    new KongaPay({
merchantId: "{merchant_id}",
merchantName: "{merchant_name}"
callBack: "{callback_url}",
amount: "{amount}",
transactionReference: “{transaction_reference}” ,
buttonSize: 140,
description : “{description}”
    });
</script>
```

#####OPTIONS Definition:
**buttonSize :** specifies the size, in pixels, of the KongPay button you’ll want to appear on your site. It defaults to 140px if not provided. Integer (optional).

**merchantId:** Your KongaPay merchant_id provided by KongaPay. String (Maximum of 15 characters)

**merchantName:** Your Company Name as you want it to appear on the Popup. String (Maximum of 20 characters).

**callBack:** The return url that will receive response after completed payment action. String (Maximum of 100 characters).

**amount:** The payable amount for the transaction in naira and kobo. Example 2005.45 will be read as Two Thousand Naira Forty Five Kobo. String (Maximum of 10 characters)

**transactionReference:** Unique transaction reference per transaction. This should always be different for every instance. String (Maximum of 32 characters)

**description:** A short description of the transaction. Optional. String (Maximum of 30 characters)

##### 3. Add Kongapay Payment Div
Add `<div id="kpay-pay-component"></div>` where you want KongaPay button to appear. This will add a ‘Pay With KongaPay button as seen in this image http://take.ms/246jD.

##### 4. User login
When a user clicks on the Pay with KongaPay button a popup is displayed where the customer enters his/her phone number linked to KongaPay. http://take.ms/yBLDD. The user will enter his phone number and click on login.

##### 5. User verify
On successful login the user will be taken to a page where he/she is to enter the One Time Password and KongaPay Pin to authorize payment. http://take.ms/CoBFJ. On click of Pay Amount, transaction will be processed.
 
##### 6. Handling Response
Response is sent to the callback set on the javascript object. Parameters of the response can be fetched using GET. 
###### Expected parameters from the response:
**status :** Status of the transaction. Expected ‘success’ or ‘error’.

**payment_reference:** KongaPay Transaction reference to be used to identify the payment. String (Maximum of 32 characters)

**comment:** Is returned when there is an error. Short description of why an error occurred. String.

### How to Implement KongaPay Link Account Web Plugin. (PART 2)
##### 1. Add Javascript Link to the page
On the page where the Merchant wants to receive payment the link to the Javascript file is to be added on the page. It is preferable to have it close to the javascript object.

Sample: 

`<script src="https://sandbox.kongapay.com/plugins/web-plugin/js/kpayLink.min.js"></script>`
```
Create Javascript Object
Javascript object is to built for the transaction. Sample Script:
<script>
    new KongaPay({
merchantId: "{merchant_id}",
merchantName: "{merchant_name}"
callBack: "{callback_url}",
buttonSize: 140,
description : “{description}”
    });
</script>
```

######OPTIONS Definition:
**buttonSize :** specifies the size, in pixels, of the KongPay button you’ll want to appear on your site. It defaults to 140px if not provided. Integer (optional).

**merchantId:** Your KongaPay merchant_id provided by KongaPay. String (Maximum of 15 characters)

**merchantName:** Your Company Name as you want it to appear on the Popup. String (Maximum of 20 characters).

**callBack:** The return url that will receive response after completed payment action. String (Maximum of 100 characters).

**description:** A short description of the transaction. String (Maximum of 30 characters)

##### 3. Add Kongapay Payment Div
Add `<div id="kpay-link-component"></div>` where you want KongaPay button to appear. This will add an “Authorize KongaPay” button as seen in this image. http://take.ms/cf81C.

##### 4. User login
When a user clicks on the Authorize KongaPay button a popup is displayed where the customer enters his/her phone number linked to KongaPay. http://take.ms/L3OmO. The user will enter his phone number and click on login.

##### 5. User verify
On successful login the user will be taken to a page where he/she is to enter the One Time Password and KongaPay Pin to authorize his/her account. http://take.ms/qoKU2. On click of Authorize, transaction will be processed.
 
##### 6. Handling Response
Response is sent to the callback set on the javascript object. Parameters of the response can be fetched using GET. 
Expected parameters from the response:

**status :** Status of the transaction. Expected ‘success’ or ‘error’.

**token:** Generated token for debiting the customer. This will be used by Merchant to debit the customer. String (Maximum of 150 characters)
comment: Is returned when there is an error. Short description of why an error occurred. String.


### Generate Access Token (PART 3)

All requests to KongaPay requires an Access Token. To generate an Access Token, KongaPay is to provide the merchant with both Merchant ID and Client Secret.

######Definition of parameters:
- **merchant_id** - Merchant Id provided by KongaPay. String (Maximum of 15 characters)
- **client_secret** - Client Secret provided by KongaPay. This should be kept securely by the Merchant. String (Maximum of 30 characters)
- **access_code** - Access Code is generated by a GET request to the Auth server. Access code is required to generate Access Token. It expires after 30 seconds. String (Maximum of 128 characters)
- **access_token** - Access Token is required to make any request to KongaPay. It expires after 6 hours. String (Maximum of 128 characters)
- **refresh_token** - Refresh Token can be used to get a new Access Token after the expiration of the Access Token. It expires after 14 days. String (Maximum of 128 characters)

#####OAuth 2.0 Authentication
This follows the standard OAuth 2.0 flow where:

1. Client requests an access code
2. KongaPay returns the access code on success of step 1 request
3. Client uses the access code to request access token
4. KongaPay returns the access token and refresh token on success of step 3 request
5. Client then uses the access token to request resources from the server.

######Base URL for OAuth: 
```
Sandbox Environment - https://staging-auth.kongapay.com

Live Environment - https://auth.kongapay.com

```
Step I

To request for an access code 

URL: `{{oauth_base_url}}/authorize?response_type=code&client_id={merchant_id}&state=alive`
Request Type: GET

Step II
```
Success Message:
{
  "status": "success",
  "data": {
    "code": "{access_code}"
  }
}

Error message:
{
  "error": "invalid_client",
  "error_description": "The client id supplied is invalid"
}
```
Step III

Use access code to request token
```
URL: {{oauth_base_url}}/token
Request Type: POST (application/json)
Parameters: 
grant_type = authorization_code
code = {access_code} (the code returned from Step II)
client_id = {merchant_id}
client_secret = {client_secret}
```

Step IV

Success Message to  Step III 
```
{
"access_token": "{access_token}",
"expires_in": 21600,
"token_type": "Bearer",
"scope": null,
"refresh_token": “{refresh_token}”
}

Error Message
{
  "error": "invalid_grant",
  "error_description": "Authorization code doesn't exist or is invalid for the client"
}
```
Step V-a

Using refresh token to get another get another access token
```
URL: {{oauth_base_url}}/token
Request Type: POST
Receives a form-data post with the following parameters
grant_type = refresh_token
refresh_token = “{refresh_token}” (the refresh token returned from step 2)
client_id = “{merchant_id}”
client_secret = “{client_id}”
```
Step V-b

Server returns another token.
```
{
  "access_token": “{access_token}”,
  "expires_in": 21600,
  "token_type": "Bearer",
  "scope": null
}
```
######NOTE: Token/code expiration
*The access token expires after 6 hours. Once the access token expires, the refresh token can be used to request for another token which will last for another 6 hours. However, refresh token expires after 14 days. Once the refresh token expires, the client needs to request another access code which will kick-start the flow again from the beginning.*

*Access code expires 30 secs after it was requested which means the access code must have been used to request a token within 30 secs.*


###Debiting a KongaPay Linked Account with a Token (PART 4)

This allows Merchants to debit a linked KongaPay Account using the Payment Token provided by KongaPay.

######Base URL for KongaPay: 
```
SandBox Environment - https://api-sandbox.kongapay.com/v3/

Live Environment - https://api.kongapay.com
```

##### Definition of parameters:
- **merchant_id** - Merchant Id provided by KongaPay. String (Maximum of 15).
- **access_token** - Access Token is required to make any request to KongaPay. It expires after 6 hours. String (Maximum of 128 characters).
- **payment_reference** - Unique payment reference to be provided by the Merchant. String (Maximum of 32 characters).
- **token** - Payment Token provided by KongaPay after successful linking of KongaPay account to Merchant’s account either via SDK or web. String (Maximum of 150 characters).
- **amount** - Amount to be debited in Naira.Kobo. Example 2005.45 will be read as Two Thousand Naira Forty Five Kobo. String (Maximum of 10 characters).
- **currency_code** - The Currency code of the transaction. Only Naira (566) accepted for now. String (Maximum of 3 characters).
- **status** - Status of the transaction. Expected “success” or “error”.
- **transaction_reference** - Transaction Reference supplied by KongaPay after a successful transaction. String (Maximum of 20 characters).
- **error_message** - Error message sent back from KongaPay when an error occurs. String (Maximum of 1000 characters).
- **error_code** - Error code sent back from KongaPay when an error occurs. String (Maximum of 5 characters).

Access token from Part 3 above is required to make payment using Payment Token.

**Endpoint:** `{{kongapay_base_url}}/payments/wallet/merchant/{merchant_id}/pay?access_token={access_token}`

**Request:**

Request Type: POST

Receives a JSON payload in the following format:
```
{
  "payment_reference": "{payment_reference}",
  "token": "{token}",
  "amount": "{amount}",
  "currency_code": "566"
}

Successful Response:
{
  "status": "success",
  "data": {
    "transaction_reference": "{transaction_reference}"
  }
}

Error response:
{
  "status": "error",
  "message": “{error_message}”,
  "code": “{error_code}”
}
```

Requerying KongaPay Payments (PART 5)

Merchants can always requery transactions made using KongaPay. This part of the documentation will help with how this can be achieved.

This allow Merchants to requery a KongaPay transaction using the payment_reference used in making payment.

######Base URL for KongaPay: 
```
Sandbox Environment - `https://api-sandbox.kongapay.com/v3`

Live Environment - `https://api.kongapay.com`
```
**Definition of parameters:**

- **merchant_id** - Merchant Id provided by KongaPay. String (Maximum of 15).
- **access_token** - Access Token is required to make any request to KongaPay. It expires after 6 hours. String (Maximum of 128 characters).
- **payment_reference** - Unique payment reference to be provided by the Merchant. String (Maximum of 32 characters).
- **amount** - Amount to be debited in Naira.Kobo. Example 2005.45 will be read as Two Thousand Naira Forty Five Kobo. String (Maximum of 10 characters).
- **currency_code** - The Currency code of the transaction. Only Naira (566) accepted for now. String (Maximum of 3 characters).
- **status** - Status of the transaction. Expected “success” or “error”.
- **transaction_reference** - Transaction Reference supplied by KongaPay after a successful transaction. String (Maximum of 20 characters).
- **response_code** - Check Response Codes and Description below.
- **error_message** - Error message sent back from KongaPay when an error occurs. String (Maximum of 1000 characters).
- **error_code** - Error code sent back from KongaPay when an error occurs. String (Maximum of 5 characters).

Access Token (access_token) from Part 3 above is required to requery Transactions.

**Endpoint:**

`{{kongapay_base_url}}/payments/wallet/merchant/{merchant_id}/payment/{payment_reference}?access_token={access_token}`

**Request:**

Request Type: GET

**Successful Response:**
```
{
  "status": "success",
  "data": {
    "payment_reference": "{payment_reference}",
    "amount": "{amount}",
    "response_code": "{response_code}",
    "currency_code": "566",
    "transaction_reference": "{transaction_reference}"
    "type": "incoming",
    "transaction_date": "2016-02-29 14:02:30"
  }
}
```

#####Response Codes and Description
```
K00 - Success
K01 - Insufficient funds
K02 - Transaction not found
K03 - Fail
```
