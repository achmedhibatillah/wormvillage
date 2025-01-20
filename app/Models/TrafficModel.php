<?php

namespace App\Models;

use CodeIgniter\Model;

class TrafficModel extends Model
{
    protected $table            = 'traffic';
    protected $primaryKey       = 'traffic_id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['traffic_hal', 'created_at'];
    protected $useTimestamps    = false;
}
