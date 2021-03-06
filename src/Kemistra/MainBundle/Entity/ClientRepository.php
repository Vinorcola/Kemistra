<?php

namespace Kemistra\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ClientRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClientRepository extends EntityRepository
{
    public function getListeParticuliers()
    {
        return $this->_em->createQueryBuilder()
                         ->from($this->_entityName, 'cl')->select('cl.id, cl.nom, cl.prenom')
                         ->where('cl.prenom IS NOT NULL')
                         ->orderBy('cl.nom, cl.prenom')
                         
                         ->getQuery()->getResult();
    }
    
    
    
    
    
    public function getListeProfessionels()
    {
        return $this->_em->createQueryBuilder()
                         ->from($this->_entityName, 'cl')->select('cl.id, cl.nom')
                         ->where('cl.prenom IS NULL')
                         ->orderBy('cl.nom, cl.prenom')
                         
                         ->getQuery()->getResult();
    }
    
    
    
    
    
    public function getOneDetails($id)
    {
        return $this->_em->createQueryBuilder()
                         ->from($this->_entityName, 'c')->select('c')
                         ->join('c.ville', 'v')->addSelect('v')
                         ->leftJoin('c.analyses', 'a')->addSelect('a')
                         ->leftJoin('a.typeAnalyse', 'ta')->addSelect('ta')
                         ->where('c.id = :id')
                         ->orderBy('a.date', 'DESC')
                         
                         ->setParameter('id', $id)
                         
                         ->getQuery()->getSingleResult();
    }
}
