import { Routes } from '@angular/router';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { CompanyListComponent } from './components/company-list/company-list.component';
import { CompanyAddComponent } from './components/company-add/company-add.component';
import { EmployeeListComponent } from './components/employee-list/employee-list.component';
import { EmployeeAddComponent } from './components/employee-add/employee-add.component';
import { DepartmentListComponent } from './components/department-list/department-list.component';
import { LeaveTypeListComponent } from './components/leave-type-list/leave-type-list.component';
import { LeaveListComponent } from './components/leave-list/leave-list.component';
import { LoginComponent } from './components/login/login.component';

export const routes: Routes = [
  { path: '', redirectTo: '/login', pathMatch: 'full' },
  { path: 'login', component: LoginComponent },
  { path: 'dashboard', component: DashboardComponent },
  { path: 'companies', component: CompanyListComponent },
  { path: 'company/add', component: CompanyAddComponent },
  { path: 'company/edit/:id', component: CompanyAddComponent },
  { path: 'employees', component: EmployeeListComponent },
  { path: 'employee/add', component: EmployeeAddComponent },
  { path: 'employee/edit/:id', component: EmployeeAddComponent },
  { path: 'departments', component: DepartmentListComponent },
  { path: 'leave-types', component: LeaveTypeListComponent },
  { path: 'leaves', component: LeaveListComponent }
];