<?php

declare(strict_types=1);

namespace dungeonlands\vanillaitemsblocks\block;

use pocketmine\block\Button;

final class BambooButton extends Button{
	#[\Override] protected function getActivationTime() : int{
		return 0;
	}
}