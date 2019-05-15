# Technology Stack

-   PHP / Laravel (require composer to install dependencies)

# Setting up

-   `composer install` (require composer)
-   Rename `.env.example` to `.env`

# To Run

-   `php artisan serve`. Then the app can be accessed at http://localhost:8000

# Assumption

-   MicroSense is running at localhost:3000

# Differs from the instructions

-   I designed the Jobs in a different way: each reader has its own operation options just so that an user can schedule a different operation on each available reader
-   Because of that, the data being posted to the `POST /jobs` endpoint is not going to be `operation [String]` and `readers [Array]`. (Also because I didn't realize that there's a specification on the data being posted until later)
-   The Error / Warning message is always being displayed as opposed to showing up after the user submit the form.
-   There will be error messages from the data validation being displayed on the top if there's any error.
-   Instructions say I'm tasked to develop a frontend application, but instead, I picked a backend framework.

# Files that I worked on

-   `App\Http\Controllers\*`
-   `resources\views\*`
-   `routes\web.php`

# Testing

-   I know you mentioned that I didn't have to write any testing, but I really wanted to give it a shot and see what I can come up with within half a day. And there're some tests in `tests\Unit\` folder. They probablly seem child's play but I tried at least :)
-   Laravel is using PHPUnit as testing framework.

# Reasonings

-   I picked a backend technology instead of a straight up frontend framework (React) because I prefer to process/manipulate the data on the backend, letting the controllers do what they're supposed to. I guess it's not showcasing asynchronous as much as it would have if I used React.
-   I could've picked React as the frontend for this but that would've defeated the purpose of me using Laravel.
-   I have a separate controller for each "Model": Health, Operation, Reader, even though there's no model defined. And the reason is that I thought about having CRUD operations on each model. For instance, you may want to add another Operation option in the future, or update / delete the Health issues.
-   ReaderController is joining the models together and send the data to the frontend.
