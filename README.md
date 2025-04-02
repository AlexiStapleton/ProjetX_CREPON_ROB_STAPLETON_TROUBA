# ProjetX_CREPON_ROB_STAPLETON_TROUBA

## 🚀 Installation et Lancement du Projet

### Prérequis
Avant de lancer le projet, assurez-vous d'avoir installé :
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/install/)

### Étapes d'installation
1. **Cloner le dépôt Git**
   ```sh
   git clone https://github.com/AlexiStapleton/ProjetX_CREPON_ROB_STAPLETON_TROUBA.git
   cd ProjetX_CREPON_ROB_STAPLETON_TROUBA
   ```

2. **Lancer les services Docker (base de données, backend, etc.)**
   ```sh
   docker-compose up -d --build
   ```

### Accès à l'application
L'application est accessible via l'URL : [http://localhost:12586](http://localhost:12586)

---

## 🛠 Structure et Organisation du Projet

```
ProjetX/
│── backend/         # Code du backend (Express, API...)
│── frontend/        # Code du frontend (React, Vue...)
│── database/        # Scripts SQL, migrations
│── docker-compose.yml  # Configuration Docker
│── package.json     # Fichier de configuration Node.js
│── README.md        # Documentation du projet
```

### 📌 Modélisation de la base de données

![Schéma de la base de données](docs/database-schema.png)

---

## 👥 Équipe de développement

| Nom                | Rôle                   |
|--------------------|------------------------|
| Alexis Stapleton   | Backend Developer      |
| Crepon Baptiste    | Database/Docker Manager|
| Rob Elioth         | Backend Developer      |
| Trouba Maël        | Frontend Developer     |

