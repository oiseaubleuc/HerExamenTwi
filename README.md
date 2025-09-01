# Mini Twitter Clone - CI/CD Pipeline Project

## Project Overzicht

Dit project is een Twitter clone gebouwd voor een tweede zit examen (herkansing) in DevOps en web development. De applicatie demonstreert moderne software development praktijken inclusief containerisatie, Kubernetes orchestration en continuous integration/continuous deployment (CI/CD) pipelines.

## Project Doelen

- Bouw een functionele Twitter clone met Laravel backend
- Implementeer uitgebreide CI/CD pipeline met GitHub Actions
- Deploy applicatie naar Kubernetes cluster met k3d
- Demonstreer DevOps best practices en automatisering
- Toon containerisatie en orchestration vaardigheden

## Technologie Stack

### Backend
- **Laravel 11** - PHP web framework
- **PHP 8.3** - Server-side programmeertaal
- **SQLite** - Database voor ontwikkeling en testing

### Frontend
- **Tailwind CSS** - Utility-first CSS framework
- **Alpine.js** - Lichtgewicht JavaScript framework
- **Vite** - Build tool en development server

### Infrastructuur
- **Docker** - Containerisatie platform
- **Kubernetes (k3d)** - Container orchestration
- **GitHub Actions** - CI/CD automatisering
- **GitHub Container Registry** - Docker image opslag

## Project Structuur

```
HerExamenTwi/
├── app/                    # Laravel applicatie logica
├── resources/             # Views, CSS, JavaScript
├── routes/                # Applicatie routes
├── database/              # Migrations en seeders
├── k8s/                   # Kubernetes manifests
├── .github/workflows/     # CI/CD pipeline definities
├── tests/                 # PHPUnit test suite
├── Dockerfile             # Container definitie
├── docker-compose.yml     # Lokale development setup
└── README.md              # Dit bestand
```

## Functionaliteiten

### Kern Functionaliteit
- Gebruikers authenticatie en registratie
- Tweet creatie en beheer
- Like en reply systeem
- Gebruikers profielen en volgen

### DevOps Functionaliteiten
- Geautomatiseerde testing pipeline
- Multi-stage Docker builds
- Kubernetes deployment automatisering
- Multi-environment ondersteuning (dev, test, main)
- Code kwaliteit en security scanning

## CI/CD Pipeline Architectuur

### Pipeline Stages

1. **Code Kwaliteit & Statische Analyse**
   - PHPStan voor statische code analyse
   - PHP CS Fixer voor coding standards
   - PHP Mess Detector voor code kwaliteit

2. **Security Analyse**
   - Dependency vulnerability scanning
   - Security best practices validatie
   - PHP compatibiliteit checks

3. **Uitgebreide Testing**
   - Unit tests met PHPUnit
   - Test coverage rapportage 
   - Multi-version PHP testing (8.2, 8.3)

4. **Performance Testing**
   - Load testing met k6
   - Resource gebruik optimalisatie

5. **Build & Deploy**
   - Docker image building
   - Multi-platform ondersteuning 
   - Geautomatiseerde Kubernetes deployment

### Workflow Bestanden

- **ci-build.yml** - Hoofd CI/CD pipeline voor main en test branches
- **deploy-k8s.yml** - Kubernetes deployment automatisering
- **dev-pipeline.yml** - Geavanceerde development pipeline met uitgebreide testing

## Kubernetes Deployment

### Cluster Setup
- **k3d** - Lichtgewicht Kubernetes distributie voor development
- **Lokale storage** - Persistent volume claims voor data persistentie

### Applicatie Componenten
- **Laravel App** - PHP-FPM applicatie server
- **Nginx** - Web server en reverse proxy
- **SQLite Database** - Persistente data opslag
- **Ingress Controller** - Externe toegang management

### Deployment Commando's
```bash
# Deploy applicatie
cd k8s
./deploy.sh

# Controleer deployment status
kubectl get all -n mini-twitter

# Toegang tot applicatie
kubectl port-forward -n mini-twitter service/mini-twitter-nginx-service 8080:80

# Cleanup deployment
./cleanup.sh
```

## Lokale Development

### Vereisten
- Docker Desktop
- k3d CLI tool
- kubectl
- PHP 8.3
- Node.js 20
- Composer

### Setup Instructies
```bash
# Clone repository
git clone https://github.com/oiseaubleuc/HerExamenTwi.git
cd HerExamenTwi

# Installeer PHP dependencies
composer install

# Installeer Node.js dependencies
npm install

# Build frontend assets
npm run build

# Start lokale development
php artisan serve
```

### Docker Development
```bash
# Start met Docker Compose
docker-compose up -d

# Toegang tot applicatie
open http://localhost:8000
```

## Testing

### Tests Uitvoeren
```bash
# Voer alle tests uit
php artisan test

# Voer tests uit met coverage
php artisan test --coverage --min=70

# Voer tests parallel uit
php artisan test --parallel

# Voer specifieke test suite uit
php artisan test --testsuite=Feature
```

### Test Coverage
- **Minimum coverage vereiste**: 70%
- **Test types**: Unit, Feature, Integration
- **Geautomatiseerde testing**: Geïntegreerd met CI/CD pipeline
- **Coverage rapportage**: Codecov integratie

## Deployment Omgevingen

### Development (dev branch)
- **Doel**: Feature development en testing
- **Pipeline**: Geavanceerde dev pipeline met uitgebreide testing
- **Deployment**: Handmatige trigger met environment selectie
- **Features**: Code kwaliteit, security scanning, performance testing

### Testing (test branch)
- **Doel**: Integratie testing en validatie
- **Pipeline**: Standaard CI/CD pipeline
- **Deployment**: Automatisch bij push
- **Features**: Basis testing, Docker builds, Kubernetes deployment

### Productie (main branch)
- **Doel**: Stabiele productie releases
- **Pipeline**: Productie CI/CD pipeline
- **Deployment**: Automatisch bij merge naar main
- **Features**: Volledige testing, security validatie, productie deployment

## Package Dependencies

### PHP Dependencies (composer.json)
- **Laravel Framework**: Web applicatie framework
- **Laravel Breeze**: Authenticatie scaffolding
- **PHPUnit**: Testing framework
- **PHPStan**: Statische analyse tool
- **PHP CS Fixer**: Coding standards tool
- **PHP Mess Detector**: Code kwaliteit analyse

### Node.js Dependencies (package.json)
- **Tailwind CSS**: Utility-first CSS framework
- **Alpine.js**: Lichtgewicht JavaScript framework
- **Vite**: Build tool en development server
- **PostCSS**: CSS processing tool
- **Autoprefixer**: CSS vendor prefixing

### Development Dependencies
- **k3d**: Kubernetes distributie voor development
- **kubectl**: Kubernetes command-line tool
- **Docker**: Containerisatie platform
- **GitHub Actions**: CI/CD automatisering platform

## Bronnen en Referenties

### Documentatie
- [Laravel Documentatie](https://laravel.com/docs) - Officiële Laravel framework documentatie
- [Kubernetes Documentatie](https://kubernetes.io/docs/) - Officiële Kubernetes documentatie
- [GitHub Actions Documentatie](https://docs.github.com/en/actions) - GitHub Actions workflow documentatie
- [Docker Documentatie](https://docs.docker.com/) - Docker containerisatie documentatie
- [Tailwind CSS Documentatie](https://tailwindcss.com/docs) - Tailwind CSS framework documentatie

### Tools en Services
- [k3d](https://k3d.io/) - Lichtgewicht Kubernetes distributie
- [GitHub Container Registry](https://docs.github.com/en/packages/working-with-a-github-packages-registry/working-with-the-container-registry) - Docker image opslag
- [Codecov](https://codecov.io/) - Code coverage rapportage
- [PHPStan](https://phpstan.org/) - PHP statische analyse tool
- [PHP CS Fixer](https://cs.symfony.com/) - PHP coding standards tool

### Best Practices
- [12 Factor App](https://12factor.net/) - Applicatie development methodologie
- [DevOps Practices](https://aws.amazon.com/devops/what-is-devops/) - DevOps methodologie en praktijken
- [Kubernetes Best Practices](https://kubernetes.io/docs/concepts/configuration/overview/) - Kubernetes configuratie best practices
- [CI/CD Best Practices](https://www.atlassian.com/continuous-delivery/principles/continuous-integration-vs-delivery-vs-deployment) - Continuous integration en deployment praktijken

## Bijdragen

### Development Workflow
1. Maak feature branch van dev
2. Implementeer wijzigingen met tests
3. Zorg voor code kwaliteit standards
4. Dien pull request in naar dev branch
5. Geautomatiseerde testing en validatie
6. Code review en goedkeuring
7. Merge naar dev branch

## Licentie

Dit project is  een  onderdeel van een tweede zit examen. Alle code en documentatie wordt as-is geleverd voor leer- en demonstratiedoeleinden.

## Gebruik van AI‑tools

Tijdens de ontwikkeling zijn AI‑tools ondersteunend gebruikt voor inspiratie, code‑refactoring, testvoorbeelden en documentatie. Er zijn uitsluitend gratis of open‑source middelen gebruikt, waaronder:

- Codeium: gratis code‑assistent voor IDE's
- Tabby (TabbyML): open‑source, lokaal te draaien code‑assistent
- ChatGPT (gratis versie): vragen beantwoorden en tekst herformuleren

Alle AI‑suggesties zijn niet ongecontroleerd overgenomen.

