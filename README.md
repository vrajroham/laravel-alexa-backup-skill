### Steps to install application

* Clone the repository
* `composer install`
* Update Alexa App ID in `config/alexa.php`
* Migrate database
* Create user using signup
* Login with newly created user credentials
* Go to OAuth2 Dashboard
* To create new client
    - Open Alexa Skill @ Amazon Developer 
    - From account linking section, copy one **Redirect URL (3rd URL)**
    - In laravel application create new client using copied redirect URL
* Create your intents in Alexa Skill on Amazon developer site
* For linking your account with application, so you can securely access your API
    - Make your laravel application publicly accessible
    - If you are using valet on MAC then you can use `valet share` and copy url with `https`
    - If you are using Linux or windows then you can use the tools called **ngrock** for the same
    - Enter your authorization uri. E.g. https://example.com/oauth/authorize.
    - Enter your client ID. E.g. 1
    - Enter scope, which is **access-alexa**. (Mentioned in App\Providers\AuthServiceProviders@boot())
    - Select Authorization grant type **Auth Code Grant**
    - Enter client secret key from laravel application.
    - Select Client Authentication Scheme as **Credentials in request body**
    - Save
    - Build your model
* Ready to have a fun with Alexa :tada: