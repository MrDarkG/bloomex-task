<center> 
    <img src="https://bloomex.ca/templates/bloomex_adaptive/images/Bloomex_logo.svg" alt="Bloomex" width="200" height="200" > 
</center>

# Bloomex test task

## Installation

After cloning the repository, you need to start docker: Run 
```bash
$ docker-compose build
$ docker-compose up -d
```
in the root directory of the project.
this should install all the dependencies and start the server.

After successfully running that command please create a `.env` file in the root directory of the project and copy the
contents of the `.env.example` file into it and fill empty fields like.

```dotenv
REDMINE_ENABLED= # if you want  to use redmine integration set this to true
REDMINE_URL=
REDMINE_API_KEY=
````

P.s you need to have redmine project with issues to use this feature.

After that you need to run the following commands to set up the database:

```bash
$ docker-compose exec bloomex.web php artisan migrate:fresh --seed
```

## Usage

After the installation, you can access the application by visiting <a href="localhost">`http://localhost`</a> in your
browser.

Default credentials are:

```dotenv
email: admin@test.com
password: password
```

## Testing

To run the tests, you need to run the following command:

```bash
$ docker-compose exec bloomex.web php artisan test --filter=unit
```
