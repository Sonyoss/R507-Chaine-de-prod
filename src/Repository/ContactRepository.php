<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Contact>
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    /**
     * Paginate contacts.
     *
     * @return Contact[] Returns an array of Contact objects
     */
    public function paginate(int $page, int $limit): array
    {
        $offset = ($page - 1) * $limit;

        return $this->createQueryBuilder('c')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Search contacts by first name or last name.
     *
     * @return Contact[] Returns an array of Contact objects
     */
    public function search(string $search): array
    {
        $qb = $this->createQueryBuilder('c');

        return $qb
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->like('c.firstName', ':search'),
                    $qb->expr()->like('c.name', ':search'),
                )
            )
            ->setParameter('search', '%'.$search.'%')
            ->getQuery()
            ->getResult()
        ;
    }
}