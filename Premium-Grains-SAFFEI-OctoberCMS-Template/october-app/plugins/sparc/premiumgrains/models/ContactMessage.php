<?php namespace Sparc\PremiumGrains\Models;

use Model;

class ContactMessage extends Model
{
    public $table = 'sparc_premiumgrains_contact_messages';

    protected $fillable = ['name', 'email', 'phone', 'enquiry_type', 'message', 'is_read', 'read_at'];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    public $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
    ];
}
