#!/bin/bash
fswatch -0 -v -o /Users/niran/Code/AgentQuote/Projects/AQ2E/app-agentquote/ | xargs -0 -n 1 -I {} /Users/niran/code/agentquoter-store/sync-git-project.sh
