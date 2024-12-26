<?php

class ContatoController extends Controller{



public function index(){




$dados = array();


$dados['nome'] = 'cheguei aqui ';



$this->carregarViews('contato', $dados);
}






}