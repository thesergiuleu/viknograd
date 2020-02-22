<?php
use Illuminate\Http\JsonResponse;
/**
 * Get the response in case of success
 *
 * @param string $message
 * @return JsonResponse
 */
function response_ok($message = 'ok')
{
    $message = is_array($message) ? $message : ['message' => $message];
    return response()->json($message);
}
/**
 * Get the response in case of fail
 *
 * @param int $code
 * @param mixed $message
 * @return JsonResponse
 */
function response_fail($message = 'not_allowed', $code = 403)
{
    $message = is_array($message) ? $message : ['message' => $message];
    return response()->json($message, $code);
}
if (!function_exists('format_to_string')) {
    function format_to_string($data, $field, $trim = ', ') {
        $string = '';
        foreach ($data as $item) {
            $string .= $item->{$field} . ', ';
        }
        return rtrim($string, $trim);
    }
}
if (!function_exists('mapGridColumn')) {
    /**
     * @param $obj
     * @param array $column
     * @return string
     */
    function mapGridColumn($obj, $column = [])
    {
        if (is_array($column)) {
            // in case we have field is a Polymorphic Relation
            // each entity may have different column name,  so we pass an array of fields
            // to match exact one
            if (array_key_exists('field', $column) && is_array($column['field'])) {
                $columnData = 'title';
                foreach ($column['field'] as $field) {
                    if (isset($obj->{$column['relation']}->{$field})) {
                        $columnData = $obj->{$column['relation']}->{$field};
                        break;
                    }
                }
                return $columnData;
            }
            // return value callback
            if (array_key_exists('callback', $column)) {
                return $column['callback']($obj);
            }

            return ($obj->{$column['relation']}) ? isPropertyOrCallback($column, $obj) : '';
        }

        if ($column instanceof Closure) {
            return $column($obj);
        }

        return $obj->{$column};
    }
}
if (!function_exists('isPropertyOrCallback')) {
    /**
     * @param $params
     * @param $model
     * @return string
     */
    function isPropertyOrCallback($params, $model)
    {
        return array_key_exists('field', $params) ? $model->{$params['relation']}->{$params['field']} : $model->{$params['relation']}->{$params['method']}();
    }
}
if (!function_exists('getSortByState')) {
    function getSortByState($params = [], $activeColumn = 'id')
    {
        if ($params['column'] === $activeColumn) {
            return ($params['order'] === 'asc' ? 'desc' : 'asc');
        }
        return ($params['order'] === 'asc' ? 'asc' : 'desc');
    }
}

if (!function_exists('getSortCssClassState')) {
    function getSortCssClassState($params = [], $activeColumn = 'id')
    {
        if ($params['column'] === $activeColumn) {
            return ($params['order'] === 'asc' ? 'arrow-down' : 'arrow-up');
        }
        return 'sort';
    }
}
if (!function_exists('checkMenuIsActive')) {
    function checkMenuIsActive($item, $active, $childKey, $field)
    {
        $flag = false;
        if (array_key_exists($childKey, $item) && is_array($item[$childKey]) && count($item[$childKey]) > 0) {
            foreach ($item[$childKey] as $record) {
                if ($record[$field] === $active) {
                    $flag = true;
                    break;
                }
            }
        }
        return $flag;
    }
}
if (!function_exists('attachQueryParamsToPagination')) {
    /**
     * @return array
     */
    function attachQueryParamsToPagination()
    {
        $search   = request()->has('search') ? ['search' => request()->input('search')] : [];
        $selectBy = [];
        if (request()->has('selectBy')) {
            foreach (request()->input('selectBy') as $filter => $value) {
                $filterName            = 'selectBy[' . $filter . ']';
                $selectBy[$filterName] = $value;
            }
        }
        return array_merge($search, $selectBy);
    }
}
if (!function_exists('attachQueryStringToUrl')) {
    /**
     * @return string
     */
    function attachQueryStringToUrl()
    {
        if (session()->has('query_string')) {

            return '?' . session()->get('query_string')[0];
        }
        return '';
    }
}

if (!function_exists('crudPartition')) {
    function crudPartition($oldData, $newData)
    {
        // ids
        $oldIds = array_pluck($oldData, 'id');
        $newIds = array_filter(array_pluck($newData, 'id'), 'is_numeric');

        // groups
        $delete = collect($oldData)
            ->filter(function ($model) use ($newIds) {
                return !in_array($model['id'], $newIds);
            });

        $update = collect($newData)
            ->filter(function ($model) use ($oldIds) {
                return array_key_exists('id', $model) && in_array($model['id'], $oldIds);
            });

        $create = collect($newData)
            ->filter(function ($model) {
                return (array_key_exists('id', $model) &&  is_null($model['id'])) || !array_key_exists('id', $model);
            });

        // return
        return [
            'update' => $update,
            'create' => $create,
            'delete' => $delete
        ];
    }
}
