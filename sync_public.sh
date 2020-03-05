#!/bin/bash
# fswatch -o /Users/niran/code/agentquoter-store/public/js/app.js | xargs -n1 -I{} /Users/niran/code/agentquoter-store/sync-public.sh
rsync -avz -og --chown=www-data:www-data --exclude '.git' --exclude 'index.php'  --exclude 'storage' /Users/niran/code/agentquoter-store/public/ root@app.agentquote.com:/var/www/html/
