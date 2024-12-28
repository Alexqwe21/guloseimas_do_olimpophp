<?php

class SobreController extends Controller
{

private $quem_sou_eu;
private $minha_historia;

private $carrosel_sobre;

public function __construct()
{
    // Inicializa a sessão se ainda não estiver iniciada
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Cria uma instância do modelo Produto e atribui à propriedade $produtoModel
    $this->quem_sou_eu = new Galeria();
    $this->minha_historia = new Galeria();
    $this->carrosel_sobre = new Galeria();
}

    public function index()
    {


        $dados = array();


        $bannerModel = new  Banner();
        $galeriasobre = new Galeria();
        $servicosobreModel = new Servicos();
        $quem_sou_eu = new Galeria();
        $minha_historia = new Galeria();


        $Banner = $bannerModel->getBanner();
        $Galeria = $galeriasobre->getGaleriasobre();
        $Servicos = $servicosobreModel->getServicos();
        $GaleriaQuemSouEu = $quem_sou_eu->getGaleriaquemsoueu();
        $Galeriaminha_historia = $minha_historia->getGaleriaminha_historia();

        $dados['banner'] =  $Banner;
        $dados['galeria_sobre'] = $Galeria;
        $dados['servicos'] = $Servicos;
        $dados['quem_sou_eu'] =  $GaleriaQuemSouEu;
        $dados['minha_historia'] = $Galeriaminha_historia;

        $this->carregarViews('sobre', $dados);
    }



    public function quem_sou_eu()
    {






        if (!isset($_SESSION['userTipo'])  || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['quem_sou_eu'] = $this->quem_sou_eu->getGaleriaquemsoueu();

        $dados['conteudo'] = 'dash/sobre/quem_sou_eu';



        $this->carregarViews('dash/dashboard', $dados);
    }


    public function minha_historia()
    {






        if (!isset($_SESSION['userTipo'])  || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['minha_historia'] = $this->minha_historia->getGaleriaminha_historia();

        $dados['conteudo'] = 'dash/sobre/minha_historia';



        $this->carregarViews('dash/dashboard', $dados);
    }



    public function carrosel_sobre()
    {






        if (!isset($_SESSION['userTipo'])  || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['carrosel_sobre'] = $this->carrosel_sobre->getGaleriasobre();

        $dados['conteudo'] = 'dash/sobre/carrosel_sobre';



        $this->carregarViews('dash/dashboard', $dados);
    }
}
