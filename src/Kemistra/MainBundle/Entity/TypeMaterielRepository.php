<?php

namespace Kemistra\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;





/**
 * TypeMaterielRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TypeMaterielRepository extends EntityRepository
{
    public function getListeWithStock()
    {
        $qb = $this->_em->createQueryBuilder()
                        ->from($this->_entityName, 'tm')->select('tm.id')->distinct(true)
                                                        ->addSelect('tm.nom')
                        ->join('tm.stockMateriel', 'sm');
        
        return $qb->getQuery()->getResult();
    }
    
    
    
    
    
    public function getWithStock($id)
    {
        $qb = $this->_em->createQueryBuilder()
                        ->from($this->_entityName, 'tm')->select('tm.id, tm.nom')
                        ->leftJoin('tm.stockMateriel', 'sm')->addSelect('sm.id as idStock, sm.quantite, sm.dateAchat')
                        ->where('tm.id = :id')->setParameter('id', $id);
        
        return $qb->getQuery()->getResult();
    }
}