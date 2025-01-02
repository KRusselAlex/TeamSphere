
export interface UserRequest {
  username:string;
  fullname?:string;
  email: string;
  password: string;
  department?:string;
  role?:boolean;
  image?: File | string | null;
}

