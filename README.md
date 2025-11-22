![Deliciousthings logo](public/logo.svg)

**DELICIOUSthings is a platform that connects pastry chefs and bakers with customers.**

## Developer guide

### Installation

1. Install [Laravel Herd for Windows](https://herd.laravel.com/windows) or [Laravel Herd for macOS](https://herd.laravel.com/)
2. Install and configure your DBMS. You may like to use [MySQL](https://dev.mysql.com/downloads/installer/)  
3. After you have installed and configured Herd and your local DBMS, open your terminal and move to the `~/Herd` directory on your system with `cd ~/Herd`
4. Use `git clone https://github.com/Arthuro12/deliciousthings.git` to clone the repository
5. Run the following commands:
    - `cd deliciousthings`
    - `cp .env.example .env`
    - `composer install`
    - `php artisan key:generate` 
    - `php artisan migrate` will run the migration files
    - `php artisan route:cache`
    - `npm install`
    - `npm run build`
    - `npm run dev`
    - `herd open` to open the app in your browser

### IDE

We recommend that all developers use [Visual Studio Code](https://code.visualstudio.com/), so that we have a common standard for IDE configurations.

1. Commands
    - `code .` open VS code from your terminal

### Versioning

1. VCS
    - git
2. git clients
    - [Fork](https://git-fork.com) 
    - [GitHub Desktop](https://desktop.github.com/download/)

### Plugins

- ESLint
- Beautify
- PHP Intelephense
- Laravel
- Laravel Extra Intellisense
- Vue (official)

### YouTube tutorials

- [Laravel Demo App](https://youtu.be/SqTdHCTWqks?si=cnznR3omXj2GBndO) with an Laravel instructor
- [Laravel Inertia App](https://www.youtube.com/watch?v=QyqrYdhSku0&t=439s) with an Laravel instructor
- [Vue Demo App](https://www.youtube.com/watch?v=s9URD3PefTk&t=230s) from [Vue Mastery](https://www.youtube.com/@VueMastery) 

### Important links

- Laravel Herd [getting started](https://herd.laravel.com/docs/macos/getting-started/installation)
- [Inertia](https://inertiajs.com/)
- [Laravel](https://laravel.com/)
- [Laravel Sanctum](https://laravel.com/docs/12.x/sanctum#spa-authentication) - Authenticate SPA 
- [Vue.js](https://vuejs.org/)
- [Reka](https://reka-ui.com/)
