
## About typeskip

# Enviornment
- Repository `https://github.com/basilk76/typeskip/` 
- Production
-- domain typeskip.ai
-- Branch `main`
- Development
-- domain usemagicopy.com
-- Branch `dev`

## Domain point to Directory 
- index.php in main directory
## Dev env for local
- For local setup use command `php -S 127.0.0.1:8000`
- `npm run watch` for development
- `npm run production` for production build
## Dependancies installation
- Run composer for php `composer install` 
- npm install for js `npm install`
## Stripe for localhost with Stripe CLI
- stripe listen --forward-to 127.0.0.1:8000/stripe/webhook
