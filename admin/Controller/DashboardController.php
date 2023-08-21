<?php

namespace Admin\Controller;

class DashboardController extends AdminController
{
   public function index()
   {
      $userModel = $this->load->model('User');

      $userModel->repository->test();

      $this->view->render('dashboard');
   }
}