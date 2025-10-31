# Laravel Application Documentation
## Tech Field Recommendation System

This documentation explains how the Laravel application works, its architecture, and key components.

---

## Table of Contents
1. [Overview](#overview)
2. [Application Architecture](#application-architecture)
3. [Database Structure](#database-structure)
4. [User Authentication & Authorization](#user-authentication--authorization)
5. [Core Features](#core-features)
6. [Controllers](#controllers)
7. [Models & Relationships](#models--relationships)
8. [Routes](#routes)
9. [Frontend](#frontend)
10. [Services](#services)
11. [Admin Panel](#admin-panel)
12. [Student Dashboard](#student-dashboard)
13. [API Integration](#api-integration)
14. [Configuration](#configuration)

---

## Overview

The Laravel application is a **Tech Field Recommendation System** that helps students discover their ideal technology career path through an interactive questionnaire. The system uses machine learning to analyze responses and provide personalized recommendations with integrated user feedback collection.

### Key Features:
- **User Authentication** (Registration, Login, Password Reset)
- **Role-based Access Control** (Students, Admins)
- **Interactive Questionnaire** with multiple question types
- **ML-powered Recommendations** via Flask microservice
- **Client Survey System** for collecting user feedback and satisfaction ratings
- **Admin Dashboard** for managing users, questions, and system data
- **Survey Analytics Dashboard** with comprehensive reporting and data visualization
- **Student Results** with downloadable PDF reports
- **Learning Roadmaps** for each tech field

---

## Application Architecture

The application follows **Laravel's MVC (Model-View-Controller)** pattern:

```
Laravel App
├── Models (Data & Business Logic)
├── Controllers (Request Handling)
├── Views (Blade Templates)
├── Routes (URL Routing)
├── Services (External Integrations)
├── Middleware (Request Filtering)
└── Database (MySQL)
```

### External Dependencies:
- **Flask Microservice** (ML predictions at `http://127.0.0.1:5001`)
- **MySQL Database** (Data storage)
- **Tailwind CSS + Alpine.js** (Frontend styling & interactivity)

---

## Database Structure

### Core Tables:

1. **users** - User accounts (students and admins)
2. **tech_fields** - Available technology fields (11 fields)
3. **questions** - Questionnaire questions (70 questions)
4. **question_options** - Multiple choice options for questions
5. **responses** - User answers to questions
6. **recommendations** - ML-generated field recommendations
7. **student_profiles** - Additional student information
8. **roles** - User roles (student, admin)
9. **user_survey_responses** - Client feedback surveys with satisfaction ratings

### Key Relationships:
- `User` → `StudentProfile` (1:1)
- `User` → `Recommendations` (1:Many)
- `User` → `Responses` (1:Many)
- `User` → `UserSurveyResponse` (1:1)
- `Question` → `QuestionOptions` (1:Many)
- `Question` → `TechField` (Many:1, optional)

---

## User Authentication & Authorization

### Authentication Flow:
1. **Registration** (`/register`) - New users sign up
2. **Login** (`/login`) - Users authenticate
3. **Dashboard Redirect** - Based on user role:
   - Students → `/dashboard` (Student Dashboard)
   - Admins → `/admin/dashboard` (Admin Panel)

### Role-based Access:
- **Students**: Can take questionnaire, view results, download reports
- **Admins**: Full system access, user management, question management

### Password Security:
- Strong password validation (8+ chars, uppercase, lowercase, number, symbol)
- Laravel's built-in password hashing
- Password reset via email

---

## Core Features

### 1. Questionnaire System
**Location**: `/questionnaire`

**Flow**:
1. Student starts questionnaire (`StudentController@showQuestionnaire`)
2. Frontend loads 70 questions via Alpine.js
3. Student submits answers (`StudentController@submitQuestionnaire`)
4. Responses saved to database
5. ML prediction triggered via `DecisionTreeService`
6. Recommendations stored and displayed

**Question Types**:
- **Scale** (1-5 Likert scale)
- **Single Choice** (radio buttons)
- **Multiple Choice** (checkboxes)

### 2. ML Integration
**Service**: `DecisionTreeService`

**Process**:
1. Laravel collects user responses
2. Formats data for Flask API
3. Sends HTTP request to Flask service
4. Receives field scores/predictions
5. Stores recommendations in database

### 3. Results & Reporting
**Location**: `/results`

**Features**:
- Top recommended tech fields with scores
- Detailed field descriptions
- Learning roadmaps for each field
- PDF download functionality
- Visual progress indicators
- **Integrated Client Survey Form** for collecting user feedback
- Post-completion thank you message

### 4. Client Survey System
**Purpose**: Collect user feedback and satisfaction ratings

**Features**:
- **Satisfaction Rating** (1-5 star scale)
- **Recommendation Likelihood** (Yes/No)
- **Open Feedback** text area
- **Improvement Suggestions** text area
- **One-time Survey** (shown only to users who haven't completed it)
- **Responsive Design** with consistent styling

**Integration**:
- Embedded in the results page
- Always visible (no toggle required)
- Submitted via AJAX with real-time validation
- Data stored in `user_survey_responses` table

---

## Controllers

### Student Controllers

#### `StudentController`
**Key Methods**:
- `dashboard()` - Main student dashboard
- `showQuestionnaire()` - Display questionnaire form
- `submitQuestionnaire()` - Process questionnaire submission
- `results()` - Show recommendation results with survey integration
- `downloadResults()` - Generate PDF report
- `editProfile()` / `updateProfile()` - Profile management
- `submitSurvey()` - **New**: Handle client survey submissions

### Admin Controllers

#### `Admin/UserController`
- CRUD operations for user management
- User creation, editing, deletion
- User listing with pagination

#### `Admin/QuestionController`
- CRUD operations for questions
- Question option management
- Tech field assignment

#### `Admin/SystemDataController`
- ML model retraining
- System statistics
- Data export functionality

#### `Admin/SurveyController`
**New Controller for Survey Analytics**
- `index()` - Display comprehensive survey analytics dashboard
- `export()` - Export survey data as CSV
- `destroy()` - Delete individual survey responses
- Statistical calculations and data visualization
- Monthly trend analysis
- User satisfaction breakdowns

#### `Admin/DashboardController`
- Main admin dashboard with system overview
- User statistics and quick access cards
- Survey response count integration

### Authentication Controllers

#### `Auth/LoginController`
- User login handling
- Role-based redirects
- Session management

#### `Auth/RegisterController`
- New user registration
- Email validation
- Password confirmation

---

## Models & Relationships

### Core Models:

#### `User`
```php
// Relationships
hasOne(StudentProfile::class)
hasMany(Recommendation::class)
hasMany(Response::class)
hasOne(UserSurveyResponse::class)  // New survey relationship
belongsToMany(Role::class)

// Key Attributes
name, email, password
```

#### `UserSurveyResponse` **[New Model]**
```php
// Relationships
belongsTo(User::class)

// Key Attributes
user_id, satisfaction_rating, would_recommend, 
feedback, improvements, created_at, updated_at
```

#### `Question`
```php
// Relationships
hasMany(QuestionOption::class)
belongsTo(TechField::class)
hasMany(QuestionFlow::class)

// Key Attributes
text, type, tech_field_id
```

#### `Recommendation`
```php
// Relationships
belongsTo(User::class)
belongsTo(TechField::class)

// Key Attributes
user_id, tech_field_id, score
```

#### `Response`
```php
// Relationships
belongsTo(User::class)
belongsTo(Question::class)

// Key Attributes
user_id, question_id, value
```

---

## Routes

### Web Routes (`routes/web.php`)

#### Public Routes:
- `GET /` - Welcome page
- `GET /login` - Login form
- `POST /login` - Login processing
- `GET /register` - Registration form
- `POST /register` - Registration processing

#### Student Routes (Authenticated):
- `GET /dashboard` - Student dashboard
- `GET /questionnaire` - Questionnaire form
- `POST /questionnaire` - Submit questionnaire
- `GET /results` - View recommendations with survey form
- `GET /results/download` - Download PDF
- `POST /survey/submit` - **New**: Submit client feedback survey
- `GET /profile` - Edit profile
- `POST /profile` - Update profile

#### Admin Routes (Authenticated + Admin Role):
- `GET /admin/dashboard` - Admin dashboard with survey statistics
- Resource routes for users: `/admin/users/*`
- Resource routes for questions: `/admin/questions/*`
- **New Survey Routes**:
  - `GET /admin/surveys` - Survey analytics dashboard
  - `GET /admin/surveys/export` - Export survey data as CSV
  - `DELETE /admin/surveys/{survey}` - Delete survey response
- `POST /admin/system/retrain` - Trigger ML retraining

#### API Routes (`routes/api.php`):
- `GET /api/questions` - Get questions (JSON)

---

## Frontend

### Technology Stack:
- **Blade Templates** (Laravel's templating engine)
- **Tailwind CSS** (Utility-first CSS framework)
- **Alpine.js** (Lightweight JavaScript framework)

### Key Frontend Components:

#### Layout Templates:
- `layouts/app.blade.php` - Main application layout
- `layouts/student.blade.php` - Student-specific layout
- `layouts/admin.blade.php` - Admin-specific layout

#### Interactive Elements:
- **Questionnaire Form** - Dynamic question rendering with Alpine.js
- **Survey Form** - Client feedback collection with real-time submission
- **Loading Modals** - Form submission feedback
- **Password Validation** - Real-time password strength checking
- **AJAX Forms** - Seamless form submissions without page reload
- **Responsive Navigation** - Mobile-friendly menus
- **Survey Analytics Charts** - Visual data representation for admin dashboard

#### Styling Features:
- **Gradient Backgrounds** - Consistent visual theme
- **Card-based Layouts** - Clean, modern design
- **Form Validation** - Inline error messages
- **Hover Effects** - Interactive UI elements
- **Custom Components** - Reusable UI patterns

---

## Services

### `DecisionTreeService`
**Purpose**: Bridge between Laravel and Flask ML service

**Key Methods**:
- `predictForUser(int $userId)` - Generate recommendations for user
- `retrain()` - Trigger ML model retraining
- `pivotResponses()` - Format data for ML service

**Configuration**:
- Base URI: `DTREE_API` environment variable
- Default: `http://127.0.0.1:5001`
- Timeout: 10 seconds

---

## Survey System **[New Feature]**

The application includes a comprehensive survey system for collecting user feedback and satisfaction data.

### Client-Side Survey Form

**Location**: Integrated into `/results` page
**Purpose**: Collect user feedback after recommendation generation

**Features**:
- **Always Visible**: No toggle required, displayed as a card on the results page
- **One-time Survey**: Only shown to users who haven't completed it
- **Responsive Design**: Adapts to mobile and desktop layouts
- **Real-time Validation**: Immediate feedback on form submission
- **AJAX Submission**: No page reload required

**Form Fields**:
1. **Satisfaction Rating** (Required)
   - 1-5 star rating scale
   - Visual star interface
   - "How satisfied are you with your recommendations?"

2. **Recommendation Likelihood** (Required)
   - Yes/No radio buttons
   - "Would you recommend this system to others?"

3. **General Feedback** (Optional)
   - Text area for open comments
   - "Please share your thoughts about the recommendations"

4. **Improvement Suggestions** (Optional)
   - Text area for specific suggestions
   - "How can we improve this system?"

### Admin Survey Analytics

**Location**: `/admin/surveys`
**Purpose**: Comprehensive survey data analysis and management

**Dashboard Features**:

1. **Quick Statistics Cards**:
   - Total survey responses
   - Response rate (completed surveys / total users)
   - Average satisfaction rating with star display
   - Recommendation rate (% who would recommend)

2. **Visual Analytics**:
   - **Satisfaction Distribution**: Horizontal bar chart showing rating breakdown
   - **Recommendation Split**: Pie chart showing Yes/No recommendation percentages
   - **Progress Indicators**: Visual representation of satisfaction levels

3. **Recent Feedback Section**:
   - Latest survey responses with user details
   - Star ratings and recommendation badges
   - Full feedback text display
   - Timestamp information

4. **Monthly Trend Analysis**:
   - Historical data table showing monthly statistics
   - Response count and average rating trends
   - Visual progress bars for quick assessment

5. **Complete Data Table**:
   - All survey responses with pagination (15 per page)
   - User information (name, email)
   - Complete survey data (rating, recommendation, feedback, suggestions)
   - Action buttons (view details, delete)
   - Responsive table design

6. **Data Management**:
   - **CSV Export**: Download all survey data
   - **Response Deletion**: Remove individual survey entries
   - **Modal Details View**: Popup with complete survey information

### Technical Implementation

**Models**:
- `UserSurveyResponse`: Stores all survey data
- Relationship: `User hasOne UserSurveyResponse`

**Controllers**:
- `StudentController@submitSurvey()`: Handle survey submissions
- `Admin\SurveyController`: Complete survey analytics management

**Database Schema**:
```sql
user_survey_responses:
- id (primary key)
- user_id (foreign key to users)
- satisfaction_rating (1-5 integer)
- would_recommend (boolean)
- feedback (text, nullable)
- improvements (text, nullable)
- created_at, updated_at (timestamps)
```

**Routes**:
- `POST /survey/submit` - Submit survey (student)
- `GET /admin/surveys` - Analytics dashboard (admin)
- `GET /admin/surveys/export` - CSV export (admin)
- `DELETE /admin/surveys/{survey}` - Delete response (admin)

### Survey Analytics Metrics

The system calculates and displays:

1. **Response Metrics**:
   - Total responses count
   - Response rate percentage
   - Monthly response trends

2. **Satisfaction Analysis**:
   - Average satisfaction rating
   - Rating distribution (1-5 stars)
   - Satisfaction percentage breakdown

3. **Recommendation Analysis**:
   - Percentage who would recommend
   - Yes/No recommendation split
   - Recommendation trends over time

4. **Qualitative Data**:
   - Recent feedback compilation
   - Improvement suggestion analysis
   - User sentiment overview

### Integration Points

1. **Results Page Integration**:
   - Survey form appears in right column on desktop
   - Stacked below results on mobile
   - Conditional display based on completion status

2. **Admin Dashboard Integration**:
   - Survey response count in main dashboard statistics
   - Quick access card to survey analytics
   - Navigation menu includes survey section

3. **User Experience**:
   - Seamless integration with existing flow
   - Thank you message after survey completion
   - Consistent styling with application theme

---

## Admin Panel

### Features:
1. **User Management**
   - View all users with pagination
   - Create new users
   - Edit user details
   - Delete users
   - Password management

2. **Question Management**
   - View all questions
   - Create new questions
   - Edit question text and options
   - Assign questions to tech fields
   - Delete questions

3. **Survey Analytics Dashboard** **[New Feature]**
   - **Comprehensive Statistics**: Total responses, response rates, average satisfaction
   - **Visual Analytics**: Satisfaction rating distribution, recommendation breakdown
   - **Data Visualization**: Pie charts, progress bars, trend analysis
   - **Recent Feedback Display**: Latest user comments with ratings
   - **Monthly Trends**: Historical data analysis over time
   - **Complete Data Table**: All survey responses with user details, pagination
   - **Export Functionality**: CSV download of all survey data
   - **Response Management**: Delete individual survey responses

4. **System Management**
   - Trigger ML model retraining
   - View system statistics with survey metrics
   - Monitor application health
   - Export data

### Security:
- Admin routes protected by authentication middleware
- Role-based access control
- CSRF protection on forms
- Input validation and sanitization

---

## Student Dashboard

### Main Features:
1. **Welcome Section**
   - Personalized greeting
   - Progress overview
   - Quick actions

2. **Questionnaire Access**
   - Start/continue questionnaire
   - Progress tracking
   - Save and resume functionality

3. **Results Display**
   - Top recommended fields
   - Confidence scores
   - Field descriptions
   - Learning roadmaps
   - **Integrated Survey Form** for feedback collection

4. **Profile Management**
   - Edit personal information
   - Update preferences
   - Account settings

5. **Feedback System** **[New Feature]**
   - **Post-recommendation Survey**: Appears after viewing results
   - **Satisfaction Rating**: 1-5 star rating system
   - **Recommendation Feedback**: Would you recommend this system?
   - **Open Comments**: General feedback text area
   - **Improvement Suggestions**: Specific improvement recommendations
   - **One-time Display**: Survey only shown once per user

### User Experience:
- **Progressive Loading** - Smooth transitions
- **Visual Feedback** - Loading states and animations
- **Responsive Design** - Works on all device sizes
- **Accessibility** - Screen reader friendly

---

## API Integration

### Internal API (Laravel ↔ Frontend):
- `GET /api/questions` - Fetch questions for frontend
- `POST /survey/submit` - Submit client feedback survey
- AJAX form submissions
- Real-time validation

### External API (Laravel ↔ Flask):
- `POST /predict` - Get ML predictions
- `POST /retrain` - Trigger model retraining
- `GET /export_tree` - Download decision tree PDF

### Error Handling:
- Connection timeouts (10 seconds)
- Graceful failure fallbacks
- User-friendly error messages
- Logging for debugging

---

## Configuration

### Environment Variables (`.env`):
```env
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tech_recommender
DB_USERNAME=root
DB_PASSWORD=

# ML Service
DTREE_API=http://127.0.0.1:5001

# Laravel
APP_URL=http://localhost:8000
APP_KEY=base64:...
```

### Key Config Files:
- `config/app.php` - Application settings
- `config/database.php` - Database connections
- `config/cors.php` - CORS settings for API
- `config/auth.php` - Authentication settings

### Security Settings:
- CSRF protection enabled
- CORS configured for API access
- Password hashing with bcrypt
- Session security settings

---

## Development Workflow

### Setup Process:
1. Clone repository
2. Install PHP dependencies (`composer install`)
3. Install Node.js dependencies (`npm install`)
4. Configure environment (`.env`)
5. Run migrations (`php artisan migrate --seed`)
6. Build assets (`npm run build`)
7. Start server (`php artisan serve`)

### Testing:
- Unit tests for models and services
- Feature tests for controllers
- Browser tests for critical user flows
- API endpoint testing

### Deployment:
- Environment-specific configurations
- Asset compilation and optimization
- Database migration scripts
- Cache optimization commands

---

## File Structure Overview

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/          # Authentication controllers
│   │   ├── Admin/         # Admin panel controllers
│   │   │   ├── SurveyController.php    # New: Survey analytics
│   │   │   ├── DashboardController.php # Enhanced with survey stats
│   │   │   └── ...
│   │   └── Student/       # Student-specific controllers
│   ├── Middleware/        # Custom middleware
│   └── Requests/          # Form request validation
├── Models/                # Eloquent models
│   ├── UserSurveyResponse.php  # New: Survey response model
│   └── ...
├── Services/              # Business logic services
└── Providers/             # Service providers

resources/
├── views/
│   ├── auth/              # Authentication views
│   ├── admin/             # Admin panel views
│   │   ├── surveys/       # New: Survey analytics views
│   │   │   └── index.blade.php  # Comprehensive dashboard
│   │   └── dashboard.blade.php  # Enhanced with survey stats
│   ├── student/           # Student dashboard views
│   │   └── results.blade.php    # Enhanced with survey form
│   └── layouts/           # Layout templates
├── css/                   # Stylesheets
└── js/                    # JavaScript files

routes/
├── web.php                # Web routes (enhanced with survey routes)
└── api.php                # API routes

database/
├── migrations/            # Database schema
│   └── create_user_survey_responses_table.php  # New table
└── seeders/              # Sample data
```

---

## Troubleshooting

### Common Issues:
1. **ML Service Connection** - Check Flask service is running on port 5001
2. **Database Connection** - Verify `.env` database credentials
3. **Asset Compilation** - Run `npm run build` after changes
4. **Cache Issues** - Clear Laravel cache with `php artisan cache:clear`
5. **Permission Errors** - Set correct file permissions on `storage/` and `bootstrap/cache/`

### Debug Mode:
- Set `APP_DEBUG=true` in `.env` for development
- Check `storage/logs/laravel.log` for error messages
- Use Laravel's built-in debugging tools

---

## Support

For technical questions or issues:
1. Check the Laravel documentation
2. Review application logs
3. Test API endpoints independently
4. Verify database connections
5. Contact development team

---

*This documentation covers the Laravel application architecture and functionality. For Flask microservice documentation, see the backend README.md file.*
