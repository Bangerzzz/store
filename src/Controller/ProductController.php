<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController{
    public function __construct(private ProductRepository $productRepository)
    {
        
    }
    #[Route('/product/{slug}',name:'product.detail')]
    public function detail(string $slug):Response{
        // $description= "SKINNY";
        // $product = [
        //     'Product-1' => ["Produit1",$description,50,"lux.png"],
        //     'Product-2' => ["Produit2",$description,100,"kota.jpg"],
        // ];
        $product = $this->productRepository->findOneByslug($slug);
        return $this->render('product/detail.html.twig',[
            'product'=> $product,
        ]);
    }

    #[Route('/products',name:'product.index')]
    #[Route('/products/page/{page}',name:'product.pagination')]
    public function index(int $page = null):Response{
        
        // $listProd = [
        //     'Product-1' => ["Produit1",50,"lux.png"],
        //     'Product-2' => ["Produit2",100,"kota.png"],
        // ];

        $results =$this->productRepository->TwelveProducts($page ?? 1,12)->getResult();
        $size = $this->productRepository->NbProducts()->getSingleScalarResult();
        $nbpage = ceil( $size / 12);
        //dd($nbpage);
        return $this->render('product/index.html.twig',[
            'products'=> $results,
            'nbPage' => $nbpage,
        ]); 
    }
}