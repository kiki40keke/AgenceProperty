# Gestion Agence — README

> Application Laravel pour gérer des **propriétés** et leurs **options**, avec une **interface d’administration** sécurisée (authentification), ainsi qu’un **formulaire de contact** qui envoie des e-mails.

---

## ✨ Fonctionnalités

- **CRUD Propriétés** : création, édition, suppression, archivage/activation.
- **Options des propriétés** : gestion des options (ex. “Piscine”, “Garage”) et association **many-to-many**.
- **Médias** : upload d’images, miniature, image principale, lien symbolique `storage:link`.
- **Recherche & filtres** : par prix, surface, ville, options, statut.
- **Espace Admin** : tableau de bord, gestion des utilisateurs/propriétés/options.
- **Authentification** : inscription, connexion, mot de passe oublié (Laravel standard / Breeze / Jetstream, au choix).
- **Formulaire de contact** : envoi d’e-mails à l’administrateur (Mailtrap/Mailhog/SMTP).
- **Validation & sécurité** : Form Requests, CSRF, Policies/Gates basiques.
- **Seeders** : données de démo (utilisateur admin + propriétés factices).
- **Prêt pour la prod** : config cache, route cache, queue pour l’e-mail (optionnel).

---

## 🏗️ Stack technique

- **Laravel** 11.x (PHP ≥ 8.2)
- **MySQL** / MariaDB (ou SQLite pour le dev)
- **Blade** / Tailwind (ou Bootstrap, selon votre projet)
- **Laravel Mail** (Mailtrap/Mailhog/SMTP)
- **Queues** (sync en dev, database/redis en prod)

---

## 🚀 Démarrage rapide

### 1) Cloner & installer
```bash
git clone <votre-repo> gestion-agence
cd gestion-agence
composer install
cp .env.example .env
php artisan key:generate
```

### 2) Configurer la base de données
Dans `.env` :
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_agence
DB_USERNAME=root
DB_PASSWORD=
```

### 3) Configurer l’envoi d’e-mails
> Pour du dev, Mailtrap/Mailhog est recommandé.

**Mailtrap (exemple)**
```dotenv
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_user
MAIL_PASSWORD=your_pass
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="no-reply@gestion-agence.test"
MAIL_FROM_NAME="Gestion Agence"
ADMIN_EMAIL="admin@gestion-agence.test"
```

**Mailhog (exemple)**
```dotenv
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="no-reply@gestion-agence.test"
MAIL_FROM_NAME="Gestion Agence"
ADMIN_EMAIL="admin@gestion-agence.test"
```

### 4) Migrer & peupler
```bash
php artisan migrate --seed
php artisan storage:link
```

> Le seeder crée un **compte admin** et quelques propriétés factices (voir `database/seeders`).

### 5) Lancer le serveur
```bash
php artisan serve
```

### 6) (Optionnel) Lancer les files (queues) pour l’e-mail
```bash
php artisan queue:work
```
> En dev, vous pouvez laisser `MAIL_MAILER=log` ou `sync`. En prod, utilisez `database`/`redis` + `supervisor`.

---

## 🧭 Structure & routes

- **Accueil** : `/` (liste + recherche)
- **Propriétés** : `/properties`, `/properties/{slug}`
- **Contact** : `/contact` (GET/POST) → envoie un e-mail à `ADMIN_EMAIL`
- **Admin** : `/admin` (protégé par auth)
    - Gestion des Propriétés : `/admin/properties`
    - Gestion des Options : `/admin/options`
    - Gestion des Utilisateurs (selon vos besoins)

> L’auth utilise les middlewares `auth` et potentiellement `can:...` (Policies) pour l’accès au back-office.

---

## 📮 Formulaire de contact (exemple)

- **Contrôleur** : `App\Http\Controllers\ContactController`
- **Request** : `App\Http\Requests\ContactRequest` (validation)
- **Mailable** : `App\Mail\ContactMessage`
- **Envoi** :
  ```php
  Mail::to(config('mail.admin_email', env('ADMIN_EMAIL')))
      ->send(new ContactMessage($data));
  ```
- **Config personnalisée** : ajoutez dans `config/mail.php`
  ```php
  'admin_email' => env('ADMIN_EMAIL', 'admin@example.com'),
  ```

---

## 🖼️ Gestion des images

- Upload via `Storage` (disk `public`).
- Lien public : `php artisan storage:link`.
- Colonnes DB typiques : `pictures` table (path, property_id, is_featured, ...).
- Affichage d’une miniature :
  ```blade
  <img src="{{ $picture->url() }}" alt="{{ $property->title }}" class="img-thumbnail">
  ```
- **Astuce** : définir une **image principale** (ex: boolean `is_featured`) pour lister la 1ère image partout.

---

## 🔐 Authentification

- Utilisez **Laravel Breeze** (recommandé pour un setup rapide) :
  ```bash
  composer require laravel/breeze --dev
  php artisan breeze:install blade
  npm install && npm run build
  ```
- Ou conservez votre implémentation actuelle (login/register/password reset).

---

## ✅ Tests (exemples)

- Tests de routes publiques / admin (403 si non authentifié).
- Tests du Contact (validation + e-mail envoyé).
- Tests du CRUD Propriétés/Options.
```bash
php artisan test
```

---

## ⚙️ Commandes utiles

```bash
# Optimisation prod
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Nettoyage cache
php artisan optimize:clear

# Dump du schéma (optionnel)
php artisan schema:dump
```

---

## 🗺️ Roadmap (suggestions)

- [ ] Pagination & tris avancés
- [ ] Upload multiple + recadrage/optimisation (Intervention Image / Spatie Media Library)
- [ ] Favoris pour les utilisateurs connectés
- [ ] Export CSV/Excel des propriétés (Laravel Excel)
- [ ] Rôles & permissions (spatie/laravel-permission)
- [ ] Tests E2E (Pest + Laravel Dusk)

---

## 🛡️ Sécurité

- Mettez `APP_KEY` et variables d’environnement **hors dépôt**.
- Utilisez HTTPS en prod.
- Vérifiez les autorisations (`Policies`, `Gates`) côté admin.
- Filtrez/validez toutes les entrées (Form Requests).

---

## 📄 Licence

Projet distribué sous licence **MIT**.  
© Votre Nom / Organisation.

---

## 🤝 Contribuer

1. Fork
2. Créez une branche : `git checkout -b feature/ma-fonctionnalite`
3. Commit : `git commit -m "Ajoute ma fonctionnalité"`
4. Push : `git push origin feature/ma-fonctionnalite`
5. Ouvrez une Pull Request

---

## 📬 Support

- Ouvrir une issue
- Ou contactez : `admin@gestion-agence.test`

---

> **Astuce** : si vous déployez, pensez à configurer la **file d’attente** pour l’envoi d’e-mails et à définir `QUEUE_CONNECTION=database` + `php artisan queue:table && php artisan migrate`, puis utilisez `supervisor` pour `queue:work` en continu.
