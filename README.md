# Task Manager API

A **Laravel-based RESTful API** for managing tasks, developed for the **Junior Full-Stack Laravel Developer assessment** at **ABM Egypt**.
The API supports full task CRUD operations and user authentication using **Laravel Sanctum**.

---

## 🚀 Features

* **Authentication**: Secure endpoints using **Sanctum** with bearer token.
* **Task Management**:

  * Create, read, update, delete (CRUD).
  * Task `status` field supports: `pending`, `in-progress`, `completed`.
* **Database Schema**:

  * `id`, `title` *(string, required)*, `status` *(enum)*, `user_id` *(foreign key)*, `timestamps`.
* **Postman Collection**: Ready-to-use Postman collection for all endpoints.

---

## 🧰 Requirements

* PHP >= 8.1
* Laravel >= 10.x
* Composer
* MySQL or SQLite
* Postman (for testing)

---

## ⚙️ Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/Jamal-Aldeen/Task-Manager-API.git
cd Task-Manager-API
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Environment

```bash
cp .env.example .env
```

Then update `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=

SANCTUM_STATEFUL_DOMAINS=localhost
SESSION_DOMAIN=localhost
```

### 4. Generate App Key

```bash
php artisan key:generate
```

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. (Optional) Seed a Test User

```bash
php artisan tinker
User::create([
  'name' => 'Test User',
  'email_id' => 'test@example.com',
  'password' => bcrypt('password')
]);
```

> Or register via the API if registration is available.

### 7. Serve the Application

```bash
php artisan serve
```

Visit: `http://localhost:8000`

---

## 📡 API Endpoints

> All task endpoints require **Sanctum authentication**.

| Method | Endpoint          | Description              | Payload (if applicable)                                      |
| ------ | ----------------- | ------------------------ | ------------------------------------------------------------ |
| POST   | `/api/login`      | Authenticate & get token | `{ "email_id": "test@example.com", "password": "password" }` |
| GET    | `/api/tasks`      | List user tasks          | –                                                            |
| POST   | `/api/tasks`      | Create a task            | `{ "title": "New Task", "status": "pending" }`               |
| PUT    | `/api/tasks/{id}` | Update a task            | `{ "title": "Updated Task", "status": "in-progress" }`       |
| DELETE | `/api/tasks/{id}` | Delete a task            | –                                                            |

---

## 🧪 Testing with Postman

### 1. Import Collection

Open Postman → Import → Choose: `Task Manager API.postman_collection.json`.

### 2. Set Environment Variables

Create a Postman environment with:

* `base_url`: `http://localhost:8000`
* `token`: *(Set automatically after login)*

### 3. Run Requests

* Start with `POST /api/login` → use returned `token`.
* Use token in **Authorization: Bearer Token** for all `/api/tasks` requests.
* Update task IDs in PUT/DELETE requests based on creation responses.

---

## 📁 Project Structure

| Path                                                    | Description                                |
| ------------------------------------------------------- | ------------------------------------------ |
| `database/migrations/2025_06_23_create_tasks_table.php` | Task table migration                       |
| `app/Models/Task.php`                                   | Task model (fillable + user relation)      |
| `app/Models/User.php`                                   | User model (HasApiTokens + tasks relation) |
| `app/Http/Controllers/AuthController.php`               | Token-based login                          |
| `app/Http/Controllers/TaskController.php`               | Task CRUD methods                          |
| `routes/api.php`                                        | API routes with Sanctum middleware         |
| `Task Manager API.postman_collection.json`              | Postman collection for testing             |

---

