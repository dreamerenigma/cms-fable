<?php

namespace Admin\Controller;

class PageController extends AdminController
{
   public function listing()
   {
      $pageModel = $this->load->model('Page');

      $data['pages'] = $pageModel->repository->getPages();

      $this->view->render('pages/list', $data);
   }

   public function create()
   {
      $pageModel = $this->load->model('Page');

      $this->view->render('pages/create');
   }

   public function edit($id)
   {
      $pageModel = $this->load->model('Page');

      $this->data['page'] = $pageModel->repository->getPageData($id);

      $this->view->render('pages/edit', $this->data);
   }

   public function add()
   {
      $params    = $this->request->post;
      $pageModel = $this->load->model('Page');

      if (isset($params['title'])) {
         $pageId = $pageModel->repository->createPage($params);
         echo $pageId;
      }
   }
}