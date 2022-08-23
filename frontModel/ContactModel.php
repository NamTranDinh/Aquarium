<?php 
class ContactModel extends BaseModel{
    public function ContactData()
    {
        return $this->buildQueryParam([
            'select' => '*',
            'from'   => 'ep_contact',
            'where'  => '',
        ])->select();
    }
}