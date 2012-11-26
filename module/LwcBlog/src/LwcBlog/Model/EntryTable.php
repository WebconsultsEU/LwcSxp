<?php
namespace LwcBlog\Model;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

class EntryTable extends AbstractTableGateway
{

    protected $table = 'entry';

    public function __construct (Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Entry());
        $this->initialize();
    }
    
    /**
     *
     * @return ResultSet
     */
    public function fetchAll ()
    {
        $resultSet = $this->select();
        return $resultSet;
    }
    
    public function fetchAllDesc()
    {
        $select = $this->getSql()->select()->order("created DESC");
        $resultSet = $this->selectWith($select);
        return $resultSet;
    }
    
    
    public function getAll(ResultSet $resultSet)
    {
       
       $results = array();
       foreach($resultSet as $result) {
           $results[] = $resultSet->current();
           $resultSet->next();
           
       }
       return $results;
    }

    public function getEntry ($id)
    {
        $id = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (! $row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveEntry (Entry $entry)
    {
        
        $data = array(
                     'title'   => $entry->title, 
                     'text'    => $entry->text, 
                     'created' => $entry->created, 
                     'author'  => $entry->author, 
                     );
        $id = (int) $entry->getId();
        if ($id == 0) {            
            $this->insert($data);
            //@todo verify if this way works            
            return $this->getEntry($this->getLastInsertValue());
           
        } else {
            if ($this->getEntry($id)) {
                $this->update($data, array('id' => $id));
                return $entry;
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteLocation ($id)
    {
        $this->delete(array('id' => $id));
    }
}