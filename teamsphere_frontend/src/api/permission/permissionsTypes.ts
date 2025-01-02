export interface PermissionRequest{
  id?: number | undefined;
  user_id: number;
  permission_type: string;
  start_date: string | Date;
  end_date: string | Date;
  reason: string;
  justification?: string | File | null;
  admin_id?: number | null;
  status?: 'pending' | 'approved' | 'rejected';
  username?: string;
  fullname?: string | null;
  notification_sent?:boolean;
  requested_at?: string | Date;
  responded_at?: string | Date | null;
}

