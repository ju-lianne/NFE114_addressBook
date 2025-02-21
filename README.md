# 📘 AdressBook

## 🚀 Installation et lancement du projet

### 1️⃣ Cloner le dépôt
```sh
git clone https://gitlab.com/caensup9475439/licence-dev/20241/addressbook/sj_adress_book.git
```

### 2️⃣ Installer les dépendances PHP et Node.js
Assure-toi d’avoir **PHP**, **Composer**, **Node.js** et **npm** installés.

#### Installation des dépendances PHP :
```sh
composer install
```

#### Installation des dépendances Node.js :
```sh
npm install
```

### 3️⃣ Configurer l’environnement
Copie le fichier `.env.example` en `.env` :
```sh
cp .env.example .env
```
Génère une clé d’application Laravel :
```sh
php artisan key:generate
```

### 4️⃣ Lancer la base de donnéesexécute les migrations :
```sh
php artisan migrate
```

### 5️⃣ Lancer le serveur de développement

#### Démarrer le serveur Laravel :
```sh
php artisan serve
```

#### Compiler les assets frontend avec Tailwind et DaisyUI :
```sh
npm run dev
```

---

## 🛠️ Technologies utilisées

- **Laravel** 
- **Livewire**
- **Tailwind CSS** 
- **DaisyUI** 
- **PostGreSQL**
- **Node.js** 
- **vite**

---

## 📁 Structure du projet

```
📂 mon-projet
├── 📁 public/                   # Fichiers accessibles publiquement (index.php, assets)
├── 📁 resources/                # Fichiers frontend (views, CSS, JS)
│   ├── 📁 css/                  # Styles personnalisés
│   ├── 📁 js/                   # Scripts JS
│   ├── 📁 views/                # Templates Blade Laravel
│       ├── 📁components         # Composants Blade
│       ├── 📁layouts            # Mises en page Blade
│       ├── 📁livewire           # Composants Livewire
│              ├──📁dashboard    # Composants Livewire pour le dasboard
│              ├──📁users        # Composants Livewire pour les users
│       ├── 📁pages              # Pages Blade
├── .env.example         # Exemple de configuration d’environnement
```
---

## 📌 Auteurs

Développé par **[Julianne et Sacha]**
