# Inventory Manager

![image](https://user-images.githubusercontent.com/25815584/197069781-47940b5f-0045-4460-b287-6ee3cc4b160a.png)

This is a simple web app to manage inventory, you can preview it [here](https://laravel-inventory-manager.herokuapp.com/). User can purchase (add) or apply (remove) inventory. The applied inventory will be taken from the oldest available (first-in-first-out). User can also see the total available quantity and its economical valuation. The tech stack used: Laravel, Inertia, Vue 3, Vite, Typescript, Bootstrap 5.

## Getting Started
1. [Install Docker Desktop](https://docs.docker.com/get-docker/)
1. Git clone this repository
1. `cp .env.example .env`
1. [Install Composer dependencies](https://laravel.com/docs/9.x/sail#installing-composer-dependencies-for-existing-projects)
1. Add `alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'` to `~/.zshrc` or `~/.bashrc`
1. `sail up -d`
1. `sail artisan key:generate`
1. `sail artisan storage:link`
1. `sail artisan migrate --seed`
1. `sail yarn`
1. `sail yarn dev`
1. App is live at http://localhost/  

## Important Files
1. [`tests/Unit/Observers/InventoryMovementObserverTest.php`](tests/Unit/Observers/InventoryMovementObserverTest.php)  
1. [`app/Observers/InventoryMovementObserver.php`](app/Observers/InventoryMovementObserver.php)
1. [`resources/vue/pages/Home.vue`](resources/vue/pages/Home.vue)

## Refactor List
1. Implement the Product model, so we can track inventory of various products
1. Use vue-i18n instead of hardcoding texts in the markup
1. Extract duplicated markup into small reusable components

## Linting
```
sail pint

sail yarn lint:all --fix
sail yarn lint resources/vue/pages/Home.vue
```

## Testing
```
sail test
sail test tests/Feature/Pages/HomeTest.php
sail test tests/Feature/Pages/HomeTest.php --filter=user_can_view_home_page
sail test -d --update-snapshots
```
