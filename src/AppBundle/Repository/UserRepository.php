<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * @param User $user
     */
    public function saveUser(User $user)
    {
        $em = $this->getEntityManager();

        $em->persist($user);
        $em->flush();
    }

    /**
     * @param string $email
     * @return null|User
     */
    public function findByEmail($email)
    {
        return $this->findOneBy([
            'email' => $email,
        ]);
    }
}
