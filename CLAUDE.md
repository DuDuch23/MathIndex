# MathIndex

Symfony 7.4 (PHP 8.4) / Doctrine ORM / PostgreSQL 16 / Webpack Encore. Voir [README.md](README.md) pour la présentation générale et les commandes.

## Environment variables

### `.env` (committé, valeurs de dev non sensibles)

| Variable | Rôle |
|---|---|
| `APP_ENV` | `dev` en local |
| `APP_SECRET` | Signe sessions/CSRF. Valeur de dev committée intentionnellement (voir commentaire dans le fichier) — **jamais réutilisée en prod** |
| `DATABASE_URL` | Connexion PostgreSQL pour un usage hors Docker (`127.0.0.1:5432`) |
| `MESSENGER_TRANSPORT_DSN` | Transport Doctrine pour Messenger |

Pas de `MAILER_DSN` : aucun mail n'est envoyé par l'app (voir `config/packages/mailer.yaml`, transport `null://null` en dur). Si l'envoi d'email devient nécessaire, réintroduire `MAILER_DSN` ici + `COMPOSE_MAILER_DSN` dans `.env.docker`/`.env.prod` + repointer `mailer.yaml` vers `%env(MAILER_DSN)%`.

`.env.local` (non committé) surcharge ces valeurs si besoin en dev hors Docker.

### `.env.docker` (committé, substitution Docker Compose dev uniquement)

Variables `${...}` interpolées par `compose.yaml`/`compose.override.yaml` — **distinctes** de celles de `.env` (voir le commentaire en tête de `compose.yaml` : `docker compose` charge par défaut `./.env` pour ses propres substitutions si `--env-file` n'est pas précisé, donc les secrets Compose sont préfixés `COMPOSE_*` pour ne jamais entrer en collision avec les variables du même nom dans le `.env` de l'app). Toujours invoqué via le Makefile (`docker compose --env-file .env.docker ...`), jamais manuellement sans ce flag.

- `POSTGRES_DB`, `POSTGRES_USER`, `POSTGRES_PASSWORD`
- `COMPOSE_APP_SECRET`
- `HTTP_PORT` (port hôte exposé pour `web`, défaut `8080`)

### `.env.prod` (jamais committé, un seul fichier, vit uniquement sur le serveur)

L'app elle-même n'a besoin d'aucun fichier `.env` en production — `app_prod` tourne uniquement avec de vraies variables d'environnement injectées par Docker Compose. `.env.prod` est donc le **seul** fichier à créer pour déployer : il fournit ces variables à `docker compose` (substitution `${...}`), qui les repasse ensuite au conteneur. Créé une fois, à la main, directement sur le serveur — jamais dans le repo.

```env
POSTGRES_PASSWORD=<mot de passe long et aléatoire>
COMPOSE_APP_SECRET=<32+ caractères aléatoires, généré indépendamment des valeurs de dev>
HTTP_PORT=8080
```

Génération de valeurs aléatoires : `openssl rand -hex 32`.

`COMPOSE_DATABASE_URL` est optionnel, uniquement si vous pointez vers une base externe plutôt que le service `database` du compose.

Déploiement :
```bash
make prod-build
make prod-up
```

Une variable manquante dans `.env.prod` fait échouer `docker compose` immédiatement (`Set COMPOSE_APP_SECRET ...`) plutôt que de démarrer avec une valeur par défaut non sécurisée. `.env.prod` reste distinct de `.env.docker` (dev) pour ne jamais mélanger placeholders et vrais secrets.

## Architecture Docker

- `Dockerfile` multi-stage : `vendor` (composer, prod uniquement), `frontend_build` (Webpack Encore), `app_prod` (PHP-FPM non-root, immuable), `app_dev` (root — voir note ci-dessous), `nginx_prod` (assets baked-in, aucun volume).
- `compose.yaml` : socle (builds, dépendances, wiring). Ne suffit pas seul en prod sans son overlay de durcissement.
- `compose.override.yaml` : auto-fusionné par `docker compose up` — bind mounts, ports exposés, watcher Node.
- `compose.prod.yaml` : overlay de durcissement prod (`read_only`, `cap_drop: [ALL]`, `tmpfs`), combiné explicitement (`make prod-up`), **jamais** auto-fusionné. Séparé du socle exprès : Docker Compose fusionne les clés de type liste (`cap_drop`, `tmpfs`) par concaténation, pas par remplacement — si ces restrictions vivaient dans `compose.yaml`, `compose.override.yaml` ne pourrait pas les retirer pour le développement.
- `docker/nginx/conf.d/default.conf` : seul `index.php` est routé vers PHP-FPM ; toute autre requête `*.php` (ex. un nom de fichier deviné sous un dossier d'upload) est rejetée en 404 sans jamais atteindre PHP-FPM — c'est la protection de fond contre une éventuelle exécution de fichier uploadé.

**Pourquoi `app_dev` tourne en root** : Docker Desktop pour Windows ne préserve pas de façon fiable les droits d'écriture de l'utilisateur uid 1000 du conteneur sur les sous-répertoires qu'il crée lui-même à l'intérieur d'un bind mount (`mkdir`/écriture ultérieure échouent en `Permission denied` après un aller-retour host↔conteneur). `app_prod`/`nginx_prod` — ce qui est réellement déployé — restent non-root ; seul le conteneur de dev local, qui ne monte jamais que l'arborescence source bind-mountée, tourne en root.

## Points connus / dette restante

- **Images dev/prod nommées séparément** (`mathindex-app-prod` etc. dans `compose.prod.yaml`) : sans ça, `app`/`web`/`migrate` de dev (target `app_dev`) et de prod (target `app_prod`) partagent le même nom d'image par défaut (`mathindex-app:latest`) — builder l'un écrase le tag de l'autre. Symptôme si ça se reproduit avec un nouveau service : `docker compose run` en dev tourne soudainement en `USER app` non-root au lieu de root, avec des erreurs `Permission denied` qui n'ont rien d'évident.
- **Pas de mail** : `symfonycasts/verify-email-bundle` a été retiré (installé mais jamais utilisé nulle part dans `src/`), et `config/packages/mailer.yaml` force `null://null`. Aucun `MAILER_DSN`/`COMPOSE_MAILER_DSN` nulle part dans le projet ni dans les fichiers d'env. À réintroduire si une fonctionnalité a besoin d'envoyer un email.

- **`npm audit`** : 8 vulnérabilités restantes (7 moderate, 1 high) après `npm audit fix`, toutes dans l'outillage de build dev-only (`webpack-dev-server`, `webpack-notifier`, `css-minimizer-webpack-plugin` — aucune ne s'exécute en production). La résolution complète nécessite `npm audit fix --force`, qui bascule `@symfony/webpack-encore` vers une version majeure (7.x) non testée dans cette session — à valider séparément avant de l'appliquer.
- **`config/packages/csrf.yaml`** (recipe Symfony pour la CSRF "stateless") a été retiré : il générait un jeton CSRF invalide en environnement de conteneur (chaîne littérale au lieu d'un jeton aléatoire), cassant le login. L'app utilise la protection CSRF classique basée sur la session, cohérente avec le reste du code existant (`isCsrfTokenValid()` un peu partout).
- Deux valeurs `APP_SECRET` et une chaîne de connexion DB ont été committées puis supprimées dans l'historique Git (commits `b1bd625`/`22fabf5`/`6845634`). Elles ne sont plus utilisées nulle part dans le code actuel, mais restent lisibles dans `git log`/`git show` pour quiconque a accès au dépôt — si ce dépôt devient public ou change de visibilité, envisager de purger l'historique (`git filter-repo`) ou simplement s'assurer qu'aucune de ces valeurs n'est jamais réutilisée.
