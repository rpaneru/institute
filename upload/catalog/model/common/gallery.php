<?php
class ModelCommonGallery extends Model 
{
    public function getGalleryData() 
    {
        $gallery_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "gallery` ");

        if ($gallery_query->num_rows) 
        {		
            return $gallery_query->rows;
        } 
        else 
        {
            return false;
        }
    }
}