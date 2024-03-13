<?php

declare(strict_types=1);

namespace dungeonlands\vanillaitemsblocks\block;

use dungeonlands\vanillaitemsblocks\ExtraVanillaBlocks;
use pocketmine\block\Block;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\Opaque;
use pocketmine\block\utils\BlockEventHelper;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Fertilizer;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\utils\Random;

/**
 * Code by Grass Block
 */
final class Nylium extends Opaque{

	public function getDropsForCompatibleTool(Item $item) : array{
		return [
			VanillaBlocks::NETHERRACK()->asItem()
		];
	}

	public function isAffectedBySilkTouch() : bool{
		return true;
	}

	public function ticksRandomly() : bool{
		return true;
	}

	public function onRandomTick() : void{
		$world = $this->position->getWorld();
		$blockAbove = $world->getBlockAt($this->position->x, $this->position->y + 1, $this->position->z);
		if(!$blockAbove->isTransparent() or $blockAbove->getTypeId() === BlockTypeIds::SNOW_LAYER){
			//nylium dies
			BlockEventHelper::spread($this, VanillaBlocks::DIRT(), $this);
		}
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		if($this->getSide(Facing::UP)->getTypeId() !== BlockTypeIds::AIR){
			return false;
		}

		if($item instanceof Fertilizer){
			$item->pop();
			$this->grow();

			return true;
		}

		return false;
	}

	//@tood add check if is crimson or nylium
	public function grow() : void{
		/** @var Block[] $arr */
		$arr = [
			VanillaBlocks::WARPED_ROOTS(), VanillaBlocks::CRIMSON_ROOTS(), ExtraVanillaBlocks::NETHER_SPROUTS()
		];

		$random = new Random(mt_rand());

		$count = 8;
		$radius = 2;

		$pos = $this->position;
		$world = $pos->world;

		$arrC = count($arr) - 1;
		for($c = 0; $c < $count; ++$c){
			$x = $random->nextRange($pos->x - $radius, $pos->x + $radius);
			$z = $random->nextRange($pos->z - $radius, $pos->z + $radius);
			if($world->getBlockAt($x, $pos->y + 1, $z)->getTypeId() === BlockTypeIds::AIR && $world->getBlockAt($x, $pos->y, $z) instanceof Nylium){
				$world->setBlockAt($x, $pos->y + 1, $z, $arr[$random->nextRange(0, $arrC)]);
			}
		}
	}
}