<?php

namespace App\Models;

use CodeIgniter\Model;

class IncomeModel extends Model
{
    protected $table = 'incomes'; 
    protected $primaryKey = 'id'; // Primary key field

    protected $allowedFields = ['title', 'amount', 'type', 'date', 'category', 'description', 'created_at', 'updated_at'];

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime'; // Format for timestamps

    protected $returnType = 'object'; // You can change it to 'array' if you prefer array results

    // Validation rules
    protected $validationRules = [
        'title' => 'required|trim|max_length[50]',
        'amount' => 'required|numeric|max_length[20]',
        'type' => 'trim',
        'date' => 'required|trim',
        'category' => 'required|trim',
        'description' => 'required|trim|max_length[20]',
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'The title field is required.',
            'max_length' => 'The title field cannot exceed 50 characters.',
        ],
        'amount' => [
            'required' => 'The amount field is required.',
            'numeric' => 'The amount field must be a number.',
            'max_length' => 'The amount field cannot exceed 20 characters.',
        ],
        'date' => [
            'required' => 'The date field is required.',
        ],
        'category' => [
            'required' => 'The category field is required.',
        ],
        'description' => [
            'required' => 'The description field is required.',
            'max_length' => 'The description field cannot exceed 20 characters.',
        ],
    ];
}
