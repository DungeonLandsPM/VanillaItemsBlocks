<?php

declare(strict_types=1);

namespace dungeonlands\vanillaitemsblocks\block;

use dungeonlands\vanillaitemsblocks\block\utils\AttachmentType;
use pocketmine\block\Block;
use pocketmine\block\Transparent;
use pocketmine\block\utils\HorizontalFacingTrait;
use pocketmine\block\utils\SupportType;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\item\Item;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

final class Grindstone extends Transparent{
	use HorizontalFacingTrait;

	private AttachmentType $attachmentType = AttachmentType::FLOOR;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->enum($this->attachmentType);
		$w->horizontalFacing($this->facing);
	}

	protected function recalculateCollisionBoxes() : array{
		if($this->attachmentType === AttachmentType::FLOOR){
			return [
				AxisAlignedBB::one()->squash(Facing::axis($this->facing), 1 / 4)->trim(Facing::UP, 3 / 16)
			];
		}
		if($this->attachmentType === AttachmentType::CEILING){
			return [
				AxisAlignedBB::one()->contract(1 / 4, 0, 1 / 4)->trim(Facing::DOWN, 1 / 4)
			];
		}

		$box = AxisAlignedBB::one()
			->squash(Facing::axis(Facing::rotateY($this->facing, true)), 1 / 4)
			->trim(Facing::UP, 1 / 16)
			->trim(Facing::DOWN, 1 / 4);

		return [
			$this->attachmentType === AttachmentType::ONE_WALL ? $box->trim($this->facing, 3 / 16) : $box
		];
	}

	public function getSupportType(int $facing) : SupportType{
		return SupportType::NONE;
	}

	public function getAttachmentType() : AttachmentType{ return $this->attachmentType; }

	/** @return $this */
	public function setAttachmentType(AttachmentType $attachmentType) : self{
		$this->attachmentType = $attachmentType;
		return $this;
	}

	private function canBeSupportedAt(Block $block, int $face) : bool{
		return $block->getAdjacentSupportType($face) !== SupportType::NONE;
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if(!$this->canBeSupportedAt($blockReplace, Facing::opposite($face))){
			return false;
		}
		if($face === Facing::UP){
			if($player !== null){
				$this->setFacing(Facing::opposite($player->getHorizontalFacing()));
			}
			$this->setAttachmentType(AttachmentType::FLOOR);
		}elseif($face === Facing::DOWN){
			$this->setAttachmentType(AttachmentType::CEILING);
		}else{
			$this->setFacing($face);
			$this->setAttachmentType(
				$this->canBeSupportedAt($blockReplace, $face) ?
					AttachmentType::TWO_WALLS :
					AttachmentType::ONE_WALL
			);
		}
		return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
	}

	public function onNearbyBlockChange() : void{
		foreach(match($this->attachmentType){
			AttachmentType::CEILING => [Facing::UP],
			AttachmentType::FLOOR => [Facing::DOWN],
			AttachmentType::ONE_WALL => [Facing::opposite($this->facing)],
			AttachmentType::TWO_WALLS => [$this->facing, Facing::opposite($this->facing)]
		} as $supportBlockDirection){
			if(!$this->canBeSupportedAt($this, $supportBlockDirection)){
				$this->position->getWorld()->useBreakOn($this->position);
				break;
			}
		}
	}

	private function isValidFaceToRing(int $faceHit) : bool{
		return match($this->attachmentType){
			AttachmentType::CEILING => true,
			AttachmentType::FLOOR => Facing::axis($faceHit) === Facing::axis($this->facing),
			AttachmentType::ONE_WALL, AttachmentType::TWO_WALLS => $faceHit === Facing::rotateY($this->facing, false) || $faceHit === Facing::rotateY($this->facing, true),
		};
	}
}