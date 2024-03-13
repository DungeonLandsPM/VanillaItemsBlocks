<?php

declare(strict_types=1);

namespace dungeonlands\vanillaitemsblocks;

use pocketmine\block\Block;
use pocketmine\block\RuntimeBlockStateRegistry;
use pocketmine\block\VanillaBlocks;
use pocketmine\data\bedrock\block\BlockTypeNames;
use pocketmine\data\bedrock\item\ItemTypeNames;
use pocketmine\data\bedrock\item\SavedItemData;
use pocketmine\inventory\CreativeInventory;
use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\AsyncTask;
use pocketmine\world\format\io\GlobalBlockStateHandlers;
use pocketmine\world\format\io\GlobalItemDataHandlers;

/**
 * Currently every block has a own class, the reason is because I just speed up to register them and after that I wanna add all features.
 */
class VanillaLoader extends PluginBase{

	public function onEnable() : void{
		self::registerBlocks();
		self::registerItems();

		$this->getServer()->getAsyncPool()->addWorkerStartHook(function(int $worker) : void{
			$this->getServer()->getAsyncPool()->submitTaskToWorker(new class extends AsyncTask{
				public function onRun() : void{
					VanillaLoader::registerBlocks();
					VanillaLoader::registerItems();
				}
			}, $worker);
		});
	}

	public static function registerBlocks() : void{
		self::registerSimpleBlock(BlockTypeNames::TARGET, ExtraVanillaBlocks::TARGET(), ["target"]);
		self::registerSimpleBlock(BlockTypeNames::BEEHIVE, ExtraVanillaBlocks::BEEHIVE(), ["beehive"]);
		self::registerSimpleBlock(BlockTypeNames::BEE_NEST, ExtraVanillaBlocks::BEE_NEST(), ["bee_nest"]);
		self::registerSimpleBlock(BlockTypeNames::BUBBLE_COLUMN, ExtraVanillaBlocks::BUBBLE_COLUMN(), ["bubble_column"]);
		self::registerSimpleBlock(BlockTypeNames::CAMPFIRE, ExtraVanillaBlocks::CAMPFIRE(), ["campfire"]);
		self::registerSimpleBlock(BlockTypeNames::SOUL_CAMPFIRE, ExtraVanillaBlocks::SOUL_CAMPFIRE(), ["soul_campfire"]);
		self::registerSimpleBlock(BlockTypeNames::COMPOSTER, ExtraVanillaBlocks::COMPOSTER(), ["composter"]);
		self::registerSimpleBlock(BlockTypeNames::CRIMSON_NYLIUM, ExtraVanillaBlocks::CRIMSON_NYLIUM(), ["crimson_nylium"]);
		self::registerSimpleBlock(BlockTypeNames::DRIPSTONE_BLOCK, ExtraVanillaBlocks::DRIPSTONE_BLOCK(), ["dripstone_block"]);
		self::registerSimpleBlock(BlockTypeNames::POINTED_DRIPSTONE, ExtraVanillaBlocks::POINTED_DRIPSTONE(), ["pointed_dripstone"]);
		self::registerSimpleBlock(BlockTypeNames::GRINDSTONE, ExtraVanillaBlocks::GRINDSTONE(), ["grindstone"]);
		self::registerSimpleBlock(BlockTypeNames::HONEY_BLOCK, ExtraVanillaBlocks::HONEY_BLOCK(), ["honey_block"]);
		self::registerSimpleBlock(BlockTypeNames::INFESTED_DEEPSLATE, ExtraVanillaBlocks::INFESTED_DEEPSLATE(), ["infested_deepslate"]);
		self::registerSimpleBlock(BlockTypeNames::LODESTONE, ExtraVanillaBlocks::LODESTONE(), ["lodestone"]);
		self::registerSimpleBlock(BlockTypeNames::MANGROVE_PROPAGULE, ExtraVanillaBlocks::MANGROVE_PROPAGULE(), ["mangrove_propagule"]);
		self::registerSimpleBlock(BlockTypeNames::MOSS_BLOCK, ExtraVanillaBlocks::MOSS_BLOCK(), ["moss_block"]);
		self::registerSimpleBlock(BlockTypeNames::MOSS_CARPET, ExtraVanillaBlocks::MOSS_CARPET(), ["moss_carpet"]);
		self::registerSimpleBlock(BlockTypeNames::NETHER_SPROUTS, ExtraVanillaBlocks::NETHER_SPROUTS(), ["nether_sprouts"]);
		self::registerSimpleBlock(BlockTypeNames::POWDER_SNOW, ExtraVanillaBlocks::POWDER_SNOW(), ["powder_snow"]);
		self::registerSimpleBlock(BlockTypeNames::SCAFFOLDING, ExtraVanillaBlocks::SCAFFOLDING(), ["scaffolding"]);
		self::registerSimpleBlock(BlockTypeNames::SCULK_VEIN, ExtraVanillaBlocks::SCULK_VEIN(), ["sculk_vein"]);
		self::registerSimpleBlock(BlockTypeNames::TURTLE_EGG, ExtraVanillaBlocks::TURTLE_EGG(), ["turtle_egg"]);
		self::registerSimpleBlock(BlockTypeNames::SEAGRASS, ExtraVanillaBlocks::SEAGRASS(), ["seagrass"]);
		self::registerSimpleBlock(BlockTypeNames::STRUCTURE_VOID, ExtraVanillaBlocks::STRUCTURE_VOID(), ["structure_void"]);
		self::registerSimpleBlock(BlockTypeNames::SUSPICIOUS_GRAVEL, ExtraVanillaBlocks::SUSPICIOUS_GRAVEL(), ["suspicious_gravel"]);
		self::registerSimpleBlock(BlockTypeNames::SUSPICIOUS_SAND, ExtraVanillaBlocks::SUSPICIOUS_SAND(), ["suspicious_sand"]);
		self::registerSimpleBlock(BlockTypeNames::WARPED_NYLIUM, ExtraVanillaBlocks::WARPED_NYLIUM(), ["warped_nylium"]);

		self::registerSimpleBlock(BlockTypeNames::BAMBOO_BLOCK, ExtraVanillaBlocks::BAMBOO_BLOCK(), ["bamboo_block"]);
		self::registerSimpleBlock(BlockTypeNames::BAMBOO_BUTTON, ExtraVanillaBlocks::BAMBOO_BUTTON(), ["bamboo_button"]);
		self::registerSimpleBlock(BlockTypeNames::BAMBOO_PRESSURE_PLATE, ExtraVanillaBlocks::BAMBOO_PRESSURE_PLATE(), ["bamboo_pressure_plate"]);
		self::registerSimpleBlock(BlockTypeNames::BAMBOO_STANDING_SIGN, ExtraVanillaBlocks::BAMBOO_SIGN(), ["bamboo_sign"]);
		self::registerSimpleBlock(BlockTypeNames::BAMBOO_SLAB, ExtraVanillaBlocks::BAMBOO_SLAB(), ["bamboo_slab"]);
		self::registerSimpleBlock(BlockTypeNames::BAMBOO_STAIRS, ExtraVanillaBlocks::BAMBOO_STAIRS(), ["bamboo_stairs"]);
		self::registerSimpleBlock(BlockTypeNames::BAMBOO_TRAPDOOR, ExtraVanillaBlocks::BAMBOO_TRAPDOOR(), ["bamboo_trapdoor"]);
		self::registerSimpleBlock(BlockTypeNames::BAMBOO_WALL_SIGN, ExtraVanillaBlocks::BAMBOO_WALL_SIGN(), ["bamboo_wall_sign"]);
		self::registerSimpleBlock(BlockTypeNames::BAMBOO_DOOR, ExtraVanillaBlocks::BAMBOO_DOOR(), ["bamboo_door"]);
		self::registerSimpleBlock(BlockTypeNames::BAMBOO_FENCE, ExtraVanillaBlocks::BAMBOO_FENCE(), ["bamboo_fence"]);
		self::registerSimpleBlock(BlockTypeNames::BAMBOO_FENCE_GATE, ExtraVanillaBlocks::BAMBOO_FENCE_GATE(), ["bamboo_fence_gate"]);
		self::registerSimpleBlock(BlockTypeNames::BAMBOO_MOSAIC, ExtraVanillaBlocks::BAMBOO_MOSAIC(), ["bamboo_mosaic"]);
		self::registerSimpleBlock(BlockTypeNames::BAMBOO_MOSAIC_SLAB, ExtraVanillaBlocks::BAMBOO_MOSAIC_SLAB(), ["bamboo_mosaic_slab"]);
		self::registerSimpleBlock(BlockTypeNames::BAMBOO_MOSAIC_STAIRS, ExtraVanillaBlocks::BAMBOO_MOSAIC_STAIRS(), ["bamboo_mosaic_stairs"]);
		self::registerSimpleBlock(BlockTypeNames::BAMBOO_PLANKS, ExtraVanillaBlocks::BAMBOO_PLANKS(), ["bamboo_planks"]);
	}

	public static function registerItems() : void{
		self::registerSimpleItem(ItemTypeNames::IRON_HORSE_ARMOR, ExtraVanillaItems::IRON_HORSE_ARMOR(), ["iron_horse_armor"]);
	}

	/**
	 * @param string[] $stringToItemParserNames
	 */
	private static function registerSimpleBlock(string $id, Block $block, array $stringToItemParserNames) : void{
		RuntimeBlockStateRegistry::getInstance()->register($block);

		GlobalBlockStateHandlers::getDeserializer()->mapSimple($id, fn() => clone $block);
		GlobalBlockStateHandlers::getSerializer()->mapSimple($block, $id);

		foreach($stringToItemParserNames as $name){
			StringToItemParser::getInstance()->registerBlock($name, fn() => clone $block);
		}
	}

	/**
	 * @param string[] $stringToItemParserNames
	 */
	private static function registerSimpleItem(string $id, Item $item, array $stringToItemParserNames) : void{
		GlobalItemDataHandlers::getDeserializer()->map($id, fn() => clone $item);
		GlobalItemDataHandlers::getSerializer()->map($item, fn() => new SavedItemData($id));

		foreach($stringToItemParserNames as $name){
			StringToItemParser::getInstance()->register($name, fn() => clone $item);
		}
	}
}