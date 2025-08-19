
# Leave Management System

A comprehensive leave management system built with Angular frontend and PHP backend API, designed to help organizations manage employee leave requests efficiently.

## 🚀 Features

### Frontend (Angular)
- **Modern UI/UX**: Clean, responsive interface using Bootstrap
- **Employee Management**: Complete CRUD operations for employees
- **Company Management**: Manage company information and settings
- **Department Management**: Organize employees by departments
- **Leave Type Management**: Configure different types of leaves
- **Leave Request Management**: Apply, approve, reject leave requests
- **Dashboard**: Overview of leave statistics and quick actions
- **Authentication**: Secure login system
- **Real-time Updates**: Dynamic data updates without page refresh

### Backend (PHP API)
- **RESTful API**: Clean API endpoints for all operations
- **Database Integration**: MySQL database with proper relationships
- **Security**: Password hashing and input validation
- **CORS Support**: Cross-origin resource sharing enabled
- **Error Handling**: Comprehensive error responses
- **Modular Structure**: Well-organized code structure

## 📋 Prerequisites

- Node.js (v14 or higher)
- Angular CLI (v15 or higher)
- PHP (v7.4 or higher)
- MySQL (v5.7 or higher)
- Web server (Apache/Nginx) or PHP built-in server

## 🛠️ Installation & Setup

### 1. Clone the Repository
```bash
git clone <repository-url>
cd leave-management-system
```

### 2. Database Setup
1. Create a MySQL database named `leavedb`
2. Import the database schema from `php-project/leavedb.sql`
3. Update database credentials in `php-api/config/database.php`

### 3. Backend Setup (PHP API)
```bash
cd php-api
# Start PHP development server
php -S 0.0.0.0:8080
```

The API will be available at `http://localhost:8080`

### 4. Frontend Setup (Angular)
```bash
cd Angular/leave-management
# Install dependencies
npm install

# Start development server
npm start
```

The application will be available at `http://localhost:4200`

## 🏗️ Project Structure

```
leave-management-system/
├── Angular/leave-management/          # Angular Frontend
│   ├── src/
│   │   ├── app/
│   │   │   ├── components/           # UI Components
│   │   │   ├── models/              # Data Models
│   │   │   ├── services/            # API Services
│   │   │   └── ...
│   │   └── ...
│   └── ...
├── php-api/                          # PHP Backend API
│   ├── api/                         # API Endpoints
│   ├── config/                      # Configuration Files
│   ├── models/                      # Data Models
│   └── ...
├── php-project/                      # Original PHP Project (Reference)
└── README.md
```

## 🌐 API Endpoints

### Authentication
- `POST /api/auth/login` - Employee login

### Companies
- `GET /api/companies` - Get all companies
- `POST /api/companies` - Create company
- `PUT /api/companies/{id}` - Update company
- `DELETE /api/companies/{id}` - Delete company

### Employees
- `GET /api/employees` - Get all employees
- `POST /api/employees` - Create employee
- `PUT /api/employees/{id}` - Update employee
- `DELETE /api/employees/{id}` - Delete employee
- `POST /api/employees/{id}/reset-password` - Reset password

### Departments
- `GET /api/departments` - Get all departments
- `POST /api/departments` - Create department

### Leave Types
- `GET /api/leave-types` - Get all leave types
- `POST /api/leave-types` - Create leave type

### Leaves
- `GET /api/leaves` - Get all leaves
- `POST /api/leaves` - Create leave request
- `PUT /api/leaves/{id}` - Update leave
- `GET /api/leaves/employee/{id}` - Get leaves by employee
- `GET /api/leaves/status/{status}` - Get leaves by status

## 🎯 Usage

### For Employees
1. **Login**: Use your credentials to access the system
2. **Apply for Leave**: Submit leave requests with required details
3. **View Leave History**: Track your leave applications and their status
4. **Update Profile**: Manage your personal information

### For Administrators
1. **Manage Companies**: Add, edit, and remove company information
2. **Manage Departments**: Organize company structure
3. **Manage Employees**: Add new employees and update existing records
4. **Configure Leave Types**: Set up different types of leaves available
5. **Process Leave Requests**: Approve or reject employee leave applications
6. **Generate Reports**: View dashboard with leave statistics

## 🔧 Configuration

### Database Configuration
Edit `php-api/config/database.php`:
```php
private $host = "localhost";
private $db_name = "leavedb";
private $username = "your_username";
private $password = "your_password";
```

### Angular API Configuration
Edit `Angular/leave-management/src/app/services/http.service.ts`:
```typescript
private baseUrl = 'http://localhost:8080/api';
```

## 🚀 Deployment

### Development
1. Start PHP server: `cd php-api && php -S 0.0.0.0:8080`
2. Start Angular: `cd Angular/leave-management && npm start`

### Production
1. **Backend**: Deploy PHP files to web server with MySQL database
2. **Frontend**: Build Angular app with `ng build --prod` and deploy to web server
3. **Database**: Import SQL schema and configure connection
4. **CORS**: Ensure proper CORS configuration for production domains

## 🔒 Security Features

- Password hashing using SHA1
- Input validation and sanitization
- SQL injection prevention using prepared statements
- XSS protection with HTML encoding
- CORS configuration for secure cross-origin requests

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 📞 Support

For support and questions:
- Create an issue in the repository
- Check the documentation
- Review the code comments for implementation details

## 🔄 Version History

- **v1.0.0**: Initial release with core functionality
- **v1.1.0**: Added dashboard and improved UI
- **v1.2.0**: Enhanced API with full CRUD operations
- **v1.3.0**: Added authentication and security features

---

**Note**: This system is designed for internal organizational use. Ensure proper security measures are in place before deploying to production environments.
