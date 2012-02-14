<?php
class Category
{
    function getCategories()
    {
        $result = R::getAll('select * from categories');
        return $result;
    }
    function getCategory($id)
    {
        $result = R::getRow('select * from categories where id=?', array($id));
        return $result;
    }
    function deleteCategory($id)
    {
        $one = R::load('categories',$id);
        R::trash($one);
    }
    function addCategory($data)
    {
        $one = R::dispense('categories');
        foreach ($data as $key => $val) {
            $one->$key = $val;
        }
        $id=R::store($one);       
    }
    function editCategory($id,$data)
    {
        $one = R::load('categories',$id);
        foreach ($data as $key => $val) {
            $one->$key = $val;
        }
        R::store($one);
    }
}