<?php


class User extends \ActiveRecord\Model
{
    static $validates_presence_of = array (
        array('username'),
        array('nome'),
        array('email'),
        array('password'),
        array('dtanascimento')
    );
}
