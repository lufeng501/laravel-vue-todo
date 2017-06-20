<?php
/**
 * Des : Todo仓库
 * Created by PhpStorm.
 * User: lufeng501206@gmail.com
 * Date: 2017/6/13
 * Time: 10:22
 */

namespace App\Repositories;


use App\Models\TodoLists;

class TodoRepos
{
    /**
     * 获取todo详情列表
     *
     * @return array
     */
    public function getTodoListsDetails($conditions = [])
    {
        $todoListsModel = TodoLists::select(['id','title','status','created_at','updated_at']);
        if (!empty($conditions['item_type']) && in_array($conditions['item_type'],[2,3])) {
            // 未完成
            if ($conditions['item_type'] == 2) {
                $todoListsModel = $todoListsModel->where('status',0);
            }
            // 已完成
            if ($conditions['item_type'] == 3) {
                $todoListsModel = $todoListsModel->where('status',1);
            }
        }
        // 判断排序类型
        if (!empty($conditions['order_type']) && in_array($conditions['order_type'],[1,2,3])) {
            // 名称排序
            if ($conditions['order_type'] == 1) {
                $todoListsModel = $todoListsModel->orderBy('title','asc');
            }
            // 创建时间排序
            if ($conditions['order_type'] == 2) {
                $todoListsModel = $todoListsModel->orderBy('created_at','desc');
            }
            // 更新时间排序
            if ($conditions['order_type'] == 3) {
                $todoListsModel = $todoListsModel->orderBy('updated_at','desc');
            }
        }
        $lists = $todoListsModel->get();
        // 转换成数组
        if (!empty($lists)) {
            $lists = $lists->toArray();
        } else {
            $lists = [];
        }
        // 变量待办事项，获得详细的待办描述
        if (!empty($lists) && is_array($lists)) {
            foreach ($lists as $key => &$value) {
                $relatedData = TodoLists::findOrFail($value['id'])->details()->select(['id','title','status','list_id'])->get();
                if (!empty($relatedData)) {
                    $relatedData = $relatedData->toArray();
                } else {
                    $relatedData = [];
                }
                $value['related_details'] = $relatedData;
            }
        }
        return $lists;
    }


    /**
     * 获取待办详情
     *
     * @param $id
     * @return array
     */
    public function getTodoDetailsById($id)
    {
        $details = [];
        $todoModel = TodoLists::select(['id','title','status','created_at','updated_at'])->where('id',$id)->first();
        if (empty($todoModel)) {
            return $details;
        }
        $details = $todoModel->toArray();
        // 获取关联的待办描述
        if (!empty($details)) {
            $relatedData = TodoLists::findOrFail($details['id'])->details()->select(['id','title','status','list_id'])->get();
            if (!empty($relatedData)) {
                $relatedData = $relatedData->toArray();
            } else {
                $relatedData = [];
            }
            $details['related_details'] = $relatedData;
        }
        return $details;
    }
}