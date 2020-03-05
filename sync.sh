#!/bin/bash
# fswatch -o /Users/niran/code/agentquoter-store | xargs -n1 -I{} /Users/niran/code/agentquoter-store/sync-app.sh
rsync -av --exclude '.git' /Users/niran/code/agentquoter-store/ root@144.202.0.184:/var/www/app/
