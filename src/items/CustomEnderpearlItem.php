<?php

declare(strict_types=1);

namespace VaxPex\items;

use pocketmine\entity\Location;
use pocketmine\entity\projectile\Throwable;
use pocketmine\item\EnderPearl;
use pocketmine\player\Player;
use VaxPex\entities\CustomEnderpearlEntity;

class CustomEnderpearlItem extends EnderPearl {

	protected function createEntity(Location $location, Player $thrower) : Throwable{
		return new CustomEnderpearlEntity($location, $thrower);
	}
}