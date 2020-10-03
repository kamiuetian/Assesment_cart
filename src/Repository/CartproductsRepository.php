<?php

namespace App\Repository;

use App\Entity\Cartproducts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cartproducts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cartproducts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cartproducts[]    findAll()
 * @method Cartproducts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartproductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cartproducts::class);
    }

    // /**
    //  * @return Cartproducts[] Returns an array of Cartproducts objects
    //  */
     

    
   public function findOneBySomeField($value): ?Cartproducts
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.productId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
     
    
    
}
