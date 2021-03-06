<?php

namespace delwhite\BlogBundle\Repository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends \Doctrine\ORM\EntityRepository
{
  public function findAllWithPaging($currentPage, $nbPerPage)
  {
      $query = $this->createQueryBuilder('article')
        ->getQuery()
        ->setFirstResult(($currentPage-1) * $nbPerPage)
        ->setMaxResults($nbPerPage)
      ;

      return new Paginator($query, true);
  }

  public function findByPublic()
  {
    return $this->findBy(
      array('published' => true),
      array('createdAt' => 'desc')
    );
  }

  public function findById($id)
  {
      return $this->findOneBy(
      array('published' => true, 'id' => 1)
    );
  }

  public function remove($id)
  {
    $article = $this->findById($id);

    if($article != null)
    {
      $em = $this->getDoctrine()->getManager();
      $em->remove($article);
      $em->flush();
    }
  }
}
