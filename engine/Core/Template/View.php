<?php

namespace Engine\Core\Template;

use Engine\Core\Template\Theme;

class View
{
   /**
    * @var \Engine\Core\Template\Theme
    */
   protected $theme;

   /**
    * View constructor.
    */
   public function __construct()
   {
      $this->theme = new Theme();
   }

   /**
    * @param $template
    * @param array $vars
    * @throws \Exception
    */
   public function render($template, $vars = [])
   {
      $templatePath = $this->getTemplatePath($template, ENV);

      if(!is_file($templatePath))
      {
         throw new \InvalidArgumentException(
            sprintf('Template "%s" not found in "%s"', $template, $templatePath)
         );
      }

      $this->theme->setData($vars);
      extract($vars);

      ob_start();
      ob_implicit_flush(0);

      try {
         require $templatePath;
      }catch (\Exception $e) {
         ob_end_clean();
         throw $e;
      }

      echo ob_get_clean();
   }

   /**
    * @param $template
    * @param null $env
    * @return string
    */
   private function getTemplatePath($template, $env = null)
   {
      if($env == 'Cms')
      {
         return ROOT_DIR . '/content/themes/default/' .  $template . '.php';
      }

      return ROOT_DIR . '/View/' .  $template . '.php';
   }
}