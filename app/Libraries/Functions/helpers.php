<?php
/**
 * Descript: 全局方法
 * User: luyingru@37.com
 * Date: 2017/2/27 11:48
 */

/**
 * 返回json格式相应
 * @param array $data
 * @param int $state
 * @return \Illuminate\Http\JsonResponse\
 */
function successJson($data = array(), $msg = 'ok', $state = 1)
{
    $response = [];
    $response['data'] = $data;
    $response['msg'] = $msg;
    $response['state'] = $state;
    return response()->json($response);
}

/**
 * 返回json格式相应
 * @param array $data
 * @param int $state
 * @return \Illuminate\Http\JsonResponse\
 */
function errorJson($data = array(), $msg = 'fail', $state = 0)
{
    $response = [];
    $response['data'] = $data;
    $response['msg'] = $msg;
    $response['state'] = $state;
    return response()->json($response);
}

/**
 * 成功返回
 * @param array $data
 * @param string $msg
 * @param int $state
 * @return array
 */
function successReturn($data = array(), $msg = 'ok', $state = 1)
{
    $returnData = [];
    $returnData['data'] = $data;
    $returnData['msg'] = $msg;
    $returnData['state'] = $state;
    return $returnData;
}

/**
 * 成功返回
 * @param array $data
 * @param string $msg
 * @param int $state
 * @return array
 */
function errorReturn($data = array(), $msg = 'fail', $state = 0)
{
    $returnData = [];
    $returnData['data'] = $data;
    $returnData['msg'] = $msg;
    $returnData['state'] = $state;
    return $returnData;
}

/**
 * 拼装select2数据格式
 * @param $data
 * @param string $relatedIdFiled
 * @param string $relatedTextFiled
 * @return array
 */
function buildSelect2FormatData($data, $relatedIdFiled = 'id', $relatedTextFiled = 'text')
{
    $formatData = [];
    if (!empty($data)) {
        foreach ($data as $key => $value) {
            $temp['id'] = $value[$relatedIdFiled];

            if (is_array($relatedTextFiled)) {
                $textArr = [];
                foreach ($relatedTextFiled as $field) {
                    $textArr[] = $value[$field];
                }
                $text = implode('-', $textArr);
            } else {
                $text = $value[$relatedTextFiled];
            }
            $temp['text'] = $text;
            $formatData[] = $temp;
        }
    }
    return $formatData;
}

/**
 * 拼装ztree数据结构
 * @param $data
 * @return array
 */
function buildZtreeData($data,$checkedArr = []){
    $formatData = [];
    if(!empty($data)) {
        foreach ($data as $key => $value) {
            $temp['id'] = $value['id'];
            $temp['pId'] = $value['pid'];
            $temp['name'] = $value['display_name'].'【'.$value['name'].'】';
            $temp['open'] = false;
            $temp['checked'] = false;
            if (!empty($checkedArr) && in_array($value['id'],$checkedArr)) {
                $temp['open'] = true;
                $temp['checked'] = true;
            }
            $formatData[] = $temp;
        }
    }
    return $formatData;
}

function rebulidDataIndex($data, $index = 'id')
{
    $formatData = [];
    if (!empty($data)) {
        foreach ($data as $key => $value) {
            $formatData[$value[$index]] = $value;
        }
    }
    return $formatData;
}

/**
 * 对象转数组
 * @param $object
 * @return mixed
 */
function object2array(&$object)
{
    $object = json_decode(json_encode($object), true);
    return $object;
}

/**
 * 获取树状结构数据(默认索引值)
 * @param $items
 * @return array
 */
function generateTreeDefault($items,$sonFields='children')
{
    $tree = array();
    foreach ($items as $item) {
        if (isset($items[$item['pid']])) {
            $items[$item['pid']][$sonFields][] = &$items[$item['id']];
        } else {
            $tree[] = &$items[$item['id']];
        }
    }
    return $tree;
}

/**
 * 获取树状结构数据（以ID作为索引值）
 * @param $items
 * @return array
 */
function generateTreeById($items,$sonFields='children')
{
    $tree = array();
    foreach ($items as $item) {
        if (isset($items[$item['pid']])) {
            $items[$item['pid']][$sonFields][$item['id']] = &$items[$item['id']];
        } else {
            $tree[$item['id']] = &$items[$item['id']];
        }
    }
    return $tree;
}

/**
 * 遍历树状结构数据
 * @param int $deep
 * @param array $results
 * @return array
 */
function scanTreeData($tree, $deep = 0, &$results = []){
    // + 保留数组索引值
    if (!empty($tree)) {
        $deep++;
        foreach ($tree as $key => $value) {
            $temp = $value;
            if (isset($temp['children'])) {
                unset($temp['children']);
            }
            $results[] = $temp;
            if ($deep < 10) {
                if (isset($value['children']) && !empty($value['children'])) {
                    scanTreeData($value['children'], $deep, $results);
                }
            }
        }
    }
    return $results;
}

/**
 * 过滤路由
 * @param $path
 * @return string
 */
function filter($path) {
    $str = $path;
    if (!empty($path)) {
        $paths = explode('/',$path);
        if (!empty($paths) && is_array($paths) && is_numeric(end($paths))) {
            array_pop($paths);
            $str = implode('/',$paths);
        }
    }
    return $str;
}