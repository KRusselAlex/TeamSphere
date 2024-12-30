<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->user_id,
            'permission_type' => $this->permission_type,
            'start_date' => $this->start_date,
            'end_date' =>  $this->end_date,
            'reason' => $this->reason,
            'justification' => $this->justification ? Storage::url($this->justification) : null,
            'admin_id'=>$this->admin_id,
            'status' => $this->status ? $this->status : "pending",
            'username' =>$this->username,
            'fullname' => $this->fullname,
            'requested_at' => $this->created_at,
            'approved_at' => $this->updated_at == $this->created_at ? null : $this->updated_at
        ];
    }
}
