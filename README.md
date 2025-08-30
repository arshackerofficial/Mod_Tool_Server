# Mod Tool Server ⚙️

The backend server component for the **VIP_Mod_Tool** client.  
This server handles authentication, file distribution, and access control.  

---

## ✨ Features
- 🔑 **Token-based login** (paired with VIP_Admin)
- 📂 **Controlled file downloads** with verification
- ⚙️ **Global configuration management**
- 🔒 Uses **obfuscated directory names** to make brute-force directory scans more difficult

---

## 📂 Project Structure
```

DB.php                  # Database connector
Global.php              # Shared config / constants
login.php               # Token-based authentication
download.php            # Secure file download endpoint
asdasdasdadfsgsdrtergdff/   # Obfuscated directory
yiueftidufudhgeurrhgiudfh/ # Obfuscated directory

````

> Note: The “nonsense” folder names are intentional.  
> They add a thin layer of obscurity against automated directory brute force attempts.

---

## 🛠️ Tech Stack
- PHP 7+
- MySQL / MariaDB (for user/token storage)
- Deployed on standard LAMP/LEMP stack

---

## 🚀 Getting Started

### Prerequisites
- PHP 7.x or later
- Web server (Apache / Nginx)
- MySQL or MariaDB
- Composer (optional, if you extend with packages)

### Setup
1. Clone the repo into your server’s web root:
   ```bash
   git clone https://github.com/arshackerofficial/Mod_Tool_Server.git

2. Configure `DB.php` with your database credentials.
3. Import schema/tables required for user accounts and token validation.
4. Deploy under HTTPS to prevent credential sniffing.

---

## 🔗 Integration with VIP Tools

* **VIP\_Admin** generates and manages access tokens.
* **VIP\_Mod\_Tool (client)** requests login and downloads content from this server.
* Server validates tokens → provides or denies access → logs activity.

---

## ⚖️ Security Notes

* Directory obfuscation is **not** security. It only reduces noise from generic brute force bots.
* Real security relies on:

  * Strong token validation
  * HTTPS enforced everywhere
  * Properly sanitized database queries (no SQL injection, please)
  * Rate limiting and logging

---

## 📖 Learning Goals

* Understanding how **client–server authentication** works in practice
* Experimenting with **secure file delivery**
* Exploring the pros/cons of obfuscation in server design

---

## ⚠️ Disclaimer

This project is a **learning exercise**. It is not hardened for production use.
Do not rely on obfuscation alone to secure sensitive data.

---

## 👨‍💻 Author

* **Arsh** – Backend & Android security enthusiast
