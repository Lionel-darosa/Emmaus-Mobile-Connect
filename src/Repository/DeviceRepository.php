<?php

namespace App\Repository;

use App\Entity\Device;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Device>
 *
 * @method Device|null find($id, $lockMode = null, $lockVersion = null)
 * @method Device|null findOneBy(array $criteria, array $orderBy = null)
 * @method Device[]    findAll()
 * @method Device[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeviceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Device::class);
    }

    public function save(Device $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Device $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function sortDevices(array $data)
    {
        $queryBuilder = $this->createQueryBuilder('d')
            ->select('d');
        
        if (!empty($data['screenSize'])) {
            $queryBuilder = $queryBuilder
                ->addOrderBy('d.screenSize', 'DESC');
        }

        if (!empty($data['ram'])) {
            $queryBuilder = $queryBuilder
                ->addOrderBy('d.ram', 'DESC');
        }

        if (!empty($data['storage'])) {
            $queryBuilder = $queryBuilder
                ->addOrderBy('d.storage', 'DESC');
        }

        if (!empty($data['price'])) {
            $queryBuilder = $queryBuilder
                ->addOrderBy('d.price', 'ASC');
        }

        $queryBuilder = $queryBuilder
            ->getQuery();
        return $queryBuilder->getResult();

    }

    public function filterDevices(array $data)
    {
        $queryBuilder = $this->createQueryBuilder('d')
            ->select('d');

        if (!empty($data['searchDevice'])) {
            $queryBuilder = $queryBuilder
                ->andWhere('d.brand Like :brand')
                ->andWhere('d.model LIKE :model')
                ->setParameter('brand', '%' . $data['searchDevice'] . '%');
        }
        
        if (!empty($data['price'])) {
            $queryBuilder = $queryBuilder
                ->addOrderBy('d.price');
        }

        if (!empty($data['agency'])) {
            $queryBuilder = $queryBuilder
                ->addOrderBy('d.agency');
        }

        if (!empty($data['state'])) {
            $queryBuilder = $queryBuilder
                ->addOrderBy('d.state');
        }

        if (!empty($data['soldAt'])) {
            $queryBuilder = $queryBuilder
                ->addOrderBy('d.soldAT');
        }

        $queryBuilder = $queryBuilder
            ->getQuery();
        return $queryBuilder->getResult();

    }

//    /**
//     * @return Device[] Returns an array of Device objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Device
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
