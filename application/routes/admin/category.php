<?php
return array(
        'GET /admin/category' => function  ()
        {
            $category = new Category();
            $categories = $category->getCategories();
            $lang = new Language();
            $langs = $lang->getLangs();
            $langs_clone = $langs;
            $details = json_decode($categories[0]['detail']);
            for ($i = 0; $i < count($details); $i ++) {
                $details[$i]->display_name = htmlspecialchars(
                        $details[$i]->display_name);
            }
            if (count($langs) > count($details) && count($details) > 0) {
                foreach ($details as $detail) {
                    foreach ($langs as $lang) {
                        if ($detail->lang_id == $lang['id']) {
                            $k = array_keys($langs, $lang);
                            unset($langs_clone[$k[0]]);
                            break;
                        }
                    }
                }
            } else {               
                $langs_clone = array();
            }
            return View::make('layouts.admin')->nest('content', 
                    'category.index', 
                    array('categories' => $categories, 'details' => $details, 
                            'langs' => $langs_clone, 
                            'cat_id' => $categories[0]['id']));
        }, 
        'GET /admin/category/(:num)' => function  ($id)
        {
            $category = new Category();
            $categories = $category->getCategories();
            $one = $category->getCategory($id);
            
            $lang = new Language();
            $langs = $lang->getLangs();
            $langs_clone = $langs;
            $details = json_decode($one['detail']);
            for ($i = 0; $i < count($details); $i ++) {
                $details[$i]->display_name = htmlspecialchars(
                        $details[$i]->display_name);
            }
            if (count($langs) > count($details)) {
                foreach ($details as $detail) {
                    foreach ($langs as $lang) {
                        if ($detail->lang_id == $lang['id']) {
                            $k = array_keys($langs, $lang);
                            unset($langs_clone[$k[0]]);
                            break;
                        }
                    }
                }
            } else {
                $langs_clone = array();
            }
            return View::make('layouts.admin')->nest('content', 
                    'category.index', 
                    array('categories' => $categories, 'details' => $details, 
                            'langs' => $langs_clone, 'cat_id' => $id));
        }, 
        'GET /admin/category/add' => function  ()
        {
            $lang = new Language();
            return View::make('layouts.admin')->nest('content', 'category.add', 
                    array('langs' => $lang->getLangs()));
        }, 
        
        'POST /admin/category/add' => function  ()
        {
            $details = array();
            for ($i = 0; $i < count($_POST['lang_id']); $i ++) {
                $detail['lang_id'] = $_POST['lang_id'][$i];
                $detail['lang_name'] = $_POST['lang_name'][$i];
                $detail['display_name'] = $_POST['display_name'][$i];
                array_push($details, $detail);
            }
            
            $category = new Category();
            $category->addCategory(
                    array('name' => $_POST['name'], 
                            'detail' => json_encode($details)));
            return Redirect::to('admin/category');
        }, 
        
        'POST /admin/category, POST /admin/category/(:num)' => function  ($cat_id=null)
        {
            $details = array();
            for ($i = 0; $i < count($_POST['lang_id']); $i ++) {
                $detail['lang_id'] = $_POST['lang_id'][$i];
                $detail['lang_name'] = $_POST['lang_name'][$i];
                $detail['display_name'] = $_POST['display_name'][$i];
                array_push($details, $detail);
            }
            $id = $_POST['id'];
            $category = new Category();
            $category->editCategory($id, 
                    array('detail' => json_encode($details)));
            return Redirect::to('admin/category/'.$cat_id);
        });        
        