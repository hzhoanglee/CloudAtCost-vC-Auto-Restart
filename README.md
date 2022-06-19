# CloudAtCost-vC-Auto-Restart

Purpose: Check if Cloud vC is stopped or not and perform a start trigger when the Container is stopped
A Infinity loop in PHP to perform request to CAC - CloudVC API. Can be used with any virtualizor servers.

## Features
- Automatically fetch list of vC and perform request if needed.
- Telegram Notification when the server is started.
- Logging into file. But believe me, you will never read the logs. Log is stored into 'vcloudrestart.log' file.
## How to use
- Create a Telegram Bot via BotFather. [This is the instructions from Telegram](https://core.telegram.org/bots)
- Clone/Download/Copy vc.php and modify the value in the top of the file:
` $telegram_token = ""; //Telegram Token
$telegram_chatid = ""; //Telegram ChatID
$cac_apikey = ""; //CloudAtCost VC API Key
$cac_apipass = ""; //CloudAtCost VC API Password
$logging = true; // true for enable logging, false for disable logging
$telegram_noti = true; // true for enable Sending Notification, false for disable Sending Notification and the sleep(5);`
- Open terminal, cd to the directory and type: `php vc.php`
- Now you are good to go.
- If you want to run it in the background. You can use [Tmux](https://github.com/tmux/tmux/)
## Why I need this?
I made this script since I accidentally bought a lifetime server from CloudAtCost. It worked great. However, some rainy days, the server is stopped without any notice. And that's why I made this script to keep it up and running for non-critical tasks.
## Should I buy CAC vC servers?
Nah, since you can't buy it anymore. But 6$ for a lifetime (of the company) server? That's crazy for non-critical tasks.
## Future updates?
Yep. But maybe not? I need a counter for Failure message since it may destroy my Telegram Notification.