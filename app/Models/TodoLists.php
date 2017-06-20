<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoLists extends Model
{
    /**
     * ORM映射的表名
     * @var string
     */
    protected $table = "todo_lists";

    /**
     * 批量赋值黑名单
     * @var array
     */
    protected $guarded = [];

    /**
     * 一对多关系，获取关联的todo详细项目
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany('App\Models\TodoDetails','list_id','id');
    }
}
