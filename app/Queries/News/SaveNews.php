<?php
namespace App\Queries\News;

use App\Models\News;

class SaveNews
{
    /**
     * Save news submitted via submission form.
     * @param array    $fields
     * @param null|int $id
     */
    public function query(array $fields, int $id = null): News
    {
        return News::updateOrCreate(
            ['id' => $id],
            $fields
        );
    }
}
