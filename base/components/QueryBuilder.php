<?php
namespace base\components;
use base\components\Model;
/**
 * Class QueryBuilder
 *
 * Used for building queries and binding params for prepares statements
 *
 * @property integer $id
 *
 * @package \base\components
 */
class QueryBuilder
{
    /* @var $bind_params array Bind params for mysqli_stmt_bind_param */
    public $bind_params = [null, ''];
    public $query = null;

    public function begin($fragment){
        $this->query = $fragment;
        return $this;
    }

    public function append($fragment, &$param = null, $type = null){
        if (is_array($param)){
            foreach ($param as &$v) {
                $this->bind_params[] = &$v;
                $this->bind_params[1] .= $type;
            }
            $values = '('.substr(str_repeat(',?', count($param)), 1).')';
            $fragment = str_replace('?', $values, $fragment);
        }else if (strlen($param)){
            $this->bind_params[] = &$param;
            $this->bind_params[1] .= $type;
        }
        $this->query .= " ".$fragment;
        return $this;
    }

    public function appendIf($should_append, $fragment, &$param = null, $type = null){
        if (!$should_append) return $this;
        return $this->append($fragment, $param, $type);
    }

    public function execute(){
        $stmt = mysqli_prepare(Model::getConnection(), $this->query);
        self::throw_if_error($stmt);
        if (count($this->bind_params) > 2) {
            $this->bind_params[0] = &$stmt;
            call_user_func_array('mysqli_stmt_bind_param', $this->bind_params);
        }
        self::throw_if_error(mysqli_stmt_execute($stmt));
        return $stmt;
    }

    /**
     * Throws exception given the result of following functions, if invalid:
     * * mysqli_prepare
     * * mysqli_stmt_execute
     *
     * @param mixed $result
     * @throws \Exception
     */
    static public function throw_if_error($result){
        if (!$result) {
            throw new \Exception(mysqli_error(Model::getConnection()));
        }
    }
}
