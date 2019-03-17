<?php
namespace App\Queries\News;

use App\Models\News;

class SaveNews
{
    /**
     * Save news submitted via submission form.
     */
    public function query(array $fields, int $id = null): News
    {
        return News::updateOrCreate(
            ['id' => $id],
            $fields
        );
    }
}
