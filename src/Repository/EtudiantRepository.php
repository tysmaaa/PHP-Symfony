<?php

namespace App\Repository;

use App\Entity\Etudiant;
use ContainerCEyEHcV\getRedirectControllerService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @extends ServiceEntityRepository<Etudiant>
 *
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

    public function findMineurs() : array {
        // Utiliser le langage DQL (Doctrine Query Language)
        // Exprimer des requêtes se basant sur le modèle objet (Entity)
        // La requête DQL sera trasnformée en requête SQL par Doctrine
        // Lors de l'exécution de la méthode

        $dateMajorite = new \DateTime("-18 years");
        // 1. exprimer la requête DQL
        $requeteDQL = "SELECT etudiant FROM App\Entity\Etudiant as etudiant.dateNaissance > :dateMajorite";
        // 2. Construire la requête
        $requete = $this->getEntityManager()->createQuery($requeteDQL);
        // 3. Donner une valeur au paramètre de la requête (:dateMajorite)
        $requete->setParameter('dateMajorite', $dateMajorite);
        // 4. Exécuter la requête et retourner le résultat
        dd($requete->getDQL());
        return $requete->getResult();
    }

    public function findMineurs2() : array {
        // Utiliser le Query Builder : classe permettant de construire
        // dynamiquement des requêtes DQL

        $dateMajorite = new \DateTime("-18 years");
        return $this->createQueryBuilder("e")
            ->where('e.dateNaissance > :dateMajorite')
            ->setParameter('dateMajorite', $dateMajorite)
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return Etudiant[] Returns an array of Etudiant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Etudiant
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
