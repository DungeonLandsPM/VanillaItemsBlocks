<?php

declare(strict_types=1);

namespace dungeonlands\vanillaitemsblocks\block;

use pocketmine\block\Opaque;
use pocketmine\item\Item;

final class PowderSnow extends Opaque{
	public function getDropsForCompatibleTool(Item $item) : array{
		return [];
	}

	public function getSilkTouchDrops(Item $item) : array{
		return [];
	}
}