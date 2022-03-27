<?php

declare(strict_types=1);

namespace VaxPex\entities;

use pocketmine\entity\projectile\EnderPearl;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\ProjectileHitEvent;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\world\particle\EndermanTeleportParticle;
use pocketmine\world\sound\EndermanTeleportSound;
use function sqrt;
use function abs;
use function atan;

class CustomEnderpearlEntity extends EnderPearl {

	protected function onHit(ProjectileHitEvent $event) : void{
		$owner = $this->getOwningEntity();
		if($owner !== null){
			$target = $event->getRayTraceResult()->getHitVector();
			$this->getWorld()->addParticle($origin = $owner->getPosition(), new EndermanTeleportParticle());
			$this->getWorld()->addSound($origin, new EndermanTeleportSound());
			$x = 0;
			$z = 0;
			$y = 0;
			//TODO: MAKE IT BETTER
			if($owner->getHorizontalFacing() == Facing::SOUTH){
				$x = 0.8;
				$z = sqrt(abs(($target->getX() * 3.8) * abs($target->getZ() * 3.8) * atan(3.8) * 4.8)) / 2;
				//TODO: Y
			}elseif($owner->getHorizontalFacing() == Facing::NORTH){
				$x = -0.8;
				$z = -sqrt(abs(($target->getX() * 2.8) * abs($target->getZ() * 2.8) * atan(2.8) * 4.8)) / 2;
			}elseif($owner->getHorizontalFacing() == Facing::WEST){
				$x = -3.8;
				//TODO: Y
				//TODO: Z
			}elseif($owner->getHorizontalFacing() == Facing::EAST){
				$x = 3.8;
				//TODO: Y
				//TODO: Z
			}
			echo $owner->getHorizontalFacing() . PHP_EOL;
			$owner->setMotion(new Vector3($x, $y, $z));
			$this->getWorld()->addSound($target, new EndermanTeleportSound());

			$owner->attack(new EntityDamageEvent($owner, EntityDamageEvent::CAUSE_FALL, 5));
		}
	}
}