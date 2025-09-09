# Test Damiano Dell'Amore - Contacts CRUD – Laravel + React

Questo progetto implementa un sistema di gestione contatti con funzionalità di creazione, lettura, aggiornamento ed eliminazione (CRUD).  
È composto da:

- **Backend**: API REST sviluppata in Laravel con persistenza su file JSON  
- **Frontend**: interfaccia utente in React (Vite)  
- **Docker**: configurazione opzionale per avviare l’intero progetto con un solo comando

---

## Clonazione del repository

```bash
git clone https://github.com/tuo-username/tuo-repo.git
cd tuo-repo
```

---

## Avvio con Docker (consigliato)

**Prerequisiti**: Docker Desktop installato e in esecuzione.

Dalla root del progetto:

```bash
docker compose up --build
```

### Servizi disponibili

- Frontend: http://localhost:3000  
- Backend API: http://localhost:8000/api/contacts

### Arresto dei container

```bash
docker compose down
```

---

## Avvio manuale (senza Docker)

### Backend (Laravel)

```bash
cd backend
composer install
php artisan serve
```

API disponibili su: http://127.0.0.1:8000/api/contacts

### Frontend (React)

In un secondo terminale:

```bash
cd frontend
npm install
echo "VITE_API_BASE=http://127.0.0.1:8000/api" > .env
npm run dev
```

Frontend disponibile su: http://127.0.0.1:5173

---

## Endpoints API

- GET /api/contacts — elenco contatti  
- POST /api/contacts — creazione contatto  
- GET /api/contacts/{id} — dettaglio contatto  
- PUT /api/contacts/{id} — aggiornamento contatto  
- DELETE /api/contacts/{id} — eliminazione contatto

---

## Esempio curl (creazione contatto)

```bash
curl -X POST http://127.0.0.1:8000/api/contacts \
  -H "Content-Type: application/json" \
  -d '{"first_name":"Mario","last_name":"Rossi","email":"mario@example.com"}'
```

---

## Requisiti soddisfatti

- CRUD completo per la gestione dei contatti (nome, cognome, email)  
- API REST sviluppata con Laravel  
- Persistenza su file JSON (backend/storage/app/private/db.json)  
- Frontend in React (Vite) per interazione con le API  
- Sistema di versioning GIT  
- Istruzioni di esecuzione fornite in questo README.md  
- Esecuzione opzionale tramite Docker

---


