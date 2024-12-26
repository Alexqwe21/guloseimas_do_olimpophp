<?php

class ComprasController extends Controller{



public function index(){




$dados = array();


$dados['nome'] = 'cheguei aqui ';



$this->carregarViews('compras', $dados);
}






}