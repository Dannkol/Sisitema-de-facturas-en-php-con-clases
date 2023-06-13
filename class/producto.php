<?php

class producto{
    use getInstance;
    function __construct(private $id_product, public $name_product, public $amount, public $value_product){

    }

}