<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
 */

declare(strict_types=1);

namespace dungeonlands\vanillaitemsblocks\block\tile;

use pocketmine\block\tile\Spawnable;
use pocketmine\math\Facing;
use pocketmine\nbt\tag\CompoundTag;

final final class Grindstone extends Spawnable{
	public const TAG_DIRECTION = "Direction"; //TAG_Int

	private int $facing = Facing::NORTH;

	public function getFacing() : int{ return $this->facing; }

	public function setFacing(int $facing) : void{ $this->facing = $facing; }

	protected function addAdditionalSpawnData(CompoundTag $nbt) : void{
		$nbt->setInt(self::TAG_DIRECTION, $this->facing);
	}

	public function readSaveData(CompoundTag $nbt) : void{
		$this->facing = $nbt->getInt(self::TAG_DIRECTION, Facing::NORTH);
	}

	protected function writeSaveData(CompoundTag $nbt) : void{
		$nbt->setInt(self::TAG_DIRECTION, $this->facing);
	}
}
