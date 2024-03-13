<?php

declare(strict_types=1);

namespace dungeonlands\vanillaitemsblocks\block;

use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\Transparent;
use pocketmine\block\utils\FacesOppositePlacingPlayerTrait;
use pocketmine\block\utils\LightableTrait;
use pocketmine\data\runtime\RuntimeDataDescriber;

final class Campfire extends Transparent{
	use FacesOppositePlacingPlayerTrait;
	use LightableTrait;

	public function __construct(BlockIdentifier $idInfo, string $name, BlockTypeInfo $typeInfo){
		parent::__construct($idInfo, $name, $typeInfo);
	}

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->horizontalFacing($this->facing);
		$w->bool($this->lit);
	}

	public function getLightLevel() : int{
		return $this->lit ? 13 : 0;
	}
}