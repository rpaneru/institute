<?php
class ModelCommonGallery extends Model 
{
    public function getGalleryData($data) 
    {
        $sql = "SELECT * FROM `" . DB_PREFIX . "gallery` ";
        
        $sort_data = array(
			'id',
			'heading',
			'caption'
		);
        
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) 
        {
            $sql .= " ORDER BY " . $data['sort'];
        } 
        else 
        {
            $sql .= " ORDER BY id";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) 
        {
            $sql .= " DESC";
        } 
        else 
        {
            $sql .= " ASC";
        }

        $gallery_query = $this->db->query($sql);
                
        if ($gallery_query->num_rows) 
        {		
            return $gallery_query->rows;
        } 
        else 
        {
            return false;
        }
    }
    
    public function getTotalGallery() 
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "gallery");
        return $query->row['total'];
    }
    
    public function getGalleryInfo($id) 
    {
        $gallery_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "gallery` where `id` = '".(int)$id."' ");

        if ($gallery_query->num_rows) 
        {		
            return $gallery_query->rows[0];
        } 
        else 
        {
            return false;
        }
    }
    
    public function addGallery($data) 
    {
        $this->db->query("INSERT INTO " . DB_PREFIX . "gallery SET heading = '" .$this->db->escape($data['heading']) . "', caption = '" . $this->db->escape($data['caption']) . "'");
        $id = $this->db->getLastId();		
        return $id;
    }
    
    public function editGallery($id, $data) 
    {
        $this->db->query("UPDATE " . DB_PREFIX . "gallery SET heading = '" .$this->db->escape($data['heading']) . "', caption = '" . $this->db->escape($data['caption']) . "' where id = '".(int)$id."'");        
    }
    
    public function deleteGallery($id) 
    {
        $this->db->query("DELETE FROM " . DB_PREFIX . "gallery WHERE id = '" . (int)$id . "'");
    }
}