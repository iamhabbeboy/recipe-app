# Recipe Posting App
### Setup 
`composer install && npm install`

## Migration & Seeder
`php artisan migrate`, 

Then run seeder by inserting dummy data for test using 
> Please run each seeder seperately to avoid foreign key errors
`php artisan db:seed --class=UserSeeder, IngredientSeeder, NutritionSeeder, & ProcedureSeeder

## Test Users
