<?php
namespace App\Data\Models;

class PersonContactModel extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'persons_contacts';

    /**
     * @var array
     */
    protected $fillable = [
        'person_id',
        'contact_type_id',
        'contact',
        'from',
        'status',
        'email_id',
        'validated_at',
        'validated_by_id',
        'provider_enrichment_id',
        'created_at',
    ];
}
