<?php

namespace App\Models\Concerns;

trait Grid {

    public function scopeFilter($query, $params) {
        $filterModel = (gettype($params['filterModel']) == 'array') ? $params['filterModel'] : json_decode($params['filterModel'], true);
        if (count($filterModel) > 0) {
            foreach ($filterModel as $key => $value) {
                if (key_exists('operator', $value)) {
                    $this->getQuery($query, $key, $value['condition1']);
                    $this->getQuery($query, $key, $value['condition2'], $value['operator']);
                } else {
                    $this->getQuery($query, $key, $value);
                }
            }
        }
        if (!empty($params['endRow'])) {
            $query->paginate($params['endRow']);
        }
        if (isset($params['sortModel'])&& !empty($params['sortModel'])) {
            $sortModel = (gettype($params['sortModel'][0]) == 'array') ? $params['sortModel'][0] : json_decode($params['sortModel'][0], true);
            if (count($sortModel) > 0) {
                $query->orderBy($sortModel['colId'], $sortModel['sort']);
            }
        }

        return $query;
    }

    private function getQuery($query, $key, $value, $operator = null) {
        $conditions = ['contains' => 'like', 'notContains' => 'not like', 'equals' => '=', 'notEqual' => '!=', 'startsWith' => 'like', 'endsWith' => 'like'];
        if (!$operator || $operator == 'AND') {
            if ($value['type'] == 'contains' || $value['type'] == 'notContains') {
                $query->where($key, $conditions[$value['type']], '%' . $value['filter'] . '%');
            } elseif ($value['type'] == 'startsWith') {
                $query->where($key, $conditions[$value['type']], $value['filter'] . '%');
            } elseif ($value['type'] == 'endsWith') {
                $query->where($key, $conditions[$value['type']], '%' . $value['filter']);
            } else {
                $query->where($key, $conditions[$value['type']], $value['filter']);
            }
        } elseif ($operator == 'OR') {
            if ($value['type'] == 'contains' || $value['type'] == 'notContains') {
                $query->orWhere($key, $conditions[$value['type']], '%' . $value['filter'] . '%');
            } elseif ($value['type'] == 'startsWith') {
                $query->orWhere($key, $conditions[$value['type']], '%' . $value['filter']);
            } elseif ($value['type'] == 'endsWith') {
                $query->orWhere($key, $conditions[$value['type']], $value['filter'] . '%');
            } else {
                $query->orWhere($key, $conditions[$value['type']], $value['filter']);
            }
        }


        return $query;
    }

}
