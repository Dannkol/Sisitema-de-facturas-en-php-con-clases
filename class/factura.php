<?php

class factura{
    use getInstance;
    function __construct(public $N_Bill, public $Bill_Date, public $Seller, private $Identification, public $Full_Name, public $Email, private $Address, private $Phone){
        var_dump($N_Bill);
    }
}