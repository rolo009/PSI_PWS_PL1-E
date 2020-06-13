<?php


class User extends \ActiveRecord\Model
{
    static $validates_presence_of = array(
        array('username'),
        array('password', 'message' => 'YooaaH it must be provided')
    );
}