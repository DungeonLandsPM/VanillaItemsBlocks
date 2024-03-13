<?php

declare(strict_types=1);

namespace dungeonlands\vanillaitemsblocks\block;

use pocketmine\block\Block;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\Transparent;
use pocketmine\block\utils\StaticSupportTrait;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\math\Axis;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;

final class Scaffolding extends Transparent{
	use StaticSupportTrait;

	protected int $stabiltiy = 0;
	protected bool $stabiltyCheck = false;

	protected function recalculateCollisionBoxes() : array{
		$bb = AxisAlignedBB::one();
		foreach($this->getAllSides() as $facing => $block){
			if(!$this->canBeSupportedBy($block)){
				$bb->trim($facing, 2 / 16);
			}
		}

		return [$bb];
	}

	private function canBeSupportedBy(Block $block) : bool{
		return $block->hasSameTypeId($this) || !$block->isSolid();
	}

	private function canBeSupportedAt(Block $block) : bool{
		$position = $block->position;
		$world = $position->getWorld();

		$down = $world->getBlock($position->down());
		$verticalAir = $down->getTypeId() === BlockTypeIds::AIR || $world->getBlock($position->up())->getTypeId() === BlockTypeIds::AIR;

		foreach($position->sidesAroundAxis(Axis::Y) as $sidePosition){
			$block = $world->getBlock($sidePosition);

			if($block->hasSameTypeId($this)){
				if(!$verticalAir){
					return false;
				}

				if($this->canBeSupportedBy($block->getSide(Facing::DOWN))){
					return true;
				}
			}
		}

		return $this->canBeSupportedBy($down);
	}

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->boundedInt(3, 0, 7, $this->stabiltiy);
		$w->bool($this->stabiltyCheck);
	}

	public function canClimb() : bool{
		return true;
	}

	public function getFuelTime() : int{
		return 50;
	}
}