# Installation process

```shell
php artisan migrate --seed
php artisan storage:link
```

Update `APP_URL` in `.env` to make sure it matches server's URL.

### Default user credentials

| Email            | Password |
|------------------|----------|
| test@example.com | password |

### Filament admin panel

Filament admin panel is accessible under /admin URI
