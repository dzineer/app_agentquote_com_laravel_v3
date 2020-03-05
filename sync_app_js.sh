#!/bin/bash
# fswatch -o /Users/niran/code/agentquoter-store/public/js/app.js | xargs -n1 -I{} /Users/niran/code/agentquoter-store/sync_app_js.sh
# rsync -avz -og --chown=www-data:www-data --exclude '.git' --exclude 'index.php'  --exclude 'storage' /Users/niran/code/agentquoter-store/public/js/app.js root@app.agentquote.com:/var/www/html/js/app.js
scp /Users/niran/code/agentquoter-store/public/js/app.js root@app.agentquote.com:/var/www/html/js/app.js