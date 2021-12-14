<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class UserFixtures extends Fixture
{
    private $encoder;
	/**
	* @var UserPasswordEncoderInterface
	**/
	public function __construct(UserPasswordEncoderInterface $encoder)
	{
		$this->encoder = $encoder;
	}

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setNom('ZIBELLI');
        $user->setPrenom('Ludovic');
        $user->setEmail('contact@zibelli-ludovic.fr');
        $user->setPoste('Chef de projet');
        $user->setTelephone('0662873229');
        $user->setRole('ROLE_ADMIN');
        $pass = 'Maely2809natha0213ziB';
        $encod = $this->encoder->encodePassword($user, $pass);
        $user->setPassword($this->encoder->encodePassword($user, 'Maely2809natha0213ziB'));
        $manager->persist($user);

        $manager->flush();
    }
}
