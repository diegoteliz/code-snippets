### Instructions

#### `.htaccess` file
- Put this file in the root directory that you want to protect.
- `AuthUserFile` must contain the exact path to the `.htpasswd` file. If you have it wrong, it will still ask for a password but nothing will seem to work.
- To get the exact path put `info.php` file in the root directory and open it from a browser.

#### `.htpasswd` file
- Put this file in the root directory that you want to protect.
- One username and password per line (`diego:papAq5PwY/QQM`), separated by a colon.
- Notice the password is encrypted though. You will need to use MD5 to encrypt your password. David Walsh has a [tool just for this](https://davidwalsh.name/web-development-tools).
