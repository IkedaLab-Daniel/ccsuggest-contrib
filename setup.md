# CCSuggest Tech Recommendation System - Setup Guide

## 📋 Prerequisites

Before starting, ensure you have the following installed:

- **XAMPP** (for MySQL and Apache)
- **PHP 8.0.2+** (comes with XAMPP)
- **Composer** (PHP package manager)
- **Node.js 16+** and **npm** (for Laravel Vite assets)
- **Python 3.11.13** (specific version required)
- **Git** (for version control)

## 🗄️ Database Setup (MySQL with XAMPP)

### 1. Install and Start XAMPP

1. Download XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. Install XAMPP following the installer instructions
3. Start the XAMPP Control Panel
4. Start **Apache** and **MySQL** services

### 2. Import Database

1. Open your web browser and go to [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Click on **"Databases"** tab
3. Create a new database named `demo_project`:
   - Database name: `demo_project`
   - Collation: `utf8mb4_unicode_ci`
   - Click **"Create"**
4. Select the newly created `demo_project` database
5. Click on the **"Import"** tab
6. Click **"Choose File"** and select the `ccsuggest.sql` file from the project root
7. Click **"Go"** to import the database
8. Verify the import was successful (you should see multiple tables created)

### 3. Configure Database Connection

The project is configured to use MySQL on port 3307 by default. If your XAMPP MySQL runs on port 3306, you'll need to adjust the configuration later in the Laravel setup.

## 🎯 Laravel Setup

### 1. Clone the Repository

```bash
git clone <repository-url>
cd vince
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Environment Configuration

```bash
# Copy the environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Environment Variables

Edit the `.env` file and update the database configuration:

```env
APP_NAME=CCSuggest
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database Configuration (adjust port if needed)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=demo_project
DB_USERNAME=root
DB_PASSWORD=

# If your XAMPP MySQL uses port 3307, use:
# DB_PORT=3307
```

**Note**: Since we're importing the database directly via phpMyAdmin, we skip Laravel migrations.

### 5. Install Node.js Dependencies (Optional)

```bash
npm install
```

**Note**: This project uses Tailwind CSS and Alpine.js via CDN, so npm dependencies are optional for basic functionality.

### 6. Build Frontend Assets (Optional)

```bash
# For development (only if you plan to modify CSS/JS)
npm run dev

# For production (only if you plan to modify CSS/JS)
npm run build
```

**Note**: Since the app uses CDN-based styling (Tailwind CSS) and JavaScript (Alpine.js), you can skip this step for basic usage.

### 7. Set Up Storage and Permissions

```bash
# Create storage link for public files
php artisan storage:link

# Set proper permissions (Linux/Mac)
chmod -R 775 storage bootstrap/cache

# On Windows, ensure the web server has write access to these directories
```

### 8. Test Laravel Installation

```bash
# Start the Laravel development server
php artisan serve
```

Visit [http://localhost:8000](http://localhost:8000) to verify Laravel is running.

## 🐍 Python Flask Backend Setup

### 1. Navigate to Backend Directory

```bash
cd backend
```

### 2. Create Python Virtual Environment

```bash
# Create virtual environment with Python 3.11.13
python3.11 -m venv venv

# Activate virtual environment
# On Windows:
venv\Scripts\activate

# On Linux/Mac:
source venv/bin/activate
```

### 3. Install Python Dependencies

```bash
# Ensure virtual environment is activated
pip install -r requirements.txt
```

### 4. Configure Flask Environment

Create a `.env` file in the `backend` directory:

```bash
# backend/.env
FLASK_APP=app.py
FLASK_ENV=development
DATABASE_URL=mysql://root:@localhost:3306/demo_project

# Adjust port if your MySQL runs on 3307:
# DATABASE_URL=mysql://root:@localhost:3307/demo_project
```

### 5. Test Flask Installation

```bash
# Ensure you're in the backend directory with venv activated
python app.py
```

The Flask service should start on [http://localhost:5001](http://localhost:5001)

## 🚀 Running the Complete System

### 1. Start All Services

You need to run these services simultaneously:

**Terminal 1 - XAMPP Services:**
- Start Apache and MySQL from XAMPP Control Panel

**Terminal 2 - Laravel:**
```bash
cd /path/to/project
php artisan serve
# Runs on http://localhost:8000
```

**Terminal 3 - Laravel Assets (Optional - only if modifying CSS/JS):**
```bash
cd /path/to/project
npm run dev
# Only needed if you're actively developing frontend assets
```

**Terminal 4 - Flask ML Service:**
```bash
cd /path/to/project/backend
source venv/bin/activate  # or venv\Scripts\activate on Windows
python app.py
# Runs on http://localhost:5000
```

### 2. Access the Application

- **Main Application**: [http://localhost:8000](http://localhost:8000)
- **Admin Panel**: [http://localhost:8000/admin](http://localhost:8000/admin)
- **Flask API**: [http://localhost:5001](http://localhost:5001)
- **phpMyAdmin**: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)

## 🔧 Configuration Details

### Laravel Configuration

Key configuration files:
- `.env` - Environment variables
         - Kung wala pa ".env" file, rename niyo lang ".env.example" to ".env" 
- `config/database.php` - Database configuration
- `config/app.php` - Application settings

### Flask Configuration

Key files:
- `backend/app.py` - Main Flask application
- `backend/requirements.txt` - Python dependencies
- `backend/.env` - Flask environment variables

### Database Schema

The `ccsuggest.sql` file contains:
- User management tables
- Question and questionnaire tables
- Recommendation system tables
- Survey response tables
- Sample data for testing

### Frontend Architecture

This project uses a **CDN-based approach** for frontend assets:
- **Tailwind CSS**: Loaded via CDN for styling
- **Alpine.js**: Loaded via CDN for JavaScript interactivity
- **No build process required**: The app works without npm compilation

**When you DO need npm:**
- Modifying `resources/css/app.css` or `resources/js/app.js`
- Adding custom CSS/JS that needs compilation
- Preparing for production deployment with optimized assets

**When you DON'T need npm:**
- Basic usage and testing
- Using the app as-is without frontend modifications
- Quick setup and demonstration

## 🛠️ Troubleshooting

### Common Issues and Solutions

**1. Database Connection Error**
- Verify XAMPP MySQL is running
- Check database name and credentials in `.env`
- Ensure the database was imported correctly

**2. Laravel Key Error**
```bash
php artisan key:generate
```

**3. Permission Errors (Linux/Mac)**
```bash
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R $USER:www-data storage bootstrap/cache
```

**4. Python Virtual Environment Issues**
```bash
# Deactivate and recreate
deactivate
rm -rf venv
python3.11 -m venv venv
source venv/bin/activate
pip install -r requirements.txt
```

**5. Node.js Asset Compilation Issues**
```bash
rm -rf node_modules package-lock.json
npm install
npm run dev
```

**6. Flask Import Errors**
- Ensure virtual environment is activated
- Verify Python version: `python --version` should show 3.11.x
- Reinstall requirements: `pip install -r requirements.txt`

### Port Conflicts

If you encounter port conflicts:
- Laravel: Change in `php artisan serve --port=8080`
- Flask: Modify `app.py` port configuration
- MySQL: Update `.env` DB_PORT setting

## 🎯 Default Users

After database import, you can log in with:

**Admin Account:**
- Email: `admin@manage.com`
- Password: `123123123`

**Student Account:**
- Email: `ice@music.com`
- Password: `123123123`

## 📚 System Features

Once setup is complete, you can:

1. **Student Features:**
   - Take technology aptitude questionnaire
   - Receive AI-powered career recommendations
   - View and download recommendation reports
   - Provide feedback through surveys

2. **Admin Features:**
   - Manage users and questions
   - View system analytics
   - Monitor survey responses
   - Export data and reports

3. **ML Backend:**
   - Decision tree-based recommendations
   - Model training and retraining
   - RESTful API for predictions

## 🔄 Development Workflow

For basic usage (most common):

```bash
# Minimal setup - only 2 terminals needed:
# Terminal 1: XAMPP (Apache + MySQL)
# Terminal 2: php artisan serve
# Terminal 3: cd backend && source venv/bin/activate && python app.py
```

For active frontend development:

```bash
# Full development environment - 4 terminals:
# Terminal 1: XAMPP (Apache + MySQL)
# Terminal 2: php artisan serve
# Terminal 3: npm run dev (only if modifying CSS/JS)
# Terminal 4: cd backend && source venv/bin/activate && python app.py
```

## 📖 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Flask Documentation](https://flask.palletsprojects.com/)
- [XAMPP Documentation](https://www.apachefriends.org/docs/)
- [Composer Documentation](https://getcomposer.org/doc/)

---

**Need Help?** Chat niyo lang ako guys!
