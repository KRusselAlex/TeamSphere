export interface PresenceRequest {
  id?: number | undefined;
  user_id: number;
  marked_at?: string;
  username: string;
  status?: boolean;
  fullname?: string | null;
}

