<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class Genealogy {

	private $em;

	public function __construct(EntityManagerInterface $em) {
		$this->em = $em;
	}

	public function makeTree($user) {
		$tree = [];
		$children = $this->getChildren($user);
		foreach ($children as $key => $member) {
			$tree[$key]['user'] = $member;
			if ($member) {
				$memberChildren = $this->getChildren($member);
			} else {
				$memberChildren = [
					'left'  => null,
					'right' => null,
				];
			}
			$tree[$key]['binary'] = $memberChildren;
		}
		return $tree;
	}


	public function getChildren($user) {
		$leftUser = $this->em->getRepository(User::class)->findOneBy(['poolParent' => $user, 'poolPosition' => 'L']);
		$rightUser = $this->em->getRepository(User::class)->findOneBy(['poolParent' => $user, 'poolPosition' => 'R']);
		return [
			'left'  => $leftUser,
			'right' => $rightUser
		];
	}

}