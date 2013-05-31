<?php

class Main{

    public function __construct(){

    }

    public function index(){

        echo "Chamou o método Default";

    }

    public function otherMethod(){

        echo "Chamou um outro método ";

    }

    public function methodWithParams( $var1, $var2 = "" ){

        echo "Var1 = $var1 ; Var2 = $var2";

    }

    public function methodRouted(){

        echo "Chamou método roteado";

    }

    public function methodGet(){

        echo "Chamou método roteado com http Get";

    }

    public function methodPost(){

        echo "Chamou método roteado com http Post";

    }

    public function methodPut(){

        echo "Chamou método roteado com http Put";

    }

    public function methodDelete(){

        echo "Chamou método roteado com http Delete";

    }

}