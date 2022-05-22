    
  
### How To Get Started

- ** git clone repository 

- ** run command composer install

- ** touch .env 

- ** add database with name of your choice

- ** run command php artisan migrate

- ** run command php artisan db:seed

- ** this will seed database with dummy data regarding a number of customers && items

- ** hit requests according to postman collection attached to begin cycle

- ** cycle includes ((((

- ** fetch all items (products) to purchase from
- ** add to cart
- ** remove from cart
- ** show cart items (count && total && details)
- ** update quantity
- ** place transaction

)))))

- ** some requests which needs being authenticated requires customer_id as validation

- ** we can type any id of earlier seeded customers 

- ** update cart step hits same request of add to cart as it checks for item existence and then update


### Laravel Version Used 

- ** 8.83.13