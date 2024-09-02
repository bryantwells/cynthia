Example requests


Create Message Command
```
curl -X POST -H "Content-Type: application/json" -H "Authorization: Bot <token>" -d $'{ "name": "Send to Cynthia\'s web", "type": 3 }' https://discordapp.com/api/applications/<app_id>/commands
```

Update Message Command
```
curl -X PATCH -H "Content-Type: application/json" -H "Authorization: Bot <token>.GIkWxB.W__47dVhnPWWQltuSehcWkuX7MvcYYL5iNl9XA" -d $'{ "name": "Send to Cynthia\'s web", "type": 3 }' https://discordapp.com/api/applications/<app_id>/commands/<command_id>
````