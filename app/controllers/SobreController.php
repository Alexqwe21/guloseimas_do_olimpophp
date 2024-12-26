<?php

class SobreController extends Controller
{



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
}
