
import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Router } from '@angular/router';
import { Employee } from '../../models/employee.model';
import { EmployeeService } from '../../services/employee.service';

@Component({
  selector: 'app-employee-list',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './employee-list.component.html',
  styleUrls: ['./employee-list.component.css']
})
export class EmployeeListComponent implements OnInit {
  employees: Employee[] = [];
  loading = false;

  constructor(
    private employeeService: EmployeeService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.loadEmployees();
  }

  loadEmployees(): void {
    this.loading = true;
    this.employeeService.getEmployees().subscribe({
      next: (data) => {
        this.employees = data;
        this.loading = false;
      },
      error: (error) => {
        console.error('Error loading employees:', error);
        this.loading = false;
      }
    });
  }

  addEmployee(): void {
    this.router.navigate(['/employee/add']);
  }

  editEmployee(employee: Employee): void {
    this.router.navigate(['/employee/edit', employee.EMPLOYID]);
  }

  deleteEmployee(employeeId: number): void {
    if (confirm('Are you sure you want to delete this employee?')) {
      this.employeeService.deleteEmployee(employeeId).subscribe({
        next: () => {
          this.loadEmployees();
          alert('Employee deleted successfully');
        },
        error: (error) => {
          console.error('Error deleting employee:', error);
          alert('Error deleting employee');
        }
      });
    }
  }

  resetPassword(employeeId: number): void {
    if (confirm('Are you sure you want to reset this employee\'s password?')) {
      this.employeeService.resetPassword(employeeId).subscribe({
        next: () => {
          alert('Password reset successfully');
        },
        error: (error) => {
          console.error('Error resetting password:', error);
          alert('Error resetting password');
        }
      });
    }
  }
}
