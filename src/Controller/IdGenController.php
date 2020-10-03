<?php
namespace App\Controller;
use Doctrine\ORM\Id\AbstractIdGenerator;
class IdGenController extends AbstractIdGenerator
{
    public function generate(\Doctrine\ORM\EntityManager $em, $entity)
    {
        $id='';
        for($i = 0; $i < 5; $i++) {
            $id .= mt_rand(0, 9);
        }
        
        return $id;
    }
}
?>