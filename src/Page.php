<?php namespace BruceCms\Pages;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

    /**
     * Columns which are allowed to be mass-assigned.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'link',
        'body',
        'sort',
        'hidden'
    ];

    /**
     * Limit a query to the pages that are not hidden from navigation.
     *
     * @param $query
     * @return mixed
     */
    public function scopeUnhidden($query)
    {
        return $query->where('hidden', '0');
    }
}
