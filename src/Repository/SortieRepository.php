<?php

namespace App\Repository;

use App\Entity\Sortie;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }

    public function findByEtat()
    {
        $em = $this->getEntityManager();
        $dql = <<<SQL
SELECT sortie FROM App\Entity\Sortie sortie
INNER JOIN sortie.etat e
WHERE e.libelle = 'Passée'
SQL;

        $query = $em->createQuery($dql);
        $result = $query->getResult();
        return $result;
    }

    public function findByInscrit(User $user)
    {
        $em = $this->getEntityManager();
        $dql = <<<SQL
SELECT sortie FROM App\Entity\Sortie sortie
WHERE :userOnline MEMBER OF sortie.inscrits
SQL;

        $query = $em->createQuery($dql);
        $query->setParameter('userOnline', $user);
        $result = $query->getResult();
        return $result;
    }

    public function findByNonInscrit(User $user)
    {
        $em = $this->getEntityManager();
        $dql = <<<SQL
SELECT sortie FROM App\Entity\Sortie sortie
WHERE :userOnline NOT MEMBER OF sortie.inscrits
SQL;

        $query = $em->createQuery($dql);
        $query->setParameter('userOnline', $user);
        $result = $query->getResult();
        return $result;
    }

    public function findSorties($site,
                                $keyword,
        //$dateDebut,
        //$dateFin,
                                $organisateur,
        //$inscrit,
        //$nonInscrit,
        //$past,
                                $user)
    {
        $qd = $this->createQueryBuilder('s');
        $qd->andWhere('s.site = :site')
           ->setParameter('site', $site);

        if ($keyword != '') {
            $qd->andWhere('s.nom LIKE :keyword');
            $qd->setParameter('keyword', '%' . $keyword . '%');
        }
        if ($organisateur === 'on') {
            $qd->andWhere('s.user = :user')
                ->setParameter('user', $user);
            $qd->innerJoin('s.etat', 'e')
                ->andWhere('e.libelle = :libelle')
                ->setParameter('libelle', 'Passée');
        }

        $query = $qd->getQuery();
        return $query->execute();

    }
}
