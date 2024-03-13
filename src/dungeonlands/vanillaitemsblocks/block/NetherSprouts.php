<?php

declare(strict_types=1);

namespace dungeonlands\vanillaitemsblocks\block;

use pocketmine\block\Block;
use pocketmine\block\BlockToolType;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\utils\StaticSupportTrait;
use pocketmine\item\Item;
use pocketmine\math\Facing;

/**
 * Code by NetherRoots
 */
final class NetherSprouts extends Block{
	use StaticSupportTrait;

	public function getDropsForCompatibleTool(Item $item) : array{
		if(($item->getBlockToolType() & BlockToolType::SHEARS) !== 0){
			return [$this->asItem()];
		}

		return [];
	}

	private function canBeSupportedAt(Block $block) : bool{
		$supportBlock = $block->getSide(Facing::DOWN);
		return $supportBlock instanceof Nylium or
			$supportBlock->getTypeId() === BlockTypeIds::SOUL_SOIL or
			$supportBlock->getTypeId() === BlockTypeIds::GRASS or
			$supportBlock->getTypeId() === BlockTypeIds::PODZOL or
			$supportBlock->getTypeId() === BlockTypeIds::MYCELIUM or
			$supportBlock->getTypeId() === BlockTypeIds::DIRT or
			$supportBlock->getTypeId() === BlockTypeIds::FARMLAND;
	}
}