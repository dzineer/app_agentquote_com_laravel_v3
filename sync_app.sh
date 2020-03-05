#!/bin/bash
# rsync -av /Users/niran/code/agentquoter-store/ root@app.agentquote.com:/var/www/app/
rsync -avz -og --chown=www-data:www-data --exclude '.git' --exclude '.env' --exclude '.idea' --exclude 'storage' /Users/niran/code/agentquoter-store/ root@app.agentquote.com:/var/www/app/

