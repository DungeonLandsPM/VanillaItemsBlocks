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

namespace dungeonlands\vanillaitemsblocks;

use dungeonlands\vanillaitemsblocks\block\BambooBlock;
use dungeonlands\vanillaitemsblocks\block\BambooButton;
use dungeonlands\vanillaitemsblocks\block\BambooDoor;
use dungeonlands\vanillaitemsblocks\block\BambooFence;
use dungeonlands\vanillaitemsblocks\block\BambooFenceGate;
use dungeonlands\vanillaitemsblocks\block\BambooMosaic;
use dungeonlands\vanillaitemsblocks\block\BambooMosaicSlab;
use dungeonlands\vanillaitemsblocks\block\BambooMosaicStairs;
use dungeonlands\vanillaitemsblocks\block\BambooPlanks;
use dungeonlands\vanillaitemsblocks\block\BambooPressurePlate;
use dungeonlands\vanillaitemsblocks\block\BambooSign;
use dungeonlands\vanillaitemsblocks\block\BambooSlab;
use dungeonlands\vanillaitemsblocks\block\BambooStairs;
use dungeonlands\vanillaitemsblocks\block\BambooTrapdoor;
use dungeonlands\vanillaitemsblocks\block\BambooWallSign;
use dungeonlands\vanillaitemsblocks\block\BubbleColumn;
use dungeonlands\vanillaitemsblocks\block\Campfire;
use dungeonlands\vanillaitemsblocks\block\Composter;
use dungeonlands\vanillaitemsblocks\block\CrimsonNylium;
use dungeonlands\vanillaitemsblocks\block\Dripstone;
use dungeonlands\vanillaitemsblocks\block\Grindstone;
use dungeonlands\vanillaitemsblocks\block\Honey;
use dungeonlands\vanillaitemsblocks\block\InfestedDeepslate;
use dungeonlands\vanillaitemsblocks\block\MangrovePropagule;
use dungeonlands\vanillaitemsblocks\block\MossBlock;
use dungeonlands\vanillaitemsblocks\block\MossCarpet;
use dungeonlands\vanillaitemsblocks\block\NetherSprouts;
use dungeonlands\vanillaitemsblocks\block\PowderSnow;
use dungeonlands\vanillaitemsblocks\block\Scaffolding;
use dungeonlands\vanillaitemsblocks\block\SculkCatalyst;
use dungeonlands\vanillaitemsblocks\block\SculkSensor;
use dungeonlands\vanillaitemsblocks\block\SculkShrieker;
use dungeonlands\vanillaitemsblocks\block\SculkVein;
use dungeonlands\vanillaitemsblocks\block\Seagrass;
use dungeonlands\vanillaitemsblocks\block\SeaTurtleEgg;
use dungeonlands\vanillaitemsblocks\block\StructureVoid;
use dungeonlands\vanillaitemsblocks\block\SuspiciousBlock;
use dungeonlands\vanillaitemsblocks\block\Target;
use dungeonlands\vanillaitemsblocks\block\Nylium;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\SimplePillar;
use pocketmine\block\utils\WoodType;
use pocketmine\item\ToolTier;
use pocketmine\utils\CloningRegistryTrait;

/**
 * This doc-block is generated automatically, do not modify it manually.
 * This must be regenerated whenever registry members are added, removed or changed.
 * @see build/generate-registry-annotations.php
 * @generate-registry-docblock
 *
 * @method static BambooBlock BAMBOO_BLOCK()
 */
final class ExtraVanillaBlocks{
	use CloningRegistryTrait;

	private function __construct(){
		//NOOP
	}

	protected static function register(string $name, Block $block) : void{
		self::_registryRegister($name, $block);
	}

	/**
	 * @return Block[]
	 * @phpstan-return array<string, Block>
	 */
	public static function getAll() : array{
		//phpstan doesn't support generic traits yet :(
		/** @var Block[] $result */
		$result = self::_registryGetAll();
		return $result;
	}

	protected static function setup() : void{
		//https://github.com/pmmp/PocketMine-MP/projects/14#card-84464964
		self::register("grindstone", new Grindstone(new BlockIdentifier(BlockTypeIds::newId()), "Grindstone", new BlockTypeInfo(BlockBreakInfo::pickaxe(2))));

		//https://github.com/pmmp/PocketMine-MP/projects/14#card-84464959
		self::register("infested_deepslate", new SimplePillar(new BlockIdentifier(BlockTypeIds::newId()), "Infested Deepslate", new BlockTypeInfo(BlockBreakInfo::pickaxe(1.5, ToolTier::WOOD))));

		//https://github.com/pmmp/PocketMine-MP/projects/14#card-84464945
		self::register("powder_snow", new PowderSnow(new BlockIdentifier(BlockTypeIds::newId()), "Powder Snow", new BlockTypeInfo(BlockBreakInfo::instant())));

		//https://github.com/pmmp/PocketMine-MP/projects/14#card-84464917
		self::register("sculk_vein", new SculkVein(new BlockIdentifier(BlockTypeIds::newId()), "Sculk Vein", new BlockTypeInfo(new BlockBreakInfo(0.2, BlockToolType::HOE))));

		//https://github.com/pmmp/PocketMine-MP/projects/14#card-84464878
		self::register("crimson_nylium", new Nylium(new BlockIdentifier(BlockTypeIds::newId()), "Crimson Nylium", new BlockTypeInfo(BlockBreakInfo::shovel(0.6))));
		self::register("warped_nylium", new Nylium(new BlockIdentifier(BlockTypeIds::newId()), "Warped Nylium", new BlockTypeInfo(BlockBreakInfo::shovel(0.6))));
		self::register("nether_sprouts", new NetherSprouts(new BlockIdentifier(BlockTypeIds::newId()), "Nether Sprouts", new BlockTypeInfo(BlockBreakInfo::instant())));

		//https://github.com/pmmp/PocketMine-MP/projects/14#card-67670122
		self::register("campfire", new Campfire(new BlockIdentifier(BlockTypeIds::newId()), "Campfire", new BlockTypeInfo(BlockBreakInfo::axe(2))));
		self::register("soul_campfire", new Campfire(new BlockIdentifier(BlockTypeIds::newId()), "Soul Campfire", new BlockTypeInfo(BlockBreakInfo::axe(2))));

		//https://github.com/pmmp/PocketMine-MP/projects/14#column-4045854
		self::register("scaffolding", new Scaffolding(new BlockIdentifier(BlockTypeIds::newId()), "Scaffolding", new BlockTypeInfo(BlockBreakInfo::instant())));

		//https://github.com/pmmp/PocketMine-MP/projects/14#card-84464960
		self::register("honey_block", new Honey(new BlockIdentifier(BlockTypeIds::newId()), "Honey Block", new BlockTypeInfo(BlockBreakInfo::instant())));

		//https://github.com/pmmp/PocketMine-MP/projects/14#card-84464953
		self::register("mangrove_propagule", new MangrovePropagule(new BlockIdentifier(BlockTypeIds::newId()), "Mangrove Propagule", new BlockTypeInfo(BlockBreakInfo::instant())));

		//https://github.com/pmmp/PocketMine-MP/projects/14#card-84464949
		self::register("moss_block", new MossBlock(new BlockIdentifier(BlockTypeIds::newId()), "Moss Block", new BlockTypeInfo(BlockBreakInfo::pickaxe(0.1))));
		self::register("moss_carpet", new MossCarpet(new BlockIdentifier(BlockTypeIds::newId()), "Moss Carpet", new BlockTypeInfo(BlockBreakInfo::pickaxe(0.1))));

		//https://github.com/pmmp/PocketMine-MP/projects/14#card-84464947
		self::register("dripstone_block", new Dripstone(new BlockIdentifier(BlockTypeIds::newId()), "Dripstone Block", new BlockTypeInfo(BlockBreakInfo::pickaxe(1.5))));
		self::register("pointed_dripstone", new Dripstone(new BlockIdentifier(BlockTypeIds::newId()), "Pointed Dripstone", new BlockTypeInfo(BlockBreakInfo::pickaxe(1.5))));

		//https://github.com/pmmp/PocketMine-MP/projects/14#card-67670104
		self::register("composter", new Composter(new BlockIdentifier(BlockTypeIds::newId()), "Composter", new BlockTypeInfo(BlockBreakInfo::axe(0.6))));

		//https://github.com/pmmp/PocketMine-MP/projects/14#card-26498080
		self::register("turtle_egg", new SeaTurtleEgg(new BlockIdentifier(BlockTypeIds::newId()), "Sea Turtle Egg", new BlockTypeInfo(BlockBreakInfo::instant())));

		//https://github.com/pmmp/PocketMine-MP/projects/14#card-26498071
		self::register("seagrass", new Seagrass(new BlockIdentifier(BlockTypeIds::newId()), "Seagrass", new BlockTypeInfo(BlockBreakInfo::instant())));

		//BAMBOO - yeah ik this is not the right way
		self::register("bamboo_block", new BambooBlock(new BlockIdentifier(BlockTypeIds::newId()), "Block of Bamboo", new BlockTypeInfo(BlockBreakInfo::axe(2))));
		self::register("bamboo_button", new BambooButton(new BlockIdentifier(BlockTypeIds::newId()), "Bamboo Button", new BlockTypeInfo(BlockBreakInfo::axe(0.5))));
		self::register("bamboo_door", new BambooDoor(new BlockIdentifier(BlockTypeIds::newId()), "Bamboo Door", new BlockTypeInfo(BlockBreakInfo::pickaxe(2))));
		self::register("bamboo_fence", new BambooFence(new BlockIdentifier(BlockTypeIds::newId()), "Bamboo Fence", new BlockTypeInfo(BlockBreakInfo::pickaxe(2))));
		self::register("bamboo_fence_gate", new BambooFenceGate(new BlockIdentifier(BlockTypeIds::newId()), "Bamboo Fence Gate", new BlockTypeInfo(BlockBreakInfo::pickaxe(2)), WoodType::CHERRY()));
		self::register("bamboo_mosaic", new BambooMosaic(new BlockIdentifier(BlockTypeIds::newId()), "Bamboo Mosaic", new BlockTypeInfo(BlockBreakInfo::pickaxe(2))));
		self::register("bamboo_mosaic_slab", new BambooMosaicSlab(new BlockIdentifier(BlockTypeIds::newId()), "Bamboo Mosaic Slab", new BlockTypeInfo(BlockBreakInfo::pickaxe(2))));
		self::register("bamboo_mosaic_stairs", new BambooMosaicStairs(new BlockIdentifier(BlockTypeIds::newId()), "Bamboo Mosaic Stairs", new BlockTypeInfo(BlockBreakInfo::pickaxe(2))));
		self::register("bamboo_planks", new BambooPlanks(new BlockIdentifier(BlockTypeIds::newId()), "Bamboo Planks", new BlockTypeInfo(BlockBreakInfo::pickaxe(2)), WoodType::CHERRY()));
		self::register("bamboo_pressure_plate", new BambooPressurePlate(new BlockIdentifier(BlockTypeIds::newId()), "Bamboo Pressure Plate", new BlockTypeInfo(BlockBreakInfo::axe(0.5))));
		self::register("bamboo_sign", new BambooSign(new BlockIdentifier(BlockTypeIds::newId()), "Bamboo Sign", new BlockTypeInfo(BlockBreakInfo::axe(0.5))));
		self::register("bamboo_slab", new BambooSlab(new BlockIdentifier(BlockTypeIds::newId()), "Bamboo Slab", new BlockTypeInfo(BlockBreakInfo::axe(0.5))));
		self::register("bamboo_stairs", new BambooStairs(new BlockIdentifier(BlockTypeIds::newId()), "Bamboo Stairs", new BlockTypeInfo(BlockBreakInfo::axe(0.5))));
		self::register("bamboo_trapdoor", new BambooTrapdoor(new BlockIdentifier(BlockTypeIds::newId()), "Bamboo Trapdoor", new BlockTypeInfo(BlockBreakInfo::axe(0.5))));

		//SUSPICIOUS SAND & GRAVEL
		self::register("suspicious_sand", new SuspiciousBlock(new BlockIdentifier(BlockTypeIds::newId()), "Suspicious Sand", new BlockTypeInfo(BlockBreakInfo::shovel(0.25))));
		self::register("suspicious_gravel", new SuspiciousBlock(new BlockIdentifier(BlockTypeIds::newId()), "Suspicious Gravel", new BlockTypeInfo(BlockBreakInfo::shovel(0.25))));

		//TARGET
		self::register("target", new Target(new BlockIdentifier(BlockTypeIds::newId()), "Target", new BlockTypeInfo(BlockBreakInfo::shovel(0.5))));

		//DECORATED POT
	}
}