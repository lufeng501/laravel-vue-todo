<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoDetails extends Model
{
    /**
     * ORM映射的表名
     * @var string
     */
    protected $table = "todo_details";

    /**
     * 批量赋值黑名单
     * @var array
     */
    protected $guarded = [];

    /**
     * 一对多关系(反转)，获取关联的todo列表项
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lists()
    {
        return $this->belongsTo('App\Models\TodoLists', 'list_id');
    }
}
