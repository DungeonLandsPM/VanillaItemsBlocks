<?php

declare(strict_types=1);

namespace dungeonlands\vanillaitemsblocks\block\utils;

use pocketmine\utils\LegacyEnumShimTrait;

/**
 * @method static AttachmentType CEILING()
 * @method static AttachmentType FLOOR()
 * @method static AttachmentType ONE_WALL()
 * @method static AttachmentType TWO_WALLS()
 */
enum AttachmentType{
	use LegacyEnumShimTrait;

	case CEILING;
	case FLOOR;
	case ONE_WALL;
	case TWO_WALLS;
}
