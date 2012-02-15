<?php
return array(
        'GET /admin/category' => function  ()
        {
            $category = new Category();
            $categories = $category->getCategories();
            $lang = new Language();
            $langs = $lang->getLangs();
            $details = json_decode($categories[0]['detail']);
            for ($i = 0; $i < count($details); $i ++) {
                $details[$i]->display_name = htmlspecialchars(
                        $details[$i]->display_name);
            }
            
            $syns_array = array();
            foreach ($langs as $lang) {
                $obj = array();
                $obj['lang_id'] = $lang['id'];
                $obj['lang_name'] = $lang['name'];
                $obj['display_name'] = '';
                foreach ($details as $detail) {
                    if ($lang['id'] == $detail->lang_id) {
                        $obj['display_name'] = $detail->display_name;
                        break;
                    }
                }
                array_push($syns_array, $obj);
            }
            return View::make('layouts.admin')->nest('content', 
                    'category.index', 
                    array('categories' => $categories, 'details' => $syns_array, 
                            'cat_id' => $categories[0]['id']));
        }, 
        'GET /admin/category/(:num)' => function  ($id)
        {
            $category = new Category();
            $categories = $category->getCategories();
            $one = $category->getCategory($id);
            
            $lang = new Language();
            $langs = $lang->getLangs();
            $details = json_decode($one['detail']);
            for ($i = 0; $i < count($details); $i ++) {
                $details[$i]->display_name = htmlspecialchars(
                        $details[$i]->display_name);
            }
            $syns_array = array();
            foreach ($langs as $lang) {
                $obj = array();
                $obj['lang_id'] = $lang['id'];
                $obj['lang_name'] = $lang['name'];
                $obj['display_name'] = '';
                foreach ($details as $detail) {
                    if ($lang['id'] == $detail->lang_id) {
                        $obj['display_name'] = $detail->display_name;
                        break;
                    }
                }
                array_push($syns_array, $obj);
            }
            return View::make('layouts.admin')->nest('content', 
                    'category.index', 
                    array('categories' => $categories, 'details' => $syns_array, 
                            'cat_id' => $id));
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
        
        'POST /admin/category, POST /admin/category/(:num)' => function  (
                $cat_id = null)
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
            return Redirect::to('admin/category/' . $cat_id);
        });        
        