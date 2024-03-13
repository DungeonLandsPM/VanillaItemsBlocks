<?php

declare(strict_types=1);

namespace dungeonlands\vanillaitemsblocks\block;

use pocketmine\block\BaseSign;

final class BambooWallSign extends BaseSign{
	#[\Override] protected function getSupportingFace() : int{
		return 0;
	}
}