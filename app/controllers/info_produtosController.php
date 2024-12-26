<?php

class info_produtosController extends Controller{



public function index(){




$dados = array();


$dados['nome'] = 'cheguei aqui ';



$this->carregarViews('info_produtos', $dados);
}






}