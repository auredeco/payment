<?php

namespace App\Controller;

use App\Entity\Payment;
use App\Form\PaymentType;

class IndexController extends BaseController
{
    public function index()
    {
        $form = $this->createForm(PaymentType::class, new Payment());

        return $this->render('index/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
