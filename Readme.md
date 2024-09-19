# Task Assignment Web Application

This Laravel web application fetches to-do tasks from two separate providers and allocates them weekly to a development team. The application includes features for managing providers, tasks, and calculating the optimal task assignments based on developer capacities and task complexities.

## Features

- Fetch and manage tasks from multiple providers.
- Assign tasks to developers based on their capacity and difficulty.
- Display weekly task allocations and estimate completion times.
- Add, remove, and update providers via API endpoints.
- View assigned tasks and provider details through web routes.

## Task Allocation Details

Tasks are fetched from two providers, each providing the following information:
- **Task Name**
- **Duration** (in hours)
- **Difficulty Level**

The development team consists of 5 developers with the following capacities:
- **DEV1:** Can complete 1x difficulty task in 1 hour.
- **DEV2:** Can complete 2x difficulty task in 1 hour.
- **DEV3:** Can complete 3x difficulty task in 1 hour.
- **DEV4:** Can complete 4x difficulty task in 1 hour.
- **DEV5:** Can complete 5x difficulty task in 1 hour.

Each developer works 45 hours per week. The application calculates the optimal assignment of tasks to minimize the total completion time and displays a weekly task schedule.

## Installation

To set up the project, follow these steps:

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/your-repo/your-project.git
   cd your-project
   
2. **Install Dependencies:**
   ```bash
   composer install
 
3. **Copy Environment File::**
   ```bash
   cp .env.example .env

4. **Generate Application Key:**
   ```bash
   php artisan key:generate

5. **Run Migrations:**
   ```bash
   php artisan migrate

6. **Seed the Database: Ensure to seed the database with developers and providers:**
   ```bash
   php artisan db:seed

5. **Run the Application:**
   ```bash
   php artisan serve

## Commands

A command named FetchTasks has been created to fetch tasks from providers and store them in the database. To run this command, use:

    php artisan fetch:tasks
    
 
## Routes
Web Routes
Providers List:
GET /providers
Displays the list of providers.

### Tasks List:
GET /tasks
Displays the list of tasks.

### Assigned Tasks List:
GET /assigned-list
Shows the task assignments for developers.

### API Routes
Create Provider:
POST /providers
Creates a new provider.

### Update Provider:
PUT /providers
Updates an existing provider.

### Delete Provider:
DELETE /providers/{id}
Deletes a provider.

### Get All Providers:
GET /providers/all
Retrieves all providers.

### Get Provider By ID:
GET /providers/{id}
Retrieves a provider by ID.

## Contributing
Feel free to open issues or submit pull requests if you want to contribute to the project.
