<?php

namespace kim\present\itempopup\command\subcommands;

use pocketmine\command\CommandSender;
use kim\present\itempopup\ItemPopup as Plugin;
use kim\present\itempopup\command\{
  PoolCommand, SubCommand
};

class ReloadSubCommand extends SubCommand{

    public function __construct(PoolCommand $owner){
        parent::__construct($owner, 'reload');
    }

    /**
     * @param CommandSender $sender
     * @param String[]      $args
     *
     * @return bool
     */
    public function onCommand(CommandSender $sender, array $args) : bool{
        $this->plugin->load();
        $sender->sendMessage(Plugin::$prefix . $this->translate('success'));

        return true;
    }
}