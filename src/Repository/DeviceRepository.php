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

        if (!empty($data['searchByBrand'])) {
            $queryBuilder = $queryBuilder
                ->andWhere('d.brand LIKE :brand')
                ->setParameter('brand', '%' . $data['searchByBrand'] .'%');
        }

        if (!empty($data['model'])) {
            $queryBuilder = $queryBuilder
                ->andWhere('d.model IN (:model)')
                ->setParameter('model', $data['model']);
        }     
        
        if (!empty($data['price'])) {
            $queryBuilder = $queryBuilder
                ->andWhere('d.price <= :price')
                ->setParameter('price', $data['price']);
        }

        if (!empty($data['agency'])) {
            $queryBuilder = $queryBuilder
                ->andWhere('d.agency IN (:agency)')
                ->setParameter('agency', $data['agency']);
        }

        if (!empty($data['soldAt'])) {
            $queryBuilder = $queryBuilder
                ->andWhere('d.soldAt IS NULL');
            }
        
        // $queryBuilder = $queryBuilder
        //     ->orderBy('d.price')
        //     ->getQuery();

        //     dd($queryBuilder->getResult());

        if (!empty($data['state'])) {
            $queryBuilder = $queryBuilder
                ->andWhere('d.state IN (:state)')
                ->setParameter('state', $data['state']);
        }

        $queryBuilder ->orderBy('d.price', 'DESC')
            ->getQuery();

        $queryBuilder = $queryBuilder
            ->orderBy('d.price')
            ->getQuery();

        return $queryBuilder->getResult();

    }

}
