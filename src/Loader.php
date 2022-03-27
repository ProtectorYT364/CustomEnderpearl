<?php

declare(strict_types=1);

namespace VaxPex;

use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemIds;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\plugin\PluginBase;
use pocketmine\world\World;
use VaxPex\entities\CustomEnderpearlEntity;
use VaxPex\items\CustomEnderpearlItem;

class Loader extends PluginBase {

	protected function onEnable(): void
	{
		EntityFactory::getInstance()->register(CustomEnderpearlEntity::class, function (World $world, CompoundTag $nbt) : CustomEnderpearlEntity{
			return new CustomEnderpearlEntity(EntityDataHelper::parseLocation($nbt, $world), null, $nbt);
		}, ["customenderpearl:entity"]);
		ItemFactory::getInstance()->register(new CustomEnderpearlItem(new ItemIdentifier(ItemIds::ENDER_PEARL, 0)), true);
	}

}