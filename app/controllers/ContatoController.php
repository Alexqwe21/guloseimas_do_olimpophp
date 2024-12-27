<?php

class ContatoController extends Controller{



public function index(){




$dados = array();


$banner_contato = new Banner();

$contato_banner = $banner_contato ->getBanner_contato();


$dados['nome'] = 'cheguei aqui ';
$dados['banner'] = $contato_banner;



$this->carregarViews('contato', $dados);
}






}