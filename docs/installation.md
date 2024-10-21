# **Project Installation Documentation**

This documentation provides step-by-step instructions to install and configure the project for the first time. The installation script ensures the environment is correctly set up with necessary dependencies, configurations, and database creation.

---

## **Pre-requisites**

Make sure you have the following installed and configured on your system:

1. **PHP**: Version compatible with Laravel.
2. **Composer**: For managing PHP dependencies.
3. **MySQL/MariaDB**: For database management.
4. **Node.js and npm**: For frontend dependencies and build.
5. **Git**: For version control.
6. **Supervisor**: For process management (if needed).

---

## **Installation Steps**

### 1. Clone the Project Repository

```bash
git clone <repository-url> project-directory
cd project-directory
```

Replace `<repository-url>` with the actual repository URL.

---

### 2. Run the Installation Script

Run the script:

```bash
./bin/install
```

---

## **What the Script Does**

1. **Database Creation:**
   - Checks if the database exists.
   - If not, it creates a database using the directory name converted to **snake_case**.

   **Example:**
   If the project directory is `loop-tag`, the database will be named `loop_tag`.

2. **Environment Configuration:**
   - Updates `.env.example` with:
     - **APP_NAME** in **Title Case** (e.g., `Loop Tag`).
     - **DB_DATABASE** in **snake_case** (e.g., `loop_tag`).
   - Copies `.env.example` to `.env` and generates an application key if `.env` does not exist.

3. **Composer Dependencies Installation:**
   - Installs Composer dependencies if the `vendor/` directory is missing.
   - Runs `update-dependencies` script if present.

4. **NPM Dependencies Installation:**
   - Installs and builds npm dependencies if `node_modules/` is not available.
   - Commits changes to the `public/` directory if modified after the build.

5. **Supervisor Configuration Update:**
   - Updates `.config/supervisord.ini` with:
     - **Command path:**
       `command=php /var/www/<project-name>/artisan horizon` (kebab-case directory name).
     - **Log file path:**
       `stdout_logfile=/var/log/supervisor/<project-name>-horizon.log` (kebab-case log file).
   - Commits the changes to `.config/supervisord.ini` if any updates are made.

6. **README.md Update:**
   - Replaces:
     - The default **GitHub URL** with the project’s remote URL.
     - **"Project Template"** with the project name in **Title Case**.
   - Commits changes to `README.md` if modified.

---

## **Usage After Installation**

Once the installation is complete, the environment is ready. You can:

- Start the Laravel development server:

  ```bash
  php artisan serve
  ```

---

## **File Structure**

```plaintext
project-directory/
├── .config/
│   └── supervisord.ini  # Supervisor configuration file
├── .env.example         # Environment configuration template
├── README.md            # Project documentation
├── .config/
│   └── install          # Installation script
├── vendor/              # Composer dependencies (auto-installed)
├── node_modules/        # NPM dependencies (auto-installed)
└── public/              # Public assets (build generated)
```

---

## **Customization**

- **Database Credentials:**
  Set your MySQL credentials using environment variables:

  ```bash
  export DB_USERNAME='your-username'
  export DB_PASSWORD='your-password'
  export DB_HOST='localhost'
  ```

- **Supervisor Configuration:**
  Adjust `.config/supervisord.ini` to meet your requirements if needed.

---

## **Troubleshooting**

1. **Permission Issues:**
   Ensure the script has execute permissions:

   ```bash
   chmod +x install.sh
   ```

2. **Database Access Error:**
   Verify that the MySQL credentials are correct and the MySQL service is running:

   ```bash
   sudo systemctl start mysql
   ```

3. **Dependency Installation Failure:**
   Ensure Composer and npm are installed:

   ```bash
   composer --version
   npm --version
   ```

4. **Supervisor Issues:**
   If Horizon doesn’t start, check the Supervisor logs:

   ```bash
   tail -f /var/log/supervisor/<project-name>-horizon.log
   ```

---

## **Conclusion**

This script automates the project setup by:

- Creating necessary configurations.
- Installing dependencies.
- Building the frontend.
- Setting up Supervisor and database connections.

If everything is configured correctly, the project will be ready to use. If you encounter any issues, refer to the troubleshooting section or consult the README.md for more details.
