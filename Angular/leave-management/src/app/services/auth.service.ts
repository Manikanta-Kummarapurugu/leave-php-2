
import { Injectable } from '@angular/core';
import { Observable, BehaviorSubject } from 'rxjs';
import { ApiService } from './api.service';
import { LoginRequest, LoginResponse, User, ResetPasswordRequest } from '../models/auth.model';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private currentUserSubject = new BehaviorSubject<User | null>(null);
  public currentUser = this.currentUserSubject.asObservable();

  constructor(private apiService: ApiService) {
    const storedUser = localStorage.getItem('currentUser');
    if (storedUser) {
      this.currentUserSubject.next(JSON.parse(storedUser));
    }
  }

  login(credentials: LoginRequest): Observable<LoginResponse> {
    return this.apiService.post<LoginResponse>('/auth/login', credentials);
  }

  logout(): void {
    localStorage.removeItem('currentUser');
    this.currentUserSubject.next(null);
  }

  setCurrentUser(user: User): void {
    localStorage.setItem('currentUser', JSON.stringify(user));
    this.currentUserSubject.next(user);
  }

  getCurrentUser(): User | null {
    return this.currentUserSubject.value;
  }

  resetPassword(userId: number, resetData: ResetPasswordRequest): Observable<any> {
    return this.apiService.post(`/auth/reset-password/${userId}`, resetData);
  }

  isLoggedIn(): boolean {
    return this.currentUserSubject.value !== null;
  }

  isAdmin(): boolean {
    const user = this.getCurrentUser();
    return user?.EMPPOSITION === 'Administrator';
  }

  isSupervisor(): boolean {
    const user = this.getCurrentUser();
    return user?.EMPPOSITION === 'Supervisor user' || user?.EMPPOSITION === 'Manager user';
  }

  isNormalUser(): boolean {
    const user = this.getCurrentUser();
    return user?.EMPPOSITION === 'Normal user';
  }
}
