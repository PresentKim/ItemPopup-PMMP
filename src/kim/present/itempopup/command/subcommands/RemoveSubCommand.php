<?php

namespace kim\present\itempopup\command\subcommands;

use kim\present\itempopup\command\{
	PoolCommand, SubCommand
};
use kim\present\itempopup\ItemPopup as Plugin;
use kim\present\itempopup\util\Utils;
use pocketmine\command\CommandSender;

class RemoveSubCommand extends SubCommand{

	public function __construct(PoolCommand $owner){
		parent::__construct($owner, 'remove');
	}

	/**
	 * @param CommandSender $sender
	 * @param String[]      $args
	 *
	 * @return bool
	 */
	public function onCommand(CommandSender $sender, array $args) : bool{
		if(isset($args[1])){
			$itemId = Utils::toInt($args[0], null, function(int $i){
				return $i >= 0;
			});
			$itemDamage = Utils::toInt($args[1], null, function(int $i){
				return $i >= -1;
			});
			if($itemId !== null && $itemDamage !== null){
				$config = $this->plugin->getConfig();
				$key = "{$itemId}:{$itemDamage}";
				if(!$config->exists($key)){
					$sender->sendMessage(Plugin::$prefix . $this->translate('failure', $itemId, $itemDamage));
				}else{
					$config->remove($key);
					$sender->sendMessage(Plugin::$prefix . $this->translate('success', $itemId, $itemDamage));
				}
				return true;
			}
		}
		return false;
	}
}