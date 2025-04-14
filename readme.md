# Web Magazine App 📰

Web application in PHP and MySQL to manage and display a school magazine, with categories, articles, keywords, and more.

## 🐳 Docker Configuration

This project includes a Docker-based environment to easily run the application and import the initial schema (`schema.sql`).

### 🧱 Requirements

- Docker
- Docker Compose

### 🚀 How to Run

1. Clone the repository:

    ```bash
    git clone https://github.com/lastxxix/simple-school-magazine.git
    cd simple-school-magazine
    ```

2. Make sure you have the `schema.sql` file in the root folder.

3. Start the containers:

    ```bash
    docker-compose up --build
    ```

4. Visit the PHP application at http://localhost:8000

### 🗄️ MySQL Information

- **Host:** mysql
- **User:** user
- **Password:** userpassword
- **Database:** giornalino

### 👥 Database Users

For production environments, you should create different database accounts with specific permissions:

- **Reader:** Read-only access to articles and public content
- **Writer:** Permission to create and edit their own articles
- **Admin:** Full access to manage all content, categories, and users

### 🔐 User Permissions

- **Reader:** Default role for new users. Can only read content.
- **Writer:** Can create posts, which must be approved before appearing on the homepage.
- **Validator:** Can approve posts created by writers.
- **Admin:** Full access to all features, including the `/users` page where they can assign writer and validator permissions to other users.

> Note: Some content and labels may appear in Italian as this was originally a school project.