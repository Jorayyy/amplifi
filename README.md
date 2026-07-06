# Amplifi — Gamified Employee Marketing & ABM Referral Tracker

Amplifi is a gamified enterprise employee advocacy and referral platform built with Laravel. It allows company employees to generate unique tracking links for corporate marketing campaigns, share them across social media circles, and earn performance points. It includes Account-Based Marketing (ABM) lookup simulation and multi-layered fraud prevention tools.

---

## 🚀 Core Features

### 🛡️ 1. Multi-Tiered Access Security
* **Role-Based Middlewares:** Restricts system pathways based on administrative status. Standard employee profiles access sharing grids, while administrative actions are blocked via forced `HTTP 403 Forbidden` barriers.
* **Isolated Routing Schemas:** Separates client redirect routers from secure application dashboards to prevent interface conflicts.

### 🌐 2. Enterprise Content Lifecycle & Administration
* **Dynamic Campaign Cards:** Administrators can deploy marketing plays live to the employee feed.
* **Full CRUD Management:** Built-in dashboard supporting immediate configuration changes, live link counters, and safe cascading deletion rules.

### 🏆 3. Gamification Mechanics & Social Amplification
* **One-Click Share Links:** Employees generate isolated, random short codes (`/share/{code}`) to easily attribute external link traffic.
* **Live Standings Leaderboard:** Evaluates points dynamically and immediately shifts profile standings, pushing top advocates up the podium.

### 🎯 4. Simulated Account-Based Marketing (ABM) Tracking
* **Corporate Domain Identification:** Intercepts incoming client redirects and evaluates network vectors against targeted high-value enterprise accounts.
* **ABM Bonus Engine:** Triggers a **+100 Points Bonus** payout to the sharing employee if an incoming visitor is successfully matched to a target account.

### 🚫 5. Anti-Fraud Filtering
* **Network Fingerprinting:** Tracks and cross-references historical visitor IP data before updating platform variables.
* **Passive Handover Fail-Safe:** Prevents score inflation from duplicate clicks without breaking the user experience; non-unique visitors are still cleanly forwarded to the destination landing page.

---

## 🛠️ Tech Stack & Architecture

* **Framework:** Laravel (v13.x) & PHP (v8.5.x)
* **Frontend UI Layout:** Tailwind CSS & Blade Template Engine
* **Database Layer:** Eloquent ORM (MySQL / SQLite)
* **Authentication Scaffold:** Laravel Breeze / Jetstream Starter Systems

---

## 📂 Project Architecture Showcase

### 🎛️ Routing Hub (`routes/web.php`)
Secures routes under isolated permission groups using standard Laravel authentication wrappers:
* `/dashboard` — Standard Employee Advocacy View
* `/admin` — Protected Management Control Hub
* `/share/{code}` — Public Tracker Engine Endpoint

### 🧠 Tracker Hub Logic (`TrackingController.php`)
```php
// Prevent Point Fraud & Log ABM Domain Matches
\(alreadyClicked = Click::where('sharable_link_id',\)link->id)
                       ->where('ip_address', \$ipAddress)
                       ->exists();

if (!\$alreadyClicked) {
    if (\(detectedDomain) {\)pointsEarned += 100; // Apply ABM Target Account Bonus
    }
    link->user->increment('points', pointsEarned);
}
```

---

## 💻 Local Installation Guide

1. Clone this repository locally:
   ```bash
   git clone https://github.com
   cd amplifi
   ```
2. Install dependency files:
   ```bash
   composer install
   npm install && npm run dev
   ```
3. Set up environment configuration:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Build database architecture and apply schema updates:
   ```bash
   php artisan migrate
   ```
5. Seed test accounts and boot up your local instance:
   ```bash
   php artisan db:seed --class=AdminUserSeeder
   php artisan serve
   ```
