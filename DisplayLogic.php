<?php
/**
 * Created by PhpStorm.
 * User: Joel Small
 * Date: 31/05/15
 * Time: 12:47 PM
 */

namespace enigmatix\helpers;
use Yii;

class DisplayLogic {

    static $defaultAction = 'change';

    static function addLogic($view, $source, $target, $conditions)
    {
        $logic      = static::evaluateConditions($conditions);
        $action     = static::buildAction($target);
        $statement  = static::buildStatement($logic, $action);
        $bound      = static::bindToField($source, $statement, static::$defaultAction);
        static::register($view, $bound);
    }

    static function evaluateConditions(array $conditions, $source){
        $script = '';

        foreach ($conditions as $attribute => $value){
            $script .= " && " . static::evaluateCondition($attribute, $value, $source);
        }

        return strlen($script) ? substr($script,4) : $script;
    }

    static function buildAction($target){
      return "{{$target.hide}}else{{$target.show;}}";
    }

    static function evaluateCondition($attribute, $value, $source){
        return "'$value'= $('#$source').attr('$attribute')'";
    }

    static function buildStatement($logic, $action){
        return "if($logic)$action";
    }

    static function bindToField($field, $script, $event){
        return "$('#$field').$event($script)'";
    }

    static function register($view, $script){
        $view->registerJS($script);
    }
} 