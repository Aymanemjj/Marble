# Marble

**A platform for artists and creators to showcase their work.**

Marble is a full-stack application where creators build a profile, organize their pieces into collages, and get discovered through a tag-based preference system that surfaces relevant work to the right audience.

---

## Stack

| Layer | Tech |
|---|---|
| Backend | Laravel (REST API) |
| Frontend | Vue.js 3 (Composition API) |
| Styling | Tailwind CSS |
| StateManagement | Pinia |
| Auth | Laravel Sanctum |

---

## Features

- **Creator profiles** — Public-facing artist pages with bio and portfolio
- **Collages & Pieces** — Organize artwork into curated collections via many-to-many relationships
- **Tag system** — Tag-based discovery with normalized preference scoring
- **Cookie-based preferences** — Guest users build a taste profile across sessions
- **File uploads** — Images stored as WebP for performance
- **Policy-based authorization** — Creators can only manage their own content

---

## Project Structure

```
marble/
├── app/
│   ├── DTOs/           # Data Transfer Objects (JsonSerializable, static make())
│   ├── Services/       # Business logic layer
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Requests/   # FormRequest validation
│   │   └── Policies/
│   └── Models/
├── database/
│   └── migrations/
└── storage/

marble-frontend/
├── src/
│   ├── composables/    # useUiState, useDataState
│   ├── components/
│   └── views/
```

---

## Getting Started

### Backend

```bash
git clone https://github.com/Aymanemjj/marble.git
cd marble

composer install
cp .env.example .env
php artisan key:generate

# Configure DB in .env, then:
php artisan migrate --seed
php artisan storage:link

php artisan serve
```

### Frontend

```bash
cd marble-frontend
npm install
npm run dev
```

---

## API

The backend exposes a REST API consumed by the Vue frontend. All protected routes require a Sanctum token passed as a Bearer header.

Key resource endpoints: `/api/profiles`, `/api/collages`, `/api/pieces`, `/api/tags`

---

## Author

**Aymane** — [github.com/Aymanemjj](https://github.com/Aymanemjj)
