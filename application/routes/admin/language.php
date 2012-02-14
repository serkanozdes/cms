<?php
return array(
        
        'GET /admin/language' => function  ()
        {
            $lang = new Language();
            return View::make('layouts.admin')->nest('content', 
                    'language.index', array('langs' => $lang->getLangs()));
        }, 
        
        'POST /admin/language/add' => function  ()
        {
            $lang = new Language();
            $lang->addLang($_POST);
            return Redirect::to('/admin/language');
        }, 
        
        'GET /admin/language/edit/(:num)' => function  ($id)
        {
            $lang = new Language();
            return View::make('layouts.admin')->nest('content', 'language.edit', 
                    array('langs' => $lang->getLangs(), 
                            'lang' => $lang->getLang($id)));
        }, 
        'POST /admin/language/edit/(:num)' => function  ($id)
        {
            $lang = new Language();
            $lang->updateLang($id, $_POST);
            return View::make('layouts.admin')->nest('content', 'language.edit', 
                    array('langs' => $lang->getLangs(), 
                            'lang' => $lang->getLang($id)));
        }, 
        
        'GET /admin/language/delete/(:num)' => function  ($id)
        {
            $lang = new Language();
            $lang->deleteLang($id);
            return Redirect::to('/admin/language');
        })

;