import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AuthService } from '../../services/auth.service';
import { LeaveService } from '../../services/leave.service';
import { EmployeeService } from '../../services/employee.service';
import { User } from '../../models/auth.model';

@Component({
  selector: 'app-dashboard',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {
  currentUser: User | null = null;
  totalEmployees = 0;
  pendingLeaves = 0;
  approvedLeaves = 0;
  rejectedLeaves = 0;

  constructor(
    public authService: AuthService,
    private leaveService: LeaveService,
    private employeeService: EmployeeService
  ) {}

  ngOnInit(): void {
    this.currentUser = this.authService.getCurrentUser();
    this.loadDashboardData();
  }

  loadDashboardData(): void {
    if (this.authService.isAdmin() || this.authService.isSupervisor()) {
      this.employeeService.getAllEmployees().subscribe({
        next: (employees) => {
          this.totalEmployees = employees.length;
        }
      });

      this.leaveService.getLeavesByStatus('PENDING').subscribe({
        next: (leaves) => {
          this.pendingLeaves = leaves.length;
        }
      });

      this.leaveService.getLeavesByStatus('APPROVED').subscribe({
        next: (leaves) => {
          this.approvedLeaves = leaves.length;
        }
      });

      this.leaveService.getLeavesByStatus('REJECTED').subscribe({
        next: (leaves) => {
          this.rejectedLeaves = leaves.length;
        }
      });
    }
  }

  get userPosition(): string {
    return this.currentUser?.EMPPOSITION || 'User';
  }

  get userName(): string {
    return this.currentUser?.EMPNAME || 'User';
  }
}