
export interface LoginRequest {
  email: string;
  password: string;
}


export interface RegisterRequest {
  username: string;
  email: string;
  password: string;
}


export interface ForgotPasswordRequest {
  email: string;
}

export interface ResetPasswordRequest {
  token: string;
  password: string;
}

export interface ResetPasswordResponse {
  message: string;
}
