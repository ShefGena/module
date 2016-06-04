<?php

class Page extends  Model
{


    public function getLastNewsByCategory($category)
    {
        $sql = "SELECT * FROM news WHERE category_id = '{$category}' ORDER BY id DESC LIMIT 5";
        return $this->db->query($sql);
    }

    public function getLastNews()
    {
        $sql = "SELECT title, img_link FROM news ORDER BY id DESC LIMIT 3";
        return $this->db->query($sql);
    }

    public function getNumberOfPages($category)
    {
        $sql = "SELECT COUNT(*) as cnt FROM news WHERE category_id = '{$category}'";
        return $this->db->query($sql);

    }

    public function getPaginationNews($page, $category)
    {
        if($page<1 ){
            $page = 1;
        }
        $limit = $page * 5;
        $start = $limit - 5;
        $sql = "SELECT * FROM news WHERE category_id = '{$category}' ORDER BY id DESC LIMIT {$start},5";
        return $this->db->query($sql);
    }

    public function getSomeNews($params)
    {
        if($params>0){
            $sql = "SELECT * FROM news WHERE id = {$params}";
            return $this->db->query($sql);
        }
        return false;

    }

    public function getTagName($search)
    {
        $sql = "SELECT * FROM catregory WHERE categories LIKE '{$search}%' ";
        return $this->db->query($sql);
    }

    public function getList($only_published = false)
    {
        $sql = "SELECT * FROM news_all ORDER BY id DESC";
        if ($only_published) {
            $sql .= " AND is_published = 1";
        }
        return $this->db->query($sql);
    }

    public function getByAlias($alias)
    {
        $alias = $this->db->escape($alias);
        $sql = "SELECT * FROM pages where alias = '{$alias}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function getById($id)
    {
        $id = (int)$id;
        $sql = "SELECT * FROM news where id = '{$id}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function save($data, $id = null)
    {
        if (!isset($data['link']) || !isset($data['title'])  || !isset($data['content'])) {
            return false;
        }
        $id = (int)$id;
        $link = $this->db->escape($data['link']);
        $title  = $this->db->escape($data['title']);
        $content = $this->db->escape($data['content']);
        $category = $this->db->escape($data['category']);


        if ( !$id ) { // Add new record
            $sql = "
                    INSERT INTO news
                    set img_link = '{$link}',
                        title = '{$title}',
                        content = '{$content }',
                        category_id = '{$category}'

            ";
        } else {// Update existing record
            $sql = "
                    UPDATE news
                    set img_link = '{$link}',
                        title = '{$title}',
                        content = '{$content }',
                        category_id = '{$category}'

                    WHERE id = '{$id}'
            ";
        }

        return $this->db->query($sql);
    }

    public function delete($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM news WHERE id = '{$id}'";
        return $this->db->query($sql);
    }
}