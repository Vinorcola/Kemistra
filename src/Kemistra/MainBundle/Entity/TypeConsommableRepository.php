<?php

namespace Kemistra\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;





/**
 * TypeConsommableRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TypeConsommableRepository extends EntityRepository
{
    public function getListeWithStock()
    {
        return $this->_em->createQueryBuilder()
                         ->from($this->_entityName, 'tc')->select('tc.id')->distinct(true)
                                                         ->addSelect('tc.nom')
                         ->join('tc.stockConsommables', 'sc')
                         
                         ->getQuery()->getResult();
    }
    
    
    
    
    
    public function getWithStock($id)
    {
        return $this->_em->createQueryBuilder()
                         ->from($this->_entityName, 'tc')->select('tc.id, tc.nom, tc.unite')
                         ->leftJoin('tc.stockConsommables', 'sc')->addSelect('sc.id as idStock, sc.numeroLot, sc.quantiteAchetee,  sc.quantiteRestante, sc.datePeremption')
                         ->where('tc.id = :id')
                         
                         ->setParameter('id', $id)
                         
                         ->getQuery()->getResult();
    }
}
