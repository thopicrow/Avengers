<?php

namespace App\Repository;

use App\Entity\Filter;
use App\Entity\Sortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }

    public function findAll()
    {
        $qd = $this->createQueryBuilder('s');

        $qd->orderBy('s.dateHeureDebut', 'ASC');
        $qd->andWhere('s.dateHeureDebut > :dateArchive')
            ->setParameter('dateArchive', new \DateTime('-30 days'));

        $query = $qd->getQuery();
        return $query->execute();
    }

    public function findSorties(Filter $filter)
    {
        $qd = $this->createQueryBuilder('s');

        $qd->innerJoin('s.etat', 'e');

        $qd->andWhere('s.dateHeureDebut > :dateArchive')
            ->setParameter('dateArchive', new \DateTime('-30 days'));

        if ($filter->getSite() != null)
        {
            $qd->andWhere('s.site = :site')
                ->setParameter('site', $filter->getSite());
        }

        if ($filter->getKeyword() != '')
        {
            $qd->andWhere('s.nom LIKE :keyword');
            $qd->setParameter('keyword', '%' . $filter->getKeyword() . '%');
        }

        if ($filter->getDateDebut() != null && $filter->getDateFin() != null)
        {
            $qd->andWhere('s.dateHeureDebut BETWEEN :dateDebut AND :dateFin ')
                ->setParameter('dateDebut', $filter->getDateDebut())
                ->setParameter('dateFin', $filter->getDateFin());
        }

        if ($filter->isOrganisateur())
        {
            $qd->andWhere('s.user = :user')
                ->setParameter('user', $filter->getUser());
        }

        if ($filter->isInscrit())
        {
            $qd->andWhere(':user MEMBER OF s.inscrits')
                ->setParameter('user', $filter->getUser());
        }
        if ($filter->isNonInscrit())
        {
            $qd->andWhere(':user NOT MEMBER OF s.inscrits')
                ->setParameter('user', $filter->getUser());
        }
        if ($filter->isPast())
        {
            $qd->andWhere('e.libelle = :libelle')
                ->setParameter('libelle', 'Passée');
        }
        $qd->orderBy('s.dateHeureDebut', 'ASC');

        $query = $qd->getQuery();
        return $query->execute();

    }
}
