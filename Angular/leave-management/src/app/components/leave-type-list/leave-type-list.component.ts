
import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { LeaveTypeService } from '../../services/leave-type.service';
import { LeaveType } from '../../models/leave-type.model';

@Component({
  selector: 'app-leave-type-list',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './leave-type-list.component.html',
  styleUrls: ['./leave-type-list.component.css']
})
export class LeaveTypeListComponent implements OnInit {
  leaveTypes: LeaveType[] = [];
  loading = true;

  constructor(private leaveTypeService: LeaveTypeService) {}

  ngOnInit(): void {
    this.loadLeaveTypes();
  }

  loadLeaveTypes(): void {
    this.leaveTypeService.getAllLeaveTypes().subscribe({
      next: (data) => {
        this.leaveTypes = data;
        this.loading = false;
      },
      error: (error) => {
        console.error('Error loading leave types:', error);
        this.loading = false;
      }
    });
  }

  deleteLeaveType(id: number): void {
    if (confirm('Are you sure you want to delete this leave type?')) {
      this.leaveTypeService.deleteLeaveType(id).subscribe({
        next: () => {
          this.loadLeaveTypes();
        },
        error: (error) => {
          console.error('Error deleting leave type:', error);
        }
      });
    }
  }
}
