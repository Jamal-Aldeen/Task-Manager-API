# Task Manager Application - README

A modern, full-stack task management application built with **Laravel** and **Livewire**, featuring a responsive web interface and a robust REST API. Developed for the **Junior Full-Stack Laravel Developer assessment** at **ABM Egypt**.

---

# Image Paths for Task Manager Application

1. **Login Page**: `screenshots/login.png`
2. **Register Page**: `screenshots/register.png`
3. **Dashboard**: `screenshots/dashboard.png`
4. **Dashboard**: `screenshots/dashboard1.png`
5. **Dashboard**: `screenshots/dashboard2.png`


## 🚀 Features

### 🖥️ Web Application
- **Secure Authentication**: Login and registration with real-time validation
- **Task Management**: Add, edit, delete, and toggle tasks with live updates
- **Responsive Design**: Mobile-friendly UI with Tailwind CSS
- **Real-time Updates**: Powered by Livewire for seamless UX
- **Session Management**: Secure login/logout functionality

### 📡 REST API
- **Sanctum Authentication**: Secure token-based access
- **CRUD Operations**: Create, read, update, and delete tasks
- **User Authorization**: Users manage only their own tasks
- **Optimized Schema**: Efficient database structure with relationships

### 🎨 Design & UX
- **Tailwind CSS**: Modern, utility-first styling
- **Loading States**: Visual feedback for actions
- **Error Handling**: Inline validation and error messages
- **Notifications**: Success messages for task actions
- **Theme Support**: Clean, accessible dark/light themes

---

## 📸 Screenshots

See the [Screenshot Guide](SCREENSHOT_GUIDE.md) for a detailed list of recommended screenshots, including authentication pages, dashboard, task management, responsive views, and UI elements.

---

## 🧰 Requirements
- **PHP** >= 7.3 | 8.0
- **Laravel** >= 8.x
- **MySQL** database
- **Composer** for dependency management
- **Node.js** (optional, for asset compilation)
- **Modern Browser** (Chrome, Firefox, Safari, Edge)

---

## ⚙️ Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/Jamal-Aldeen/Task-Manager-API.git
   cd Task-Manager-API
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Configure Environment**
   ```bash
   cp .env.example .env
   ```
   Update `.env` with your database credentials:
   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=task
   DB_USERNAME=root
   DB_PASSWORD=your_password
   APP_URL=http://127.0.0.1:8000
   SANCTUM_STATEFUL_DOMAINS=127.0.0.1:8000,localhost:8000
   SESSION_DOMAIN=127.0.0.1
   ```

4. **Generate App Key**
   ```bash
   php artisan key:generate
   ```

5. **Set Up Database**
   ```bash
   mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS task;"
   php artisan migrate
   ```

6. **Create Test User (Optional)**
   ```bash
   php artisan tinker
   User::create(['name' => 'Test User', 'email' => 'test@example.com', 'password' => bcrypt('password123')]);
   ```

7. **Serve the Application**
   ```bash
   php artisan serve --host=127.0.0.1 --port=8888
   ```
   Visit: **http://127.0.0.1:8888**

---

## 🎯 Usage

### 🔐 Authentication
- **Login**: Navigate to `/login`, use `test@example.com` and `password123`
- **Register**: Go to `/register` to create a new account
- **Logout**: Click "Logout" in the top navigation

### ✅ Task Management
- **Add Task**: Enter title and click "Add Task"
- **Edit Task**: Click the pencil icon, edit, and save
- **Toggle Status**: Click the circle icon to mark as completed/pending
- **Delete Task**: Click the trash icon and confirm

### 📡 API Endpoints
| Method | Endpoint           | Description              |
|--------|--------------------|--------------------------|
| POST   | `/api/login`       | Authenticate & get token |
| POST   | `/api/register`    | Register new user        |
| POST   | `/api/logout`      | Logout user              |
| GET    | `/api/tasks`       | List user tasks          |
| POST   | `/api/tasks`       | Create a task            |
| PUT    | `/api/tasks/{id}`  | Update a task            |
| DELETE | `/api/tasks/{id}`  | Delete a task            |

---

## 🧪 Testing
- **Web Testing**: Test authentication, task CRUD, and responsive design
- **API Testing**: Use `Task Manager API.postman_collection.json` in Postman
- **Environment**: Set `base_url` to `http://127.0.0.1:8888` in Postman

---

## 🛠️ Technical Stack
- **Frontend**: Livewire 2.x, Tailwind CSS, Alpine.js, Blade
- **Backend**: Laravel 8.x, Sanctum, Eloquent ORM
- **Database**: MySQL
- **Security**: CSRF protection, bcrypt hashing, input validation

---

## 🚀 Deployment
1. Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`
2. Optimize: `php artisan config:cache`, `php artisan route:cache`, `php artisan view:cache`
3. Configure web server (Apache/Nginx) with `/public` as document root
4. Run migrations: `php artisan migrate --force`

---

## 📝 License
This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).

---
