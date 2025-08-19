
export interface LoginRequest {
  username: string;
  password: string;
}

export interface LoginResponse {
  success: boolean;
  message: string;
  user?: User;
  token?: string;
}

export interface User {
  EMPID: number;
  EMPLOYID: string;
  EMPNAME: string;
  EMPPOSITION: string;
  COMPANY: string;
  DEPARTMENT: string;
  USERNAME: string;
  ACCSTATUS: string;
}

export interface ResetPasswordRequest {
  currentPassword: string;
  newPassword: string;
  confirmPassword: string;
}
