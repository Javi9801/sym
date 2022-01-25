<?php

namespace App\Repository;

use App\Entity\AlumnoAsignatura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AlumnoAsignatura|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlumnoAsignatura|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlumnoAsignatura[]    findAll()
 * @method AlumnoAsignatura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlumnoAsignaturaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlumnoAsignatura::class);
    }

    // /**
    //  * @return AlumnoAsignatura[] Returns an array of AlumnoAsignatura objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AlumnoAsignatura
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
