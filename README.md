<div align="center">

# 🇧🇩 Price Bond Bangladesh

### A free, open-source citizen portal for tracking Bangladesh Bank prize bonds and instantly verifying draw results.

[![License: MIT](https://img.shields.io/badge/License-MIT-indigo.svg)](LICENSE)
[![Laravel](https://img.shields.io/badge/Laravel-12-red.svg)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-3-violet.svg)](https://livewire.laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-v4-06b6d4.svg)](https://tailwindcss.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-blueviolet.svg)](https://www.php.net)

[**🚀 Live Demo**](https://bond.nayem.com.bd) · [**📖 Documentation**](#-getting-started) · [**🐛 Report a Bug**](https://github.com/rofequl/price-bond-checker/issues) · [**💬 Request a Feature**](https://github.com/rofequl/price-bond-checker/issues)

</div>

---

## 📌 About

**Price Bond Bangladesh** is a modern, fully Bangla-localized web application that helps Bangladeshi citizens organize their prize bond numbers and automatically check them against official Bangladesh Bank draw results. No more manually scanning long PDFs — save your bonds once and verify in one click every quarter.

> ⚠️ **Disclaimer:** This is an unofficial, community-built tool. It is **not affiliated with Bangladesh Bank or the Government of Bangladesh**. Always verify final winning numbers against the official government PDF released by Bangladesh Bank.

---

## ✨ Features

### 👤 For Citizens
- 🔐 **Free account** with email or mobile login
- 📁 **Block-based organization** — group bonds (up to 100 per block) for easy management
- 🎯 **One-click auto-verification** against the latest 8 valid draws
- 🏆 **Winner notifications** with prize category, amount and draw details
- 🔎 **Search & filter** your bond numbers
- ✏️ **Edit & delete** bonds anytime
- 📱 **Fully responsive** — works on mobile, tablet, desktop

### 🌐 Public (No Login Required)
- 📊 **Public results page** with formatted winning numbers from every draw
- 📄 **Official PDF download** for each draw (uploaded by admin)
- 📖 **Help / how-it-works** page with step-by-step Bangla guide
- ❓ **FAQ section** answering common questions

### 🛡️ For Admin
- 📊 **Modern admin dashboard** with stat overview
- 📄 **Draw result entry** with all 5 prize categories + amounts + official PDF upload
- 🔢 **Smart validation** — enforces exact prize-number counts (1/1/2/2/40)
- 📅 **3-month draw gap** enforced automatically
- 🪟 **Automatic 8-draw valid window** — older draws auto-expire from matching pool
- 📋 **Series management** — activate/deactivate available bond series
- 👥 **User list** with block & bond counts

### 🎨 Design
- 💜 **Modern Indigo / Violet design system** with emerald accents
- 🌗 **Light theme** with subtle gradients and smooth transitions
- 🇧🇩 **Noto Sans Bengali** + Inter font stack for crisp Bangla & English typography
- ⚡ **Tailwind CSS v4** with custom design tokens

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | PHP 8.2+, Laravel 12 |
| **Frontend** | Livewire 3, Alpine.js, Tailwind CSS v4 |
| **Database** | MySQL 8 / MariaDB 10.4+ |
| **Build** | Vite 8 |
| **Auth** | Laravel session-based auth with role middleware |

---

## 🚀 Getting Started

### Prerequisites

- **PHP** 8.2 or higher with `mbstring`, `pdo_mysql`, `gd`, `fileinfo` extensions
- **Composer** 2.x
- **Node.js** 18+ and npm
- **MySQL** 8 / **MariaDB** 10.4+ (or any Laravel-supported database)

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/rofequl/price-bond-checker.git
cd price-bond-checker

# 2. Install PHP dependencies
composer install

# 3. Install JS dependencies
npm install

# 4. Copy the environment file
cp .env.example .env

# 5. Generate the application key
php artisan key:generate

# 6. Configure your database in .env
#    DB_DATABASE=price_bond
#    DB_USERNAME=root
#    DB_PASSWORD=
# Then run migrations
php artisan migrate

# 7. Seed the default Super Admin + active bond series
php artisan db:seed

# 8. Create the public storage symlink (required for PDF uploads)
php artisan storage:link

# 9. Build front-end assets
npm run build

# 10. Serve the application
php artisan serve
```

The site will be available at **http://localhost:8000**.

### Default Super Admin credentials

After running `php artisan db:seed`, a Super Admin account is created with these defaults:

| Field | Value |
|---|---|
| Email | `admin@gmail.com` |
| Password | `password` |

Log in at **`/admin`** with these credentials.

> ⚠️ **Change them immediately after first login.** The default password is documented publicly and is unsafe for production.

**How to change:**

- **Email / name / phone** — log in as the Super Admin at `/admin`, then use the citizen dashboard profile section (or update directly via tinker).
- **Password** — set up SMTP first in **Admin → SMTP / Email**, then use **Forgot Password** on the login page to receive a reset link, or update via tinker:

```bash
php artisan tinker
```

```php
$u = \App\Models\User::where('email', 'admin@gmail.com')->first();
$u->password = 'your-new-strong-password'; // auto-hashed by the cast
$u->save();
```

Re-running `php artisan db:seed` is safe — the seeder uses `firstOrCreate`, so it only creates the Super Admin if a user with the email `admin@gmail.com` does not exist yet. Once you change the password (or the email), re-seeding leaves that account untouched.

### Development mode

```bash
# Run Vite dev server with HMR
npm run dev

# In another terminal
php artisan serve
```

---

## 📁 Project Structure

```
price-bond-checker/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php          # Citizen auth + public pages
│   │   └── AdminAuthController.php     # Admin panel
│   ├── Livewire/Citizen/
│   │   ├── Dashboard.php               # Citizen dashboard component
│   │   └── ResultVerify.php            # Verification workflow
│   └── Models/
│       ├── PrizeBondDraw.php
│       ├── PrizeBondDrawWinner.php
│       ├── PrizeBondSeries.php
│       ├── PrizeBond.php
│       └── PrizeBondBlock.php
├── database/migrations/                # Schema versions
├── resources/
│   ├── css/app.css                     # Design system + Tailwind theme
│   └── views/
│       ├── layouts/                    # Portal + admin layouts
│       ├── auth/                       # Citizen login/register
│       ├── admin/                      # Admin pages
│       ├── public/                     # Public results + help
│       └── livewire/citizen/           # Citizen Livewire views
├── routes/web.php                      # All routes
└── public/storage/results/             # Uploaded draw PDFs (symlinked)
```

---

## 🧪 Running Tests

```bash
php artisan test
```

---

## 📦 Deployment

### Production checklist

1. Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`
2. Set `APP_URL` to your live domain
3. Run: `php artisan config:cache && php artisan route:cache && php artisan view:cache`
4. Run: `npm run build`
5. Ensure `storage/` and `bootstrap/cache/` are writable by the web server
6. Run `php artisan storage:link` once on the server
7. Set up a queue worker if you intend to add background jobs later

---

## 🤝 Contributing

Contributions, bug reports, and feature requests are welcome!

1. **Fork** the repository
2. **Create** your feature branch (`git checkout -b feature/AmazingFeature`)
3. **Commit** your changes (`git commit -m 'Add some AmazingFeature'`)
4. **Push** to the branch (`git push origin feature/AmazingFeature`)
5. **Open** a Pull Request

Please make sure your code follows Laravel conventions and that you preserve the original author attribution per the [LICENSE](LICENSE).

---

## 📜 License & Attribution

This project is licensed under the **MIT License** with an attribution clause — see the [LICENSE](LICENSE) file for full terms.

You are free to:

- ✅ Use the software commercially or privately
- ✅ Modify, fork and redistribute
- ✅ Use as part of a larger project

You must:

- ⚠️ **Preserve original author credit** ("Md Nayem") in the README, an About page, or the application footer
- ⚠️ **Not claim original authorship** of this software or substantial portions of it
- ⚠️ **Link back** to https://github.com/rofequl/price-bond-checker or https://nayem.com.bd

---

## 👨‍💻 Author

**Md Nayem**

- 🌐 Website: [nayem.com.bd](https://nayem.com.bd)
- 🐙 GitHub: [@rofequl](https://github.com/rofequl)
- 📦 Repository: [price-bond-checker](https://github.com/rofequl/price-bond-checker)

> If you use this software, please drop a ⭐ on the repository — it really helps!

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) — for the elegant PHP framework
- [Livewire](https://livewire.laravel.com) — for reactive components without JS overhead
- [Tailwind CSS](https://tailwindcss.com) — for the utility-first styling
- [Heroicons](https://heroicons.com) — for the SVG icons
- The Bangladeshi developer community 🇧🇩

---

<div align="center">

**Made with ❤️ in Bangladesh by [Md Nayem](https://nayem.com.bd)**

</div>
