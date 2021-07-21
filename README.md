# Qunatox PHP Assesment

### Set up the project

- Clone the project to your local repository [Link](https://github.com/chrix95/quantox-assessment.git)
- Rename the `.env.sample` file to `.env`
- Update all variables within the `.env` file
```
DATABASE_HOST=
DATABASE_PORT=3306
DATABASE_NAME=
DATABASE_USERNAME=
DATABASE_PASSWORD=
```
- Create database on your local machine and import the dump file `quantox.sql` within the root directory
- Install all depencies
```bash
composer install
```
- Start the project using the command below:
```bash
php -S 127.0.0.1:8000 -t public
```

### Test the endpoint
- Use the url below:
```GET
http://127.0.0.1:8000/students/{student_id}
```

### Contributors
- [Email](mailto:engchris95@gmail.com)