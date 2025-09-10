# Laravel + Vue Technical Challenge (Senior Level)

This project is a **SPA** built with **Laravel 12** and **Vue 3 + Vite + Pinia**.  
The goal is to create a project management system with Kanban boards and real-time tasks.

---

## Stack

### Core
- **Backend:** Laravel 12, Sanctum, Policies, Events, Queues
- **Frontend:** Vue 3, Vite, Pinia, Vue Router, vue-draggable-next
- **Realtime:** Laravel Echo + Pusher **(or laravel-websockets)**
- **Storage:** MySQL, Redis
- **Testing:** Pest (backend), Vitest (frontend)

### Optional Enhancements
- File attachments with S3/MinIO
- Full-text search with Laravel Scout
- OpenAPI documentation & Postman collection
- Internationalization (i18n)
- Docker setup for development and CI/CD
- Cypress for end-to-end testing

---

## Feature Checklist

### Core
- [ ] Registration / Login with Sanctum (**Pending**)
- [ ] Project management (create, edit, archive, pagination, filters, roles) (**Pending**)
- [ ] Kanban board with columns and drag & drop task reordering (**Pending**)
- [ ] Task CRUD with priority, assignment, due date, tags, and comments (**Pending**)
- [ ] Role-based permissions: Owner, Manager, Member, Viewer using Policies (**Pending**)
- [ ] Task filters & search by assignee, priority, tags, and status (**Pending**)
- [ ] Minimal auditing with `activity_logs` for task changes (**Pending**)

### Optional Enhancements
- [ ] Advanced real-time with user presence and simultaneous editing (**Pending**)
- [ ] Notifications on task assignment or mentions in comments (**Pending**)
- [ ] File attachments with queues for thumbnail generation (**Pending**)
- [ ] Full-text search with Laravel Scout (**Pending**)
- [ ] Performance optimization with cache and DB indexes (**Pending**)
- [ ] Internationalization (i18n) (**Pending**)
- [ ] OpenAPI documentation & Postman collection (**Pending**)
- [ ] Docker setup for development and CI/CD (**Pending**)
- [ ] End-to-end tests with Cypress (**Pending**)

---

## Development Setup

### Requirements
- PHP 8.3+
- Composer 2
- Node.js 20+
- MySQL
- Redis (for queues & caching)
- Docker (optional for local dev)

### Installation
```bash
git clone git@github.com:YOUR_USERNAME/prueba-laravel-vue.git
cd prueba-laravel-vue

# Backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

# Frontend
npm install
npm run dev
```

### Servers
- API: http://localhost:
- SPA: http://localhost:

## Progress Notes
Each commit updates this README by marking the status of features:
- **Pending** > not started
- **In development** > currently being worked on
- **Done** > completed and tested

## Testing
### Backend (Pest)
´´´
php artisan test
´´´

### Frontend (Vitest)
´´´
npm run test
´´´

### End-to-End (Cypress)*
´´´
npm run cypress:open
´´´