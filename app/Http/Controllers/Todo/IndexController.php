<?php
/**
 * Des : Todo模块
 * Created by PhpStorm.
 * User: lufeng501206@gmail.com
 * Date: 2017/6/8
 * Time: 11:07
 */

namespace App\Http\Controllers\Todo;


use App\Http\Controllers\Controller;
use App\Repositories\TodoRepos;
use App\Models\TodoDetails;
use App\Models\TodoLists;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * todo仓库依赖实例对象
     * @var TodoRepos
     */
    private $todoRepos;

    public function __construct(TodoRepos $todoRepos)
    {
        $this->todoRepos = $todoRepos;
    }

    /**
     * 获取待办列表数据
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse\
     */
    public function getTodoLists(Request $request)
    {
        $conditions = $request->input();
        $data = $this->todoRepos->getTodoListsDetails($conditions);
        return successJson($data);
    }

    /**
     * 获取待办详情
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse\
     */
    public function getTodoItemDetails($id)
    {
        $data = $this->todoRepos->getTodoDetailsById($id);
        return successJson($data);
    }

    /**
     * 保存待办事项
     *
     * @param Request $request
     * @param bool $id
     * @return \Illuminate\Http\JsonResponse\
     */
    public function addTodoItem(Request $request, $id = false)
    {
        $data = $request->input();
        if (empty($data['title'])) {
            return errorJson();
        }
        $todoListsData['title'] = $data['title'];
        // 开始事务处理
        \DB::beginTransaction();
        if (empty($id)) {
            $res = TodoLists::create($todoListsData);
        } else {
            $todoListsModel = TodoLists::find($id);
            $todoListsModel->title = $data['title'];
            $res = $todoListsModel->save();
        }
        if (!$res) {
            // 回滚
            \DB::rollBack();
            return errorJson();
        }
        $todoListsId = empty($id) ? $res->id : $id;
        $lists = $data['lists'];
        $complete = 1; // 标记是否完成
        if (!empty($lists) && is_array($lists)) {
            foreach ($lists as $key => $value) {
                // 待办内容为空即跳过
                if (empty($value['title'])) {
                    // 删除
                    if (!empty($value['id'])) {
                        $res = TodoDetails::destroy($value['id']);
                        if (!$res) {
                            // 回滚
                            \DB::rollBack();
                            return errorJson();
                        }
                    }
                    // 退出本次循环操作
                    continue;
                }

                $todoDetailsData['title'] = $value['title'];
                $todoDetailsData['status'] = !empty(filter_var($value['status'], FILTER_VALIDATE_BOOLEAN)) ? 1 : 0;
                $todoDetailsData['list_id'] = $todoListsId;

                // 判断todo是否已经全部完成
                if ($complete && $todoDetailsData['status'] == 0) {
                    $complete = 0;
                }

                if (!empty($value['id'])) {
                    $todoDetailsModel = TodoDetails::find($value['id']);
                    $res = $todoDetailsModel->update($todoDetailsData);
                } else {
                    $res = TodoDetails::create($todoDetailsData);
                }

                if (!$res) {
                    // 回滚
                    \DB::rollBack();
                    return errorJson();
                }

            }
            $res = TodoLists::find($todoListsId)->update(['status'=>$complete]);
            if (!$res) {
                // 回滚
                \DB::rollBack();
                return errorJson();
            }
        } else {
            \DB::rollBack();
            return errorJson();
        }
        // 事务提交
        \DB::commit();
        return successJson();
    }

    /**
     * 删除待办
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse\
     */
    public function delete($id)
    {
        // 获取待办详情
        $details = $this->todoRepos->getTodoDetailsById($id);
        $relatedDetails = $details['related_details'];
        \DB::beginTransaction();
        // 删除关联的待办详情
        if (!empty($relatedDetails)) {
            $relatedDetailsIdArr = array_column($relatedDetails, 'id');
            $res = TodoDetails::destroy($relatedDetailsIdArr);
            if (!$res) {
                // 回滚
                \DB::rollBack();
                return errorJson();
            }
        }
        // 删除待办
        $res = TodoLists::destroy($id);
        if (!$res) {
            // 回滚
            \DB::rollBack();
            return errorJson();
        }
        \DB::commit();
        return successJson();
    }
}